<?php
require_once 'config.php';
requireLogin();

$success = '';
$error = '';
$importCount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['import_file'])) {
    $file = $_FILES['import_file'];

    if ($file['error'] === 0) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExtension === 'xml') {
            // INTENTIONAL VULN: XXE - XML External Entity injection vulnerability
            libxml_disable_entity_loader(false);
            $dom = new DOMDocument();
            $dom->loadXML(file_get_contents($fileTmpName), LIBXML_NOENT | LIBXML_DTDLOAD);

            $passwords = $dom->getElementsByTagName('password');
            $conn = getDbConnection();

            foreach ($passwords as $password) {
                $name = $password->getElementsByTagName('name')->item(0)->nodeValue;
                $username = $password->getElementsByTagName('username')->item(0)->nodeValue;
                $pwd = $password->getElementsByTagName('value')->item(0)->nodeValue;
                $notes = $password->getElementsByTagName('notes')->item(0) ? $password->getElementsByTagName('notes')->item(0)->nodeValue : '';

                if ($name && $username && $pwd) {
                    $stmt = $conn->prepare("INSERT INTO passwords (user_id, name, username, password, notes) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$_SESSION['user_id'], $name, $username, $pwd, $notes]);
                    $importCount++;
                }
            }

            $success = "Successfully imported $importCount passwords!";
        } elseif ($fileExtension === 'csv') {
            // INTENTIONAL VULN: XXE via CSV to XML conversion
            $csvData = file_get_contents($fileTmpName);
            $lines = explode("\n", $csvData);
            $conn = getDbConnection();

            $xml = '<?xml version="1.0" encoding="UTF-8"?><passwords>';
            foreach ($lines as $index => $line) {
                if ($index === 0 || empty(trim($line))) continue;

                $data = str_getcsv($line);
                if (count($data) >= 3) {
                    $xml .= '<password>';
                    $xml .= '<name>' . $data[0] . '</name>';
                    $xml .= '<username>' . $data[1] . '</username>';
                    $xml .= '<value>' . $data[2] . '</value>';
                    $xml .= '<notes>' . ($data[3] ?? '') . '</notes>';
                    $xml .= '</password>';
                }
            }
            $xml .= '</passwords>';

            libxml_disable_entity_loader(false);
            $dom = new DOMDocument();
            $dom->loadXML($xml, LIBXML_NOENT | LIBXML_DTDLOAD);

            $passwords = $dom->getElementsByTagName('password');

            foreach ($passwords as $password) {
                $name = $password->getElementsByTagName('name')->item(0)->nodeValue;
                $username = $password->getElementsByTagName('username')->item(0)->nodeValue;
                $pwd = $password->getElementsByTagName('value')->item(0)->nodeValue;
                $notes = $password->getElementsByTagName('notes')->item(0)->nodeValue;

                if ($name && $username && $pwd) {
                    $stmt = $conn->prepare("INSERT INTO passwords (user_id, name, username, password, notes) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$_SESSION['user_id'], $name, $username, $pwd, $notes]);
                    $importCount++;
                }
            }

            $success = "Successfully imported $importCount passwords!";
        } else {
            $error = 'Invalid file format. Please upload CSV or XML files only.';
        }
    } else {
        $error = 'Error uploading file';
    }
}

$pageTitle = 'Import Passwords';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Import Passwords</h1>
        <p>Bulk import passwords from CSV or XML files</p>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="import-container">
        <div class="import-box">
            <form method="POST" enctype="multipart/form-data" class="form">
                <div class="form-group">
                    <label for="import_file">Select File</label>
                    <input type="file" id="import_file" name="import_file" accept=".csv,.xml" required>
                    <small>Supported formats: CSV, XML (max 5MB)</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Import Passwords</button>
                    <a href="/dashboard.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div class="import-info">
            <h3>File Format Requirements</h3>

            <h4>CSV Format</h4>
            <pre class="code-block">name,username,password,notes
Gmail,john@gmail.com,MyPass123,Personal email
Facebook,johndoe,SocialPass456,Social media</pre>

            <h4>XML Format</h4>
            <pre class="code-block">&lt;?xml version="1.0"?&gt;
&lt;passwords&gt;
  &lt;password&gt;
    &lt;name&gt;Gmail&lt;/name&gt;
    &lt;username&gt;john@gmail.com&lt;/username&gt;
    &lt;value&gt;MyPass123&lt;/value&gt;
    &lt;notes&gt;Personal email&lt;/notes&gt;
  &lt;/password&gt;
&lt;/passwords&gt;</pre>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
