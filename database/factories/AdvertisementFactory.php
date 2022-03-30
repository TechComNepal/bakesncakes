<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Advertisement;
use App\Models\AdvertisementPlacement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    /**
         * Define the model's default state.
         *
         * @return array
         */
    protected $model = Advertisement::class;
    public function definition()
    {
        return [
            'name'                       => $this->faker->name,
            'brand_id'                   => Brand::where('status', true)->get()->random()->id,
            'clicks'                     => rand(0, 10),
            'rank'                       => rand(0, 10),
            'advertisement_placement_id' => AdvertisementPlacement::where('status', true)->get()->random()->id,
            'status'                     => $this->faker->randomElement(['on', 'off']),
            'created_at'                 => now(),
            'updated_at'                 => now(),
        ];
    }
}
