<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Restaurant; // Import the Restaurant model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert users
        $users = [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'User',
                'phone' => '1234567890',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor User',
                'email' => 'vendor@example.com',
                'role' => 'Vendor',
                'phone' => '1234567890',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rider User',
                'email' => 'rider@example.com',
                'role' => 'Rider',
                'phone' => '1234567890',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert users into the users table
        foreach ($users as $userData) {
            $user = User::create($userData);

            if ($user->role === 'Vendor') {
                Restaurant::create([
                    'user_id' => $user->id, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
