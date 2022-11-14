<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\Api\UserJson;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Http\Requests\Api\{LoginRequest, RegisterUserRequest};

class AuthController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

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

        return $this->responseToken($token, Auth::user());
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
     * @param RegisterUserRequest $registerUserRequest
     * @return Response|Application|ResponseFactory
     */
    public function register(RegisterUserRequest $registerUserRequest): Response|Application|ResponseFactory
    {
        $user = $registerUserRequest->validated();
        $user['password'] = Hash::make($user['password']);

        $user = $this->user->create($user);
        $token = \JWTAuth::attempt($registerUserRequest->credentials());

        return response([
            'data' => [
                'token' => $token,
                'user' => new UserJson($user)
            ]
        ], 201);
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    public function refresh(): Application|ResponseFactory|Response
    {
        $token = \Auth::guard('api')->refresh();
        return $this->responseToken($token, Auth::user());
    }

    /**
     * @param string|null $token
     * @param $user
     * @return Response|Application|ResponseFactory
     */
    private function responseToken(?string $token, $user): Response|Application|ResponseFactory
    {
        return $token
            ? response([
                'data' => [
                    'token' => $token,
                    'user' => new UserJson($user)
                ]
            ])
            : response([
                'error' => __('auth.failed')
            ], 400);
    }
}
