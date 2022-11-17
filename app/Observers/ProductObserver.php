<?php

namespace App\Observers;

use App\Models\Product;
use App\Tenant\TenantObserver;
use Illuminate\Support\Str;

class ProductObserver
{
    use TenantObserver;

    /**
     * @param Product $product
     * @return void
     */
    public function creating(Product $product): void
    {
        $product->slug = Str::slug($product->name);
        $product->company_id = $this->getCompanyId();
    }

    /**
     * Handle the Product "created" event.
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product)
    {
    }

    /**
     * @param Product $product
     * @return void
     */
    public function updating(Product $product)
    {

    }

    /**
     * Handle the Product "updated" event.
     *
     * @param Product $product
     * @return void
     */
    public function updated(Product $product)
    {

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
