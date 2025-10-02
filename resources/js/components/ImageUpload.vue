<template>
  <div class="w-full max-w-2xl mx-auto">
    <div
      @dragover.prevent="isDragging = true"
      @dragleave.prevent="isDragging = false"
      @drop.prevent="handleDrop"
      :class="[
        'border-4 border-dashed rounded-xl p-12 text-center transition-all',
        isDragging
          ? 'border-primary-500 bg-primary-50'
          : 'border-gray-300 hover:border-primary-400',
      ]"
    >
      <div v-if="!imagePreview">
        <svg
          class="mx-auto h-16 w-16 text-gray-400"
          stroke="currentColor"
          fill="none"
          viewBox="0 0 48 48"
        >
          <path
            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
        <div class="mt-4">
          <label
            for="file-upload"
            class="cursor-pointer inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
          >
            <span>Upload an image</span>
            <input
              id="file-upload"
              type="file"
              class="sr-only"
              accept="image/*"
              @change="handleFileSelect"
            />
          </label>
        </div>
        <p class="mt-2 text-sm text-gray-500">or drag and drop</p>
        <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF up to 10MB</p>
      </div>

      <div v-else class="relative">
        <img
          :src="imagePreview"
          alt="Preview"
          class="max-h-96 mx-auto rounded-lg"
        />
        <button
          @click="clearImage"
          class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors"
        >
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
        <button
          @click="searchByImage"
          class="mt-4 px-8 py-3 bg-primary-600 text-white font-semibold rounded-full hover:bg-primary-700 transition-colors"
        >
          Search by this image
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isDragging = ref(false);
const imagePreview = ref(null);
const selectedFile = ref(null);

const handleFileSelect = (event) => {
  const file = event.target.files[0];
  if (file && file.type.startsWith('image/')) {
    selectedFile.value = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const handleDrop = (event) => {
  isDragging.value = false;
  const file = event.dataTransfer.files[0];
  if (file && file.type.startsWith('image/')) {
    selectedFile.value = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const clearImage = () => {
  imagePreview.value = null;
  selectedFile.value = null;
};

const searchByImage = async () => {
  if (!selectedFile.value) return;

  const formData = new FormData();
  formData.append('image', selectedFile.value);

  // TODO: Implement API call
  window.location.href = '/search/image';
};
</script>
