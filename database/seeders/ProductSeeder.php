<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(25)->create();

        $products = Product::all();

        Product::all()->map(function ($product) {
            $product->addMedia(public_path('demo_images/products/product-' . rand(1, 9) . '.jpg'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}
