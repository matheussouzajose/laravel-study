<?php

namespace App\Virtual\Resource\Password;

/**
 * @OA\Schema(
 *     title="Unprocessable",
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
     *     property="errors",
     *     title="errors",
     *     @OA\Property(
     *         property="email",
     *         type="array",
     *         @OA\Items(
     *             type="string"
     *         )
     *     ),
     * )
     *
     * @var array
     */
    private array $errors;
}
