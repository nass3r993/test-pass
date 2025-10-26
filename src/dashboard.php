<?php
require_once 'config.php';
requireLogin();

$user = getCurrentUser();
$conn = getDbConnection();

$stmt = $conn->prepare("SELECT COUNT(*) as count FROM passwords WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$passwordCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

$stmt = $conn->prepare("SELECT COUNT(*) as count FROM login_history WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$loginCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

$stmt = $conn->prepare("SELECT * FROM passwords WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$stmt->execute([$_SESSION['user_id']]);
$recentPasswords = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Dashboard';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Welcome back, <?php echo htmlspecialchars($user['full_name']); ?></h1>
        <p>Here's an overview of your FortiPass account</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <div class="stat-content">
                <h3><?php echo $passwordCount; ?></h3>
                <p>Saved Passwords</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <div class="stat-content">
                <h3>Protected</h3>
                <p>Account Security</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2v20M2 12h20"></path>
                </svg>
            </div>
            <div class="stat-content">
                <h3><?php echo $loginCount; ?></h3>
                <p>Login Sessions</p>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <h2>Recent Passwords</h2>
            <a href="/passwords.php" class="btn btn-secondary">View All</a>
        </div>

        <?php if (count($recentPasswords) > 0): ?>
            <div class="password-list">
                <?php foreach ($recentPasswords as $pwd): ?>
                    <div class="password-item">
                        <div class="password-info">
                            <h3><?php echo htmlspecialchars($pwd['name']); ?></h3>
                            <p><?php echo htmlspecialchars($pwd['username']); ?></p>
                        </div>
                        <div class="password-actions">
                            <button class="btn btn-sm" onclick="copyPassword('<?php echo htmlspecialchars($pwd['password']); ?>')">Copy</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>No passwords saved yet. <a href="/add-password.php">Add your first password</a></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="section">
        <div class="section-header">
            <h2>Quick Actions</h2>
        </div>
        <div class="action-grid">
            <a href="/add-password.php" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <h3>Add Password</h3>
                <p>Save a new password</p>
            </a>
            <a href="/import.php" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                <h3>Import Passwords</h3>
                <p>Bulk import from file</p>
            </a>
            <a href="/tips.php" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <h3>Security Tips</h3>
                <p>Learn best practices</p>
            </a>
        </div>
    </div>
</div>

<script>
function copyPassword(password) {
    navigator.clipboard.writeText(password).then(() => {
        alert('Password copied to clipboard!');
    });
}
</script>

<?php include 'footer.php'; ?>
