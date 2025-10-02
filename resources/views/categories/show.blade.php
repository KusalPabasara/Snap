@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="min-h-screen">
    <!-- Category Header -->
    <div class="bg-primary text-primary-content py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('categories.index') }}" class="btn btn-ghost btn-sm">
                    ← Back to Categories
                </a>
            </div>
            <h1 class="text-4xl font-bold mb-4">{{ $category->icon ?? '📦' }} {{ $category->name }}</h1>
            <p class="text-lg opacity-90">{{ $category->description }}</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Subcategories -->
        @if($childCategories->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Subcategories</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($childCategories as $child)
                        <a href="{{ route('categories.show', $child->slug) }}" class="card bg-base-200 hover:bg-base-300 transition-colors">
                            <div class="card-body p-4 text-center">
                                <div class="text-3xl mb-2">{{ $child->icon ?? '📦' }}</div>
                                <h3 class="text-sm font-semibold">{{ $child->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Products -->
        <div>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Products ({{ $products->total() }})</h2>
                <div class="flex gap-2">
                    <select class="select select-bordered select-sm">
                        <option>Sort by: Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                    </select>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            <figure class="h-48 bg-gradient-to-br from-base-200 to-base-300">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center w-full h-full text-6xl">
                                        {{ $category->icon ?? '📦' }}
                                    </div>
                                @endif
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title text-lg">{{ $product->name }}</h3>
                                <p class="text-sm opacity-70 line-clamp-2">{{ $product->description }}</p>

                                <div class="flex items-center gap-2 text-sm opacity-70 mt-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <a href="{{ route('shops.show', $product->shop_id) }}" class="link link-hover">
                                        {{ $product->shop->name }}
                                    </a>
                                </div>

                                <div class="card-actions justify-between items-center mt-4">
                                    <div class="text-2xl font-bold text-primary">
                                        Rs. {{ number_format($product->price, 2) }}
                                    </div>
                                    <button class="btn btn-primary btn-sm">View</button>
                                </div>

                                @if($product->stock_quantity > 0)
                                    <div class="badge badge-success badge-sm">In Stock</div>
                                @else
                                    <div class="badge badge-error badge-sm">Out of Stock</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>No products found in this category yet.</span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
