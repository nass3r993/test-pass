<?php
require_once 'config.php';
requireLogin();

$conn = getDbConnection();
$stmt = $conn->prepare("SELECT * FROM login_history WHERE user_id = ? ORDER BY login_time DESC");
$stmt->execute([$_SESSION['user_id']]);
$history = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Login History';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Login History</h1>
        <p>View your recent account activity</p>
    </div>

    <?php if (count($history) > 0): ?>
        <div class="history-list">
            <?php foreach ($history as $entry): ?>
                <div class="history-item">
                    <div class="history-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                    </div>
                    <div class="history-content">
                        <h3>Successful Login</h3>
                        <div class="history-details">
                            <p><strong>Time:</strong> <?php echo date('M d, Y \a\t g:i A', strtotime($entry['login_time'])); ?></p>
                            <p><strong>IP Address:</strong> <?php echo htmlspecialchars($entry['ip_address']); ?></p>
                            <!-- INTENTIONAL VULN: Stored XSS - User-Agent displayed without sanitization -->
                            <p><strong>Device:</strong> <?php echo $entry['user_agent']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <h2>No login history</h2>
            <p>Your login activity will appear here</p>
        </div>
    <?php endif; ?>

    <div class="info-box">
        <h3>Security Notice</h3>
        <p>If you notice any suspicious activity or unrecognized logins, please change your password immediately and contact support.</p>
    </div>
</div>

<?php include 'footer.php'; ?>
