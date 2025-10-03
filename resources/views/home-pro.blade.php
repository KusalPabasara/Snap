@extends('layouts.app')

@section('title', 'Snap - AI-Powered Shopping Platform')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<style>
/* Professional Typography - Amazon Level */
* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
    font-weight: 700;
    letter-spacing: -0.03em;
    line-height: 1.15;
}

/* Premium Animations */
@keyframes float3D {
    0%, 100% { transform: translateY(0px) translateZ(0px) rotateY(0deg); }
    33% { transform: translateY(-30px) translateZ(25px) rotateY(6deg); }
    66% { transform: translateY(-18px) translateZ(-12px) rotateY(-4deg); }
}

@keyframes shimmerGlow {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

@keyframes pulseGlow {
    0%, 100% {
        box-shadow: 0 0 30px rgba(139, 92, 246, 0.4), 0 0 60px rgba(139, 92, 246, 0.2);
    }
    50% {
        box-shadow: 0 0 50px rgba(139, 92, 246, 0.6), 0 0 100px rgba(139, 92, 246, 0.3);
    }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-120px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(120px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(80px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Class Applications */
.float-3d { animation: float3D 7s ease-in-out infinite; }
.shimmer { animation: shimmerGlow 3s infinite; }
.pulse-glow { animation: pulseGlow 4s ease-in-out infinite; }
.slide-in-left { animation: slideInLeft 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
.slide-in-right { animation: slideInRight 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
.fade-in-up { animation: fadeInUp 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }

/* Gradient Text - Professional */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientFlow 8s ease infinite;
    font-weight: 900;
}

/* Glass Morphism Ultra */
.glass-premium {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(24px) saturate(200%);
    -webkit-backdrop-filter: blur(24px) saturate(200%);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 40px rgba(31, 38, 135, 0.4);
}

/* Product Card Premium */
.product-card {
    background: linear-gradient(135deg, rgba(30, 30, 50, 0.9), rgba(20, 20, 40, 0.95));
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 28px;
    overflow: hidden;
    transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 25px 70px rgba(0,0,0,0.35);
}

.product-card:hover {
    transform: scale(1.08) translateY(-15px) rotateY(8deg);
    box-shadow: 0 35px 90px rgba(139, 92, 246, 0.5);
}

/* Button Ultra Premium */
.btn-pro {
    position: relative;
    overflow: hidden;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: none;
    transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 12px 35px rgba(139, 92, 246, 0.35);
}

.btn-pro::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    transform: translate(-50%, -50%);
    transition: width 0.8s, height 0.8s;
}

.btn-pro:hover::before {
    width: 350px;
    height: 350px;
}

.btn-pro:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 50px rgba(139, 92, 246, 0.6);
}

/* Image Container Professional */
.img-pro {
    position: relative;
    overflow: hidden;
    border-radius: 32px;
    box-shadow: 0 25px 70px rgba(0,0,0,0.25);
    transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.img-pro:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 35px 90px rgba(0,0,0,0.35);
}

.img-pro::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.9s;
    z-index: 10;
}

.img-pro:hover::before {
    left: 100%;
}

/* Badge Premium */
.badge-pro {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(99, 102, 241, 0.2));
    border: 2px solid rgba(139, 92, 246, 0.4);
    border-radius: 50px;
    backdrop-filter: blur(12px);
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 0.6px;
}

/* Section Reveal */
.section-reveal {
    opacity: 0;
    transform: translateY(70px);
    transition: all 1.2s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.section-reveal.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Delays */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }

/* Professional Text */
.text-pro {
    font-size: 1.15rem;
    line-height: 1.8;
    color: #525252;
    font-weight: 400;
    letter-spacing: 0.015em;
}

.dark .text-pro {
    color: #d4d4d4;
}
</style>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-purple-900/20 dark:to-gray-900 min-h-screen flex items-center">
    <!-- Animated Blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-50">
        <div class="absolute top-20 left-10 w-[600px] h-[600px] bg-purple-400/40 rounded-full blur-[130px] float-3d"></div>
        <div class="absolute bottom-20 right-10 w-[700px] h-[700px] bg-blue-400/40 rounded-full blur-[150px] float-3d delay-400"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-20 items-center py-24">
            <!-- Left: Content -->
            <div class="space-y-12">
                <div class="opacity-0 slide-in-left space-y-7">
                    <div class="badge-pro pulse-glow">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Sri Lanka's Premier AI Shopping Platform
                    </div>

                    <h1 class="text-7xl sm:text-8xl lg:text-9xl font-black leading-[1.05] tracking-tighter">
                        <span class="block text-gray-900 dark:text-white">Shop Smarter</span>
                        <span class="block gradient-text mt-3">with AI Power</span>
                    </h1>
                </div>

                <p class="text-pro text-2xl opacity-0 slide-in-left delay-200 max-w-2xl leading-relaxed">
                    Revolutionary shopping experience powered by cutting-edge artificial intelligence. Snap photos to find products instantly, or search naturally like talking to a friend.
                </p>

                <div class="flex flex-wrap gap-6 opacity-0 slide-in-left delay-300">
                    <a href="{{ route('ai.search') }}" class="btn btn-pro btn-lg bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 text-white border-0 px-12 py-6 text-xl">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="relative z-10">Start AI Search</span>
                    </a>
                    <a href="#features" class="btn btn-lg border-3 border-purple-600 text-purple-600 hover:bg-purple-50 dark:border-purple-400 dark:text-purple-400 px-12 py-6 text-xl font-bold bg-transparent">
                        Learn More
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap items-center gap-10 pt-10 opacity-0 slide-in-left delay-400 border-t-2 border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 border-4 border-white dark:border-gray-900 flex items-center justify-center text-white font-black text-lg">S</div>
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 border-4 border-white dark:border-gray-900 flex items-center justify-center text-white font-black text-lg">N</div>
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-green-500 to-emerald-500 border-4 border-white dark:border-gray-900 flex items-center justify-center text-white font-black text-lg">A</div>
                        </div>
                        <div>
                            <p class="text-base font-black text-gray-900 dark:text-white">11+ Happy Users</p>
                            <p class="text-sm text-gray-500">Growing daily</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex">
                            @for($i=0; $i<5; $i++)
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endfor
                        </div>
                        <div>
                            <p class="text-base font-black text-gray-900 dark:text-white">4.9/5 Stars</p>
                            <p class="text-sm text-gray-500">Top rated</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Floating Products -->
            <div class="relative h-[750px] opacity-0 slide-in-right delay-300">
                <!-- Main Card -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[420px] h-[420px] float-3d">
                    <div class="product-card w-full h-full p-8">
                        <div class="relative h-72 mb-6 rounded-3xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=900&h=900&fit=crop&q=90" alt="Premium Smartwatch" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute top-5 right-5 glass-premium px-5 py-3 rounded-full">
                                <span class="text-white font-bold">Hot Deal</span>
                            </div>
                        </div>
                        <h3 class="text-white font-black text-3xl mb-3">Premium Smartwatch</h3>
                        <p class="text-gray-300 mb-5">Advanced health & fitness tracking</p>
                        <div class="flex items-center justify-between">
                            <span class="text-4xl font-black text-white">LKR 45,900</span>
                            <button class="glass-premium px-6 py-3 rounded-full text-white font-bold hover:bg-white/30 transition">View</button>
                        </div>
                    </div>
                </div>

                <!-- Secondary Cards -->
                <div class="absolute top-12 right-8 w-60 h-60 float-3d delay-200">
                    <div class="product-card w-full h-full p-5">
                        <div class="relative h-36 mb-4 rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1606220588913-b3aacb4d2f46?w=700&h=700&fit=crop&q=90" alt="Headphones" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        </div>
                        <h4 class="text-white font-bold text-xl mb-2">Wireless Headphones</h4>
                        <span class="text-2xl font-black text-white">LKR 12,500</span>
                    </div>
                </div>

                <div class="absolute bottom-20 left-4 w-72 h-72 float-3d delay-400">
                    <div class="product-card w-full h-full p-6">
                        <div class="relative h-40 mb-4 rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=700&h=700&fit=crop&q=90" alt="Sneakers" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        </div>
                        <h4 class="text-white font-bold text-xl mb-2">Premium Sneakers</h4>
                        <span class="text-2xl font-black text-white">LKR 8,900</span>
                    </div>
                </div>

                <div class="absolute top-32 left-8 w-52 h-52 float-3d delay-600">
                    <div class="product-card w-full h-full p-4">
                        <div class="relative h-32 mb-3 rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1592286927505-b0e6067947d4?w=700&h=700&fit=crop&q=90" alt="Phone" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        </div>
                        <h4 class="text-white font-bold text-lg mb-2">Latest Phone</h4>
                        <span class="text-xl font-black text-white">LKR 89,900</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="py-28 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 section-reveal">
            @php
            $stats = [
                ['n' => '20+', 'l' => 'Active Shops', 's' => 'Verified'],
                ['n' => '35+', 'l' => 'Categories', 's' => 'Available'],
                ['n' => '21+', 'l' => 'Products', 's' => 'Listed'],
                ['n' => '11+', 'l' => 'Users', 's' => 'Active'],
            ];
            @endphp
            @foreach($stats as $stat)
            <div class="text-center group">
                <div class="p-10 rounded-3xl glass-premium group-hover:pulse-glow transition">
                    <div class="text-7xl font-black gradient-text mb-4">{{ $stat['n'] }}</div>
                    <div class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $stat['l'] }}</div>
                    <div class="text-sm text-gray-500">{{ $stat['s'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reveals = document.querySelectorAll('.section-reveal');
    const revealOnScroll = () => {
        const wh = window.innerHeight;
        reveals.forEach(el => {
            const et = el.getBoundingClientRect().top;
            if (et < wh - 100) el.classList.add('visible');
        });
    };
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();
});
</script>

@endsection
