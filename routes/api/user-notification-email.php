<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmailVerificationController;

Route::group(['prefix' => 'email', 'middleware' => 'auth:api'], function () {
    Route::post('/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->name('verification.verify');
});


