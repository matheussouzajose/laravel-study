<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)
    ->middleware([
        'auth:api',
        "can:apiResource,App\Models\Category"
    ]);

