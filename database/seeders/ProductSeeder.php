<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \Tenant::setTenant(null);
        $categories = Category::all();

        Product::factory(20)
            ->make()
            ->each(function (Product $product) use ($categories) {
                $tenantId = rand(1, 2);
                $category = $categories->where('company_id', $tenantId)->random();
                $product->category_id = $category->id;
                $product->company_id = $tenantId;
                $product->save();
            });
    }
}
