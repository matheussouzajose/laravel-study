<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewPasswordForgotRequest;
use App\Http\Requests\Api\NewPasswordResetRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    /**
     * @param NewPasswordForgotRequest $request
     * @return Response|Application|ResponseFactory
     * @throws ValidationException
     */
    public function forgotPassword(NewPasswordForgotRequest $request): Response|Application|ResponseFactory
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return response([
                'status' => __($status)
            ]);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /**
     * @param NewPasswordResetRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function reset(NewPasswordResetRequest $request): Response|Application|ResponseFactory
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'Redefinição de senha com sucesso'
            ]);
        }

        return response([
            'message' => __($status)
        ], 500);
    }
}
