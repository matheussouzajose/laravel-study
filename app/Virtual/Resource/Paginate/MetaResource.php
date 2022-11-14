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
class MetaResource
{
    /**
     * @OA\Property(
     *     title="current_page",
     *     description="current_page data",
     *     example=1
     * )
     * @var int
     */
    private int $current_page;

    /**
     * @OA\Property(
     *     title="from",
     *     description="from data",
     *     example=1
     * )
     * @var int
     */
    private int $from;

    /**
     * @OA\Property(
     *     title="last_page",
     *     description="last_page data",
     *     example=3
     * )
     * @var int
     */
    private int $last_page;

    /**
     * @OA\Property(
     *     property="links",
     *     title="links",
     *     @OA\Items(
     *         @OA\Property(
     *             property="url",
     *             type="string",
     *             example="http://localhost:8000/api/v1/resource?page=1"
     *         ),
     *         @OA\Property(
     *             property="label",
     *             type="string",
     *             example="1"
     *         ),
     *         @OA\Property(
     *             property="active",
     *             type="string",
     *             example=true
     *         ),
     *     )
     * )
     *
     * @var array
     */
    private array $links;

    /**
     * @OA\Property(
     *     title="path",
     *     description="path data",
     *     example="http://localhost:8000/api/v1/resource"
     * )
     * @var string
     */
    private string $path;

    /**
     * @OA\Property(
     *     title="per_page",
     *     description="per_page data",
     *     example=1
     * )
     * @var int
     */
    private int $per_page;

    /**
     * @OA\Property(
     *     title="to",
     *     description="to data",
     *     example=1
     * )
     * @var int
     */
    private int $to;

    /**
     * @OA\Property(
     *     title="total",
     *     description="total data",
     *     example=1
     * )
     * @var int
     */
    private int $total;

}
