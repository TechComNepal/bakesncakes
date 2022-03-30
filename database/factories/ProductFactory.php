<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'sku' => $this->faker->bothify('?###??##'),
            'description' => $this->faker->realText(100),
            'cost_price' => $this->faker->numberBetween(200, 999),
            'selling_price' => $this->faker->numberBetween(1000, 9999),
            'tags' => $this->faker->randomElement(['baked goods', 'cup cake', 'cake boxes', 'bread']),
            'discount_type' => $this->faker->randomElement(['flat', 'percent']),
            'discount' => $this->faker->numberBetween(0, 50),
            'is_taxable' => rand(0,1),
            'quantity' =>  $this->faker->numberBetween(10, 100),
            'min_purchase_unit' => $this->faker->numberBetween(1, 4),
            'is_refundable' => rand(0,1),
            'is_featured' => rand(0,1),
            'is_trending' => rand(0,1),
            'is_sellable' => rand(0,1),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'units' => $this->faker->randomElement(['Pcs', 'Kg']),
            'order_custom_msg' => rand(0,1),
            'brand_id' => Brand::get()->random()->id,
            'category_id' => Category::get()->random()->id,
            'user_id'    => User::where('name', '!=', 'User')->get()->random()->id,
        ];
    }
}
