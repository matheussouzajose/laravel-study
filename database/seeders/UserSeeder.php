<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->create([
                'name' => 'Matheus S. Jose',
                'email' => 'matheus@gmail.com'
            ]);

        User::factory()
            ->unverified()
            ->create([
                'name' => 'Matheus S. Jose',
                'email' => 'matheus@gmail.com.br'
            ]);
    }
}
