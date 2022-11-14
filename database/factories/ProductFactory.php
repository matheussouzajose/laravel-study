<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'cover' => fake()->imageUrl,
            'description' => fake()->sentence,
            'stock' => fake()->randomDigit(),
            'price' => fake()->randomFloat(2, 100, 1000)
        ];
    }
}
