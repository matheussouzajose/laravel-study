<?php

namespace App\Virtual\Resource\Password;

/**
 * @OA\Schema(
 *     title="Unprocessable login",
 *     description="Unprocessable Content",
 *     @OA\Xml(
 *         name="Unprocessable"
 *     )
 * )
 */
class UnprocessablePassword
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
     * @var UnprocessablePasswordErrors
     */
    private UnprocessablePasswordErrors $errors;
}
