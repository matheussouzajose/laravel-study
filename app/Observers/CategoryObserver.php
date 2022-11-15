<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryObserver
{
    public function creating(Category $category): void
    {
        $hasUser = Auth::hasUser();
        $company = \Tenant::getTenant();

        if ($hasUser || $company) {
            if (!$company) {
                $userAuth = Auth::user();
                \Tenant::setTenant($userAuth->company);
            }
            $category->company_id = $company->id;
        }
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
