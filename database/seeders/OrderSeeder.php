<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::insert([
            [
                'user_id' => 1, 
                'total_price' => 12.99, 
                'status' => 'pending', 
                'payment_method' => 'credit_card', 
                'delivery_address' => '123 Food Street, City, Country', 
                'notes' => 'Please include extra napkins.', 
                'restaurant' => 'Sushi Delight', 
                'placed_at' => now(), 
            ],
            [
                'user_id' => 1, 
                'total_price' => 12.99, 
                'status' => 'pending', 
                'payment_method' => 'credit_card', 
                'delivery_address' => '123 Food Street, City, Country', 
                'notes' => 'Please include extra napkins.', 
                'restaurant' => 'Sushi Delight', 
                'placed_at' => now(), 
            ],
        ]);
    }
}
