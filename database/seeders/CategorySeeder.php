<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \Tenant::setTenant(Company::find(1));
        Category::factory(5)->create();

        \Tenant::setTenant(Company::find(2));
        Category::factory(5)->create();
    }
}
