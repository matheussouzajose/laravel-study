<?php

namespace App\Virtual\Resource\Password;

/**
 * @OA\Schema(
 *     title="Unprocessable login errors",
 *     description="Unprocessable Content",
 *     @OA\Xml(
 *         name="Unprocessable"
 *     )
 * )
 */
class UnprocessablePasswordErrors
{
    /**
     * @OA\Property(
     *     property="email",
     *     title="email",
     *     @OA\Items(
     *         type="string",
     *     )
     * )
     *
     * @var array
     */
    private array $email;
}
