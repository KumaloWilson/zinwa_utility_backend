<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@zinwa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        // Create vendor user
        User::create([
            'name' => 'Vendor User',
            'email' => 'vendor@zinwa.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        // Create consumer user
        User::create([
            'name' => 'Consumer User',
            'email' => 'consumer@zinwa.com',
            'password' => Hash::make('password'),
            'role' => 'consumer',
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        // Create additional test users
        User::factory(10)->create();
    }
}

