<?php

namespace App\Virtual\Request\Category;

/**
 * @OA\Schema(
 *      title="Password user request",
 *      description="Password user request body data",
 *      type="object",
 *      required={"email"}
 * )
 */
class CategoryRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new category",
     *      example="Category x"
     * )
     *
     * @var string
     */
    public string $name;
}
