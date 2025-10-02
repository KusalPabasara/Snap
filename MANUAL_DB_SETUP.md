# PostgreSQL Connection Troubleshooting

## Current Status

- ✅ PostgreSQL 17 is installed
- ✅ Service "postgresql-x64-17" is RUNNING
- ⚠️ Connection to localhost:5432 is being refused

## Possible Causes

1. **PostgreSQL is listening on a different interface**
2. **Firewall is blocking the connection**
3. **PostgreSQL configuration needs adjustment**
4. **Service just started and needs time to initialize**

---

## Solution 1: Use pgAdmin (RECOMMENDED)

This is the easiest way to set up the database:

### Steps:

1. **Open pgAdmin 4** (should be installed with PostgreSQL)
   - Find it in Start Menu → PostgreSQL 17 → pgAdmin 4

2. **Connect to Server**
   - You may be asked for a master password (this is for pgAdmin itself)
   - Expand "Servers" in left panel
   - Right-click "PostgreSQL 17" → Connect
   - Enter password: `mypassword`

3. **Create Database**
   - Right-click on "Databases"
   - Select "Create" → "Database..."
   - Name: `snap`
   - Owner: postgres
   - Click "Save"

4. **Enable PostGIS Extension**
   - Click on the "snap" database
   - Click on "Query Tool" (icon in toolbar)
   - Type: `CREATE EXTENSION postgis;`
   - Click Execute (F5 or play button)
   - Should see: "CREATE EXTENSION - Query returned successfully"

5. **Test Connection**
   - Go back to your command prompt
   - Run: `php artisan migrate`
   - Should work now!

---

## Solution 2: Check PostgreSQL Configuration

### Find Data Directory

1. Open Command Prompt as Administrator
2. Run:
```bash
"C:\Program Files\PostgreSQL\17\bin\postgres.exe" --version
```

### Check Configuration File

1. Open: `C:\Program Files\PostgreSQL\17\data\postgresql.conf`
2. Look for these lines:
```
listen_addresses = '*'    # Should allow connections
port = 5432               # Should be 5432
```

3. If changed, restart service:
```cmd
net stop postgresql-x64-17
net start postgresql-x64-17
```

### Check pg_hba.conf

1. Open: `C:\Program Files\PostgreSQL\17\data\pg_hba.conf`
2. Make sure there's a line like:
```
host    all             all             127.0.0.1/32            scram-sha-256
```

---

## Solution 3: Use SQL Shell (psql)

If pgAdmin doesn't work:

1. Open **SQL Shell (psql)** from Start Menu → PostgreSQL 17
2. Press Enter for default values (localhost, 5432, postgres, postgres)
3. Enter password: `mypassword`
4. You should see: `postgres=#`
5. Run these commands:

```sql
CREATE DATABASE snap;
\c snap
CREATE EXTENSION postgis;
\q
```

Then try: `php artisan migrate`

---

## Solution 4: Wait and Retry

Sometimes the service needs a minute to fully start:

```bash
# Wait 30 seconds
timeout /t 30

# Try again
php artisan db:show
```

---

## Solution 5: Check Windows Firewall

1. Open Windows Defender Firewall
2. Click "Allow an app through firewall"
3. Find "postgres.exe"
4. Make sure both Private and Public are checked
5. Click OK

---

## Alternative: Use SQLite for Now

If PostgreSQL is giving too much trouble, you can use SQLite temporarily:

### 1. Enable SQLite Extension

Edit `C:\php\php.ini`:

Find and uncomment (remove `;`):
```ini
extension=pdo_sqlite
extension=sqlite3
```

### 2. Update .env

```env
DB_CONNECTION=sqlite
# Comment out PostgreSQL settings
```

### 3. Create Database File

```bash
echo. > database\database.sqlite
```

### 4. Run Migrations

```bash
php artisan migrate
```

**Note**: SQLite won't have PostGIS (geolocation), but you can test other features.

---

## Testing the Connection

Once you've tried one of the solutions above, test:

### Test 1: Simple Connection
```bash
php artisan tinker
```
```php
try {
    DB::connection()->getPdo();
    echo "Connected!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
exit
```

### Test 2: Run Migrations
```bash
php artisan migrate
```

You should see:
```
2025_10_01_233752_create_shops_table ......................... DONE
2025_10_01_233800_create_categories_table .................... DONE
...
```

---

## Once Database is Working

After database connection works:

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Build Frontend
```bash
npm run dev
```
(Keep this terminal open)

### 3. Start Laravel Server
Open new terminal:
```bash
php artisan serve
```

### 4. Visit Application
http://localhost:8000

---

## Quick Commands Reference

```bash
# Check service status
sc query postgresql-x64-17

# Start service
net start postgresql-x64-17

# Stop service
net stop postgresql-x64-17

# Test Laravel DB connection
php artisan db:show

# Run migrations
php artisan migrate

# Clear config cache
php artisan config:clear
```

---

## Need More Help?

### Check PostgreSQL Logs

Location: `C:\Program Files\PostgreSQL\17\data\log\`

Open the most recent `.log` file to see what's happening.

### Check Laravel Logs

Location: `C:\Users\mymem\Documents\Snap\storage\logs\laravel.log`

---

## Summary

**Most likely solution**: Use **pgAdmin** to create the database (Solution 1)

It's the graphical tool that comes with PostgreSQL and is the easiest way to manage databases on Windows.

After creating the database in pgAdmin:
1. Run `php artisan migrate`
2. Run `npm run dev`
3. Run `php artisan serve`
4. Visit http://localhost:8000

Good luck! 🚀
