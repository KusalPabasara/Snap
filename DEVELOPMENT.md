# Snap Development Guide

## 📋 Table of Contents
1. [Project Setup](#project-setup)
2. [Database Configuration](#database-configuration)
3. [Development Workflow](#development-workflow)
4. [Architecture Overview](#architecture-overview)
5. [API Endpoints](#api-endpoints)
6. [Testing](#testing)
7. [Deployment](#deployment)

---

## 🚀 Project Setup

### Initial Setup (Already Completed)
```bash
# The project has been initialized with:
✅ Laravel 12 framework
✅ Vue.js 3 with Vite
✅ Tailwind CSS
✅ PostgreSQL database configuration
✅ Redis for caching and queues
✅ Core database migrations
✅ Laravel models with relationships
```

### Next Steps for Development

1. **Install PostgreSQL** (if not already installed)
   ```bash
   # Download from: https://www.postgresql.org/download/
   # Or use Docker:
   docker run --name snap-postgres -e POSTGRES_PASSWORD=yourpassword -p 5432:5432 -d postgres:15
   ```

2. **Install Redis** (if not already installed)
   ```bash
   # Download from: https://redis.io/download
   # Or use Docker:
   docker run --name snap-redis -p 6379:6379 -d redis:7
   ```

3. **Configure Database**
   ```bash
   # Create database
   createdb snap

   # Or using psql:
   psql -U postgres
   CREATE DATABASE snap;

   # Enable PostGIS extension for geolocation
   psql snap -c "CREATE EXTENSION postgis;"
   ```

4. **Update .env file**
   ```env
   DB_PASSWORD=your_postgres_password
   REDIS_PASSWORD=your_redis_password (if set)
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Install NPM Dependencies & Build Assets**
   ```bash
   npm install
   npm run dev
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

---

## 🗄️ Database Configuration

### Tables Created
1. **users** - Customer and shop owner accounts
2. **shops** - Shop information with geolocation
3. **categories** - Hierarchical product categories
4. **products** - Product listings
5. **product_images** - Multiple images per product
6. **searches** - User search history
7. **recommendations** - AI-generated recommendations
8. **subscriptions** - Shop subscription plans
9. **favorites** - User wishlists

### PostGIS Setup for Geolocation
```sql
-- Enable PostGIS extension (already configured in migrations)
CREATE EXTENSION postgis;

-- Example query for nearby shops (within 5km)
SELECT *,
  ST_Distance(
    ST_MakePoint(longitude, latitude)::geography,
    ST_MakePoint(?, ?)::geography
  ) / 1000 as distance_km
FROM shops
WHERE ST_DWithin(
  ST_MakePoint(longitude, latitude)::geography,
  ST_MakePoint(?, ?)::geography,
  5000
)
ORDER BY distance_km;
```

---

## 🔄 Development Workflow (GitHub Flow)

### Branch Naming Convention
- `feature/user-authentication` - New features
- `bugfix/search-query-fix` - Bug fixes
- `hotfix/payment-error` - Critical fixes
- `chore/update-dependencies` - Maintenance

### Step-by-Step Workflow

1. **Create Feature Branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make Changes & Commit**
   ```bash
   git add .
   git commit -m "feat: add image search functionality"
   ```

3. **Push to Remote**
   ```bash
   git push origin feature/your-feature-name
   ```

4. **Create Pull Request**
   - Go to GitHub
   - Create PR from your branch to `main`
   - Add description and request review

5. **Code Review & Merge**
   - Address review comments
   - Merge to `main` after approval

### Commit Message Format
```
<type>: <subject>

[optional body]

Types:
- feat: New feature
- fix: Bug fix
- docs: Documentation
- style: Formatting
- refactor: Code restructuring
- test: Adding tests
- chore: Maintenance
```

---

## 🏗️ Architecture Overview

### Backend Structure
```
app/
├── Http/Controllers/
│   ├── SearchController.php       # Image & text search
│   ├── ShopController.php         # Shop CRUD
│   ├── ProductController.php      # Product management
│   └── API/                       # API controllers
├── Models/
│   ├── User.php                   # User model with roles
│   ├── Shop.php                   # Shop with geolocation
│   ├── Product.php                # Products with metadata
│   └── ...
├── Services/
│   ├── ImageRecognitionService.php # AI image processing
│   ├── NLPService.php              # Natural language processing
│   ├── GeolocationService.php      # Location-based search
│   └── RecommendationEngine.php    # AI recommendations
└── Jobs/
    ├── ProcessImageSearch.php
    └── GenerateRecommendations.php
```

### Frontend Structure
```
resources/
├── views/                    # Blade templates
│   ├── layouts/
│   │   └── app.blade.php
│   ├── home.blade.php
│   ├── search-results.blade.php
│   └── shop/
│       └── dashboard.blade.php
└── js/                      # Vue.js components
    ├── components/
    │   ├── SearchBar.vue
    │   ├── ImageUpload.vue
    │   ├── ResultsMap.vue
    │   └── PriceComparison.vue
    └── app.js
```

---

## 🔌 API Endpoints (To Be Implemented)

### Authentication
```
POST   /api/register          - User registration
POST   /api/login             - User login
POST   /api/logout            - User logout
GET    /api/user              - Get authenticated user
```

### Search
```
GET    /api/search            - Text-based search
POST   /api/search/image      - Image-based search
GET    /api/search/suggestions - Search autocomplete
```

### Products
```
GET    /api/products          - List products
GET    /api/products/{id}     - Get product details
POST   /api/products          - Create product (shop owner)
PUT    /api/products/{id}     - Update product
DELETE /api/products/{id}     - Delete product
```

### Shops
```
GET    /api/shops             - List shops
GET    /api/shops/{id}        - Get shop details
GET    /api/shops/nearby      - Get nearby shops
POST   /api/shops             - Register shop
PUT    /api/shops/{id}        - Update shop
```

### Recommendations
```
GET    /api/recommendations   - Get personalized recommendations
POST   /api/recommendations/generate - Generate recommendations
```

---

## 🧪 Testing

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage

# Frontend tests
npm run test
```

### Test Structure
```
tests/
├── Feature/
│   ├── SearchTest.php
│   ├── ShopTest.php
│   └── ProductTest.php
└── Unit/
    ├── ImageRecognitionServiceTest.php
    └── RecommendationEngineTest.php
```

### Writing Tests
```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;

class SearchTest extends TestCase
{
    public function test_text_search_returns_results()
    {
        $product = Product::factory()->create([
            'name' => 'iPhone 15 Pro'
        ]);

        $response = $this->get('/api/search?q=iPhone');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }
}
```

---

## 🚀 Deployment

### Environment Setup
```bash
# Production environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://snap.lk

# Database
DB_CONNECTION=pgsql
DB_HOST=your-production-db-host
DB_DATABASE=snap_production

# Cache & Queue
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```

### Deployment Steps

1. **Build Assets**
   ```bash
   npm run build
   ```

2. **Optimize Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Run Migrations**
   ```bash
   php artisan migrate --force
   ```

4. **Queue Worker (Supervisor)**
   ```ini
   [program:snap-worker]
   process_name=%(program_name)s_%(process_num)02d
   command=php /var/www/snap/artisan queue:work redis --sleep=3 --tries=3
   autostart=true
   autorestart=true
   user=www-data
   numprocs=4
   redirect_stderr=true
   stdout_logfile=/var/www/snap/storage/logs/worker.log
   ```

5. **Nginx Configuration**
   ```nginx
   server {
       listen 80;
       server_name snap.lk;
       root /var/www/snap/public;

       add_header X-Frame-Options "SAMEORIGIN";
       add_header X-Content-Type-Options "nosniff";

       index index.php;

       charset utf-8;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }

       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

---

## 🔧 Common Development Tasks

### Adding a New Feature
1. Create feature branch
2. Create migration if needed: `php artisan make:migration create_feature_table`
3. Create model: `php artisan make:model Feature`
4. Create controller: `php artisan make:controller FeatureController`
5. Add routes in `routes/web.php` or `routes/api.php`
6. Create Vue component if needed
7. Write tests
8. Commit and push

### Adding AI Service
1. Create service class: `app/Services/YourAIService.php`
2. Add API keys to `.env`
3. Create job for async processing: `php artisan make:job ProcessAITask`
4. Dispatch job from controller
5. Configure queue worker

### Database Queries with Geolocation
```php
// Find shops within 5km radius
$shops = Shop::select('*')
    ->selectRaw('ST_Distance(
        ST_MakePoint(longitude, latitude)::geography,
        ST_MakePoint(?, ?)::geography
    ) / 1000 as distance', [$userLng, $userLat])
    ->whereRaw('ST_DWithin(
        ST_MakePoint(longitude, latitude)::geography,
        ST_MakePoint(?, ?)::geography,
        5000
    )', [$userLng, $userLat])
    ->orderBy('distance')
    ->get();
```

---

## 📝 TODO: Next Implementation Steps

### Phase 1: Authentication & User Management
- [ ] Install Laravel Breeze/Jetstream for authentication
- [ ] Create user registration flow
- [ ] Add role-based middleware
- [ ] Create user profile pages

### Phase 2: Search Functionality
- [ ] Implement text search with Meilisearch/Elasticsearch
- [ ] Set up image upload and processing
- [ ] Integrate AI image recognition API
- [ ] Create search results page with map

### Phase 3: Shop Management
- [ ] Create shop registration form
- [ ] Build shop owner dashboard
- [ ] Add product CRUD operations
- [ ] Implement bulk product upload

### Phase 4: AI Integration
- [ ] Set up Google Cloud Vision / AWS Rekognition
- [ ] Implement NLP for text search
- [ ] Build recommendation engine
- [ ] Add A/B testing framework

### Phase 5: Payment & Subscriptions
- [ ] Integrate Stripe/PayPal
- [ ] Add local payment gateway (PayHere)
- [ ] Create subscription management
- [ ] Build invoicing system

---

## 🐛 Troubleshooting

### Common Issues

1. **Migration Errors**
   ```bash
   php artisan migrate:fresh  # Recreate all tables
   php artisan migrate:rollback  # Rollback last migration
   ```

2. **Cache Issues**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

3. **Queue Not Processing**
   ```bash
   php artisan queue:restart
   php artisan queue:work --tries=3
   ```

4. **NPM Build Errors**
   ```bash
   rm -rf node_modules package-lock.json
   npm install
   npm run build
   ```

---

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js 3 Guide](https://vuejs.org/guide/)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [PostGIS Documentation](https://postgis.net/documentation/)
- [GitHub Flow Guide](https://guides.github.com/introduction/flow/)

---

## 🤝 Contributing

Please follow the GitHub Flow workflow and ensure:
- Code follows PSR-12 coding standards
- All tests pass before submitting PR
- Commit messages follow conventional commits format
- Documentation is updated for new features

---

**Happy Coding! 🚀**
