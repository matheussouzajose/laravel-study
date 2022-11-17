<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {

    Route::apiResource('products', ProductController::class)
        ->middleware(['can:admin'])->only(['store', 'update', 'destroy']);

    Route::apiResource('products', ProductController::class)
        ->only(['index', 'show']);

    Route::post('products/cover', [ProductController::class, 'updateCover'])
        ->middleware(['can:admin']);

    Route::delete('products/{product}/cover', [ProductController::class, 'destroyCover'])
        ->middleware(['can:admin']);

    Route::post('products/stock-entries', [ProductController::class, 'stockEntries'])
        ->middleware(['can:admin']);

    Route::post('products/stock-outputs', [ProductController::class, 'stockOutPuts'])
        ->middleware(['can:admin']);
});


