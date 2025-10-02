# 🧪 Local Testing Guide for Snap

## Prerequisites Check

### ✅ What's Already Installed
- PHP 8.4 ✓
- Composer ✓
- Node.js & NPM ✓
- PostgreSQL 17 ✓
- Git ✓

### ⚠️ What Needs to Be Started
- **PostgreSQL Service** - Currently not running

---

## 🚀 Quick Start Guide

### Step 1: Start PostgreSQL Service

**Option A: Using Windows Services**
1. Press `Win + R`
2. Type `services.msc` and press Enter
3. Find "postgresql-x64-17" in the list
4. Right-click and select "Start"

**Option B: Using pgAdmin**
1. Open pgAdmin 4
2. Connect to localhost server
3. Service will start automatically

**Option C: Using Command Prompt (as Administrator)**
```cmd
net start postgresql-x64-17
```

### Step 2: Create Database

Once PostgreSQL is running, execute:

```bash
# Using psql
PGPASSWORD=mypassword "C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -c "CREATE DATABASE snap;"

# Enable PostGIS extension (for geolocation features)
PGPASSWORD=mypassword "C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -d snap -c "CREATE EXTENSION postgis;"
```

**Or use pgAdmin:**
1. Right-click on "Databases"
2. Create → Database
3. Name: `snap`
4. Click "Save"

### Step 3: Run Migrations

```bash
cd C:\Users\mymem\Documents\Snap
php artisan migrate
```

This will create all the tables:
- users
- shops
- products
- categories
- product_images
- searches
- recommendations
- subscriptions
- favorites

### Step 4: Build Frontend Assets

```bash
# Install dependencies (already done)
npm install

# Build assets for development
npm run dev
```

Keep this terminal open - it will watch for changes and rebuild automatically.

### Step 5: Start Laravel Development Server

Open a **new terminal** and run:

```bash
cd C:\Users\mymem\Documents\Snap
php artisan serve
```

You should see:
```
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server.
```

### Step 6: Access the Application

Open your browser and visit:
- **Homepage**: http://localhost:8000
- **Laravel Welcome Page**: Should load successfully

---

## 🧪 Testing Features

### 1. Test Database Connection

```bash
php artisan tinker
```

Then run:
```php
DB::connection()->getPdo();
// Should output: PDO object

DB::table('users')->count();
// Should output: 0 (no users yet)
```

### 2. Create Test Data

```bash
# Create a user
php artisan tinker
```

```php
$user = new App\Models\User();
$user->name = 'Test User';
$user->email = 'test@snap.lk';
$user->password = bcrypt('password');
$user->role = 'customer';
$user->save();

// Create a shop owner
$owner = App\Models\User::create([
    'name' => 'Shop Owner',
    'email' => 'owner@snap.lk',
    'password' => bcrypt('password'),
    'role' => 'shop_owner',
    'phone' => '+94771234567',
]);

// Create a shop
$shop = App\Models\Shop::create([
    'owner_id' => $owner->id,
    'name' => 'Tech Paradise',
    'description' => 'Electronics and gadgets',
    'address' => 'Colombo 07, Sri Lanka',
    'latitude' => 6.9271,
    'longitude' => 79.8612,
    'phone' => '+94112345678',
    'status' => 'active',
]);

// Create a category
$category = App\Models\Category::create([
    'name' => 'Electronics',
    'slug' => 'electronics',
    'description' => 'Electronic devices and accessories',
]);

// Create a product
$product = App\Models\Product::create([
    'shop_id' => $shop->id,
    'category_id' => $category->id,
    'name' => 'iPhone 15 Pro',
    'description' => 'Latest Apple iPhone',
    'price' => 450000.00,
    'stock_quantity' => 10,
    'sku' => 'IP15PRO-001',
]);
```

### 3. Test Relationships

```php
// Get shop products
$shop->products;

// Get product shop
$product->shop->name;

// Get user's shops
$owner->shops;
```

---

## 📊 Database Queries

### Check Tables
```bash
php artisan tinker
```

```php
// List all tables
DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");

// Count records in each table
DB::table('users')->count();
DB::table('shops')->count();
DB::table('products')->count();
```

### Test Geolocation Queries

```php
// Find shops within 5km of a location (Colombo Fort)
$lat = 6.9344;
$lng = 79.8428;

$shops = App\Models\Shop::select('*')
    ->selectRaw("
        ST_Distance(
            ST_MakePoint(longitude, latitude)::geography,
            ST_MakePoint(?, ?)::geography
        ) / 1000 as distance
    ", [$lng, $lat])
    ->whereRaw("
        ST_DWithin(
            ST_MakePoint(longitude, latitude)::geography,
            ST_MakePoint(?, ?)::geography,
            5000
        )
    ", [$lng, $lat])
    ->orderBy('distance')
    ->get();
```

---

## 🔧 Common Issues & Solutions

### Issue 1: "Connection refused" Error
**Cause**: PostgreSQL service not running

**Solution**:
1. Start PostgreSQL service (see Step 1 above)
2. Verify it's running: `services.msc` → Find "postgresql-x64-17" → Status should be "Running"

### Issue 2: "Database snap does not exist"
**Cause**: Database not created

**Solution**:
```bash
PGPASSWORD=mypassword "C:\Program Files\PostgreSQL\17\bin\psql.exe" -U postgres -c "CREATE DATABASE snap;"
```

### Issue 3: "SQLSTATE[08006] password authentication failed"
**Cause**: Wrong password in .env

**Solution**:
1. Check .env file: `DB_PASSWORD=mypassword`
2. Verify password is correct for postgres user

### Issue 4: npm run dev fails
**Cause**: Node modules not installed

**Solution**:
```bash
npm install
npm run dev
```

### Issue 5: Port 8000 already in use
**Solution**:
```bash
# Use different port
php artisan serve --port=8001
```

---

## 🎨 Frontend Testing

### Test Vue Components

1. Visit http://localhost:8000
2. Open browser console (F12)
3. Check for Vue.js warnings/errors

### Test Tailwind CSS

The welcome page should have Tailwind classes applied. Check:
- Colors render correctly
- Typography looks good
- Responsive design works

---

## 📝 Test Checklist

Before proceeding with development, verify:

- [ ] PostgreSQL service is running
- [ ] Database "snap" exists
- [ ] PostGIS extension is enabled
- [ ] All migrations ran successfully
- [ ] No migration errors
- [ ] Can create test user
- [ ] Can create test shop
- [ ] Can create test product
- [ ] Relationships work correctly
- [ ] `php artisan serve` runs without errors
- [ ] `npm run dev` runs without errors
- [ ] Can access http://localhost:8000
- [ ] No browser console errors

---

## 🐛 Debug Mode

### Enable Query Logging

Add to `routes/web.php`:

```php
use Illuminate\Support\Facades\DB;

DB::listen(function ($query) {
    logger()->info(
        $query->sql,
        $query->bindings,
        $query->time
    );
});
```

Check logs at: `storage/logs/laravel.log`

### Test Database Connection

```bash
php artisan tinker
```

```php
try {
    DB::connection()->getPdo();
    echo "Database connection successful!";
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
```

---

## 🚀 Next Steps After Testing

Once everything is working:

1. **Install Authentication**
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install vue
   npm install
   npm run build
   php artisan migrate
   ```

2. **Create Seed Data**
   ```bash
   php artisan make:seeder CategoriesSeeder
   php artisan make:seeder ShopsSeeder
   ```

3. **Set Up Search**
   ```bash
   composer require laravel/scout
   # Choose Meilisearch or Elasticsearch
   ```

4. **Start Building Features**
   - User registration
   - Shop management
   - Product CRUD
   - Search functionality
   - Image upload

---

## 📞 Need Help?

If you encounter issues:

1. Check `storage/logs/laravel.log`
2. Run `php artisan config:clear`
3. Run `php artisan cache:clear`
4. Restart Laravel server
5. Check PostgreSQL logs

---

**Status**: ⏳ Waiting for PostgreSQL service to start

**Next Command**: `php artisan migrate` (after PostgreSQL is running)
