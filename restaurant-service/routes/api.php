<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::apiResource('restaurants', RestaurantController::class);

Route::apiResource('restaurants.menus', MenuController::class); 