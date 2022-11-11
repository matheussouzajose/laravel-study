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
     * @OA\Post(
     *      path="/email/verification-notification",
     *      operationId="verification-notification",
     *      tags={"Email"},
     *      security={{"bearer_token":{}}},
     *      summary="Send email for confirmation user",
     *      description="Send email for confirmation user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EmailResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
     */
    public function sendVerificationEmail(Request $request): Application|ResponseFactory|Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response([
                'message' => 'E-mail já verificado.'
            ]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'Link de verificação enviado.'
        ]);
    }

    /**
     * @param EmailVerificationRequest $request
     * @return Application|ResponseFactory|Response
     * @OA\Get(
     *      path="/email/verify-email/{id}/{hash}",
     *      operationId="verify-email",
     *      tags={"Email"},
     *      security={{"bearer_token":{}}},
     *      summary="Confirmation user",
     *      description="Confirmation user",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="hash",
     *          description="hash",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EmailResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
     */
    public function verify(EmailVerificationRequest $request): Application|ResponseFactory|Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response([
                'message' => 'E-mail já verificado.'
            ]);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response([
            'message' => 'O e-mail foi verificado.'
        ]);
    }
}
