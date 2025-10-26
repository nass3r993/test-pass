<?php
require_once 'config.php';
requireLogin();

$conn = getDbConnection();
$search = $_GET['q'] ?? '';

if ($search) {
    // INTENTIONAL VULN: SQL Injection - Direct concatenation of user input
    $query = "SELECT * FROM passwords WHERE user_id = " . $_SESSION['user_id'] . " AND (name LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%')";
    $stmt = $conn->query($query);
    $passwords = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare("SELECT * FROM passwords WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $passwords = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$pageTitle = 'Passwords';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Your Passwords</h1>
        <a href="/add-password.php" class="btn btn-primary">Add New Password</a>
    </div>

    <div class="search-bar">
        <form method="GET" class="search-form">
            <input type="text" name="q" placeholder="Search passwords..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
            <?php if ($search): ?>
                <a href="/passwords.php" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if (count($passwords) > 0): ?>
        <div class="password-list">
            <?php foreach ($passwords as $pwd): ?>
                <div class="password-item-card">
                    <div class="password-card-header">
                        <h3><?php echo htmlspecialchars($pwd['name']); ?></h3>
                        <div class="password-actions">
                            <button class="btn btn-sm btn-secondary" onclick="togglePassword(<?php echo $pwd['id']; ?>)">Show</button>
                            <button class="btn btn-sm btn-primary" onclick="copyPassword('<?php echo htmlspecialchars($pwd['password']); ?>')">Copy</button>
                        </div>
                    </div>
                    <div class="password-card-body">
                        <div class="password-field">
                            <label>Username</label>
                            <p><?php echo htmlspecialchars($pwd['username']); ?></p>
                        </div>
                        <div class="password-field">
                            <label>Password</label>
                            <p id="pwd-<?php echo $pwd['id']; ?>" class="password-hidden">••••••••</p>
                        </div>
                        <?php if ($pwd['notes']): ?>
                            <div class="password-field">
                                <label>Notes</label>
                                <p><?php echo htmlspecialchars($pwd['notes']); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="password-meta">
                            <small>Added on <?php echo date('M d, Y', strtotime($pwd['created_at'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <h2>No passwords found</h2>
            <p><?php echo $search ? 'Try a different search term' : 'Start by adding your first password'; ?></p>
            <a href="/add-password.php" class="btn btn-primary">Add Password</a>
        </div>
    <?php endif; ?>
</div>

<script>
const passwordData = <?php echo json_encode(array_column($passwords, 'password', 'id')); ?>;

function togglePassword(id) {
    const elem = document.getElementById('pwd-' + id);
    if (elem.classList.contains('password-hidden')) {
        elem.textContent = passwordData[id];
        elem.classList.remove('password-hidden');
        event.target.textContent = 'Hide';
    } else {
        elem.textContent = '••••••••';
        elem.classList.add('password-hidden');
        event.target.textContent = 'Show';
    }
}

function copyPassword(password) {
    navigator.clipboard.writeText(password).then(() => {
        alert('Password copied to clipboard!');
    });
}
</script>

<?php include 'footer.php'; ?>
