@extends('layouts.app')

@section('title', 'Snap - AI-Powered Shopping Made Easy')

@section('content')
<style>
/* Modern Animations */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(60px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes floatUpDown {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-30px); }
}

@keyframes rotateIn {
    from {
        opacity: 0;
        transform: rotate(-10deg) scale(0.9);
    }
    to {
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }
}

@keyframes parallaxFloat {
    0% { transform: translateY(0px) translateX(0px); }
    25% { transform: translateY(-20px) translateX(10px); }
    50% { transform: translateY(-10px) translateX(-10px); }
    75% { transform: translateY(-25px) translateX(5px); }
    100% { transform: translateY(0px) translateX(0px); }
}

.animate-slide-in-left {
    animation: slideInLeft 1s ease-out forwards;
}

.animate-slide-in-right {
    animation: slideInRight 1s ease-out forwards;
}

.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
}

.animate-float-up-down {
    animation: floatUpDown 4s ease-in-out infinite;
}

.animate-rotate-in {
    animation: rotateIn 1s ease-out forwards;
}

.animate-parallax-float {
    animation: parallaxFloat 8s ease-in-out infinite;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }
.delay-700 { animation-delay: 0.7s; }
.delay-800 { animation-delay: 0.8s; }

/* Image hover effects */
.hover-scale {
    transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.hover-scale:hover {
    transform: scale(1.05) rotate(2deg);
}

/* Gradient text */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradient-flow 4s ease infinite;
}

@keyframes gradient-flow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Premium button */
.btn-premium {
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
}

.btn-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.btn-premium:hover::before {
    left: 100%;
}

.section-reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.section-reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
</style>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-purple-900 dark:to-gray-900 min-h-screen flex items-center">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-parallax-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-300/20 rounded-full blur-3xl animate-parallax-float delay-400"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center py-20">
            <!-- Left Content -->
            <div class="space-y-8">
                <div class="opacity-0 animate-slide-in-left">
                    <span class="inline-block px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-300 rounded-full text-sm font-semibold mb-6">
                        ✨ Sri Lanka's First AI Shopping Platform
                    </span>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-tight mb-6">
                        Shop Smarter with
                        <span class="gradient-text block mt-2">AI-Powered Search</span>
                    </h1>
                </div>

                <p class="text-xl text-gray-700 dark:text-gray-300 opacity-0 animate-slide-in-left delay-200 leading-relaxed">
                    Take a photo. Find products instantly. No more endless scrolling. Just snap, search, and shop from nearby stores.
                </p>

                <div class="flex flex-wrap gap-4 opacity-0 animate-slide-in-left delay-300">
                    <a href="{{ route('ai.search') }}" class="btn btn-lg btn-premium bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white border-0 shadow-2xl hover:shadow-purple-500/50 transform hover:scale-105 transition-all">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Try AI Search Now
                    </a>
                    <a href="#features" class="btn btn-lg btn-outline hover:bg-purple-50 dark:hover:bg-purple-900/30">
                        Learn More
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap items-center gap-6 pt-8 opacity-0 animate-slide-in-left delay-400">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 border-2 border-white dark:border-gray-800"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 border-2 border-white dark:border-gray-800"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-400 border-2 border-white dark:border-gray-800"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Trusted by 11+ users</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">4.9/5 rating</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - Floating Product Images -->
            <div class="relative h-[600px] opacity-0 animate-slide-in-right delay-300">
                <!-- Main Product Image -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 hover-scale animate-float-up-down">
                    <div class="relative w-full h-full rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=600&fit=crop"
                             alt="Smartwatch"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white font-bold text-xl">Premium Smartwatch</h3>
                            <p class="text-white/90">LKR 45,900</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Product 1 -->
                <div class="absolute top-10 right-10 w-48 h-48 hover-scale animate-parallax-float delay-200">
                    <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop"
                             alt="Headphones"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                            <p class="text-white font-semibold text-sm">Wireless Headphones</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Product 2 -->
                <div class="absolute bottom-20 left-0 w-56 h-56 hover-scale animate-parallax-float delay-400">
                    <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=400&fit=crop"
                             alt="Sneakers"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                            <p class="text-white font-semibold text-sm">Sport Sneakers</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Product 3 -->
                <div class="absolute top-32 left-0 w-40 h-40 hover-scale animate-parallax-float delay-600">
                    <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=400&fit=crop"
                             alt="Smartphone"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
                            <p class="text-white font-semibold text-xs">Latest Phone</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-20 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 section-reveal">
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-extrabold gradient-text mb-2">20+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Active Shops</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-extrabold gradient-text mb-2">35+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Categories</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-extrabold gradient-text mb-2">21+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Products</div>
            </div>
            <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-extrabold gradient-text mb-2">11+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Happy Users</div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div id="features" class="py-24 bg-gradient-to-b from-white to-purple-50 dark:from-gray-800 dark:to-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 section-reveal">
            <h2 class="text-5xl font-extrabold gradient-text mb-4">Why Choose Snap?</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Revolutionary shopping experience powered by artificial intelligence
            </p>
        </div>

        <!-- Feature 1 - Image Search -->
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-32 section-reveal">
            <div class="order-2 lg:order-1">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-purple-200 dark:bg-purple-900/30 rounded-full blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop"
                         alt="AI Image Search"
                         class="relative rounded-3xl shadow-2xl hover-scale">
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="inline-block px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-300 rounded-full text-sm font-semibold mb-4">
                    🖼️ AI Image Recognition
                </div>
                <h3 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Take a Photo, Find it Instantly
                </h3>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                    Our AI analyzes your product photos and matches them with items from nearby shops. No more typing long descriptions!
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <strong class="text-gray-900 dark:text-white">Instant Recognition</strong>
                            <p class="text-gray-600 dark:text-gray-400">AI identifies products in seconds</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <strong class="text-gray-900 dark:text-white">Smart Matching</strong>
                            <p class="text-gray-600 dark:text-gray-400">Finds similar products automatically</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <strong class="text-gray-900 dark:text-white">Detail Extraction</strong>
                            <p class="text-gray-600 dark:text-gray-400">Detects color, brand, category</p>
                        </div>
                    </li>
                </ul>
                <a href="{{ route('ai.search') }}" class="btn btn-premium bg-gradient-to-r from-purple-600 to-blue-600 text-white border-0 mt-8">
                    Try Image Search →
                </a>
            </div>
        </div>

        <!-- Feature 2 - Location Search -->
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-32 section-reveal">
            <div>
                <div class="inline-block px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 rounded-full text-sm font-semibold mb-4">
                    📍 Smart Location
                </div>
                <h3 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Find Shops Near You
                </h3>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                    Interactive maps show you exactly where to buy products. See distances, get directions, and shop locally.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <strong class="text-gray-900 dark:text-white">Real-time Distance</strong>
                            <p class="text-gray-600 dark:text-gray-400">Shops sorted by proximity</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <strong class="text-gray-900 dark:text-white">Interactive Maps</strong>
                            <p class="text-gray-600 dark:text-gray-400">Visual shop locations</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <strong class="text-gray-900 dark:text-white">Filter by Distance</strong>
                            <p class="text-gray-600 dark:text-gray-400">1km to 50km radius</p>
                        </div>
                    </li>
                </ul>
                <a href="{{ route('shops.map') }}" class="btn btn-premium bg-gradient-to-r from-blue-600 to-cyan-600 text-white border-0 mt-8">
                    Explore Map →
                </a>
            </div>
            <div>
                <div class="relative">
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-200 dark:bg-blue-900/30 rounded-full blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1569025743873-ea3a9ade89f9?w=800&h=600&fit=crop"
                         alt="Location Map"
                         class="relative rounded-3xl shadow-2xl hover-scale">
                </div>
            </div>
        </div>

        <!-- Feature 3 - AI Text Search -->
        <div class="grid lg:grid-cols-2 gap-16 items-center section-reveal">
            <div class="order-2 lg:order-1">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-pink-200 dark:bg-pink-900/30 rounded-full blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop"
                         alt="AI Text Search"
                         class="relative rounded-3xl shadow-2xl hover-scale">
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="inline-block px-4 py-2 bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-300 rounded-full text-sm font-semibold mb-4">
                    💬 Natural Language
                </div>
                <h3 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Search Like You Talk
                </h3>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                    No need for exact keywords. Our AI understands what you mean and finds exactly what you're looking for.
                </p>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-6 mb-6">
                    <p class="text-gray-600 dark:text-gray-400 italic mb-2">Try searches like:</p>
                    <ul class="space-y-2">
                        <li class="text-gray-900 dark:text-white">"red dress for a party"</li>
                        <li class="text-gray-900 dark:text-white">"gaming laptop under 100k"</li>
                        <li class="text-gray-900 dark:text-white">"wireless headphones with noise cancelling"</li>
                    </ul>
                </div>
                <a href="{{ route('ai.search') }}" class="btn btn-premium bg-gradient-to-r from-pink-600 to-purple-600 text-white border-0">
                    Try Text Search →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-24 bg-gradient-to-br from-purple-600 via-blue-600 to-cyan-600 dark:from-purple-900 dark:via-blue-900 dark:to-cyan-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-parallax-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-parallax-float delay-400"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto section-reveal">
            <h2 class="text-5xl font-extrabold text-white mb-6">
                Ready to Transform Your Shopping?
            </h2>
            <p class="text-xl text-white/90 mb-10 leading-relaxed">
                Join thousands of smart shoppers who save time and money with AI-powered search. Start finding products instantly today.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('ai.search') }}" class="btn btn-lg bg-white text-purple-600 hover:bg-gray-100 border-0 shadow-2xl btn-premium">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Start Searching Now
                </a>
                <a href="{{ route('categories.index') }}" class="btn btn-lg btn-outline text-white border-white hover:bg-white/10">
                    Browse Categories
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Categories Preview -->
<div class="py-24 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 section-reveal">
            <h2 class="text-5xl font-extrabold gradient-text mb-4">Popular Categories</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Explore products across all categories</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 section-reveal">
            @php
            $categories = [
                ['name' => 'Electronics', 'icon' => '📱', 'color' => 'from-blue-500 to-cyan-500', 'image' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400&h=300&fit=crop'],
                ['name' => 'Fashion', 'icon' => '👕', 'color' => 'from-pink-500 to-rose-500', 'image' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400&h=300&fit=crop'],
                ['name' => 'Home', 'icon' => '🏠', 'color' => 'from-green-500 to-emerald-500', 'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400&h=300&fit=crop'],
                ['name' => 'Sports', 'icon' => '⚽', 'color' => 'from-orange-500 to-amber-500', 'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=400&h=300&fit=crop'],
                ['name' => 'Books', 'icon' => '📚', 'color' => 'from-purple-500 to-indigo-500', 'image' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=300&fit=crop'],
                ['name' => 'Beauty', 'icon' => '💄', 'color' => 'from-pink-500 to-purple-500', 'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&h=300&fit=crop'],
                ['name' => 'Toys', 'icon' => '🧸', 'color' => 'from-yellow-500 to-orange-500', 'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400&h=300&fit=crop'],
                ['name' => 'Food', 'icon' => '🍔', 'color' => 'from-red-500 to-pink-500', 'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&h=300&fit=crop'],
            ];
            @endphp

            @foreach($categories as $category)
            <a href="{{ route('categories.index') }}" class="group">
                <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t {{ $category['color'] }} opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
                        <span class="text-4xl mb-2">{{ $category['icon'] }}</span>
                        <span class="text-lg font-bold">{{ $category['name'] }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Scroll Reveal Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const revealElements = document.querySelectorAll('.section-reveal');

    const revealOnScroll = () => {
        const windowHeight = window.innerHeight;

        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const revealPoint = 150;

            if (elementTop < windowHeight - revealPoint) {
                element.classList.add('visible');
            }
        });
    };

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Initial check
});

// Parallax effect on scroll
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallaxElements = document.querySelectorAll('.animate-parallax-float');

    parallaxElements.forEach((el, index) => {
        const speed = 0.5 + (index * 0.1);
        el.style.transform = `translateY(${scrolled * speed}px)`;
    });
});
</script>

@endsection
