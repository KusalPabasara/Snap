@extends('layouts.app')

@section('title', 'Browse Shops')

@section('content')
<div class="min-h-screen">
    <div class="bg-primary text-primary-content py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Browse Shops</h1>
            <p class="text-lg opacity-90">Discover local shops near you</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($shops as $shop)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">{{ $shop->name }}</h2>
                        <p>{{ Str::limit($shop->description, 100) }}</p>
                        <div class="flex items-center gap-2 text-sm opacity-70">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $shop->address }}
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-primary btn-sm">View Shop</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full alert alert-info">
                    <span>No shops found.</span>
                </div>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $shops->links() }}
        </div>
    </div>
</div>
@endsection
