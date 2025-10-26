# FortiPass - Intentionally Vulnerable Password Manager

⚠️ **SECURITY WARNING: FOR EDUCATIONAL PURPOSES ONLY** ⚠️

This is an intentionally vulnerable password manager application designed for security training, CTF competitions, and penetration testing practice. **DO NOT deploy this application to production or any publicly accessible environment.**

## Purpose

FortiPass is a deliberately insecure PHP web application that demonstrates common web vulnerabilities. It is intended for:

- Security training and education
- Capture The Flag (CTF) competitions
- Penetration testing practice
- Learning secure coding practices by understanding what NOT to do

## Requirements

- Docker
- Docker Compose

## Quick Start

1. Clone this repository
2. Navigate to the project directory
3. Start the application:

```bash
docker compose up --build
```

4. Access the application at: `http://localhost:8080`
5. Wait 30-60 seconds for the database to initialize on first run

## Default Credentials

Use these credentials to log in:

- **Email:** `user@example.com`
- **Password:** `password` (bcrypt hash is pre-seeded in database)

## Application Features

- User authentication and session management
- Password storage and management
- Password search functionality
- Bulk password import (CSV/XML)
- Profile management with image upload
- Login history tracking
- Security tips page
- Settings management

## Intentional Vulnerabilities

This application contains the following **intentional security vulnerabilities**:

### 1. SQL Injection (SQLi)
**Location:** `src/passwords.php` (search functionality)

The password search feature uses direct string concatenation with user input, allowing SQL injection attacks.

**PoC Hint:**
```
Search query: ' OR 1=1 --
```

### 2. XML External Entity (XXE) Injection
**Location:** `src/import.php` (CSV/XML import)

Both CSV and XML import functionality processes external entities without proper validation, allowing XXE attacks.

**PoC Hint:**
Create an XML file with:
```xml
<?xml version="1.0"?>
<!DOCTYPE foo [<!ENTITY xxe SYSTEM "file:///etc/passwd">]>
<passwords>
  <password>
    <name>&xxe;</name>
    <username>test</username>
    <value>test</value>
  </password>
</passwords>
```

### 3. File Upload Vulnerability
**Location:** `src/profile.php` (profile image upload)

The profile image upload allows `.phtml` files and preserves original filenames, enabling arbitrary code execution.

**PoC Hint:**
Upload a file named `shell.phtml` containing PHP code. Access it at `/uploads/profile_images/shell.phtml`.

### 4. Directory Listing
**Location:** `uploads/profile_images/`

Directory listing is enabled for the uploads folder, allowing enumeration of uploaded files.

**PoC Hint:**
Navigate to: `http://localhost:8080/uploads/profile_images/`

### 5. Server-Side Template Injection (SSTI)
**Location:** `src/add-password.php` (password name field)

The password name field evaluates template expressions using `eval()`, allowing code execution.

**PoC Hint:**
Use password name: `{{system('whoami')}}`

### 6. Stored Cross-Site Scripting (XSS)
**Location:** `src/login-history.php` via `src/login.php`

User-Agent strings are stored without sanitization and displayed without encoding, allowing stored XSS attacks.

**PoC Hint:**
Modify User-Agent header during login to:
```
User-Agent: <script>alert('XSS')</script>
```
Then view the Login History page.

## Project Structure

```
project/
├── docker-compose.yml          # Docker orchestration
├── Dockerfile                  # PHP+Apache image config
├── init.sql                    # Database schema and seed data
├── src/                        # Application source code
│   ├── config.php             # Database connection and helpers
│   ├── header.php             # Common header template
│   ├── footer.php             # Common footer template
│   ├── index.php              # Entry point
│   ├── login.php              # Login page
│   ├── logout.php             # Logout handler
│   ├── dashboard.php          # User dashboard
│   ├── passwords.php          # Password list and search
│   ├── add-password.php       # Add new password
│   ├── import.php             # Bulk import passwords
│   ├── profile.php            # User profile management
│   ├── settings.php           # Application settings
│   ├── login-history.php      # Login activity log
│   ├── tips.php               # Security tips page
│   └── assets/
│       └── style.css          # Application styles
├── uploads/                    # User uploads directory
│   └── profile_images/        # Profile images
└── backups/                    # Backup directory
```

## Security Notices

### ⚠️ CRITICAL WARNINGS

1. **Never deploy this application to production**
2. **Run only in isolated, local environments**
3. **Do not expose this application to the internet**
4. **Do not use this code as a template for real applications**
5. **All vulnerabilities are intentional and documented**

### Best Practices (What This App Does NOT Do)

This application intentionally violates security best practices. For production applications:

- ✅ Always use parameterized queries (prepared statements)
- ✅ Disable XML external entity processing
- ✅ Validate and sanitize all file uploads
- ✅ Disable directory listings
- ✅ Never use `eval()` with user input
- ✅ Always encode output to prevent XSS
- ✅ Use security headers (CSP, X-Frame-Options, etc.)
- ✅ Implement rate limiting
- ✅ Use HTTPS in production
- ✅ Implement proper error handling

## Database Schema

The application uses MySQL with the following tables:

- `users` - User accounts
- `passwords` - Stored passwords
- `login_history` - Login activity logs
- `settings` - User preferences

See `init.sql` for complete schema details.

## Troubleshooting

### Database Connection Issues
Wait 30-60 seconds after starting for MySQL to fully initialize.

### Permission Errors
Ensure Docker has proper permissions to mount volumes.

### Port Conflicts
If port 8080 or 3306 is in use, modify `docker-compose.yml` to use different ports.

## Learning Resources

After exploring the vulnerabilities in this application, we recommend:

- OWASP Top 10: https://owasp.org/www-project-top-ten/
- OWASP Web Security Testing Guide
- PortSwigger Web Security Academy
- SANS Secure Coding Guidelines

## Disclaimer

This software is provided for educational purposes only. The authors are not responsible for any misuse or damage caused by this program. Use this software at your own risk and only in controlled, authorized environments.

**Remember:** Understanding vulnerabilities is the first step toward building secure applications. Always follow secure coding practices in production code.

## License

This project is provided as-is for educational purposes. Do not use in production environments.
