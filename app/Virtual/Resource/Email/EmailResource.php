<?php

namespace App\Virtual\Resource\Email;

/**
 * @OA\Schema(
 *     title="Email Resource",
 *     description="Email resource",
 *     @OA\Xml(
 *         name="EmailResource"
 *     )
 * )
 */
class EmailResource
{
    /**
     * @OA\Property(
     *     title="message",
     *     description="Message"
     * )
     *
     * @var string
     */
    private string $message;
}
