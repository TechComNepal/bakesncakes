<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    protected $model=Slider::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id'=> Brand::get()->random()->id,
             'status' => 1,
            'is_popup' => (bool) random_int(0, 1),
        ];
    }
}
