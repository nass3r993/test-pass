<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>FortiPass</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="4" y="10" width="24" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                    <circle cx="16" cy="19" r="3" fill="currentColor"/>
                    <path d="M10 10V8C10 5.79086 11.7909 4 14 4H18C20.2091 4 22 5.79086 22 8V10" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <span>FortiPass</span>
            </a>

            <?php if (isLoggedIn()): ?>
            <div class="nav-links">
                <a href="/dashboard.php" class="nav-link">Dashboard</a>
                <a href="/passwords.php" class="nav-link">Passwords</a>
                <a href="/add-password.php" class="nav-link">Add Password</a>
                <a href="/tips.php" class="nav-link">Tips</a>
                <a href="/profile.php" class="nav-link">Profile</a>
                <a href="/settings.php" class="nav-link">Settings</a>
                <a href="/login-history.php" class="nav-link">Login History</a>
                <a href="/logout.php" class="nav-link logout-link">Logout</a>
            </div>
            <?php else: ?>
            <div class="nav-links">
                <a href="/tips.php" class="nav-link">Tips</a>
                <a href="/login.php" class="nav-link">Login</a>
                <a href="/register.php" class="btn btn-primary btn-sm">Get Started</a>
            </div>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main-content">
