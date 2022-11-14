<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::group([], base_path('routes/api/auth.php'));
    Route::group([], base_path('routes/api/user-notification-email.php'));
    Route::group([], base_path('routes/api/password.php'));
    Route::group([], base_path('routes/api/categories.php'));
    Route::group([], base_path('routes/api/products.php'));
});
