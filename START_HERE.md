# 🔐 FortiPass - START HERE

## ⚠️ IMPORTANT: Read This First

**This is an INTENTIONALLY VULNERABLE application designed for educational purposes only.**

FortiPass is a realistic-looking password manager that contains security vulnerabilities for learning and practice. It should **NEVER** be deployed to production or any publicly accessible environment.

---

## 📖 Quick Links

Choose your path:

### 🚀 Just Want to Start?
**→ Read [`QUICKSTART.md`](QUICKSTART.md)**
- 3-step deployment
- Login credentials
- Basic usage

### 🎓 Want to Learn?
**→ Read [`README.md`](README.md)**
- Complete documentation
- All 6 vulnerabilities explained
- PoC hints for each vulnerability
- Learning resources

### 🛠️ Need Help Deploying?
**→ Read [`DEPLOYMENT.md`](DEPLOYMENT.md)**
- Detailed setup instructions
- Troubleshooting guide
- System requirements

### ✅ Want to Verify Everything?
**→ Read [`VERIFICATION.md`](VERIFICATION.md)**
- Complete implementation checklist
- All features verified
- Code quality checks

### 📊 Want an Overview?
**→ Read [`PROJECT_SUMMARY.txt`](PROJECT_SUMMARY.txt)**
- Project overview
- Technology stack
- File structure
- Quick reference

---

## 🎯 What Is This?

FortiPass is a **fully functional password manager** web application built with PHP, MySQL, and Docker. It looks and feels like a production application, but it contains **6 intentional security vulnerabilities**:

1. **SQL Injection** - In password search
2. **XXE Injection** - In file import
3. **File Upload Vulnerability** - Allows malicious files
4. **Directory Listing** - Exposes uploaded files
5. **Server-Side Template Injection** - In password names
6. **Stored XSS** - In login history

---

## 🚀 Quick Start (30 seconds)

```bash
# 1. Start the application
docker compose up --build

# 2. Wait 30-60 seconds for database initialization

# 3. Open browser to:
http://localhost:8080

# 4. Login with:
Email: user@example.com
Password: password
```

That's it! You're ready to explore.

---

## 📚 What You'll Learn

By exploring this application, you will:

- ✅ Understand how common web vulnerabilities work in real applications
- ✅ Learn to identify security flaws in code
- ✅ Practice safe exploitation techniques
- ✅ Discover why input validation and output encoding are critical
- ✅ Understand secure coding practices by seeing what NOT to do
- ✅ Build skills for security testing and penetration testing

---

## 🎨 Features

FortiPass includes all the features of a real password manager:

- 🔐 User authentication and session management
- 📊 Dashboard with statistics
- 🔑 Password storage and management
- 🔍 Search functionality
- 📁 Bulk import (CSV/XML)
- 👤 User profile with image upload
- ⚙️ Settings and preferences
- 📜 Login history tracking
- 💡 Security tips and best practices

---

## ⚠️ Critical Safety Warnings

### DO NOT:
- ❌ Deploy to production servers
- ❌ Use on the internet
- ❌ Store real passwords in it
- ❌ Use in any non-isolated environment
- ❌ Assume this code is secure

### DO:
- ✅ Run in Docker containers only
- ✅ Use in isolated lab environments
- ✅ Practice responsible disclosure
- ✅ Learn from the vulnerabilities
- ✅ Apply lessons to secure coding

---

## 🏗️ Project Structure

```
FortiPass/
├── START_HERE.md           ← You are here
├── QUICKSTART.md          ← Fast setup guide
├── README.md              ← Full documentation
├── DEPLOYMENT.md          ← Detailed deployment
├── VERIFICATION.md        ← Implementation checklist
├── PROJECT_SUMMARY.txt    ← Project overview
├── docker-compose.yml     ← Docker setup
├── Dockerfile             ← Container config
├── init.sql               ← Database schema
└── src/                   ← Application code
    ├── login.php          ← Authentication
    ├── dashboard.php      ← Main dashboard
    ├── passwords.php      ← Password list (SQLi here)
    ├── add-password.php   ← Add password (SSTI here)
    ├── import.php         ← Bulk import (XXE here)
    ├── profile.php        ← Profile (File upload here)
    ├── login-history.php  ← Login logs (XSS here)
    └── ...                ← Other pages
```

---

## 🎓 Recommended Learning Path

### 1. Deploy & Explore (30 min)
- Deploy with Docker
- Login and explore all features
- Understand the application flow

### 2. Read Documentation (30 min)
- Read README.md for vulnerability details
- Review PoC hints
- Understand each vulnerability type

### 3. Practice (2-4 hours)
- Try to exploit each vulnerability
- Use safe, local testing only
- Document your findings

### 4. Learn Mitigation (1-2 hours)
- Research how to fix each vulnerability
- Study secure coding practices
- Review OWASP guidelines

---

## 🛑 Legal & Ethical Use

This project is designed for:
- ✅ Security education
- ✅ CTF competitions
- ✅ Authorized penetration testing practice
- ✅ Learning secure coding

This project is NOT for:
- ❌ Attacking real systems
- ❌ Unauthorized access attempts
- ❌ Malicious activities
- ❌ Production deployment

**Use responsibly. Test only on systems you own or have explicit permission to test.**

---

## 💬 Need Help?

1. Check [`DEPLOYMENT.md`](DEPLOYMENT.md) for troubleshooting
2. Review Docker and Docker Compose documentation
3. Ensure system requirements are met (Docker, 2GB RAM, ports 8080/3306 free)

---

## 🎉 Ready to Begin?

Choose your next step:

- **Impatient?** → Go to [`QUICKSTART.md`](QUICKSTART.md)
- **Thorough?** → Go to [`README.md`](README.md)
- **Need Details?** → Go to [`DEPLOYMENT.md`](DEPLOYMENT.md)

---

**Remember: This is a training tool. Learn, practice, and most importantly—build secure applications! 🔒**

---

*FortiPass - Teaching Security Through Practice*
