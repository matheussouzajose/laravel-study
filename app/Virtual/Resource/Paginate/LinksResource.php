<?php

namespace App\Virtual\Resource\Paginate;

/**
 * @OA\Schema(
 *     title="Links Paginate",
 *     description="Link Paginate Content",
 *     @OA\Xml(
 *         name="Links"
 *     )
 * )
 */
class LinksResource
{
    /**
     * @OA\Property(
     *     title="self",
     *     description="self data",
     *     example="link-value"
     * )
     * @var string
     */
    private string $self;

    /**
     * @OA\Property(
     *     title="first",
     *     description="First data",
     *     example="http://localhost:8000/api/v1/resource?page=1"
     * )
     * @var string
     */
    private string $first;

    /**
     * @OA\Property(
     *     title="last",
     *     description="Last data",
     *     example="http://localhost:8000/api/v1/resource?page=3"
     * )
     * @var string
     */
    private string $last;

    /**
     * @OA\Property(
     *     title="prev",
     *     description="Prev data",
     *     example=null
     * )
     * @var string
     */
    private string $prev;

    /**
     * @OA\Property(
     *     title="next",
     *     description="Next data",
     *     example="http://localhost:8000/api/v1/resource?page=2"
     * )
     * @var string
     */
    private string $next;
}
