<?php

namespace App\Tenant;

use Illuminate\Support\Facades\Auth;

trait TenantObserver
{
    /**
     * @return int|null
     */
    protected function getCompanyId(): ?int
    {
        $hasUser = Auth::hasUser();
        $company = \Tenant::getTenant();

        if ($hasUser || $company) {
            if (!$company) {
                $userAuth = Auth::user();
                \Tenant::setTenant($userAuth->company);
                $company = \Tenant::getTenant();
            }
            return $company->id;
        }

        return null;
    }
}
