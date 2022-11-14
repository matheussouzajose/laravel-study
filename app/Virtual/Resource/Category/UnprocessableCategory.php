<?php

namespace App\Virtual\Resource\Category;

/**
 * @OA\Schema(
 *     title="Unprocessable",
 *     description="Unprocessable Content",
 *     @OA\Xml(
 *         name="Unprocessable"
 *     )
 * )
 */
class UnprocessableCategory
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
     *         property="name",
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
