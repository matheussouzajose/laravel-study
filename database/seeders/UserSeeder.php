<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()
            ->unverified()
            ->user()
            ->create([
                'name' => 'Matheus S. Jose',
                'email' => 'matheus@gmail.com.br'
            ]);

        \Tenant::setTenant(Company::find(1));
        User::factory()
            ->unverified()
            ->admin()
            ->create([
                'name' => 'Admin Tenant',
                'email' => 'admin.tenant@gmail.com.br'
            ]);

        \Tenant::setTenant(Company::find(2));
        User::factory()
            ->unverified()
            ->admin()
            ->create([
                'name' => 'Admin Tenant 2',
                'email' => 'admin.tenant2@gmail.com.br'
            ]);
    }
}
