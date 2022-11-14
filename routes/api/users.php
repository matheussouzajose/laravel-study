<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users/me', [UserController::class, 'me'])
        ->name('users.me');

    Route::apiResource('users', UserController::class)
        ->middleware('can:admin');
});




