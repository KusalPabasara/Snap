<template>
  <div class="w-full max-w-4xl mx-auto">
    <div class="relative">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search for products, shops, or categories..."
        class="w-full px-6 py-4 pr-12 text-lg border-2 border-gray-300 rounded-full focus:outline-none focus:border-primary-500 transition-colors"
        @keyup.enter="handleSearch"
      />
      <button
        @click="handleSearch"
        class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-primary-600 text-white p-3 rounded-full hover:bg-primary-700 transition-colors"
      >
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
          />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const searchQuery = ref('');

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    // Emit search event or navigate to search results
    window.location.href = `/search?q=${encodeURIComponent(searchQuery.value)}`;
  }
};
</script>
