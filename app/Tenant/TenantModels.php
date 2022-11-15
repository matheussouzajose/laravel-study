<?php

namespace App\Tenant;

trait TenantModels
{
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());
    }
}
