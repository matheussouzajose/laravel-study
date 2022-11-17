<?php

namespace App\Observers;

use App\Models\Category;
use App\Tenant\TenantObserver;
use Illuminate\Support\Facades\Auth;

class CategoryObserver
{
    use TenantObserver;

    /**
     * @param Category $category
     * @return void
     */
    public function creating(Category $category): void
    {
        $category->company_id = $this->getCompanyId();

    }

    /**
     * Handle the Category "created" event.
     *
     * @param Category $category
     * @return void
     */
    public function created(Category $category)
    {

    }

    /**
     * @param Category $category
     * @return void
     */
    public function updating(Category $category)
    {

    }

    /**
     * Handle the Category "updated" event.
     *
     * @param Category $category
     * @return void
     */
    public function updated(Category $category)
    {

    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
