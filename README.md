# 🔍 Snap - Smart Navigation & Product Finder

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-green.svg)](https://vuejs.org)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-blue.svg)](https://postgresql.org)

> **Revolutionizing product discovery in Sri Lanka** - Find what you want, where you want it, instantly.

## 🎯 Problem Statement

In today's fast-paced world, especially among youth in Sri Lanka, people often:
- See a product (food, electronics, clothing, books, etc.) and want to buy it immediately
- Waste countless hours searching online or visiting physical stores
- Face disappointment with online shopping (can't test products physically)
- Experience uncertainty about product availability in nearby stores
- Struggle with inconsistent pricing and lack of transparency

**Result**: Wasted time + questionable satisfaction + frustration

## 💡 Our Solution

**Snap** is an intelligent shopping recommendation platform that:

1. **Image-Based Search**: Upload a photo of any product → AI finds matching items nearby
2. **Natural Language Search**: Describe what you want in plain text → Smart search finds it
3. **Location-Aware Results**: Shows nearest shops with availability and pricing
4. **Price Comparison**: Compare prices across multiple vendors instantly
5. **Smart Recommendations**: AI suggests alternatives and better deals

### 🏪 Supported Categories
- 🍔 Food & Restaurants (menus, dishes)
- 📱 Electronics (phones, laptops, accessories)
- 👕 Clothing & Fashion
- 📚 Books & Stationery
- 🥬 Groceries (vegetables, fruits, daily essentials)
- 🏠 Home & Living
- 🎮 Entertainment & Gaming

## 🚀 Technology Stack

### Backend
- **Framework**: Laravel 12 (PHP 8.4)
- **Database**: PostgreSQL 15 with PostGIS (geolocation)
- **Caching**: Redis 7 (sessions, cache, queues)
- **Queue Management**: Laravel Horizon
- **API Authentication**: Laravel Sanctum
- **Search**: Meilisearch / Elasticsearch

### Frontend
- **Framework**: Vue.js 3 (Composition API)
- **Templating**: Blade (SEO-friendly server rendering)
- **Build Tool**: Vite
- **Styling**: Tailwind CSS 3
- **Maps**: Google Maps API / Leaflet + OpenStreetMap
- **Charts**: Chart.js (analytics)

### AI/ML Services
- **Image Recognition**: Google Cloud Vision AI / AWS Rekognition
- **NLP**: OpenAI API / Hugging Face Transformers
- **Custom Models**: Python (FastAPI) + TensorFlow/PyTorch
- **Recommendation Engine**: Collaborative + Content-based filtering

### DevOps & Infrastructure
- **CI/CD**: GitHub Actions
- **Containerization**: Docker
- **Web Server**: Nginx
- **Process Monitoring**: Supervisor
- **Hosting**: AWS / DigitalOcean / Laravel Vapor

## 📂 Project Structure

```
snap/
├── app/
│   ├── Http/Controllers/
│   │   ├── SearchController.php      # Image & text search
│   │   ├── ShopController.php        # Shop management
│   │   ├── ProductController.php     # Product CRUD
│   │   └── RecommendationController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Shop.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Search.php
│   │   └── Recommendation.php
│   ├── Services/
│   │   ├── ImageRecognitionService.php
│   │   ├── NLPService.php
│   │   ├── GeolocationService.php
│   │   └── RecommendationEngine.php
│   └── Jobs/
│       ├── ProcessImageSearch.php
│       └── GenerateRecommendations.php
├── database/
│   └── migrations/
│       ├── create_users_table.php
│       ├── create_shops_table.php
│       ├── create_products_table.php
│       ├── create_categories_table.php
│       ├── create_searches_table.php
│       └── create_subscriptions_table.php
├── resources/
│   ├── views/              # Blade templates
│   │   ├── layouts/
│   │   ├── home.blade.php
│   │   ├── search-results.blade.php
│   │   └── shop/dashboard.blade.php
│   └── js/                 # Vue.js components
│       ├── components/
│       │   ├── SearchBar.vue
│       │   ├── ImageUpload.vue
│       │   ├── ResultsMap.vue
│       │   └── PriceComparison.vue
│       └── app.js
├── routes/
│   ├── web.php            # Blade-rendered routes
│   ├── api.php            # JSON API endpoints
│   └── channels.php       # Broadcasting
└── tests/
    ├── Feature/
    └── Unit/
```

## 🗄️ Database Schema

### Core Tables

#### `users`
```sql
id, name, email, password, role (customer/shop_owner/admin),
phone, location_lat, location_lng, created_at, updated_at
```

#### `shops`
```sql
id, owner_id, name, description, address, location (PostGIS POINT),
latitude, longitude, phone, email, website, subscription_tier,
verified_at, status, created_at, updated_at
```

#### `products`
```sql
id, shop_id, category_id, name, description, price, stock_quantity,
sku, image_url, image_vector (for AI similarity),
metadata (JSON), created_at, updated_at
```

#### `categories`
```sql
id, parent_id, name, slug, icon, description, created_at, updated_at
```

#### `searches`
```sql
id, user_id, query_text, uploaded_image_path, search_type,
results_count, location_lat, location_lng, created_at
```

#### `recommendations`
```sql
id, user_id, product_id, score, reason, algorithm_used, created_at
```

#### `subscriptions`
```sql
id, shop_id, plan_name, price, billing_cycle, features (JSON),
starts_at, ends_at, status, created_at, updated_at
```

## 🎯 Business Model

### Revenue Streams

1. **Shop Subscriptions** (Primary)
   - **Basic**: LKR 5,000/month (50 products, basic analytics)
   - **Premium**: LKR 15,000/month (500 products, advanced analytics, API access)
   - **Enterprise**: LKR 50,000/month (unlimited products, priority support, custom integration)

2. **Transaction Fees**: 2-5% on facilitated sales (optional)

3. **Sponsored Listings**: Pay-per-click model for featured products

4. **Premium User Features**: LKR 500/month
   - Price drop alerts
   - Advanced filters
   - Save unlimited favorites
   - Priority customer support

5. **API Access**: For enterprise integrations and third-party apps

## 🚀 Development Roadmap

### Phase 1: MVP (Weeks 1-6)
- [x] Project initialization with Laravel + Vue.js
- [ ] User authentication system
- [ ] Basic image upload & search
- [ ] Text-based search with filters
- [ ] Shop registration & product management
- [ ] Geolocation & map integration
- [ ] Basic recommendation engine

### Phase 2: Core Features (Weeks 7-10)
- [ ] AI image recognition integration
- [ ] Advanced NLP search
- [ ] Price comparison engine
- [ ] Shop owner dashboard with analytics
- [ ] Payment gateway integration
- [ ] Subscription management
- [ ] API for shop data updates

### Phase 3: Optimization (Weeks 11-12)
- [ ] Performance optimization (caching, CDN)
- [ ] Testing (Unit, Feature, E2E)
- [ ] Security hardening
- [ ] SEO optimization

### Phase 4: Launch (Week 13-14)
- [ ] Beta testing with selected shops
- [ ] Deployment to production
- [ ] Marketing campaign
- [ ] User onboarding

### Post-Launch Enhancements
- [ ] Mobile apps (Flutter/React Native)
- [ ] Multi-language support (Sinhala, Tamil, English)
- [ ] Social features (reviews, ratings, sharing)
- [ ] Delivery integration
- [ ] Loyalty programs
- [ ] AI chatbot for customer support

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ & NPM
- PostgreSQL 15+ with PostGIS extension
- Redis 7+

### Step 1: Clone Repository
```bash
git clone https://github.com/yourusername/snap.git
cd snap
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=snap
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Configure Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Step 4: Database Setup
```bash
# Create database
createdb snap

# Enable PostGIS extension
psql snap -c "CREATE EXTENSION postgis;"

# Run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed
```

### Step 5: Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### Step 6: Start Development Server
```bash
# Start Laravel server
php artisan serve

# Start queue worker
php artisan queue:work

# In another terminal, start Vite
npm run dev
```

Visit: `http://localhost:8000`

## 📊 Key Features Breakdown

### 🔍 Image Search Flow
1. User uploads product image
2. Image preprocessed & sent to AI service
3. AI identifies product category & features
4. Database queried for visual similarity matches
5. Results filtered by geolocation
6. Ranked by relevance, price, distance

### 📝 Text Search Flow
1. User enters natural language query
2. NLP processes intent & extracts entities
3. Semantic search in product database
4. Category & price filters applied
5. Location-based ranking
6. Display with map view

### 🏪 Shop Owner Dashboard
- Product inventory management
- Bulk upload via CSV/Excel
- Real-time stock updates
- Sales analytics & insights
- Customer demographics
- Revenue tracking
- Subscription management

### 🤖 AI Recommendation Engine
- **Collaborative Filtering**: User behavior patterns
- **Content-Based**: Product attributes similarity
- **Hybrid Approach**: Combined for best results
- **A/B Testing**: Continuous algorithm improvement

## 🧪 Testing

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

## 🚀 Deployment

### Using Laravel Vapor (AWS)
```bash
# Install Vapor CLI
composer require laravel/vapor-cli

# Deploy
vapor deploy production
```

### Manual Deployment (VPS)
1. Set up Nginx + PHP-FPM
2. Configure SSL (Let's Encrypt)
3. Set up Supervisor for queues
4. Configure Redis
5. Run migrations
6. Build frontend assets
7. Set up cron jobs

## 📈 Success Metrics

- **User Acquisition**: 10,000 users in 3 months
- **Shop Onboarding**: 500 shops in 6 months
- **Search Success Rate**: >70% find desired product
- **Time Saved**: Average 30 minutes per search
- **Revenue Target**: LKR 500,000 MRR by month 12
- **User Satisfaction**: >4.5/5 rating

## 🤝 Contributing

We follow **GitHub Flow** for development:

1. Create feature branch: `git checkout -b feature/your-feature`
2. Make changes & commit: `git commit -m "feat: add feature"`
3. Push branch: `git push origin feature/your-feature`
4. Create Pull Request
5. Code review & merge

### Commit Message Convention
```
feat: add image search functionality
fix: resolve geolocation accuracy issue
docs: update API documentation
chore: upgrade dependencies
test: add unit tests for search service
```

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Team

- **Project Lead**: [Your Name]
- **Backend Developer**: [Team Member]
- **Frontend Developer**: [Team Member]
- **AI/ML Engineer**: [Team Member]
- **DevOps Engineer**: [Team Member]

## 📞 Contact & Support

- **Website**: https://snap.lk
- **Email**: support@snap.lk
- **Documentation**: https://docs.snap.lk
- **API Docs**: https://api.snap.lk/docs

---

<div align="center">
  <p>Built with ❤️ in Sri Lanka 🇱🇰</p>
  <p>
    <strong>Snap</strong> - Because your time matters
  </p>
</div>
