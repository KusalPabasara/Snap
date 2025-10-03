<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Snap') }} - @yield('title', 'Smart Shopping Platform')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/js/app.js'])

    @stack('styles')

    <!-- Dark mode initialization script -->
    <script>
        // Initialize dark mode before page renders to prevent flash
        const htmlEl = document.documentElement;
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlEl.classList.add('dark');
            htmlEl.setAttribute('data-theme', 'dark');
        } else {
            htmlEl.classList.remove('dark');
            htmlEl.setAttribute('data-theme', 'light');
        }
    </script>
</head>
<body class="h-full antialiased">
    <div id="app">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="flex items-center space-x-2">
                                <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                </svg>
                                <span class="text-2xl font-bold text-gray-900 dark:text-white">Snap</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="/" class="border-primary-500 dark:border-primary-400 text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Home
                            </a>
                            <a href="{{ route('ai.search') }}" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 hover:text-gray-700 dark:hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                AI Search
                            </a>
                            <a href="/shops" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 hover:text-gray-700 dark:hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                                Shops
                            </a>
                            <a href="/categories" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 hover:text-gray-700 dark:hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                                Categories
                            </a>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none transition-colors" aria-label="Toggle dark mode">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <a href="/register-shop" class="bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Register Shop
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 dark:bg-gray-950 text-white mt-20 transition-colors duration-200">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="w-8 h-8 text-primary-500 dark:text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            <span class="text-2xl font-bold">Snap</span>
                        </div>
                        <p class="text-gray-400 dark:text-gray-300 mb-4">
                            Find products faster. Shop smarter. Save time with AI-powered search and nearby shop recommendations.
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Built with ❤️ in Sri Lanka 🇱🇰
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider mb-4 text-gray-200">For Customers</h3>
                        <ul class="space-y-2 text-gray-400 dark:text-gray-300">
                            <li><a href="/search?type=image" class="hover:text-white transition">Image Search</a></li>
                            <li><a href="/search" class="hover:text-white transition">Text Search</a></li>
                            <li><a href="/shops" class="hover:text-white transition">Browse Shops</a></li>
                            <li><a href="/categories" class="hover:text-white transition">Categories</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider mb-4 text-gray-200">For Shops</h3>
                        <ul class="space-y-2 text-gray-400 dark:text-gray-300">
                            <li><a href="/register-shop" class="hover:text-white transition">Register Shop</a></li>
                            <li><a href="/pricing" class="hover:text-white transition">Pricing</a></li>
                            <li><a href="/api-docs" class="hover:text-white transition">API Access</a></li>
                            <li><a href="/support" class="hover:text-white transition">Support</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-800 dark:border-gray-700 text-center text-gray-400 dark:text-gray-300 text-sm">
                    <p>&copy; {{ date('Y') }} Snap. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Dark mode toggle script -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Show appropriate icon
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            // Toggle icons
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Toggle dark mode
            const htmlEl = document.documentElement;
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    htmlEl.classList.add('dark');
                    htmlEl.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    htmlEl.classList.remove('dark');
                    htmlEl.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                }
            } else {
                if (htmlEl.classList.contains('dark')) {
                    htmlEl.classList.remove('dark');
                    htmlEl.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                } else {
                    htmlEl.classList.add('dark');
                    htmlEl.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>

    <!-- Geolocation Script -->
    <script>
        // Request geolocation on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check if geolocation is already stored
            const storedLocation = localStorage.getItem('userLocation');

            if (!storedLocation && navigator.geolocation) {
                // Request location permission
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const location = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            accuracy: position.coords.accuracy,
                            timestamp: new Date().toISOString()
                        };

                        localStorage.setItem('userLocation', JSON.stringify(location));
                        console.log('Location saved:', location);

                        // Dispatch custom event for components that need location
                        window.dispatchEvent(new CustomEvent('locationUpdated', { detail: location }));
                    },
                    function(error) {
                        console.warn('Geolocation error:', error.message);
                        // Store that user denied permission
                        if (error.code === error.PERMISSION_DENIED) {
                            localStorage.setItem('locationPermission', 'denied');
                        }
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            } else if (storedLocation) {
                // Dispatch event with stored location
                const location = JSON.parse(storedLocation);
                window.dispatchEvent(new CustomEvent('locationUpdated', { detail: location }));
            }
        });

        // Function to refresh location (can be called by components)
        window.refreshLocation = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const location = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            accuracy: position.coords.accuracy,
                            timestamp: new Date().toISOString()
                        };

                        localStorage.setItem('userLocation', JSON.stringify(location));
                        window.dispatchEvent(new CustomEvent('locationUpdated', { detail: location }));
                    },
                    function(error) {
                        console.warn('Geolocation error:', error.message);
                    }
                );
            }
        };

        // Function to get stored location
        window.getUserLocation = function() {
            const stored = localStorage.getItem('userLocation');
            return stored ? JSON.parse(stored) : null;
        };
    </script>

    @stack('scripts')
</body>
</html>
