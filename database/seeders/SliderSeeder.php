<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::factory()->count(6)->create();

        Slider::all()->map(function ($slider) {
            $slider->addMedia(public_path('demo_images/slider/slider-0' . rand(1, 4) . '.jpg'))->preservingOriginal()->toMediaCollection('desktop');
        });
    }
}
