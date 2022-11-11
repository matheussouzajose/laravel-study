<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * @param $request
     * @param array $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards): void
    {
        abort(response()->json(['error' => __('auth.unauthorized')], 401));
    }
}
