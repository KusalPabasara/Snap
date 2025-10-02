@extends('layouts.app')

@section('title', 'Project Issues & Roadmap')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">📋 Project Issues & Roadmap</h1>
            <p class="text-lg opacity-90">Track development progress and upcoming features</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Priority Issues -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <span class="badge badge-error badge-lg">High Priority</span>
                Critical Issues
            </h2>
            <div class="space-y-4">
                <div class="card bg-base-100 shadow-xl border-l-4 border-error">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="card-title text-xl">#1 PostGIS Extension Not Installed</h3>
                                <p class="text-sm opacity-70 mt-2">PostgreSQL doesn't have PostGIS extension. This is required for advanced geolocation queries.</p>
                                <div class="mt-4 space-y-2">
                                    <p class="font-semibold">Solution:</p>
                                    <ul class="list-disc list-inside space-y-1 text-sm">
                                        <li>Install PostGIS extension for PostgreSQL</li>
                                        <li>Run: <code class="badge badge-sm">CREATE EXTENSION postgis;</code></li>
                                        <li>Update Shop migration to use geometry type</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="badge badge-error gap-2">Critical</div>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">database</span>
                                <span class="badge badge-outline">geolocation</span>
                            </div>
                            <div class="text-sm opacity-70">Status: <span class="font-semibold text-error">Pending</span></div>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-error">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="card-title text-xl">#2 Authentication System Missing</h3>
                                <p class="text-sm opacity-70 mt-2">No user authentication implemented. Users can't register, login, or manage accounts.</p>
                                <div class="mt-4 space-y-2">
                                    <p class="font-semibold">Solution:</p>
                                    <ul class="list-disc list-inside space-y-1 text-sm">
                                        <li>Install Laravel Breeze: <code class="badge badge-sm">composer require laravel/breeze</code></li>
                                        <li>Run setup: <code class="badge badge-sm">php artisan breeze:install vue</code></li>
                                        <li>Create user registration and login pages</li>
                                        <li>Protect shop registration route with auth middleware</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="badge badge-error gap-2">Critical</div>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">authentication</span>
                                <span class="badge badge-outline">security</span>
                            </div>
                            <div class="text-sm opacity-70">Status: <span class="font-semibold text-error">Pending</span></div>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-error">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="card-title text-xl">#3 No Sample Data / Database Seeding</h3>
                                <p class="text-sm opacity-70 mt-2">Empty database makes testing difficult. Need realistic sample data.</p>
                                <div class="mt-4 space-y-2">
                                    <p class="font-semibold">Solution:</p>
                                    <ul class="list-disc list-inside space-y-1 text-sm">
                                        <li>Create database seeders for all tables</li>
                                        <li>Add 50+ sample products with images</li>
                                        <li>Add 20+ sample shops in Sri Lanka</li>
                                        <li>Add realistic categories and subcategories</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="badge badge-error gap-2">Critical</div>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">database</span>
                                <span class="badge badge-outline">testing</span>
                            </div>
                            <div class="text-sm opacity-70">Status: <span class="font-semibold text-error">Pending</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medium Priority Issues -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <span class="badge badge-warning badge-lg">Medium Priority</span>
                Important Features
            </h2>
            <div class="space-y-4">
                <div class="card bg-base-100 shadow-xl border-l-4 border-warning">
                    <div class="card-body">
                        <h3 class="card-title">#4 Image Upload & AI Recognition Not Implemented</h3>
                        <p class="text-sm opacity-70">Image search tab exists but doesn't actually upload or process images.</p>
                        <div class="mt-2 text-sm">
                            <p class="font-semibold">Todo:</p>
                            <ul class="list-disc list-inside">
                                <li>Implement image upload to storage</li>
                                <li>Integrate Google Cloud Vision API or AWS Rekognition</li>
                                <li>Extract product features from images</li>
                                <li>Match against product database</li>
                            </ul>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">AI/ML</span>
                                <span class="badge badge-outline">feature</span>
                            </div>
                            <span class="badge badge-warning">Medium</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-warning">
                    <div class="card-body">
                        <h3 class="card-title">#5 Search Results Need Pagination Styling</h3>
                        <p class="text-sm opacity-70">Laravel pagination links don't use DaisyUI styling.</p>
                        <div class="mt-2 text-sm">
                            <p class="font-semibold">Todo:</p>
                            <ul class="list-disc list-inside">
                                <li>Create custom pagination view with DaisyUI</li>
                                <li>Publish pagination views: <code class="badge badge-sm">php artisan vendor:publish --tag=laravel-pagination</code></li>
                                <li>Style with DaisyUI button classes</li>
                            </ul>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">UI/UX</span>
                                <span class="badge badge-outline">design</span>
                            </div>
                            <span class="badge badge-warning">Medium</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-warning">
                    <div class="card-body">
                        <h3 class="card-title">#6 Missing Shop & Category Detail Pages</h3>
                        <p class="text-sm opacity-70">Routes exist but views not created for shop details and category product views.</p>
                        <div class="mt-2 text-sm">
                            <p class="font-semibold">Todo:</p>
                            <ul class="list-disc list-inside">
                                <li>Create shops/show.blade.php with product grid</li>
                                <li>Create categories/show.blade.php with filters</li>
                                <li>Add breadcrumbs for navigation</li>
                                <li>Display shop contact info and location map</li>
                            </ul>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">views</span>
                                <span class="badge badge-outline">feature</span>
                            </div>
                            <span class="badge badge-warning">Medium</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-warning">
                    <div class="card-body">
                        <h3 class="card-title">#7 Geolocation Permission Not Requested</h3>
                        <p class="text-sm opacity-70">App needs user's location for nearby shop search but doesn't request browser permission.</p>
                        <div class="mt-2 text-sm">
                            <p class="font-semibold">Todo:</p>
                            <ul class="list-disc list-inside">
                                <li>Add geolocation API permission request</li>
                                <li>Show current location on search page</li>
                                <li>Allow manual location input as fallback</li>
                                <li>Save location to localStorage</li>
                            </ul>
                        </div>
                        <div class="card-actions justify-between mt-4">
                            <div class="flex gap-2">
                                <span class="badge badge-outline">feature</span>
                                <span class="badge badge-outline">geolocation</span>
                            </div>
                            <span class="badge badge-warning">Medium</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Priority / Enhancement -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <span class="badge badge-info badge-lg">Low Priority</span>
                Enhancements & Nice-to-Have
            </h2>
            <div class="space-y-4">
                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#8 Admin Dashboard Missing</h3>
                        <p class="text-sm opacity-70">No admin panel to manage shops, products, and users.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">admin</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#9 Payment Gateway Integration</h3>
                        <p class="text-sm opacity-70">Subscription system designed but no payment processing.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">payments</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#10 Email Notifications</h3>
                        <p class="text-sm opacity-70">No email system for shop approval, password reset, etc.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">notifications</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#11 Mobile App (Flutter/React Native)</h3>
                        <p class="text-sm opacity-70">Native mobile apps for better UX on iOS and Android.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">mobile</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#12 Search Engine Integration (Meilisearch/Elasticsearch)</h3>
                        <p class="text-sm opacity-70">Current search uses basic SQL LIKE. Need full-text search for better results.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">search</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#13 Product Reviews & Ratings</h3>
                        <p class="text-sm opacity-70">Allow users to rate products and shops.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">feature</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#14 Favorites/Wishlist Functionality</h3>
                        <p class="text-sm opacity-70">Database table exists but no UI to save/view favorites.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">feature</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl border-l-4 border-info">
                    <div class="card-body">
                        <h3 class="card-title">#15 API Documentation (Swagger/OpenAPI)</h3>
                        <p class="text-sm opacity-70">API endpoints exist but not documented.</p>
                        <div class="card-actions justify-between mt-4">
                            <span class="badge badge-outline">documentation</span>
                            <span class="badge badge-info">Enhancement</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Summary -->
        <div class="stats shadow w-full bg-base-100">
            <div class="stat">
                <div class="stat-figure text-error">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="stat-title">High Priority</div>
                <div class="stat-value text-error">3</div>
                <div class="stat-desc">Critical issues to fix</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="stat-title">Medium Priority</div>
                <div class="stat-value text-warning">4</div>
                <div class="stat-desc">Important features</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="stat-title">Enhancements</div>
                <div class="stat-value text-info">8</div>
                <div class="stat-desc">Nice-to-have features</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div class="stat-title">Total Issues</div>
                <div class="stat-value">15</div>
                <div class="stat-desc">Tracked & documented</div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="mt-12 alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <h3 class="font-bold">Recommended Next Steps:</h3>
                <ol class="list-decimal list-inside mt-2 space-y-1">
                    <li>Create database seeders with sample data (#3)</li>
                    <li>Install Laravel Breeze for authentication (#2)</li>
                    <li>Create shop and category detail views (#6)</li>
                    <li>Install PostGIS extension (#1)</li>
                    <li>Implement geolocation permission (#7)</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
