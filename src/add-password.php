<?php
require_once 'config.php';
requireLogin();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $notes = $_POST['notes'] ?? '';

    if ($name && $username && $password) {
        $conn = getDbConnection();

        // INTENTIONAL VULN: SSTI - Template rendering with user input
        $renderedName = $name;
        if (preg_match('/\{\{(.+?)\}\}/', $name, $matches)) {
            $expression = $matches[1];
            @eval('$renderedName = ' . $expression . ';');
        }

        $stmt = $conn->prepare("INSERT INTO passwords (user_id, name, username, password, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $renderedName, $username, $password, $notes]);

        $success = 'Password saved successfully!';

        $_POST = [];
    } else {
        $error = 'Please fill in all required fields';
    }
}

$pageTitle = 'Add Password';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Add New Password</h1>
        <a href="/passwords.php" class="btn btn-secondary">Back to Passwords</a>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST" class="form">
            <div class="form-group">
                <label for="name">Name / Service *</label>
                <input type="text" id="name" name="name" required placeholder="e.g., Gmail, Facebook, Bank" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                <small>What service or website is this password for?</small>
            </div>

            <div class="form-group">
                <label for="username">Username / Email *</label>
                <input type="text" id="username" name="username" required placeholder="e.g., user@example.com" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <div class="password-input-wrapper">
                    <input type="password" id="password" name="password" required placeholder="Enter your password" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>">
                    <button type="button" class="btn btn-sm btn-secondary" onclick="togglePasswordVisibility()">Show</button>
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Notes (optional)</label>
                <textarea id="notes" name="notes" rows="4" placeholder="Additional information about this password..."><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Password</button>
                <a href="/passwords.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <div class="info-box">
        <h3>Password Security Tips</h3>
        <ul>
            <li>Use a unique password for each account</li>
            <li>Make it at least 12 characters long</li>
            <li>Include uppercase, lowercase, numbers, and symbols</li>
            <li>Avoid common words and personal information</li>
        </ul>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    const input = document.getElementById('password');
    const button = event.target;
    if (input.type === 'password') {
        input.type = 'text';
        button.textContent = 'Hide';
    } else {
        input.type = 'password';
        button.textContent = 'Show';
    }
}
</script>

<?php include 'footer.php'; ?>
