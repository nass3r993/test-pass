# FortiPass - Documentation Index

Welcome to FortiPass! This index will help you find the right documentation for your needs.

## 📖 Documentation Files

### 🎯 [`START_HERE.md`](START_HERE.md) ⭐ **START HERE**
**Your entry point to the project.**
- Quick overview of what FortiPass is
- Links to all other documentation
- Safety warnings and ethical use guidelines
- Recommended learning path

### 🚀 [`QUICKSTART.md`](QUICKSTART.md)
**Get running in 3 steps (5 minutes).**
- Minimal setup instructions
- Default credentials
- Basic troubleshooting
- Quick reference for vulnerabilities

### 📚 [`README.md`](README.md)
**Complete project documentation.**
- Detailed description of all features
- All 6 vulnerabilities explained
- PoC hints for exploitation
- Security best practices
- Project structure
- Comprehensive troubleshooting

### 🛠️ [`DEPLOYMENT.md`](DEPLOYMENT.md)
**Detailed deployment guide.**
- Prerequisites and requirements
- Step-by-step installation
- Configuration options
- Advanced troubleshooting
- Security isolation recommendations

### ✅ [`VERIFICATION.md`](VERIFICATION.md)
**Implementation verification checklist.**
- Complete feature list with checkboxes
- Vulnerability implementation confirmation
- Code quality verification
- Testing checklist

### 📊 [`PROJECT_SUMMARY.txt`](PROJECT_SUMMARY.txt)
**Quick reference summary.**
- Project overview
- Technology stack
- File structure diagram
- Vulnerability quick reference
- Command cheat sheet

## 🎯 Which File Should I Read?

### I'm brand new here
→ Read [`START_HERE.md`](START_HERE.md)

### I just want to run it NOW
→ Read [`QUICKSTART.md`](QUICKSTART.md)

### I want to learn about the vulnerabilities
→ Read [`README.md`](README.md)

### I'm having deployment issues
→ Read [`DEPLOYMENT.md`](DEPLOYMENT.md)

### I want to verify everything is correct
→ Read [`VERIFICATION.md`](VERIFICATION.md)

### I need a quick reference
→ Read [`PROJECT_SUMMARY.txt`](PROJECT_SUMMARY.txt)

## 🔧 Configuration Files

- **`docker-compose.yml`** - Docker services configuration
- **`Dockerfile`** - PHP+Apache container definition
- **`init.sql`** - Database schema and seed data
- **`.htaccess`** - Apache rewrite rules
- **`package.json`** - Project metadata and scripts
- **`.gitignore`** - Git ignore patterns

## 📁 Source Code

All application code is in the `src/` directory:

### Core Files
- **`config.php`** - Database and authentication
- **`header.php`** - Common header template
- **`footer.php`** - Common footer template

### Pages
- **`index.php`** - Entry point
- **`login.php`** - Authentication page
- **`logout.php`** - Logout handler
- **`dashboard.php`** - Main dashboard
- **`passwords.php`** - Password list (⚠️ SQLi)
- **`add-password.php`** - Add password (⚠️ SSTI)
- **`import.php`** - Bulk import (⚠️ XXE)
- **`profile.php`** - User profile (⚠️ File Upload)
- **`settings.php`** - User settings
- **`login-history.php`** - Login logs (⚠️ XSS)
- **`tips.php`** - Security tips

### Assets
- **`assets/style.css`** - Application styling

## 🎓 Recommended Reading Order

### For Complete Beginners
1. [`START_HERE.md`](START_HERE.md) - Understand what this is
2. [`QUICKSTART.md`](QUICKSTART.md) - Get it running
3. [`README.md`](README.md) - Learn the details
4. Explore the application
5. Try the PoC hints

### For Security Practitioners
1. [`QUICKSTART.md`](QUICKSTART.md) - Deploy quickly
2. [`README.md`](README.md) - Review vulnerabilities
3. [`VERIFICATION.md`](VERIFICATION.md) - Confirm implementation
4. Start testing

### For Instructors/CTF Creators
1. [`VERIFICATION.md`](VERIFICATION.md) - Verify completeness
2. [`README.md`](README.md) - Review all features
3. [`PROJECT_SUMMARY.txt`](PROJECT_SUMMARY.txt) - Quick reference
4. Review source code

## ⚠️ Important Notes

- **All documentation files contain safety warnings**
- **PoC hints are provided, not full exploits**
- **The UI appears production-like (no training labels)**
- **All safety information is in repository files only**

## 🚀 Quick Start Summary

```bash
# Deploy
docker compose up --build

# Access
http://localhost:8080

# Login
user@example.com / password
```

## 📞 Support

For issues:
1. Check [`DEPLOYMENT.md`](DEPLOYMENT.md) troubleshooting section
2. Review Docker logs: `docker compose logs`
3. Verify system requirements
4. Ensure ports 8080 and 3306 are available

## 🔒 Remember

This is an **educational tool** with **intentional vulnerabilities**.

- ✅ Use for learning
- ✅ Practice in isolated environments
- ✅ Learn secure coding practices
- ❌ Never deploy to production
- ❌ Never use on the internet
- ❌ Never test on systems without permission

---

**Happy Learning! Build Secure Code! 🔐**

*FortiPass - A project for security education and responsible disclosure*
