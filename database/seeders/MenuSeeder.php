<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::insert([
            [
                'name' => 'Grilled Chicken Bento',
                'description' => 'A perfectly grilled chicken mealbox with steamed rice and fresh vegetables.',
                'price' => 12.99,
                'image' => 'images/grilled_chicken_bento.jpg',
                'restaurant_id' => '1',
                'calories' => 500,
                'vegetarian' => '0',
                'active' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Salmon Teriyaki Bento',
                'description' => 'Delicious teriyaki-glazed salmon served with rice, miso soup, and pickles.',
                'price' => 15.50,
                'image' => 'images/salmon_teriyaki_bento.jpg',
                'restaurant_id' => '1',
                'calories' => 500,
                'vegetarian' => '0',
                'active' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classic Egg Sandwich',
                'description' => 'Soft sandwich bread with creamy egg filling and fresh lettuce.',
                'price' => 5.99,
                'image' => 'images/classic_egg_sandwich.jpg',
                'restaurant_id' => '1',
                'calories' => 500,
                'vegetarian' => '0',
                'active' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Avocado Tuna Sandwich',
                'description' => 'A healthy tuna sandwich with avocado, lettuce, and a touch of lemon.',
                'price' => 7.50,
                'image' => 'images/avocado_tuna_sandwich.jpg',
                'restaurant_id' => '1',
                'calories' => 500,
                'vegetarian' => '0',
                'active' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fresh Orange Juice',
                'description' => 'Freshly squeezed orange juice with no added sugar.',
                'price' => 4.99,
                'image' => 'images/fresh_orange_juice.jpg',
                'restaurant_id' => '1',
                'calories' => 500,
                'vegetarian' => '0',
                'active' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
