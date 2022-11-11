<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewPasswordController;

Route::group([], function () {
    Route::post('/forgot-password', [NewPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [NewPasswordController::class, 'reset'])
        ->name('password.reset');

});
