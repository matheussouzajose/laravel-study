<?php

namespace App\Events;

use App\Models\Product;

class StockEntryCreated
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private readonly Product $product)
    {
        //
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
