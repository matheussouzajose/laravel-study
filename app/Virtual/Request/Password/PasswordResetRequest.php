<?php

namespace App\Virtual\Request\Password;

/**
 * @OA\Schema(
 *      title="Password user request",
 *      description="Password user request body data",
 *      type="object",
 *      required={"email","password", "password_confirmation", "token"}
 * )
 */
class PasswordResetRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of the user",
     *      example="matheus@gmail.com"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password of the user",
     *      example="123456789"
     * )
     *
     * @var string
     */
    public string $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="Confirmation password of the user",
     *      example="123456789"
     * )
     *
     * @var string
     */
    public string $password_confirmation;

    /**
     * @OA\Property(
     *      title="token",
     *      description="Token for reset password",
     *      example="441c6dbacfebdc913f5302cbc7212dde99d6aa41c271aafe9260f18256c2edf0"
     * )
     *
     * @var string
     */
    public string $token;
}
