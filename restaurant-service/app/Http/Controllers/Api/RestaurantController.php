<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::with('menus')->get();
        return response()->json($restaurants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'rating' => 'numeric|min:0|max:5'
        ]);

        $restaurant = Restaurant::create($validated);
        return response()->json($restaurant, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('menus');
        return response()->json($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'address' => 'string|max:255',
            'phone' => 'string|max:20',
            'email' => 'email|max:255',
            'logo' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'rating' => 'numeric|min:0|max:5'
        ]);

        $restaurant->update($validated);
        return response()->json($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
