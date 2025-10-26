<?php
require_once 'config.php';
requireLogin();

$user = getCurrentUser();
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $fullName = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? '';

        if ($fullName && $email) {
            $conn = getDbConnection();
            $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
            $stmt->execute([$fullName, $email, $_SESSION['user_id']]);
            $success = 'Profile updated successfully!';
            $user = getCurrentUser();
        } else {
            $error = 'Please fill in all fields';
        }
    }

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $file = $_FILES['profile_image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];

        // INTENTIONAL VULN: File Upload - Allows .phtml extension and uses original filename
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'phtml'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileSize < 5000000) {
                $uploadDir = '/var/www/html/uploads/profile_images/';
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $conn = getDbConnection();
                    $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
                    $stmt->execute([$fileName, $_SESSION['user_id']]);
                    $success = 'Profile image updated successfully!';
                    $user = getCurrentUser();
                } else {
                    $error = 'Failed to upload file';
                }
            } else {
                $error = 'File is too large (max 5MB)';
            }
        } else {
            $error = 'Invalid file type';
        }
    }
}

$pageTitle = 'Profile';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Your Profile</h1>
        <p>Manage your account information</p>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="profile-container">
        <div class="profile-sidebar">
            <div class="profile-image-section">
                <?php if ($user['profile_image']): ?>
                    <img src="/uploads/profile_images/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" class="profile-image">
                <?php else: ?>
                    <div class="profile-image-placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="upload-form">
                    <input type="file" name="profile_image" id="profile_image" accept="image/*" style="display: none;">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('profile_image').click()">
                        Change Photo
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" id="upload-btn" style="display: none;">
                        Upload
                    </button>
                </form>
            </div>

            <div class="profile-info">
                <h3><?php echo htmlspecialchars($user['full_name']); ?></h3>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
                <small>Member since <?php echo date('M Y', strtotime($user['created_at'])); ?></small>
            </div>
        </div>

        <div class="profile-main">
            <h2>Account Information</h2>
            <form method="POST" class="form">
                <input type="hidden" name="update_profile" value="1">

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required value="<?php echo htmlspecialchars($user['full_name']); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('profile_image').addEventListener('change', function() {
    if (this.files.length > 0) {
        document.getElementById('upload-btn').style.display = 'inline-block';
    }
});
</script>

<?php include 'footer.php'; ?>
