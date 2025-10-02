# GitHub Issues Creation Script for Snap Project
# Run this after installing GitHub CLI: winget install --id GitHub.cli

Write-Host "Creating GitHub Issues for Snap Project..." -ForegroundColor Cyan

# Check if gh CLI is installed
try {
    gh --version | Out-Null
} catch {
    Write-Host "ERROR: GitHub CLI not found!" -ForegroundColor Red
    Write-Host "Install it with: winget install --id GitHub.cli" -ForegroundColor Yellow
    exit 1
}

# Check if authenticated
$authStatus = gh auth status 2>&1
if ($authStatus -match "not logged into") {
    Write-Host "Please login to GitHub first:" -ForegroundColor Yellow
    gh auth login
}

Write-Host "`nCreating High Priority Issues..." -ForegroundColor Red

# Issue #1: PostGIS
gh issue create --title "[CRITICAL] PostGIS Extension Not Installed" --body @"
PostgreSQL doesn't have PostGIS extension. This is required for advanced geolocation queries.

## Problem
Current implementation uses basic lat/lng decimals without PostGIS spatial indexing, which is inefficient for location-based queries.

## Solution
1. Install PostGIS extension for PostgreSQL
2. Run: ``CREATE EXTENSION postgis;``
3. Update Shop migration to use geometry type
4. Add spatial indexes for better performance

## Commands
``````sql
CREATE EXTENSION postgis;
ALTER TABLE shops ADD COLUMN location GEOGRAPHY(Point, 4326);
CREATE INDEX shops_location_idx ON shops USING GIST(location);
``````

## Impact
- Enables efficient radius-based shop searches
- Better performance for nearby product queries
- Proper distance calculations
"@ --label "priority: critical,database,geolocation"

Write-Host "✓ Issue #1 created: PostGIS Extension" -ForegroundColor Green

# Issue #2: Authentication
gh issue create --title "[CRITICAL] Authentication System Missing" --body @"
No user authentication implemented. Users can't register, login, or manage accounts.

## Problem
- No user registration/login functionality
- Shop registration has placeholder owner_id
- No protected routes
- No user sessions

## Solution
1. Install Laravel Breeze: ``composer require laravel/breeze --dev``
2. Run setup: ``php artisan breeze:install vue``
3. Run migrations: ``php artisan migrate``
4. Update shop registration to use ``auth()->id()``
5. Add auth middleware to protected routes

## Routes to Protect
- /register-shop (require auth)
- /shops/{id}/edit (require ownership)
- /favorites (require auth)

## Impact
- Users can create accounts and login
- Shop owners properly associated with shops
- Secure access control
"@ --label "priority: critical,authentication,security"

Write-Host "✓ Issue #2 created: Authentication System" -ForegroundColor Green

# Issue #3: Sample Data
gh issue create --title "[CRITICAL] No Sample Data / Database Seeding" --body @"
Empty database makes testing difficult. Need realistic sample data.

## Problem
- Database tables exist but are empty
- Can't test search functionality
- Can't demo the application
- Difficult to develop features

## Solution
1. Create seeders for all tables
2. Add realistic data (50+ products, 20+ shops)
3. Include Sri Lankan cities and businesses
4. Add sample users and categories

## Impact
- Enables proper testing
- Demonstrates functionality
- Provides realistic user experience
"@ --label "priority: critical,database,testing"

Write-Host "✓ Issue #3 created: Sample Data Seeding" -ForegroundColor Green

Write-Host "`nCreating Medium Priority Issues..." -ForegroundColor Yellow

# Issue #4: Image AI
gh issue create --title "Image Upload & AI Recognition Not Implemented" --body @"
Image search tab exists but doesn't actually upload or process images.

## Solution
1. Configure Laravel filesystem for image uploads
2. Integrate AI service (Google Cloud Vision/AWS Rekognition)
3. Extract product features from images
4. Match against product database

## Impact
- Users can search by taking/uploading photos
- Unique selling point for the platform
"@ --label "priority: medium,AI/ML,feature"

Write-Host "✓ Issue #4 created: Image AI Recognition" -ForegroundColor Green

# Issue #5: Pagination
gh issue create --title "Search Results Need Pagination Styling" --body @"
Laravel pagination links don't use DaisyUI styling.

## Solution
1. Publish Laravel pagination views
2. Replace with DaisyUI button classes
3. Use DaisyUI join component for pagination

## Impact
- Consistent UI/UX
- Professional appearance
"@ --label "priority: medium,UI/UX,design"

Write-Host "✓ Issue #5 created: Pagination Styling" -ForegroundColor Green

# Issue #6: Detail Pages
gh issue create --title "Missing Shop & Category Detail Pages" --body @"
Routes exist but views not created for shop details and category product views.

## Solution
Create these view files:
- resources/views/shops/show.blade.php
- resources/views/categories/show.blade.php

Include: product grids, maps, filters, breadcrumbs

## Impact
- Complete user journey
- Users can view shop/category details
"@ --label "priority: medium,views,UI/UX"

Write-Host "✓ Issue #6 created: Detail Pages" -ForegroundColor Green

# Issue #7: Geolocation
gh issue create --title "Geolocation Permission Not Requested" --body @"
App needs user's location for nearby shop search but doesn't request browser permission.

## Solution
1. Add geolocation API permission request
2. Display current location to user
3. Add manual location input as fallback
4. Save location to localStorage

## Impact
- Enables nearby shop searches
- Core feature becomes functional
"@ --label "priority: medium,geolocation,JavaScript"

Write-Host "✓ Issue #7 created: Geolocation Permission" -ForegroundColor Green

Write-Host "`nCreating Enhancement Issues..." -ForegroundColor Cyan

# Issue #8: Admin Dashboard
gh issue create --title "Admin Dashboard Missing" --body @"
No admin panel to manage shops, products, and users.

## Features Needed
- User management
- Shop approval workflow
- Product moderation
- Analytics dashboard

## Technology: Laravel Filament (free, modern)
"@ --label "priority: low,admin,enhancement"

Write-Host "✓ Issue #8 created: Admin Dashboard" -ForegroundColor Green

# Issue #9: Payments
gh issue create --title "Payment Gateway Integration" --body @"
Subscription system designed but no payment processing.

## Required
- Shop owner subscriptions
- Payment processing (PayHere/Stripe)
- Recurring billing
- Invoice generation
"@ --label "priority: low,payments,enhancement"

Write-Host "✓ Issue #9 created: Payment Gateway" -ForegroundColor Green

# Issue #10: Email
gh issue create --title "Email Notifications System" --body @"
No email system for shop approval, password reset, etc.

## Emails Needed
- Shop registration confirmation
- Shop approval/rejection
- Password reset
- Welcome email

## Setup: Mailgun/SendGrid
"@ --label "priority: low,notifications,enhancement"

Write-Host "✓ Issue #10 created: Email Notifications" -ForegroundColor Green

# Issue #11: Mobile
gh issue create --title "Mobile App (Flutter/React Native)" --body @"
Native mobile apps for better UX on iOS and Android.

## Features
- Camera integration for image search
- GPS for location tracking
- Push notifications
- Offline capabilities

## Technology: Flutter (recommended)
"@ --label "priority: low,mobile,enhancement"

Write-Host "✓ Issue #11 created: Mobile App" -ForegroundColor Green

# Issue #12: Search Engine
gh issue create --title "Full-Text Search Engine (Meilisearch)" --body @"
Current search uses basic SQL LIKE. Need full-text search.

## Benefits
- Fast search
- Typo tolerance
- Relevance ranking
- Better multi-language support

## Technology: Meilisearch (recommended)
"@ --label "priority: low,search,enhancement"

Write-Host "✓ Issue #12 created: Search Engine" -ForegroundColor Green

# Issue #13: Reviews
gh issue create --title "Product Reviews & Ratings System" --body @"
Allow users to rate products and shops.

## Features
- 5-star rating system
- Written reviews
- Review moderation
- Verified purchase badge
"@ --label "priority: low,reviews,enhancement"

Write-Host "✓ Issue #13 created: Reviews System" -ForegroundColor Green

# Issue #14: Wishlist
gh issue create --title "Favorites/Wishlist Functionality" --body @"
Database table exists but no UI to save/view favorites.

## Solution
1. Create favorites API endpoints
2. Add JavaScript for toggle favorite
3. Create favorites page
4. Add heart icon to product cards
"@ --label "priority: low,feature,enhancement"

Write-Host "✓ Issue #14 created: Wishlist UI" -ForegroundColor Green

# Issue #15: API Docs
gh issue create --title "API Documentation (Swagger/OpenAPI)" --body @"
API endpoints exist but not documented.

## Solution
Generate API documentation using Laravel OpenAPI

## Should Include
- All API endpoints
- Request/response examples
- Authentication requirements
- Interactive testing

## Access: /api/documentation
"@ --label "priority: low,documentation,enhancement"

Write-Host "✓ Issue #15 created: API Documentation" -ForegroundColor Green

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "SUCCESS! Created 15 GitHub Issues" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "`nView them at: https://github.com/KusalPabasara/Snap/issues" -ForegroundColor Yellow
Write-Host "`nBreakdown:" -ForegroundColor White
Write-Host "  Critical Issues:    3" -ForegroundColor Red
Write-Host "  Medium Priority:    4" -ForegroundColor Yellow
Write-Host "  Enhancements:       8" -ForegroundColor Cyan
Write-Host "`nPress any key to exit..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
