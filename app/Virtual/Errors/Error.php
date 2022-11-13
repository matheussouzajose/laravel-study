<?php

namespace App\Virtual\Errors;

/**
 * @OA\Schema(
 *     title="Error Resource",
 *     description="Error resource",
 *     @OA\Xml(
 *         name="ErrorResource"
 *     )
 * )
 */
class Error
{
    /**
     * @OA\Property(
     *     title="error",
     *     description="Error"
     * )
     *
     * @var string
     */
    private string $error;
}
