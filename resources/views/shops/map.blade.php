@extends('layouts.app')

@section('title', 'Find Shops Near You')

@section('content')
<div class="min-h-screen bg-base-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-4">
                Find Shops Near You
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Discover nearby shops using interactive map or list view
            </p>
        </div>

        <!-- View Toggle -->
        <div class="flex justify-center mb-6">
            <div class="tabs tabs-boxed bg-white dark:bg-gray-800 shadow-lg">
                <a class="tab tab-lg tab-active" id="map-tab" onclick="switchView('map')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    Map View
                </a>
                <a class="tab tab-lg" id="list-tab" onclick="switchView('list')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    List View
                </a>
            </div>
        </div>

        <!-- Search Controls -->
        <div class="card bg-white dark:bg-gray-800 shadow-xl mb-6">
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Search Location</span>
                        </label>
                        <input type="text" id="locationSearch" placeholder="Enter address or place..." class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Radius (km)</span>
                        </label>
                        <select id="radiusSelect" class="select select-bordered" onchange="updateShops()">
                            <option value="1000">1 km</option>
                            <option value="5000" selected>5 km</option>
                            <option value="10000">10 km</option>
                            <option value="20000">20 km</option>
                            <option value="50000">50 km</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Category</span>
                        </label>
                        <select id="categoryFilter" class="select select-bordered" onchange="updateShops()">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex gap-2">
                    <button class="btn btn-primary" onclick="useCurrentLocation()">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Use My Location
                    </button>
                    <button class="btn btn-outline" onclick="updateShops()">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Map View -->
        <div id="map-view" class="mb-6">
            <div class="card bg-white dark:bg-gray-800 shadow-xl">
                <div class="card-body p-0">
                    <div id="map" class="w-full h-[600px] rounded-xl"></div>
                </div>
            </div>
        </div>

        <!-- List View -->
        <div id="list-view" class="hidden">
            <div id="shops-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Shops will be populated here -->
            </div>
            <div id="list-loading" class="text-center py-12">
                <div class="loading loading-spinner loading-lg text-primary"></div>
            </div>
            <div id="list-empty" class="hidden text-center py-12">
                <p class="text-gray-500">No shops found in this area</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let map;
    let markers = [];
    let userMarker;
    let currentLat = 6.9271; // Default: Colombo
    let currentLng = 79.8612;

    function initMap() {
        // Initialize map
        map = L.map('map').setView([currentLat, currentLng], 13);

        // Add OpenStreetMap tiles (free alternative to Google Maps)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Add user marker
        userMarker = L.marker([currentLat, currentLng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map).bindPopup('You are here').openPopup();

        // Try to get user's current location
        useCurrentLocation();

        // Load shops
        updateShops();
    }

    function switchView(view) {
        const mapView = document.getElementById('map-view');
        const listView = document.getElementById('list-view');
        const mapTab = document.getElementById('map-tab');
        const listTab = document.getElementById('list-tab');

        if (view === 'map') {
            mapView.classList.remove('hidden');
            listView.classList.add('hidden');
            mapTab.classList.add('tab-active');
            listTab.classList.remove('tab-active');
            setTimeout(() => map.invalidateSize(), 100);
        } else {
            mapView.classList.add('hidden');
            listView.classList.remove('hidden');
            listTab.classList.add('tab-active');
            mapTab.classList.remove('tab-active');
            updateShopsList();
        }
    }

    function useCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    currentLat = position.coords.latitude;
                    currentLng = position.coords.longitude;

                    map.setView([currentLat, currentLng], 14);
                    userMarker.setLatLng([currentLat, currentLng]);
                    updateShops();
                },
                (error) => {
                    console.error('Geolocation error:', error);
                    alert('Could not get your location. Using default location (Colombo).');
                }
            );
        }
    }

    async function updateShops() {
        const radius = document.getElementById('radiusSelect').value;
        const category = document.getElementById('categoryFilter').value;

        try {
            const response = await fetch(`/api/shops/nearby?latitude=${currentLat}&longitude=${currentLng}&radius=${radius}${category ? '&category_id=' + category : ''}`);
            const data = await response.json();

            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Add shop markers
            if (data.shops && data.shops.length > 0) {
                data.shops.forEach(shop => {
                    if (shop.latitude && shop.longitude) {
                        const marker = L.marker([shop.latitude, shop.longitude], {
                            icon: L.icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            })
                        }).addTo(map);

                        marker.bindPopup(`
                            <div class="p-2">
                                <h3 class="font-bold text-lg">${shop.name}</h3>
                                <p class="text-sm text-gray-600">${shop.description || ''}</p>
                                <p class="text-sm font-semibold mt-2">${shop.formatted_distance || ''}</p>
                                <a href="/shops/${shop.id}" class="btn btn-primary btn-sm mt-2">View Shop</a>
                            </div>
                        `);

                        markers.push(marker);
                    }
                });
            }

        } catch (error) {
            console.error('Error fetching shops:', error);
        }
    }

    async function updateShopsList() {
        const radius = document.getElementById('radiusSelect').value;
        const category = document.getElementById('categoryFilter').value;
        const listContainer = document.getElementById('shops-list');
        const loading = document.getElementById('list-loading');
        const empty = document.getElementById('list-empty');

        loading.classList.remove('hidden');
        listContainer.classList.add('hidden');
        empty.classList.add('hidden');

        try {
            const response = await fetch(`/api/shops/nearby?latitude=${currentLat}&longitude=${currentLng}&radius=${radius}${category ? '&category_id=' + category : ''}`);
            const data = await response.json();

            loading.classList.add('hidden');

            if (data.shops && data.shops.length > 0) {
                listContainer.classList.remove('hidden');
                listContainer.innerHTML = data.shops.map(shop => `
                    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all">
                        <div class="card-body">
                            <h3 class="card-title">${shop.name}</h3>
                            <p class="text-sm text-gray-600">${shop.description || ''}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold">${shop.formatted_distance || 'N/A'}</span>
                            </div>
                            <div class="card-actions justify-end mt-4">
                                <a href="/shops/${shop.id}" class="btn btn-primary btn-sm">View Shop</a>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                empty.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error fetching shops:', error);
            loading.classList.add('hidden');
            empty.classList.remove('hidden');
        }
    }

    // Initialize map when page loads
    document.addEventListener('DOMContentLoaded', () => {
        // Load Leaflet CSS and JS
        const leafletCSS = document.createElement('link');
        leafletCSS.rel = 'stylesheet';
        leafletCSS.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
        document.head.appendChild(leafletCSS);

        const leafletJS = document.createElement('script');
        leafletJS.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
        leafletJS.onload = initMap;
        document.head.appendChild(leafletJS);
    });
</script>
@endpush
@endsection
