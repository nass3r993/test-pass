<?php
require_once 'config.php';

$pageTitle = 'Password Security Tips';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Password Security Tips</h1>
        <p>Best practices for creating and managing strong passwords</p>
    </div>

    <div class="tips-grid">
        <div class="tip-card">
            <div class="tip-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <h2>Use Strong Passwords</h2>
            <p>Create passwords that are at least 12 characters long and include a mix of uppercase letters, lowercase letters, numbers, and special characters. Avoid using common words, names, or dates.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <h2>Unique for Every Account</h2>
            <p>Never reuse passwords across different accounts. If one account is compromised, using unique passwords ensures your other accounts remain secure.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <h2>Change Regularly</h2>
            <p>Update your passwords periodically, especially for sensitive accounts like email, banking, and social media. Consider changing passwords every 3-6 months.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2a5 5 0 0 0-5 5v3H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-2V7a5 5 0 0 0-5-5z"></path>
                </svg>
            </div>
            <h2>Enable Two-Factor Authentication</h2>
            <p>Add an extra layer of security by enabling two-factor authentication (2FA) wherever possible. This requires a second form of verification beyond just your password.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <h2>Beware of Phishing</h2>
            <p>Never enter your password on suspicious websites or click links in unexpected emails. Always verify the URL and ensure you're on the legitimate site before entering credentials.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </div>
            <h2>Keep Passwords Private</h2>
            <p>Never share your passwords with anyone, even friends or family. If you need to share access to an account, use secure sharing features provided by password managers.</p>
        </div>
    </div>

    <div class="section">
        <h2>Password Strength Examples</h2>
        <div class="example-grid">
            <div class="example-box weak">
                <h3>Weak ❌</h3>
                <code>password123</code>
                <p>Too common and predictable</p>
            </div>
            <div class="example-box medium">
                <h3>Better ⚠️</h3>
                <code>MyD0g2023</code>
                <p>Better but still guessable</p>
            </div>
            <div class="example-box strong">
                <h3>Strong ✅</h3>
                <code>vK9#mL2$pR7&wN3!</code>
                <p>Random, long, and complex</p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
