<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class NearbyShopsController extends Controller
{
    /**
     * Find shops near user's location
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:100|max:50000', // 100m to 50km
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius ?? 5000; // Default 5km

        $shops = Shop::active()
            ->nearby($latitude, $longitude, $radius)
            ->with('products')
            ->paginate(20);

        // Add formatted distance to each shop
        $shops->getCollection()->transform(function ($shop) use ($latitude, $longitude) {
            $shop->formatted_distance = $shop->formattedDistanceTo($latitude, $longitude);
            return $shop;
        });

        return response()->json([
            'success' => true,
            'data' => $shops,
            'user_location' => [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ],
            'radius_meters' => $radius,
        ]);
    }

    /**
     * Get nearby shops view
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
        // Get user location from request or use Colombo as default
        $latitude = $request->query('lat', 6.9271);
        $longitude = $request->query('lng', 79.8612);
        $radius = $request->query('radius', 5000);

        $shops = Shop::active()
            ->nearby($latitude, $longitude, $radius)
            ->with('products')
            ->paginate(20);

        // Add formatted distance
        $shops->getCollection()->transform(function ($shop) use ($latitude, $longitude) {
            $shop->formatted_distance = $shop->formattedDistanceTo($latitude, $longitude);
            return $shop;
        });

        return view('shops.nearby', [
            'shops' => $shops,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => $radius,
        ]);
    }
}
