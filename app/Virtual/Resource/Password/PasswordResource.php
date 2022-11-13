<?php

namespace App\Virtual\Resource\Password;

/**
 * @OA\Schema(
 *     title="PasswordResource user",
 *     description="PasswordResource Content",
 *     @OA\Xml(
 *         name="PasswordResource"
 *     )
 * )
 */
class PasswordResource
{
    /**
     * @OA\Property(
     *     title="status",
     *     description="Status Message"
     * )
     *
     * @var string
     */
    private string $status;
}
