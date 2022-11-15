<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TenantModels
{
    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
