<?php

namespace App\Listeners;

use App\Events\StockEntryCreated;
use App\Mail\StockGreatherMax;
use Illuminate\Support\Facades\Mail;

class IncrementStockEntryListener
{
    /**
     * Handle the event.
     *
     * @param StockEntryCreated $stockEntryCreated
     * @return void
     */
    public function handle(StockEntryCreated $stockEntryCreated): void
    {
        $product = $stockEntryCreated->getProduct();
        if ($product->stock > $product::STOCK_MAX) {
            Mail::to(env('MAIL_STOCK'))->send(new StockGreatherMax($product));
        }
    }
}
