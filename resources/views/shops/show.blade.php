@extends('layouts.app')

@section('title', $shop->name)

@section('content')
<div class="min-h-screen">
    <!-- Shop Header -->
    <div class="bg-gradient-to-r from-primary to-secondary text-primary-content py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('shops.index') }}" class="btn btn-ghost btn-sm">
                    ← Back to Shops
                </a>
            </div>

            <div class="flex flex-col md:flex-row gap-8 items-start">
                <!-- Shop Logo/Image -->
                <div class="avatar placeholder">
                    <div class="bg-neutral text-neutral-content rounded-full w-32 h-32">
                        <span class="text-5xl">{{ substr($shop->name, 0, 1) }}</span>
                    </div>
                </div>

                <!-- Shop Info -->
                <div class="flex-1">
                    <h1 class="text-4xl font-bold mb-4">{{ $shop->name }}</h1>
                    <p class="text-lg opacity-90 mb-4">{{ $shop->description }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Address -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold">Address</div>
                                <div class="opacity-90">{{ $shop->address }}</div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold">Phone</div>
                                <a href="tel:{{ $shop->phone }}" class="opacity-90 hover:underline">{{ $shop->phone }}</a>
                            </div>
                        </div>

                        <!-- Email -->
                        @if($shop->email)
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold">Email</div>
                                    <a href="mailto:{{ $shop->email }}" class="opacity-90 hover:underline">{{ $shop->email }}</a>
                                </div>
                            </div>
                        @endif

                        <!-- Website -->
                        @if($shop->website)
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold">Website</div>
                                    <a href="{{ $shop->website }}" target="_blank" class="opacity-90 hover:underline">Visit Website</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Status Badge -->
                    <div class="mt-4">
                        @if($shop->status === 'active')
                            <div class="badge badge-success gap-2">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Verified Shop
                            </div>
                        @endif
                        @if($shop->subscription_tier !== 'none')
                            <div class="badge badge-primary gap-2">{{ ucfirst($shop->subscription_tier) }} Member</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">Products ({{ $shop->products->count() }})</h2>
        </div>

        @if($shop->products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($shop->products as $product)
                    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                        <figure class="h-48 bg-gradient-to-br from-base-200 to-base-300">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-6xl">
                                    {{ $product->category->icon ?? '📦' }}
                                </div>
                            @endif
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title text-lg">{{ $product->name }}</h3>
                            <p class="text-sm opacity-70 line-clamp-2">{{ $product->description }}</p>

                            <div class="flex items-center gap-2 text-sm opacity-70 mt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <a href="{{ route('categories.show', $product->category->slug) }}" class="link link-hover">
                                    {{ $product->category->name }}
                                </a>
                            </div>

                            <div class="card-actions justify-between items-center mt-4">
                                <div class="text-2xl font-bold text-primary">
                                    Rs. {{ number_format($product->price, 2) }}
                                </div>
                                <button class="btn btn-primary btn-sm">View</button>
                            </div>

                            @if($product->stock_quantity > 0)
                                <div class="badge badge-success badge-sm">In Stock ({{ $product->stock_quantity }})</div>
                            @else
                                <div class="badge badge-error badge-sm">Out of Stock</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>This shop hasn't listed any products yet.</span>
            </div>
        @endif

        <!-- Map Section (Placeholder) -->
        <div class="mt-12">
            <h3 class="text-2xl font-bold mb-6">Location</h3>
            <div class="card bg-base-200">
                <div class="card-body">
                    <div class="h-64 bg-base-300 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-lg opacity-70">Map integration coming soon</p>
                            <p class="text-sm opacity-50 mt-2">{{ $shop->latitude }}, {{ $shop->longitude }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
