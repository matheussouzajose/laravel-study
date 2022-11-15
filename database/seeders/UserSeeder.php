<?php

namespace Database\Seeders;

use App\Models\Company;
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
            ->user()
            ->create([
                'name' => 'Matheus S. Jose',
                'email' => 'matheus@gmail.com'
            ]);

        User::factory()
            ->unverified()
            ->admin()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com.br',
                'company_id' => 1
            ]);

        User::factory()
            ->unverified()
            ->admin()
            ->create([
                'name' => 'Admin 2',
                'email' => 'admin 2@gmail.com.br',
                'company_id' => 2
            ]);
    }
}
