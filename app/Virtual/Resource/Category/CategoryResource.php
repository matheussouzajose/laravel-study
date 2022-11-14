<?php

namespace App\Virtual\Resource\Category;

use App\Virtual\Models\Category;
use App\Virtual\Resource\Paginate\LinksResource;
use App\Virtual\Resource\Paginate\MetaResource;

/**
 * @OA\Schema(
 *     title="Category index",
 *     description="Category Content",
 *     @OA\Xml(
 *         name="Category"
 *     )
 * )
 */
class CategoryResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Category data"
     * )
     * @var Category[]
     */
    private array $data;
}
