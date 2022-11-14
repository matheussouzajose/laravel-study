<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\User;
use App\Policies\Api\CategoryPolice;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolice::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user){
            if($user->role == User::ROLE_ADMIN){
                return true;
            }
        });
    }
}
