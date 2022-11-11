<?php

namespace App\Virtual\Resource\Login;

/**
 * @OA\Schema(
 *     title="Unprocessable login errors",
 *     description="Unprocessable Content",
 *     @OA\Xml(
 *         name="Unprocessable"
 *     )
 * )
 */
class UnprocessableErrors
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

    /**
     * @OA\Property(
     *     property="password",
     *     title="password",
     *     @OA\Items(
     *         type="string",
     *     )
     * )
     *
     * @var array
     */
    private array $password;
}
