<?php

namespace App\Virtual\Resource\Login;

/**
 * @OA\Schema(
 *     title="Unprocessable login",
 *     description="Unprocessable Content",
 *     @OA\Xml(
 *         name="Unprocessable"
 *     )
 * )
 */
class UnprocessableLogin
{
    /**
     * @OA\Property(
     *     title="message",
     *     description="Error Message"
     * )
     *
     * @var string
     */
    private string $message;

    /**
     * @OA\Property(
     *     title="message",
     *     description="Error Message"
     * )
     * @var UnprocessableLoginErrors
     */
    private UnprocessableLoginErrors $errors;
}
