<template>
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 max-w-3xl mx-auto lg:mx-0 transition-colors duration-200">
    <!-- Tab Buttons -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 dark:border-gray-700">
      <button
        @click="searchType = 'text'"
        :class="searchType === 'text' ? 'border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
        class="flex items-center space-x-2 px-4 py-3 border-b-2 font-medium transition-colors"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <span>Text Search</span>
      </button>
      <button
        @click="searchType = 'image'"
        :class="searchType === 'image' ? 'border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
        class="flex items-center space-x-2 px-4 py-3 border-b-2 font-medium transition-colors"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Image Search</span>
      </button>
    </div>

    <!-- Text Search -->
    <div v-if="searchType === 'text'" class="relative">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search for products, shops, or categories..."
        class="w-full px-6 py-4 pr-12 text-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white border-2 border-gray-300 dark:border-gray-600 rounded-full focus:outline-none focus:border-primary-500 dark:focus:border-primary-400 placeholder-gray-500 dark:placeholder-gray-400 transition-colors"
        @keyup.enter="handleSearch"
      />
      <button
        @click="handleSearch"
        class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 text-white p-3 rounded-full transition-colors"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </button>
    </div>

    <!-- Image Search -->
    <div v-else class="space-y-4">
      <div class="flex items-center justify-center w-full">
        <label
          for="image-upload"
          class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
        >
          <div v-if="!imagePreview" class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
              <span class="font-semibold">Click to upload</span> or drag and drop
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or WEBP (MAX. 10MB)</p>
          </div>
          <div v-else class="relative w-full h-full p-4">
            <img :src="imagePreview" alt="Preview" class="w-full h-full object-contain rounded-lg" />
            <button
              @click.prevent="clearImage"
              class="absolute top-6 right-6 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <input
            id="image-upload"
            type="file"
            class="hidden"
            accept="image/*"
            @change="handleImageUpload"
          />
        </label>
      </div>
      <button
        @click="handleImageSearch"
        :disabled="!imageFile"
        class="w-full bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 disabled:bg-gray-400 dark:disabled:bg-gray-600 disabled:cursor-not-allowed text-white font-medium py-3 px-6 rounded-full transition-colors"
      >
        Search by Image
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const searchQuery = ref('');
const searchType = ref('text');
const imageFile = ref(null);
const imagePreview = ref(null);

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    window.location.href = `/search?q=${encodeURIComponent(searchQuery.value)}`;
  }
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file && file.type.startsWith('image/')) {
    imageFile.value = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const clearImage = () => {
  imageFile.value = null;
  imagePreview.value = null;
  document.getElementById('image-upload').value = '';
};

const handleImageSearch = () => {
  if (imageFile.value) {
    const formData = new FormData();
    formData.append('image', imageFile.value);

    // For now, just redirect with a flag - we'll implement the actual upload API later
    window.location.href = '/search?type=image';
  }
};
</script>
