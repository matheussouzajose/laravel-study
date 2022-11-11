<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')
        ->group(base_path('routes/api/auth.php'));

    Route::prefix('email')
        ->group(base_path('routes/api/user-notification-email.php'));

    Route::prefix('password')
        ->group(base_path('routes/api/password.php'));
});
