# FortiPass - Quick Start Guide

⚠️ **FOR EDUCATIONAL USE ONLY - INTENTIONALLY VULNERABLE APPLICATION**

## 🚀 Get Started in 3 Steps

### 1. Start the Application

```bash
docker compose up --build
```

### 2. Wait for Initialization

Wait 30-60 seconds for the database to initialize. Watch for:
```
db_1   | ready for connections
```

### 3. Access & Login

- **URL:** http://localhost:8080
- **Email:** user@example.com
- **Password:** password

## 📋 What You Can Do

### Explore the Application
- ✅ Dashboard with statistics
- ✅ View and manage passwords
- ✅ Add new passwords
- ✅ Search passwords
- ✅ Import passwords (CSV/XML)
- ✅ Update profile with image
- ✅ View login history
- ✅ Change settings

### Practice Security Testing
This application contains **6 intentional vulnerabilities**:

1. **SQL Injection** - Password search
2. **XXE Injection** - File import
3. **File Upload** - Profile images (allows .phtml)
4. **Directory Listing** - /uploads/profile_images/
5. **SSTI** - Password name field ({{ }} syntax)
6. **Stored XSS** - User-Agent in login history

See `README.md` for detailed PoC hints.

## 🛑 Stop the Application

```bash
docker compose down
```

## 🔄 Reset Everything

```bash
docker compose down -v
docker compose up --build
```

## 📚 Documentation

- `README.md` - Complete documentation and vulnerability details
- `DEPLOYMENT.md` - Detailed deployment instructions
- `VERIFICATION.md` - Complete implementation checklist

## ⚠️ Important Reminders

1. **Never use in production**
2. **Run in isolated environments only**
3. **For educational purposes only**
4. **Do not expose to the internet**
5. **All vulnerabilities are intentional**

## 🐛 Troubleshooting

### Port Already in Use
Edit `docker-compose.yml` and change ports:
```yaml
ports:
  - "8081:80"  # Change 8080 to 8081
```

### Can't Connect to Database
Wait longer (up to 60 seconds) or check logs:
```bash
docker compose logs
```

### Need to Reset
```bash
docker compose down -v && docker compose up --build
```

---

**Happy Learning! Stay Safe. Code Secure.** 🔒
