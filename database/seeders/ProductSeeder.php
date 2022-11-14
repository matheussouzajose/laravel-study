<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = Category::all();
        Product::factory(100)
            ->make()
            ->each(function (Product $product) use ($categories) {
                $category = $categories->random();
                $product->category_id = $category->id;
                $product->save();
            });
    }
}
