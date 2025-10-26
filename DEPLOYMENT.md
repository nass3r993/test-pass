# FortiPass Deployment Guide

## Prerequisites

Before deploying FortiPass, ensure you have:

- Docker Engine 20.10 or higher
- Docker Compose 2.0 or higher
- At least 2GB of available RAM
- Ports 8080 and 3306 available

## Installation Steps

### 1. Clone or Extract the Project

```bash
cd fortipass
```

### 2. Verify Project Structure

Ensure the following structure exists:

```
fortipass/
├── docker-compose.yml
├── Dockerfile
├── init.sql
├── README.md
├── src/
│   ├── config.php
│   ├── header.php
│   ├── footer.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   ├── passwords.php
│   ├── add-password.php
│   ├── import.php
│   ├── profile.php
│   ├── settings.php
│   ├── login-history.php
│   ├── tips.php
│   └── assets/
│       └── style.css
├── uploads/
│   └── profile_images/
└── backups/
```

### 3. Build and Start Containers

```bash
docker compose up --build
```

Or run in detached mode:

```bash
docker compose up -d --build
```

### 4. Wait for Database Initialization

The first time you start the application, the MySQL database needs time to initialize. Wait approximately 30-60 seconds before accessing the application.

You can check the logs with:

```bash
docker compose logs -f
```

Wait until you see:
```
db_1   | ready for connections
web_1  | Apache started successfully
```

### 5. Access the Application

Open your web browser and navigate to:

```
http://localhost:8080
```

### 6. Login

Use the default credentials:

- **Email:** `user@example.com`
- **Password:** `password`

## Stopping the Application

To stop the containers:

```bash
docker compose down
```

To stop and remove all data (including database):

```bash
docker compose down -v
```

## Troubleshooting

### Port Already in Use

If port 8080 or 3306 is already in use, modify `docker-compose.yml`:

```yaml
services:
  web:
    ports:
      - "8081:80"  # Change 8080 to 8081
  db:
    ports:
      - "3307:3306"  # Change 3306 to 3307
```

### Cannot Connect to Database

1. Check if both containers are running:
   ```bash
   docker compose ps
   ```

2. View logs for errors:
   ```bash
   docker compose logs db
   docker compose logs web
   ```

3. Restart the containers:
   ```bash
   docker compose restart
   ```

### Permission Denied Errors

Ensure Docker has permission to create volumes and mount directories:

```bash
chmod -R 755 uploads/
chmod -R 755 backups/
```

### Database Not Initializing

If the database doesn't initialize on first run:

1. Stop containers and remove volumes:
   ```bash
   docker compose down -v
   ```

2. Start fresh:
   ```bash
   docker compose up --build
   ```

## Manual Database Reset

To reset the database to its initial state:

```bash
docker compose down -v
docker compose up --build
```

## Development Mode

For development with live code reloading, the source files are mounted as volumes. Any changes to PHP files will be reflected immediately without rebuilding.

## Production Warning

⚠️ **DO NOT USE THIS APPLICATION IN PRODUCTION**

This application is intentionally vulnerable and designed for educational purposes only. Never deploy it to:

- Public-facing servers
- Production environments
- Any environment accessible from the internet
- Shared hosting environments

Always run in isolated, local environments only.

## Security Isolation

For maximum safety during testing:

1. Run in a VM or container
2. Disconnect from network when possible
3. Use a firewall to restrict access
4. Never process real passwords or sensitive data
5. Destroy the environment after testing

## Next Steps

After successful deployment:

1. Read the `README.md` for vulnerability descriptions
2. Practice identifying and exploiting the vulnerabilities
3. Learn secure coding practices to prevent these issues
4. Study the code comments marked with `// INTENTIONAL VULN:`

## Support

This is an educational project. For issues or questions:

1. Check the troubleshooting section
2. Review Docker and Docker Compose documentation
3. Ensure system requirements are met
