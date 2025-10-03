@extends('layouts.app')

@section('title', 'Find Products Instantly')

@section('content')
<!-- Animated Background -->
<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
}

.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-scaleIn {
    animation: scaleIn 0.6s ease-out forwards;
}

.animate-pulse-slow {
    animation: pulse 3s ease-in-out infinite;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }

.glass-effect {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
</style>

<!-- Hero Section with Animated Gradient Background -->
<div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-purple-600 via-blue-600 to-cyan-500 dark:from-purple-900 dark:via-blue-900 dark:to-cyan-900 animate-gradient">
    <!-- Floating Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-float delay-200"></div>
        <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-cyan-500/20 rounded-full blur-3xl animate-float delay-400"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-32">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[80vh]">
            <!-- Left Content -->
            <div class="text-white space-y-8">
                <div class="opacity-0 animate-fadeInUp">
                    <div class="inline-block mb-4">
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-lg rounded-full text-sm font-semibold">
                            🚀 AI-Powered Shopping Platform
                        </span>
                    </div>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-tight">
                        Find What You Want,
                        <span class="bg-gradient-to-r from-yellow-300 via-pink-300 to-purple-300 bg-clip-text text-transparent">
                            Right Where You Need It
                        </span>
                    </h1>
                </div>

                <p class="text-xl text-white/90 opacity-0 animate-fadeInUp delay-100">
                    Stop wasting time searching! Use AI-powered image recognition or simple text search to find products in nearby shops instantly.
                </p>

                <!-- Animated Features -->
                <div class="flex flex-wrap gap-4 opacity-0 animate-fadeInUp delay-200">
                    <div class="flex items-center gap-2 px-4 py-2 glass-effect rounded-full transition-transform hover:scale-105">
                        <svg class="w-5 h-5 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">AI-Powered Search</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 glass-effect rounded-full transition-transform hover:scale-105">
                        <svg class="w-5 h-5 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Nearby Shops</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 glass-effect rounded-full transition-transform hover:scale-105">
                        <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Best Prices</span>
                    </div>
                </div>

                <!-- AI Search CTA - Primary -->
                <div class="flex flex-wrap gap-4 opacity-0 animate-fadeInUp delay-300">
                    <a href="{{ route('ai.search') }}" class="group px-8 py-4 bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 text-white rounded-full font-bold text-lg shadow-2xl hover:shadow-purple-500/50 transform hover:scale-105 transition-all duration-300 animate-pulse-slow">
                        <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Try AI Search Now!
                        <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-xs">NEW</span>
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-8 py-4 bg-white text-purple-600 rounded-full font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                        Browse Categories
                    </a>
                </div>
            </div>

            <!-- Right Content - Animated Cards -->
            <div class="relative h-[600px] opacity-0 animate-scaleIn delay-400">
                <!-- Floating Product Cards -->
                <div class="absolute top-0 right-0 w-64 glass-effect rounded-2xl p-6 shadow-2xl transform hover:scale-105 transition-all duration-300 animate-float">
                    <div class="w-full h-32 bg-gradient-to-br from-purple-400 to-pink-400 rounded-xl mb-4"></div>
                    <h3 class="text-white font-bold text-lg mb-2">Latest Gadgets</h3>
                    <p class="text-white/70 text-sm">iPhone 15 Pro Max</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-2xl font-bold text-white">Rs. 549,900</span>
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="absolute top-40 left-0 w-64 glass-effect rounded-2xl p-6 shadow-2xl transform hover:scale-105 transition-all duration-300 animate-float delay-200">
                    <div class="w-full h-32 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-xl mb-4"></div>
                    <h3 class="text-white font-bold text-lg mb-2">Fashion Trends</h3>
                    <p class="text-white/70 text-sm">Summer Collection</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-2xl font-bold text-white">Rs. 8,500</span>
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 right-20 w-64 glass-effect rounded-2xl p-6 shadow-2xl transform hover:scale-105 transition-all duration-300 animate-float delay-400">
                    <div class="w-full h-32 bg-gradient-to-br from-green-400 to-emerald-400 rounded-xl mb-4"></div>
                    <h3 class="text-white font-bold text-lg mb-2">Gaming Gear</h3>
                    <p class="text-white/70 text-sm">PlayStation 5</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-2xl font-bold text-white">Rs. 189,900</span>
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 opacity-0 animate-fadeInUp delay-500">
            <div class="flex flex-col items-center gap-2 text-white/70 animate-pulse-slow">
                <span class="text-sm">Scroll to explore</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-20 bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">20+</div>
                <div class="text-sm mt-2 opacity-70">Active Shops</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">35+</div>
                <div class="text-sm mt-2 opacity-70">Categories</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">21+</div>
                <div class="text-sm mt-2 opacity-70">Products</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">11+</div>
                <div class="text-sm mt-2 opacity-70">Happy Users</div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="py-20 bg-gradient-to-b from-base-100 to-base-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-purple-600 via-blue-600 to-cyan-600 bg-clip-text text-transparent mb-4">
                Browse by Category
            </h2>
            <p class="text-lg opacity-70">Find exactly what you're looking for</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
            $categories = [
                ['name' => 'Electronics', 'icon' => '📱', 'color' => 'from-blue-500 to-cyan-500', 'slug' => 'electronics'],
                ['name' => 'Fashion', 'icon' => '👕', 'color' => 'from-pink-500 to-rose-500', 'slug' => 'fashion'],
                ['name' => 'Food', 'icon' => '🍔', 'color' => 'from-orange-500 to-amber-500', 'slug' => 'food-beverages'],
                ['name' => 'Books', 'icon' => '📚', 'color' => 'from-purple-500 to-indigo-500', 'slug' => 'books-items'],
                ['name' => 'Groceries', 'icon' => '🛒', 'color' => 'from-green-500 to-emerald-500', 'slug' => 'groceries'],
                ['name' => 'Home', 'icon' => '🏠', 'color' => 'from-teal-500 to-cyan-500', 'slug' => 'home-garden'],
                ['name' => 'Gaming', 'icon' => '🎮', 'color' => 'from-violet-500 to-purple-500', 'slug' => 'gaming'],
                ['name' => 'Beauty', 'icon' => '💄', 'color' => 'from-fuchsia-500 to-pink-500', 'slug' => 'beauty'],
            ];
            @endphp

            @foreach($categories as $index => $category)
            <a href="{{ route('categories.show', $category['slug']) }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br {{ $category['color'] }} p-8 text-white shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="text-5xl mb-3 transform group-hover:scale-110 transition-transform duration-300">{{ $category['icon'] }}</div>
                <h3 class="text-xl font-bold">{{ $category['name'] }}</h3>
                <div class="absolute top-0 right-0 w-20 h-20 bg-white/20 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- How It Works -->
<div class="py-20 bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4">How Snap Works</h2>
            <p class="text-lg opacity-70">Find products in 3 simple steps</p>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-3xl font-bold shadow-xl group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
                    1
                </div>
                <h3 class="text-2xl font-bold mb-4">Search</h3>
                <p class="opacity-70">Upload an image or type what you're looking for</p>
            </div>

            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-3xl font-bold shadow-xl group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
                    2
                </div>
                <h3 class="text-2xl font-bold mb-4">Discover</h3>
                <p class="opacity-70">AI finds matching products in nearby shops</p>
            </div>

            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-white text-3xl font-bold shadow-xl group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
                    3
                </div>
                <h3 class="text-2xl font-bold mb-4">Shop</h3>
                <p class="opacity-70">Visit the shop or contact them directly</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-blue-600 to-cyan-600 animate-gradient"></div>
    <div class="absolute inset-0 bg-black/20"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Ready to Start Shopping?</h2>
        <p class="text-xl mb-8 opacity-90">Join thousands of happy shoppers finding what they need, when they need it.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-purple-600 rounded-full font-bold text-lg shadow-2xl hover:shadow-white/50 transform hover:scale-105 transition-all duration-300">
                Get Started Free
            </a>
            <a href="{{ route('shops.index') }}" class="px-8 py-4 glass-effect text-white rounded-full font-bold text-lg hover:bg-white/20 transform hover:scale-105 transition-all duration-300">
                Browse Shops
            </a>
        </div>
    </div>
</div>
@endsection
