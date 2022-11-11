<?php

namespace App\Virtual\Resource\Login;

/**
 * @OA\Schema(
 *     title="Login Resource",
 *     description="Login resource",
 *     @OA\Xml(
 *         name="LoginResource"
 *     )
 * )
 */
class LoginResource
{
    /**
     * @OA\Property(
     *     title="Token",
     *     description="Token wrapper"
     * )
     *
     * @var string
     */
    private string $token;
}
