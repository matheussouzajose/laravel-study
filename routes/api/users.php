<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users/me', [UserController::class, 'me'])
    ->name('users.me')
    ->middleware(['auth:api']);

Route::apiResource('users', UserController::class)
    ->middleware(['auth:api', 'can:admin']);
