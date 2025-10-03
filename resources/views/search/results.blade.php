<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Results - Snap</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-base-100">

    @include('layouts.navigation')

    <div class="container mx-auto px-4 py-8">
        <!-- Search Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-4">Search Results</h1>
            @if($query)
                <p class="text-lg text-gray-600">Showing results for: <span class="font-semibold text-purple-600">"{{ $query }}"</span></p>
            @endif
        </div>

        <!-- Filters & Sort -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="flex-1">
                <input type="text"
                       id="searchInput"
                       value="{{ $query }}"
                       placeholder="Search products..."
                       class="input input-bordered w-full"
                       onkeypress="if(event.key==='Enter') performSearch()">
            </div>
            <select id="categoryFilter" class="select select-bordered" onchange="performSearch()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ $category == $cat->slug ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <select id="sortBy" class="select select-bordered" onchange="performSearch()">
                <option value="relevance">Sort by Relevance</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="newest">Newest First</option>
            </select>
        </div>

        <!-- Results Grid -->
        <div id="results-container">
            <div id="loading" class="text-center py-12">
                <div class="loading loading-spinner loading-lg text-primary"></div>
                <p class="mt-4 text-gray-500">Loading results...</p>
            </div>

            <div id="products-grid" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"></div>

            <div id="no-results" class="hidden text-center py-20">
                <svg class="w-32 h-32 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No products found</h3>
                <p class="text-gray-500 mb-6">Try adjusting your search or filters</p>
                <a href="{{ route('ai.search') }}" class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Try AI Search
                </a>
            </div>
        </div>

        <!-- Pagination -->
        <div id="pagination" class="hidden mt-8 flex justify-center"></div>
    </div>

    <script>
        let currentPage = 1;

        // Perform search on page load
        document.addEventListener('DOMContentLoaded', () => {
            performSearch();
        });

        async function performSearch(page = 1) {
            const query = document.getElementById('searchInput').value;
            const category = document.getElementById('categoryFilter').value;
            const sortBy = document.getElementById('sortBy').value;

            const loading = document.getElementById('loading');
            const grid = document.getElementById('products-grid');
            const noResults = document.getElementById('no-results');

            loading.classList.remove('hidden');
            grid.classList.add('hidden');
            noResults.classList.add('hidden');

            try {
                const params = new URLSearchParams({
                    q: query,
                    category: category,
                    sort: sortBy,
                    page: page
                });

                const response = await fetch(`/api/search?${params}`);
                const data = await response.json();

                loading.classList.add('hidden');

                if (data.data && data.data.length > 0) {
                    displayProducts(data.data);
                    if (data.last_page > 1) {
                        displayPagination(data.current_page, data.last_page);
                    }
                } else {
                    noResults.classList.remove('hidden');
                }

                // Update URL
                window.history.pushState({}, '', `/search/results?${params}`);

            } catch (error) {
                console.error('Search error:', error);
                loading.classList.add('hidden');
                noResults.classList.remove('hidden');
            }
        }

        function displayProducts(products) {
            const grid = document.getElementById('products-grid');
            grid.classList.remove('hidden');

            grid.innerHTML = products.map(product => `
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <figure class="h-56 bg-gray-100">
                        <img src="${product.image_url || 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop'}"
                             alt="${product.name}"
                             class="w-full h-full object-cover">
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-lg line-clamp-2">${product.name}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">${product.description || ''}</p>

                        ${product.category ? `
                            <div class="badge badge-secondary badge-sm mt-2">${product.category.name}</div>
                        ` : ''}

                        <div class="flex items-center justify-between mt-4">
                            <div>
                                <span class="text-2xl font-bold text-purple-600">LKR ${parseFloat(product.price).toLocaleString()}</span>
                                ${product.shop ? `
                                    <p class="text-xs text-gray-500 mt-1">${product.shop.name}</p>
                                ` : ''}
                            </div>
                            <button class="btn btn-primary btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function displayPagination(currentPage, lastPage) {
            const pagination = document.getElementById('pagination');
            pagination.classList.remove('hidden');

            let html = '<div class="join">';

            // Previous button
            if (currentPage > 1) {
                html += `<button class="join-item btn" onclick="performSearch(${currentPage - 1})">«</button>`;
            }

            // Page numbers
            for (let i = 1; i <= lastPage; i++) {
                if (i === currentPage) {
                    html += `<button class="join-item btn btn-active">${i}</button>`;
                } else if (i === 1 || i === lastPage || Math.abs(i - currentPage) <= 2) {
                    html += `<button class="join-item btn" onclick="performSearch(${i})">${i}</button>`;
                } else if (i === currentPage - 3 || i === currentPage + 3) {
                    html += `<button class="join-item btn btn-disabled">...</button>`;
                }
            }

            // Next button
            if (currentPage < lastPage) {
                html += `<button class="join-item btn" onclick="performSearch(${currentPage + 1})">»</button>`;
            }

            html += '</div>';
            pagination.innerHTML = html;
        }
    </script>
</body>
</html>
