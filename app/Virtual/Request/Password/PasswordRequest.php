<?php

namespace App\Virtual\Request\Password;

/**
 * @OA\Schema(
 *      title="Password user request",
 *      description="Password user request body data",
 *      type="object",
 *      required={"email"}
 * )
 */
class PasswordRequest
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
}
