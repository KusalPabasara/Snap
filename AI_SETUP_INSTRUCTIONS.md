# AI Search Setup Instructions

## Overview
Snap now features advanced AI-powered product search using image recognition and intelligent text analysis. This guide will help you configure the AI services to enable these features.

## Features Implemented

### 1. **AI Image Search** 🖼️
- Upload product images to find similar items
- Powered by OpenAI GPT-4 Vision or Google Gemini Vision
- Extracts: product name, category, keywords, color, brand, description
- Smart product matching based on visual analysis

### 2. **AI Text Search** 🔍
- Natural language product queries
- Understands context and intent
- Suggests relevant filters and categories
- Refines search queries automatically

### 3. **Interactive Shop Map** 🗺️
- Uses OpenStreetMap (Leaflet) - no API key required!
- PostGIS spatial queries for nearby shops
- Real-time distance calculations
- Map and list views

## Quick Start

### Option 1: OpenAI (Recommended)

1. **Get OpenAI API Key**
   - Visit: https://platform.openai.com/api-keys
   - Create an account or sign in
   - Click "Create new secret key"
   - Copy the key (starts with `sk-`)

2. **Update `.env` file**
   ```env
   OPENAI_API_KEY=sk-your-actual-api-key-here
   OPENAI_MODEL=gpt-4o
   OPENAI_VISION_MODEL=gpt-4o
   AI_PROVIDER=openai
   ```

3. **Test the feature**
   - Go to: http://localhost:8000/ai-search
   - Upload an image or enter text query
   - Verify AI analysis appears

### Option 2: Google Gemini (Alternative)

1. **Get Gemini API Key**
   - Visit: https://makersuite.google.com/app/apikey
   - Sign in with Google account
   - Click "Create API Key"
   - Copy the key

2. **Update `.env` file**
   ```env
   GEMINI_API_KEY=your-gemini-api-key-here
   AI_PROVIDER=gemini
   ```

## Current Configuration

The `.env` file has been pre-configured with placeholders:

```env
# AI Services Configuration
OPENAI_API_KEY=your_openai_api_key_here
OPENAI_MODEL=gpt-4o
OPENAI_VISION_MODEL=gpt-4o

# Google Gemini (Alternative to OpenAI)
GEMINI_API_KEY=your_gemini_api_key_here

# Google Maps API (Optional - OpenStreetMap is used by default)
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here

# AI Search Configuration
AI_PROVIDER=openai
MAX_IMAGE_SIZE=5120
```

## Testing the AI Features

### 1. Image Search Test
```bash
# Navigate to AI Search page
http://localhost:8000/ai-search

# Steps:
1. Click "Image Search" tab
2. Upload a product image (JPG, PNG, GIF - max 5MB)
3. Click "Search with AI"
4. View AI analysis results
5. Browse matched products
```

### 2. Text Search Test
```bash
# Navigate to AI Search page
http://localhost:8000/ai-search

# Steps:
1. Click "Text Search" tab
2. Enter query: "wireless headphones under 5000 LKR"
3. Click search or press Enter
4. View AI-refined results
5. Check suggested filters
```

### 3. Shop Map Test
```bash
# Navigate to Shop Map
http://localhost:8000/shops/map

# Features:
1. Interactive OpenStreetMap (no API key needed!)
2. Toggle between Map/List view
3. Adjust search radius (1-50 km)
4. Filter by category
5. Click "Use My Location" for geolocation
```

## API Pricing (as of 2024)

### OpenAI GPT-4o
- **Input**: $2.50 per 1M tokens
- **Output**: $10.00 per 1M tokens
- **Vision**: Same as text pricing
- **Free tier**: $5 credit for new accounts
- **Typical image search**: ~$0.01 per request

### Google Gemini
- **Gemini 1.5 Flash**: Free up to 15 RPM
- **Gemini 1.5 Pro**: Free up to 2 RPM
- **Vision**: Included in text pricing
- **Free tier**: Generous free quota

**Recommendation**: Start with Gemini for free testing, switch to OpenAI for production.

## Fallback Behavior

If AI services are unavailable or API keys are invalid:
- **Image search**: Returns error message, prompts for API key setup
- **Text search**: Falls back to basic keyword search
- **Maps**: Uses OpenStreetMap (no API key required)

## Troubleshooting

### Issue: "AI analysis failed"
**Solution:**
1. Check API key is valid in `.env`
2. Verify `AI_PROVIDER` is set correctly
3. Check internet connection
4. Review Laravel logs: `storage/logs/laravel.log`

### Issue: "Failed to process image search"
**Solution:**
1. Ensure image is under 5MB
2. Use supported formats: JPG, PNG, GIF
3. Check OpenAI/Gemini API quota
4. Verify API key has vision access enabled

### Issue: "No shops found on map"
**Solution:**
1. Database may need shop seeding
2. Check PostGIS is installed: `SELECT PostGIS_version();`
3. Verify shops have latitude/longitude data
4. Try increasing search radius

## File Structure

```
app/
├── Services/
│   └── AISearchService.php          # AI integration service
├── Http/Controllers/
│   └── AISearchController.php       # AI search endpoints
resources/views/
├── search/
│   ├── ai-search.blade.php         # AI search page
│   └── results.blade.php           # Search results
├── shops/
│   └── map.blade.php               # Interactive map
routes/
└── web.php                         # Routes configuration
config/
└── services.php                    # API configuration
```

## Advanced Configuration

### Custom Image Processing
Edit `app/Services/AISearchService.php`:
```php
// Adjust max tokens for responses
'max_tokens' => 500  // Default: 500

// Modify AI prompt for better results
'content' => 'Your custom prompt here...'
```

### Database Optimization
```bash
# Ensure PostGIS spatial index exists
php artisan migrate

# Check spatial index
psql -d snap -c "\d shops"
# Should show: shops_location_idx (GIST index)
```

## Production Deployment

1. **Security**
   - Never commit `.env` file
   - Use environment variables in production
   - Rotate API keys regularly

2. **Performance**
   - Enable Laravel caching: `php artisan config:cache`
   - Use queue workers for AI requests
   - Implement rate limiting on AI endpoints

3. **Monitoring**
   - Track API usage and costs
   - Monitor response times
   - Set up error alerting

## Support & Resources

- **OpenAI Docs**: https://platform.openai.com/docs
- **Gemini Docs**: https://ai.google.dev/docs
- **Leaflet Maps**: https://leafletjs.com/
- **PostGIS**: https://postgis.net/documentation/

## Next Steps

1. ✅ Set up API keys in `.env`
2. ✅ Test AI search features
3. ✅ Customize AI prompts if needed
4. 🚀 Deploy to production
5. 📊 Monitor usage and costs

---

**Built with ❤️ for Snap - AI-Powered Shopping Platform**

Last updated: {{ date('Y-m-d') }}
