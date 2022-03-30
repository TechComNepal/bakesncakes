<?php

namespace Database\Factories;


use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
 
    protected $model = Testimonial::class;
    public function definition()
    {
        return [
            'title'=> $this->faker->name,
            'description'=> $this->faker->realText(100),
            'created_at'=> now(),
            'updated_at'=> now(),
        ];
    }
}
