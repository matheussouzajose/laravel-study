<?php

namespace App\Tenant;

use App\Models\Company;

class TenantManager
{
    private $tenant;

    /**
     * @return Company|null
     */
    public function getTenant(): ?Company
    {
        return $this->tenant;
    }

    /**
     * @param Company|null $tenant
     */
    public function setTenant(?Company $tenant): void
    {
        $this->tenant = $tenant;
    }

}
