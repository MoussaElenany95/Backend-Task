<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // user
        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

    }
}
