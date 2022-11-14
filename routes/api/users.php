<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', CategoryController::class)
    ->except(['store'])
    ->middleware('auth:api');

