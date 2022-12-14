<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'phone' => fake()->phoneNumber,
            'document_number' => Str::random(11),
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * @return UserFactory
     */
    public function unverified(): UserFactory
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * @return UserFactory
     */
    public function user(): UserFactory
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_USER,
            'company_id' => null
        ]);
    }

    /**
     * @return UserFactory
     */
    public function admin(): UserFactory
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_ADMIN,
        ]);
    }
}
