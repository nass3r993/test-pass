<?php
require_once 'config.php';
requireLogin();

$conn = getDbConnection();
$stmt = $conn->prepare("SELECT * FROM settings WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$settings) {
    $stmt = $conn->prepare("INSERT INTO settings (user_id) VALUES (?)");
    $stmt->execute([$_SESSION['user_id']]);
    $settings = ['theme' => 'light', 'two_factor_enabled' => 0, 'email_notifications' => 1];
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = $_POST['theme'] ?? 'light';
    $twoFactor = isset($_POST['two_factor_enabled']) ? 1 : 0;
    $emailNotifications = isset($_POST['email_notifications']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE settings SET theme = ?, two_factor_enabled = ?, email_notifications = ? WHERE user_id = ?");
    $stmt->execute([$theme, $twoFactor, $emailNotifications, $_SESSION['user_id']]);

    $success = 'Settings saved successfully!';
    $settings['theme'] = $theme;
    $settings['two_factor_enabled'] = $twoFactor;
    $settings['email_notifications'] = $emailNotifications;
}

$pageTitle = 'Settings';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Settings</h1>
        <p>Customize your FortiPass experience</p>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <div class="settings-container">
        <form method="POST" class="form">
            <div class="settings-section">
                <h2>Appearance</h2>
                <div class="form-group">
                    <label for="theme">Theme</label>
                    <select id="theme" name="theme" class="form-select">
                        <option value="light" <?php echo $settings['theme'] === 'light' ? 'selected' : ''; ?>>Light</option>
                        <option value="dark" <?php echo $settings['theme'] === 'dark' ? 'selected' : ''; ?>>Dark</option>
                        <option value="auto" <?php echo $settings['theme'] === 'auto' ? 'selected' : ''; ?>>Auto</option>
                    </select>
                </div>
            </div>

            <div class="settings-section">
                <h2>Security</h2>
                <div class="form-group-checkbox">
                    <label>
                        <input type="checkbox" name="two_factor_enabled" <?php echo $settings['two_factor_enabled'] ? 'checked' : ''; ?>>
                        <span>Enable Two-Factor Authentication</span>
                    </label>
                    <small>Add an extra layer of security to your account</small>
                </div>
            </div>

            <div class="settings-section">
                <h2>Notifications</h2>
                <div class="form-group-checkbox">
                    <label>
                        <input type="checkbox" name="email_notifications" <?php echo $settings['email_notifications'] ? 'checked' : ''; ?>>
                        <span>Email Notifications</span>
                    </label>
                    <small>Receive security alerts and updates via email</small>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
