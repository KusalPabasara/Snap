@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                @if($query)
                    Search Results for "<span class="text-primary-600 dark:text-primary-400">{{ $query }}</span>"
                @else
                    Search Results
                @endif
            </h1>
            <p class="text-gray-600 dark:text-gray-300">
                Found {{ $products->total() }} {{ Str::plural('product', $products->total()) }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Filters Sidebar -->
            <aside class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-4 transition-colors duration-200">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filters</h2>

                    <form action="{{ route('search') }}" method="GET" class="space-y-6">
                        <input type="hidden" name="q" value="{{ $query }}">

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Category
                            </label>
                            <select
                                name="category"
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 text-gray-900 dark:text-white transition-colors"
                            >
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Price Range (LKR)
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <input
                                    type="number"
                                    name="min_price"
                                    placeholder="Min"
                                    value="{{ request('min_price') }}"
                                    class="px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-colors"
                                />
                                <input
                                    type="number"
                                    name="max_price"
                                    placeholder="Max"
                                    value="{{ request('max_price') }}"
                                    class="px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-colors"
                                />
                            </div>
                        </div>

                        <!-- Distance Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Distance (km)
                            </label>
                            <input
                                type="number"
                                name="radius"
                                placeholder="10"
                                value="{{ request('radius', 10) }}"
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-colors"
                            />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maximum distance from your location</p>
                        </div>

                        <div class="flex space-x-2">
                            <button
                                type="submit"
                                class="flex-1 bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 text-white font-medium py-2 px-4 rounded-lg transition-colors"
                            >
                                Apply Filters
                            </button>
                            <a
                                href="{{ route('search', ['q' => $query]) }}"
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors"
                            >
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Results Grid -->
            <main class="lg:col-span-3">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden group">
                                <!-- Product Image -->
                                <div class="relative h-48 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                    @if($product->image_url)
                                        <img
                                            src="{{ $product->image_url }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                                        />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Stock Badge -->
                                    @if($product->stock_quantity > 0)
                                        <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                            In Stock
                                        </span>
                                    @else
                                        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                            Out of Stock
                                        </span>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <div class="mb-2">
                                        <span class="text-xs font-medium text-primary-600 dark:text-primary-400">
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-1">
                                        {{ $product->name }}
                                    </h3>

                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-2">
                                        {{ $product->description }}
                                    </p>

                                    <!-- Shop Info -->
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ $product->shop->name ?? 'Unknown Shop' }}
                                    </div>

                                    <!-- Price and Action -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                                                LKR {{ number_format($product->price, 2) }}
                                            </span>
                                        </div>
                                        <button class="bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-12 text-center transition-colors duration-200">
                        <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No products found</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Try adjusting your search or filters to find what you're looking for.
                        </p>
                        <a
                            href="/"
                            class="inline-block bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 text-white font-medium py-2 px-6 rounded-lg transition-colors"
                        >
                            Back to Home
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
