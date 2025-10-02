import './bootstrap';
import { createApp } from 'vue';

// Import components
import SearchBar from './components/SearchBar.vue';
import ImageUpload from './components/ImageUpload.vue';

// Create Vue app
const app = createApp({});

// Register components globally
app.component('search-bar', SearchBar);
app.component('image-upload', ImageUpload);

// Mount the app
app.mount('#app');
