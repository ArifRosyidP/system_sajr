<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // Product::factory()->count(20)->create();
    public function run(): void
    {
        Product::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Laptop Asus',
                'slug' => 'laptop-asus',
                'description' => 'Laptop gaming',
                'price' => 12000000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Mouse Logitech',
                'slug' => 'mouse-logitech',
                'description' => 'Mouse wireless',
                'price' => 250000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
