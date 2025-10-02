# GitHub Issues Creation Guide

## Option 1: Using GitHub CLI (Recommended)

First, install GitHub CLI:
```bash
# Windows (using winget)
winget install --id GitHub.cli

# Or download from: https://cli.github.com/
```

Then run these commands:

```bash
# Login to GitHub
gh auth login

# Navigate to project directory
cd C:\Users\mymem\Documents\Snap

# Create High Priority Issues
gh issue create --title "PostGIS Extension Not Installed" --body "PostgreSQL doesn't have PostGIS extension. This is required for advanced geolocation queries.

## Problem
Current implementation uses basic lat/lng decimals without PostGIS spatial indexing, which is inefficient for location-based queries.

## Solution
1. Install PostGIS extension for PostgreSQL
2. Run: \`CREATE EXTENSION postgis;\`
3. Update Shop migration to use geometry type
4. Add spatial indexes for better performance

## Commands
\`\`\`sql
CREATE EXTENSION postgis;
ALTER TABLE shops ADD COLUMN location GEOGRAPHY(Point, 4326);
CREATE INDEX shops_location_idx ON shops USING GIST(location);
\`\`\`

## Impact
- Enables efficient radius-based shop searches
- Better performance for nearby product queries
- Proper distance calculations" --label "critical,database,geolocation"

gh issue create --title "Authentication System Missing" --body "No user authentication implemented. Users can't register, login, or manage accounts.

## Problem
- No user registration/login functionality
- Shop registration has placeholder owner_id
- No protected routes
- No user sessions

## Solution
1. Install Laravel Breeze: \`composer require laravel/breeze --dev\`
2. Run setup: \`php artisan breeze:install vue\`
3. Run migrations: \`php artisan migrate\`
4. Update shop registration to use \`auth()->id()\`
5. Add auth middleware to protected routes

## Routes to Protect
- /register-shop (require auth)
- /shops/{id}/edit (require ownership)
- /favorites (require auth)

## Impact
- Users can create accounts and login
- Shop owners properly associated with shops
- Secure access control" --label "critical,authentication,security"

gh issue create --title "No Sample Data / Database Seeding" --body "Empty database makes testing difficult. Need realistic sample data.

## Problem
- Database tables exist but are empty
- Can't test search functionality
- Can't demo the application
- Difficult to develop features

## Solution
1. Create seeders for all tables:
   - \`php artisan make:seeder CategorySeeder\`
   - \`php artisan make:seeder ShopSeeder\`
   - \`php artisan make:seeder ProductSeeder\`
2. Add realistic data:
   - 50+ products with images
   - 20+ shops in Sri Lankan cities
   - 10+ categories with subcategories
   - Sample users (customers and shop owners)

## Categories to Add
- Electronics (phones, laptops, accessories)
- Fashion (clothing, shoes, jewelry)
- Food & Beverages
- Books & Stationery
- Home & Garden
- Beauty & Personal Care
- Sports & Outdoors
- Gaming

## Sri Lankan Cities for Shops
- Colombo, Kandy, Galle, Jaffna, Negombo, Anuradhapura, Batticaloa

## Impact
- Enables proper testing
- Demonstrates functionality
- Provides realistic user experience" --label "critical,database,testing"

# Create Medium Priority Issues
gh issue create --title "Image Upload & AI Recognition Not Implemented" --body "Image search tab exists but doesn't actually upload or process images.

## Problem
- Image upload UI exists but not functional
- No image storage configured
- No AI/ML integration for image recognition
- Image search redirects without processing

## Solution
1. Configure Laravel filesystem for image uploads
2. Integrate AI service (choose one):
   - Google Cloud Vision API
   - AWS Rekognition
   - Azure Computer Vision
3. Extract product features from images
4. Match against product database using extracted features

## Implementation Steps
\`\`\`php
// 1. Create image upload endpoint
Route::post('/api/search/image', [SearchController::class, 'imageSearch']);

// 2. Store uploaded image
\$path = \$request->file('image')->store('searches', 'public');

// 3. Call AI service
\$labels = CloudVision::detectLabels(\$path);

// 4. Search products by labels
\$products = Product::whereIn('name', \$labels)
    ->orWhereIn('description', \$labels)
    ->get();
\`\`\`

## AI Service APIs
- Google Cloud Vision: https://cloud.google.com/vision
- AWS Rekognition: https://aws.amazon.com/rekognition/
- OpenAI CLIP: https://openai.com/research/clip

## Impact
- Users can search by taking/uploading photos
- Unique selling point for the platform
- Better user experience" --label "enhancement,AI/ML,feature"

gh issue create --title "Search Results Need Pagination Styling" --body "Laravel pagination links don't use DaisyUI styling.

## Problem
- Default Laravel pagination uses Tailwind classes
- Doesn't match DaisyUI component style
- Inconsistent with rest of the UI

## Solution
1. Publish Laravel pagination views:
   \`php artisan vendor:publish --tag=laravel-pagination\`
2. Edit \`resources/views/vendor/pagination/tailwind.blade.php\`
3. Replace with DaisyUI button classes

## DaisyUI Pagination Example
\`\`\`html
<div class=\"join\">
  <button class=\"join-item btn\">1</button>
  <button class=\"join-item btn btn-active\">2</button>
  <button class=\"join-item btn\">3</button>
  <button class=\"join-item btn\">4</button>
</div>
\`\`\`

## Files to Modify
- resources/views/vendor/pagination/tailwind.blade.php
- resources/views/vendor/pagination/default.blade.php

## Impact
- Consistent UI/UX
- Better visual design
- Professional appearance" --label "enhancement,UI/UX,design"

gh issue create --title "Missing Shop & Category Detail Pages" --body "Routes exist but views not created for shop details and category product views.

## Problem
- Route: \`/shops/{id}\` returns error (view not found)
- Route: \`/categories/{slug}\` returns error (view not found)
- Controllers implemented but views missing

## Solution
Create these view files:

### 1. resources/views/shops/show.blade.php
- Display shop information (name, address, phone, email)
- Show shop location on map (Leaflet or Google Maps)
- List all shop products in grid
- Show shop ratings/reviews
- Display opening hours

### 2. resources/views/categories/show.blade.php
- Display category name and description
- Show subcategories if any
- Product grid with filters
- Breadcrumb navigation
- Sort options (price, popularity, newest)

## Features to Include
- Product cards with images
- Add to favorites button
- Price display
- Stock status
- Shop information
- Distance from user location

## Impact
- Users can view shop details
- Browse products by category
- Complete user journey" --label "feature,views,UI/UX"

gh issue create --title "Geolocation Permission Not Requested" --body "App needs user's location for nearby shop search but doesn't request browser permission.

## Problem
- Search controller expects lat/lng parameters
- No JavaScript to request user location
- Manual location input not available
- Nearby shops feature not functional

## Solution
1. Add geolocation API permission request on homepage
2. Display current location to user
3. Add manual location input as fallback
4. Save location to localStorage

## Implementation
\`\`\`javascript
// Request location permission
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition((position) => {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;
    localStorage.setItem('userLat', lat);
    localStorage.setItem('userLng', lng);
  });
}
\`\`\`

## UI Components Needed
- Location permission prompt
- Current location display
- Manual address input with geocoding
- Location accuracy indicator

## Impact
- Enables nearby shop searches
- Better user experience
- Core feature becomes functional" --label "feature,geolocation,JavaScript"

# Create Enhancement Issues
gh issue create --title "Admin Dashboard Missing" --body "No admin panel to manage shops, products, and users.

## Features Needed
- User management (list, edit, delete)
- Shop approval/rejection workflow
- Product moderation
- Category management
- Analytics dashboard
- Reports generation

## Technology Options
- Laravel Nova (paid)
- Filament (free, modern)
- Custom admin panel with Vue

## Routes
- /admin/dashboard
- /admin/users
- /admin/shops
- /admin/products
- /admin/categories" --label "enhancement,admin,feature"

gh issue create --title "Payment Gateway Integration" --body "Subscription system designed but no payment processing.

## Required Features
- Shop owner subscriptions (Basic, Premium, Enterprise)
- Payment processing
- Recurring billing
- Invoice generation
- Payment history

## Payment Gateways (Sri Lanka)
- PayHere (local, popular)
- Stripe (international)
- PayPal (international)

## Implementation
1. Choose payment gateway
2. Install SDK/package
3. Create subscription plans table
4. Add payment processing endpoints
5. Handle webhooks for payment status" --label "enhancement,payments,feature"

gh issue create --title "Email Notifications System" --body "No email system for shop approval, password reset, etc.

## Emails Needed
- Shop registration confirmation
- Shop approval/rejection notification
- Password reset
- Welcome email for new users
- Weekly digest for shop owners
- Product out of stock alerts

## Setup
1. Configure mail driver in .env
2. Create mail classes
3. Design email templates
4. Set up queue for background processing

## Mail Services
- Mailgun (recommended)
- SendGrid
- Amazon SES
- Gmail SMTP (development)" --label "enhancement,notifications,email"

gh issue create --title "Mobile App (Flutter/React Native)" --body "Native mobile apps for better UX on iOS and Android.

## Why Mobile App?
- Better performance
- Offline capabilities
- Push notifications
- Camera integration for image search
- GPS for location tracking
- App store presence

## Technology Options
- Flutter (recommended)
- React Native
- Ionic

## Features
- User authentication
- Product search (text & image)
- Nearby shops map view
- Barcode scanner
- Push notifications
- Offline favorites list" --label "enhancement,mobile,future"

gh issue create --title "Full-Text Search Engine (Meilisearch/Elasticsearch)" --body "Current search uses basic SQL LIKE. Need full-text search for better results.

## Problem
- SQL LIKE queries are slow
- No relevance ranking
- No typo tolerance
- No synonym support
- Poor multi-language support

## Solution
Implement Meilisearch or Elasticsearch

### Meilisearch (Recommended)
- Easy to set up
- Fast and lightweight
- Built-in typo tolerance
- Good for small to medium datasets

### Elasticsearch
- More powerful
- Better for large datasets
- More complex setup

## Implementation
\`\`\`bash
# Install Meilisearch
composer require meilisearch/meilisearch-php

# Add to products model
use Laravel\\Scout\\Searchable;
class Product extends Model {
    use Searchable;
}

# Index products
php artisan scout:import \"App\\Models\\Product\"
\`\`\`" --label "enhancement,search,performance"

gh issue create --title "Product Reviews & Ratings System" --body "Allow users to rate products and shops.

## Database Tables Needed
\`\`\`sql
CREATE TABLE reviews (
    id BIGINT PRIMARY KEY,
    user_id BIGINT,
    product_id BIGINT,
    shop_id BIGINT,
    rating INT (1-5),
    comment TEXT,
    created_at TIMESTAMP
);
\`\`\`

## Features
- 5-star rating system
- Written reviews
- Review moderation
- Verified purchase badge
- Helpful/not helpful votes
- Photo uploads with reviews
- Response from shop owners

## UI Components
- Star rating input
- Review form
- Review list with filters
- Average rating display
- Rating distribution chart" --label "enhancement,feature,reviews"

gh issue create --title "Favorites/Wishlist Functionality" --body "Database table exists but no UI to save/view favorites.

## Problem
- favorites table exists in database
- No UI to add/remove favorites
- No favorites page to view saved items
- Heart icon not functional

## Solution
1. Create favorites API endpoints
2. Add JavaScript for toggle favorite
3. Create favorites page (resources/views/favorites.blade.php)
4. Add heart icon to product cards
5. Show favorite count on user menu

## API Endpoints
\`\`\`php
POST /api/favorites/{product_id}  // Add to favorites
DELETE /api/favorites/{product_id} // Remove from favorites
GET /favorites // View favorites page
\`\`\`

## Features
- Quick add/remove from any page
- Favorites page with product grid
- Remove from favorites
- Share wishlist link
- Email wishlist" --label "enhancement,feature,UI/UX"

gh issue create --title "API Documentation (Swagger/OpenAPI)" --body "API endpoints exist but not documented.

## Problem
- Search API endpoint exists but not documented
- No API documentation for developers
- Difficult for third-party integration

## Solution
Generate API documentation using:

### Option 1: Laravel OpenAPI (Recommended)
\`\`\`bash
composer require vyuldashev/laravel-openapi
php artisan openapi:generate
\`\`\`

### Option 2: Scramble
\`\`\`bash
composer require dedoc/scramble
\`\`\`

## Documentation Should Include
- All API endpoints
- Request/response examples
- Authentication requirements
- Rate limiting info
- Error codes
- Code examples (PHP, JavaScript, Python)

## Access
- /api/documentation
- Interactive API testing
- Download OpenAPI JSON/YAML" --label "enhancement,documentation,API"

echo "All GitHub issues created successfully!"
```

## Option 2: Create Issues Manually on GitHub

Visit: https://github.com/KusalPabasara/Snap/issues/new

Copy and paste each issue from the `/issues` page on your local app:
http://127.0.0.1:8000/issues

---

## Quick Start (Windows)

1. Install GitHub CLI:
```powershell
winget install --id GitHub.cli
```

2. Restart terminal and run:
```bash
cd C:\Users\mymem\Documents\Snap
gh auth login
```

3. Copy all the `gh issue create` commands above and paste into terminal

4. Press Enter and watch issues get created!

---

## Verification

After running, check:
https://github.com/KusalPabasara/Snap/issues

You should see 15 new issues with proper labels and priorities!
