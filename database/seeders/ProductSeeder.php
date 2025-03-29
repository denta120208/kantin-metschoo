<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            1 => 'image/download (1).jpeg',
            2 => 'image/63300cfd403f0.jpg',
            3 => 'image/mie ayam.jpeg',
            4 => 'image/bakso.jpeg',
            5 => 'image/soto.webp',
            6 => 'image/ayam.jpg',
        ];

        foreach ($products as $productId => $image) {
            Product::where('id', $productId)->update(['image' => $image]);
        }
    }
}
