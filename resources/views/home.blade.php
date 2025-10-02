@extends('layouts.app')

@section('title', 'Find Products Instantly')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-primary-600 to-primary-800 dark:from-primary-700 dark:to-primary-900 overflow-hidden transition-colors duration-200">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                        <span class="block">Find What You Want,</span>
                        <span class="block text-primary-200 dark:text-primary-100">Right Where You Need It</span>
                    </h1>
                    <p class="mt-3 text-base text-primary-100 dark:text-primary-50 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Stop wasting time searching! Use AI-powered image recognition or simple text search to find products in nearby shops instantly.
                    </p>

                    <!-- Search Tabs -->
                    <div class="mt-10 sm:mt-12" id="search-container">
                        <search-bar></search-bar>
                    </div>

                    <!-- Features -->
                    <div class="mt-8 flex flex-wrap gap-4 justify-center lg:justify-start">
                        <div class="flex items-center text-primary-100 dark:text-primary-50">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            AI-Powered Search
                        </div>
                        <div class="flex items-center text-primary-100 dark:text-primary-50">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Nearby Shops
                        </div>
                        <div class="flex items-center text-primary-100 dark:text-primary-50">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Price Comparison
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full bg-primary-700 dark:bg-primary-800 flex items-center justify-center transition-colors duration-200">
            <svg class="w-64 h-64 text-primary-500 dark:text-primary-600 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="py-16 bg-white dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                How Snap Works
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Find products in 3 simple steps
            </p>
        </div>

        <div class="mt-12">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 mx-auto transition-colors duration-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-medium text-gray-900 dark:text-white">1. Search</h3>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                        Upload an image or type what you're looking for
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 mx-auto transition-colors duration-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-medium text-gray-900 dark:text-white">2. Discover</h3>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                        AI finds matching products in nearby shops
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 mx-auto transition-colors duration-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-medium text-gray-900 dark:text-white">3. Shop</h3>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                        Compare prices and visit the shop that suits you best
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="py-16 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                Popular Categories
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Explore products across various categories
            </p>
        </div>

        <div class="mt-12 grid grid-cols-2 gap-4 md:grid-cols-4 lg:gap-6">
            <!-- Category Cards -->
            <a href="/categories/electronics" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">📱</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Electronics</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Phones, Laptops & More</p>
            </a>

            <a href="/categories/food" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">🍔</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Food</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Restaurants & Cafes</p>
            </a>

            <a href="/categories/fashion" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">👕</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Fashion</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Clothing & Accessories</p>
            </a>

            <a href="/categories/books" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">📚</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Books</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Bookstores & Stationery</p>
            </a>

            <a href="/categories/groceries" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">🥬</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Groceries</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Fresh Produce & Essentials</p>
            </a>

            <a href="/categories/home" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">🏠</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Home</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Furniture & Decor</p>
            </a>

            <a href="/categories/gaming" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">🎮</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Gaming</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Games & Consoles</p>
            </a>

            <a href="/categories/beauty" class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <div class="text-4xl mb-3">💄</div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Beauty</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Cosmetics & Care</p>
            </a>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-16 bg-primary-600 dark:bg-primary-700 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            <div class="text-center">
                <div class="text-4xl font-bold text-white">500+</div>
                <div class="mt-2 text-primary-100 dark:text-primary-50">Active Shops</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-white">50K+</div>
                <div class="mt-2 text-primary-100 dark:text-primary-50">Products</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-white">10K+</div>
                <div class="mt-2 text-primary-100 dark:text-primary-50">Happy Users</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-white">99%</div>
                <div class="mt-2 text-primary-100 dark:text-primary-50">Success Rate</div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16 bg-white dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-primary-600 to-primary-800 dark:from-primary-700 dark:to-primary-900 rounded-2xl shadow-xl overflow-hidden transition-colors duration-200">
            <div class="px-6 py-12 sm:px-12 sm:py-16 lg:flex lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        <span class="block">Own a shop?</span>
                        <span class="block text-primary-200 dark:text-primary-100">Join Snap today.</span>
                    </h2>
                    <p class="mt-4 text-lg text-primary-100 dark:text-primary-50">
                        Reach thousands of customers searching for products like yours.
                    </p>
                </div>
                <div class="mt-8 lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-lg shadow">
                        <a href="/register-shop" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-primary-600 bg-white hover:bg-gray-50 transition-colors">
                            Register Your Shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
