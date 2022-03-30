<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Testimonial::insert([
            [
                'title'=>'Ram Nepal',
                'slug'=>'ram-nepal',
                'description'=>'1)	Had ordered Rasmalai Cake for my friend\'s b\'day. He never liked any other flavours than chocolate but after tasting this he was totally into it. It was super, liked by all',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'title'=>'Shyam Shrestha',
                'slug'=>'shyam-shrestha',                
                'description'=>'Had ordered Cup Cake for my friend\'s b\'day. He never liked any other flavours than chocolate but after tasting this he was totally into it. It was super, liked by all',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'title'=>'Hari gopal',
                'slug'=>'hari-gopal',
                'description'=>'I wanted an eggless cake in 2 hours\' time and I came across Warm Oven. My mom likes fresh fruit cake that isn\'t too sweet...so I took a bet with this one.Placing an order was very simple and the cake was delivered in 2 hours flat. It was fresh and delicious',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'title'=>'kiran Limbu',
                'slug'=>'kiran-limbu',
                'description'=>'I wanted an eggless cake in 2 hours\' time and I came across Warm Oven. My mom likes fresh fruit cake that isn\'t too sweet...so I took a bet with this one.Placing an order was very simple and the cake was delivered in 2 hours flat. It was fresh and delicious',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);

           Testimonial::all()->map(function ($testimonials) {
            $testimonials->addMedia(public_path('demo_images/clients/client-' . rand(1, 5) . '.png'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}
