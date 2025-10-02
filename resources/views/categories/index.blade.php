@extends('layouts.app')

@section('title', 'Browse Categories')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <div class="bg-primary text-primary-content py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Browse Categories</h1>
            <p class="text-lg opacity-90">Explore products across various categories</p>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow image-full">
                    <figure class="h-48 bg-gradient-to-br from-primary to-secondary"></figure>
                    <div class="card-body">
                        <h2 class="card-title text-2xl">{{ $category->icon ?? '📦' }} {{ $category->name }}</h2>
                        <p class="opacity-80">{{ $category->description }}</p>
                        <div class="card-actions justify-end mt-4">
                            <div class="badge badge-outline">{{ $category->products_count ?? 0 }} products</div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>No categories found. Please add categories to get started.</span>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
