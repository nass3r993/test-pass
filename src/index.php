<?php
require_once 'config.php';

if (isLoggedIn()) {
    header('Location: /dashboard.php');
    exit;
}

$pageTitle = 'Home';
include 'header.php';
?>

<style>
.hero-section {
    text-align: center;
    padding: 4rem 2rem;
    max-width: 900px;
    margin: 0 auto;
}

.hero-section h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.hero-section p {
    font-size: 1.25rem;
    color: var(--text-secondary);
    margin-bottom: 2.5rem;
    line-height: 1.8;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.features-section {
    padding: 4rem 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.features-section h2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 3rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: var(--surface-color);
    padding: 2rem;
    border-radius: 20px;
    border: 1px solid var(--border-color);
    text-align: center;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-color);
}

.feature-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--bg-primary);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.feature-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.feature-card p {
    color: var(--text-secondary);
    line-height: 1.7;
}

.cta-section {
    text-align: center;
    padding: 4rem 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.cta-section h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.cta-section p {
    font-size: 1.25rem;
    color: var(--text-secondary);
    margin-bottom: 2rem;
}

@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem;
    }

    .features-section h2,
    .cta-section h2 {
        font-size: 2rem;
    }
}
</style>

<div class="hero-section">
    <h1>Secure Your Digital Life</h1>
    <p>FortiPass is a modern password manager that keeps your credentials safe and accessible. One master password to rule them all.</p>
    <div class="hero-buttons">
        <a href="/register.php" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1.125rem;">Get Started Free</a>
        <a href="/tips.php" class="btn btn-secondary" style="padding: 1rem 2.5rem; font-size: 1.125rem;">Learn More</a>
    </div>
</div>

<div class="features-section">
    <h2>Why Choose FortiPass?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <h3>Encrypted Storage</h3>
            <p>Your passwords are encrypted with industry-standard security protocols to keep them safe from unauthorized access.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <h3>Secure Access</h3>
            <p>Access your passwords from anywhere with confidence. Your data is protected with advanced security features.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                </svg>
            </div>
            <h3>Easy Import</h3>
            <p>Import passwords from other password managers or CSV files. Migrating to FortiPass is simple and quick.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
            <h3>Password Health</h3>
            <p>Get insights into your password security. Identify weak or reused passwords and improve your security posture.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
            </div>
            <h3>Browser Integration</h3>
            <p>Seamlessly integrate with your browser for quick access to your passwords. Autofill credentials with ease.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 6v6l4 2"></path>
                </svg>
            </div>
            <h3>Login History</h3>
            <p>Track your login activity and monitor access to your account. Stay informed about when and where you sign in.</p>
        </div>
    </div>
</div>

<div class="cta-section">
    <h2>Ready to Get Started?</h2>
    <p>Join thousands of users who trust FortiPass to keep their passwords secure.</p>
    <a href="/register.php" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1.125rem;">Create Your Account</a>
</div>

<?php include 'footer.php'; ?>
