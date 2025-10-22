<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'admin',
            'email'    => 'admin@example.com',
            'password' => 'Pa$$w0rd!',
        ]);

        Product::factory(300)->create()->each(function ($product, $index) {
            $product->name = 'Product-' . ($index + 1);
            $product->save();
        });
        Product::create([
            'name'        => 'Wireless Noise-cancelling Headphones',
            'slug'        => 'wireless-noise-cancelling-headphones',
            'description' => 'Over-ear headphones with active noise cancellation, 30-hour battery life, Bluetooth 5.2, built-in mic.',
            'price'       => 129.99,
            'image'       => null,
        ]);

        Product::create([
            'name'        => 'Portable Bluetooth Speaker',
            'slug'        => 'portable-bluetooth-speaker',
            'description' => 'Waterproof IPX7 speaker with 10-hour playtime and compact design for travel.',
            'price'       => 59.99,
            'image'       => null,
        ]);

        Product::create([
            'name'        => 'Phone Case - Shockproof (iPhone 14)',
            'slug'        => 'phone-case-shockproof-iphone-14',
            'description' => 'TPU shockproof case with raised edges and textured grip for iPhone 14.',
            'price'       => 19.99,
            'image'       => null,
        ]);
    }
}
