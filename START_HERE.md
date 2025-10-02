# 🚀 START HERE - Snap Project Setup

## ✅ What's Already Done

Your Snap project is **fully initialized** and ready for testing! Here's what has been set up:

### 🎯 Project Foundation
- ✅ Laravel 12 with PHP 8.4
- ✅ Vue.js 3 + Vite
- ✅ Tailwind CSS
- ✅ Database migrations created
- ✅ Laravel models with relationships
- ✅ Vue components (SearchBar, ImageUpload)
- ✅ Git repository with GitHub Flow
- ✅ Comprehensive documentation

### 📁 Files Created
- `README.md` - Project overview
- `DEVELOPMENT.md` - Developer guide
- `PROJECT_SUMMARY.md` - Implementation roadmap
- `TESTING_GUIDE.md` - Local testing instructions
- `start-testing.bat` - Automated testing script
- `check-status.bat` - System status checker

---

## ⚠️ What You Need to Do Now

### STEP 1: Start PostgreSQL Service ⭐ REQUIRED

**Option A: Using Windows Services** (Recommended)
1. Press `Win + R`
2. Type `services.msc` and press Enter
3. Find "**postgresql-x64-17**" in the list
4. Right-click → **Start**
5. Wait for status to show "Running"

**Option B: Using Command Prompt (as Administrator)**
```cmd
net start postgresql-x64-17
```

**Option C: Using pgAdmin**
- Open pgAdmin 4
- It will start the service automatically

---

### STEP 2: Run the Setup Script

Once PostgreSQL is running, double-click:

```
start-testing.bat
```

This script will automatically:
1. ✓ Check PostgreSQL is running
2. ✓ Create the 'snap' database
3. ✓ Enable PostGIS extension
4. ✓ Run all database migrations
5. ✓ Build frontend assets
6. ✓ Start Laravel development server

---

### STEP 3: Access the Application

Open your browser and visit:

**http://localhost:8000**

You should see the Laravel welcome page!

---

## 🔍 Alternative: Manual Setup

If the script doesn't work, follow these manual steps:

### 1. Start PostgreSQL
See STEP 1 above

### 2. Create Database
```bash
"C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -h localhost -W
```
Password: `mypassword`

Then run:
```sql
CREATE DATABASE snap;
\c snap
CREATE EXTENSION postgis;
\q
```

### 3. Run Migrations
```bash
cd C:\Users\mymem\Documents\Snap
php artisan migrate
```

### 4. Build Assets
```bash
npm run dev
```
(Keep this terminal open)

### 5. Start Laravel Server
Open a **new terminal**:
```bash
cd C:\Users\mymem\Documents\Snap
php artisan serve
```

### 6. Visit Application
http://localhost:8000

---

## 🧪 Quick Tests

Once the application is running, test these features:

### Test 1: Check Database Connection
```bash
php artisan tinker
```
```php
DB::connection()->getPdo(); // Should return PDO object
DB::table('users')->count(); // Should return 0
```

### Test 2: Create Test Data
```php
// Create a test user
$user = App\Models\User::create([
    'name' => 'Test User',
    'email' => 'test@snap.lk',
    'password' => bcrypt('password'),
    'role' => 'customer',
]);

// Create a shop owner
$owner = App\Models\User::create([
    'name' => 'Shop Owner',
    'email' => 'owner@snap.lk',
    'password' => bcrypt('password'),
    'role' => 'shop_owner',
]);

// Create a shop
$shop = App\Models\Shop::create([
    'owner_id' => $owner->id,
    'name' => 'Tech Paradise',
    'description' => 'Best electronics in Sri Lanka',
    'address' => 'Colombo 07',
    'latitude' => 6.9271,
    'longitude' => 79.8612,
    'phone' => '+94771234567',
    'status' => 'active',
]);

// Verify
$shop->owner->name; // Should return "Shop Owner"
```

### Test 3: Check Vue.js is Working
1. Open http://localhost:8000
2. Press F12 (Developer Tools)
3. Go to Console tab
4. Look for Vue.js warnings (should be none)

---

## 📊 Database Tables Created

When you run migrations, these tables will be created:

| Table | Purpose |
|-------|---------|
| `users` | Customer & shop owner accounts |
| `shops` | Shop listings with location |
| `products` | Product catalog |
| `categories` | Product categories (hierarchical) |
| `product_images` | Multiple images per product |
| `searches` | Search analytics |
| `recommendations` | AI recommendations |
| `subscriptions` | Shop payment plans |
| `favorites` | User wishlists |

---

## 🐛 Troubleshooting

### Problem: "Connection refused" error

**Solution**: PostgreSQL service is not running
- Start the service (see STEP 1 above)
- Verify: Run `check-status.bat`

### Problem: "Database snap does not exist"

**Solution**: Create the database manually
```bash
"C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -c "CREATE DATABASE snap;"
```

### Problem: "npm run dev" fails

**Solution**: Install dependencies
```bash
npm install
npm run dev
```

### Problem: Port 8000 is busy

**Solution**: Use a different port
```bash
php artisan serve --port=8001
```

Then visit: http://localhost:8001

---

## 📚 Documentation Reference

| File | Purpose |
|------|---------|
| **START_HERE.md** (this file) | Quick start guide |
| **README.md** | Project overview & business model |
| **DEVELOPMENT.md** | Development workflow & architecture |
| **PROJECT_SUMMARY.md** | Complete implementation plan |
| **TESTING_GUIDE.md** | Detailed testing instructions |

---

## 🎯 Next Steps After Testing

Once you verify everything works:

### 1. Install Authentication (Week 1)
```bash
composer require laravel/breeze --dev
php artisan breeze:install vue
npm install && npm run build
php artisan migrate
```

### 2. Set Up Search Engine (Week 2)
```bash
composer require laravel/scout meilisearch/meilisearch-php
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
```

### 3. Integrate AI Image Recognition (Week 3-4)
```bash
composer require google/cloud-vision
# OR
composer require aws/aws-sdk-php
```

### 4. Build Features
Follow the roadmap in `PROJECT_SUMMARY.md`

---

## 🆘 Need Help?

### Check Logs
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Or open in editor
notepad storage\logs\laravel.log
```

### Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Reset Database
```bash
php artisan migrate:fresh
```
⚠️ This will delete all data!

---

## ✅ Pre-Launch Checklist

Before starting development, ensure:

- [ ] PostgreSQL service is running
- [ ] Database 'snap' exists
- [ ] PostGIS extension is enabled
- [ ] All migrations ran successfully
- [ ] No migration errors
- [ ] `php artisan serve` works
- [ ] Can access http://localhost:8000
- [ ] No PHP errors
- [ ] No browser console errors
- [ ] Can create test data in tinker
- [ ] Database relationships work

---

## 🚀 Current Status

**✅ Project Setup**: Complete
**✅ Documentation**: Complete
**✅ Database Schema**: Ready
**✅ Frontend Setup**: Ready
**⏳ PostgreSQL Service**: Needs to be started
**⏳ Migrations**: Ready to run

---

## 📞 Quick Reference

### Important Commands

```bash
# Start development
npm run dev                 # Terminal 1 (assets)
php artisan serve          # Terminal 2 (Laravel)

# Database
php artisan migrate        # Run migrations
php artisan migrate:fresh  # Reset database
php artisan tinker         # Database console

# Clear caches
php artisan config:clear
php artisan cache:clear

# Check status
.\check-status.bat
```

### Important URLs
- Application: http://localhost:8000
- GitHub Repo: https://github.com/KusalPabasara/Snap

### Database Info
- Host: localhost (127.0.0.1)
- Port: 5432
- Database: snap
- Username: postgres
- Password: mypassword

---

## 🎉 Ready to Start?

1. **Start PostgreSQL** (services.msc → postgresql-x64-17 → Start)
2. **Double-click** `start-testing.bat`
3. **Open browser** to http://localhost:8000
4. **Start coding!** 🚀

---

*Project initialized: October 2, 2025*
*Branch: feature/project-initialization*
*Status: Ready for local testing*
