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
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="Login user",
     *      description="Returns token JWT for User",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResource")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(ref="#/components/schemas/UnprocessableLogin")
     *       )
     * )
     *
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
     * @OA\Post(
     *      path="/auth/logout",
     *      operationId="logout",
     *      tags={"Auth"},
     *      security={{"bearer_token":{}}},
     *      summary="Logout user",
     *      description="Destroy token of the user",
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
     */
    public function logout(): Response
    {
        \Auth::guard('api')->logout();
        return response()->noContent();
    }

    /**
     * @return Application|ResponseFactory|Response
     * @OA\Post(
     *      path="/auth/refresh",
     *      operationId="refresh",
     *      tags={"Auth"},
     *      security={{"bearer_token":{}}},
     *      summary="Refresh user",
     *      description="Refresh token of the user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
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
