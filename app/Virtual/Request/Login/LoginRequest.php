<?php

namespace App\Virtual\Request\Login;

/**
 * @OA\Schema(
 *      title="Login user request",
 *      description="Login user request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */

class LoginRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of the user",
     *      example="email@gmail.com.br"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Passowrd of the user",
     *      example="123456"
     * )
     *
     * @var string
     */
    public string $password;
}
