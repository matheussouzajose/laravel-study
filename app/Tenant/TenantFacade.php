<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Support\Facades\Facade;

class TenantFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TenantManager::class;
    }

}
