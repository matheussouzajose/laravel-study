<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('categories', CategoryController::class)
        ->middleware(['can:admin'])->only(['store', 'update', 'destroy']);

    Route::apiResource('categories', CategoryController::class)
        ->only(['index', 'show']);
});



