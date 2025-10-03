<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Search - Snap</title>
    @vite(['resources/js/app.js'])
    <style>
        .dropzone {
            border: 3px dashed #cbd5e0;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }
        .dropzone.dragover {
            border-color: #a855f7;
            background-color: #faf5ff;
        }
        .image-preview {
            max-width: 100%;
            max-height: 400px;
            border-radius: 1rem;
        }
        .ai-result-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">

    @include('layouts.navigation')

    <div class="container mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent mb-4">
                AI-Powered Search
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300">
                Search by image or text using advanced AI technology
            </p>
        </div>

        <!-- Search Tabs -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="tabs tabs-boxed bg-white dark:bg-gray-800 shadow-lg">
                <a class="tab tab-lg tab-active" id="image-tab" onclick="switchTab('image')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Image Search
                </a>
                <a class="tab tab-lg" id="text-tab" onclick="switchTab('text')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Text Search
                </a>
            </div>
        </div>

        <!-- Image Search Panel -->
        <div id="image-search-panel" class="max-w-4xl mx-auto">
            <div class="card bg-white dark:bg-gray-800 shadow-2xl">
                <div class="card-body">
                    <!-- Dropzone -->
                    <div class="dropzone p-12 text-center cursor-pointer" id="dropzone">
                        <input type="file" id="imageInput" accept="image/*" class="hidden">
                        <div id="upload-prompt">
                            <svg class="w-24 h-24 mx-auto text-purple-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-2">
                                Drop an image here or click to browse
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400">
                                Supports: JPG, PNG, GIF (Max 5MB)
                            </p>
                        </div>
                        <div id="preview-container" class="hidden">
                            <img id="imagePreview" class="image-preview mx-auto mb-4">
                            <button type="button" class="btn btn-error btn-sm" onclick="clearImage()">
                                Remove Image
                            </button>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <button id="searchImageBtn" class="btn btn-primary btn-lg w-full mt-6 hidden" onclick="searchByImage()">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search with AI
                    </button>
                </div>
            </div>
        </div>

        <!-- Text Search Panel -->
        <div id="text-search-panel" class="max-w-4xl mx-auto hidden">
            <div class="card bg-white dark:bg-gray-800 shadow-2xl">
                <div class="card-body">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-lg font-semibold">What are you looking for?</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="textQuery" placeholder="e.g., wireless headphones, red dress, laptop under 50000 LKR..."
                                   class="input input-bordered input-lg w-full pr-12"
                                   onkeypress="if(event.key==='Enter') searchByText()">
                            <button class="btn btn-primary btn-circle absolute right-2 top-2" onclick="searchByText()">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Quick Suggestions -->
                    <div class="mt-6">
                        <p class="text-sm text-gray-500 mb-3">Popular searches:</p>
                        <div class="flex flex-wrap gap-2">
                            <button class="badge badge-lg badge-outline" onclick="quickSearch('smartphone')">Smartphone</button>
                            <button class="badge badge-lg badge-outline" onclick="quickSearch('laptop')">Laptop</button>
                            <button class="badge badge-lg badge-outline" onclick="quickSearch('fashion')">Fashion</button>
                            <button class="badge badge-lg badge-outline" onclick="quickSearch('home decor')">Home Decor</button>
                            <button class="badge badge-lg badge-outline" onclick="quickSearch('sports equipment')">Sports</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center">
                <div class="loading loading-spinner loading-lg text-primary mb-4"></div>
                <p class="text-xl font-semibold">AI is analyzing...</p>
                <p class="text-gray-500">This may take a few seconds</p>
            </div>
        </div>

        <!-- AI Analysis Results -->
        <div id="ai-results" class="hidden max-w-4xl mx-auto mt-8">
            <div class="card ai-result-card text-white shadow-2xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4">
                        <span class="pulse-dot inline-block w-3 h-3 bg-green-400 rounded-full mr-2"></span>
                        AI Analysis
                    </h2>
                    <div id="ai-content" class="space-y-3"></div>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div id="results-section" class="hidden max-w-7xl mx-auto mt-12">
            <h2 class="text-3xl font-bold mb-6">Search Results</h2>
            <div id="results-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"></div>
            <div id="no-results" class="hidden text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xl text-gray-500">No products found matching your search</p>
            </div>
        </div>
    </div>

    <script>
        let selectedFile = null;

        // Tab switching
        function switchTab(tab) {
            const imageTab = document.getElementById('image-tab');
            const textTab = document.getElementById('text-tab');
            const imagePanel = document.getElementById('image-search-panel');
            const textPanel = document.getElementById('text-search-panel');

            if (tab === 'image') {
                imageTab.classList.add('tab-active');
                textTab.classList.remove('tab-active');
                imagePanel.classList.remove('hidden');
                textPanel.classList.add('hidden');
            } else {
                textTab.classList.add('tab-active');
                imageTab.classList.remove('tab-active');
                textPanel.classList.remove('hidden');
                imagePanel.classList.add('hidden');
            }
        }

        // Image upload handling
        const dropzone = document.getElementById('dropzone');
        const imageInput = document.getElementById('imageInput');
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('imagePreview');
        const searchBtn = document.getElementById('searchImageBtn');

        dropzone.addEventListener('click', () => imageInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');

            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleImageSelect(file);
            }
        });

        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                handleImageSelect(file);
            }
        });

        function handleImageSelect(file) {
            selectedFile = file;

            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                uploadPrompt.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                searchBtn.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function clearImage() {
            selectedFile = null;
            imageInput.value = '';
            uploadPrompt.classList.remove('hidden');
            previewContainer.classList.add('hidden');
            searchBtn.classList.add('hidden');
            hideResults();
        }

        // Search by image
        async function searchByImage() {
            if (!selectedFile) return;

            const formData = new FormData();
            formData.append('image', selectedFile);

            showLoading();
            hideResults();

            try {
                const response = await fetch('/api/ai-search/image', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();
                hideLoading();

                if (data.success) {
                    displayAIAnalysis(data.ai_analysis);
                    displayResults(data.products.data || data.products);
                } else {
                    alert('Search failed: ' + (data.error || 'Unknown error'));
                }
            } catch (error) {
                hideLoading();
                alert('Search failed. Please try again.');
                console.error(error);
            }
        }

        // Search by text
        async function searchByText() {
            const query = document.getElementById('textQuery').value.trim();
            if (!query) return;

            showLoading();
            hideResults();

            try {
                const response = await fetch('/api/ai-search/text', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ query })
                });

                const data = await response.json();
                hideLoading();

                if (data.success) {
                    if (data.ai_analysis) {
                        displayAIAnalysis(data.ai_analysis);
                    }
                    displayResults(data.products.data || data.products);
                } else {
                    alert('Search failed: ' + (data.error || 'Unknown error'));
                }
            } catch (error) {
                hideLoading();
                alert('Search failed. Please try again.');
                console.error(error);
            }
        }

        function quickSearch(term) {
            document.getElementById('textQuery').value = term;
            searchByText();
        }

        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
        }

        function displayAIAnalysis(analysis) {
            const container = document.getElementById('ai-content');
            const resultsDiv = document.getElementById('ai-results');

            let html = '';

            if (analysis.product_name) {
                html += `<p><strong>Product:</strong> ${analysis.product_name}</p>`;
            }

            if (analysis.category) {
                html += `<p><strong>Category:</strong> ${analysis.category}</p>`;
            }

            if (analysis.keywords && analysis.keywords.length > 0) {
                html += `<p><strong>Keywords:</strong> ${analysis.keywords.join(', ')}</p>`;
            }

            if (analysis.color) {
                html += `<p><strong>Color:</strong> ${analysis.color}</p>`;
            }

            if (analysis.brand) {
                html += `<p><strong>Brand:</strong> ${analysis.brand}</p>`;
            }

            if (analysis.description) {
                html += `<p><strong>Description:</strong> ${analysis.description}</p>`;
            }

            if (analysis.refined_query) {
                html += `<p><strong>Refined Search:</strong> ${analysis.refined_query}</p>`;
            }

            container.innerHTML = html;
            resultsDiv.classList.remove('hidden');
        }

        function displayResults(products) {
            const grid = document.getElementById('results-grid');
            const noResults = document.getElementById('no-results');
            const section = document.getElementById('results-section');

            section.classList.remove('hidden');

            if (!products || products.length === 0) {
                grid.classList.add('hidden');
                noResults.classList.remove('hidden');
                return;
            }

            grid.classList.remove('hidden');
            noResults.classList.add('hidden');

            grid.innerHTML = products.map(product => `
                <div class="card bg-white dark:bg-gray-800 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <figure class="h-48 bg-gray-200">
                        <img src="${product.image_url || 'https://via.placeholder.com/400x300?text=' + encodeURIComponent(product.name)}"
                             alt="${product.name}"
                             class="w-full h-full object-cover">
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-lg">${product.name}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">${product.description || ''}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-2xl font-bold text-purple-600">LKR ${parseFloat(product.price).toLocaleString()}</span>
                            ${product.shop ? `<span class="badge badge-sm">${product.shop.name}</span>` : ''}
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function hideResults() {
            document.getElementById('ai-results').classList.add('hidden');
            document.getElementById('results-section').classList.add('hidden');
        }
    </script>
</body>
</html>
