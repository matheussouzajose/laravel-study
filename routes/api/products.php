<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class)
    ->middleware('auth:api');
Route::post('products/cover', [ProductController::class, 'updateCover']);
Route::delete('products/{product}/cover', [ProductController::class, 'destroyCover']);
