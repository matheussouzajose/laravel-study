<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationController extends Controller
{
    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function sendVerificationEmail(Request $request): Application|ResponseFactory|Response
    {
        $this->hasVerifiedEmail($request);

        $request->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'Link de verificação enviado.'
        ]);
    }

    /**
     * @param EmailVerificationRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function verify(EmailVerificationRequest $request): Application|ResponseFactory|Response
    {
        $this->hasVerifiedEmail($request);

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response([
            'message' => 'O e-mail foi verificado.'
        ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    private function hasVerifiedEmail(Request $request): void
    {
        if ($request->user()->hasVerifiedEmail()) {
            response([
                'message' => 'E-mail já verificado.'
            ]);
        }
    }
}
