<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * @param LoginRequest $request
     * @return Application|ResponseFactory|Response
     * @throws ValidationException
     */
    public function login(LoginRequest $request): Application|ResponseFactory|Response
    {
        $request->authenticate();
        $credentials = $request->credentials();
        $token = \JWTAuth::attempt($credentials);

        return $this->responseToken($token);
    }

    /**
     * @return Response
     */
    public function logout(): Response
    {
        \Auth::guard('api')->logout();
        return response()->noContent();
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    public function refresh(): Application|ResponseFactory|Response
    {
        $token = \Auth::guard('api')->refresh();
        return $this->responseToken($token);
    }

    /**
     * @param string|null $token
     * @return Response|Application|ResponseFactory
     */
    private function responseToken(?string $token): Response|Application|ResponseFactory
    {
        return $token
            ? response(compact('token'))
            : response([
                'error' => __('auth.failed')
            ], 400);
    }
}
