<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Blog::insert([

        [
            'id'=>1,
            'title'=>' Best Valentine’s Day Cake Near Me ',
            'slug'=>'best-valentines-day-cake-near-me',
            'user_id'=>1,
            'description'=>'
            <p>Ah, Valentine\'s Day! For those of us who love to bake, it\'s all about hearts and flours — and chocolate, of course. Sure, a dozen roses are striking and a box of candy is sweet, but baking a homemade treat for your special someone? That\'s a gift straight from the heart(h).</p>
            <p>Among the different varieties of Nepali food available, momo is one of the most popular items. In fact, momos are so popular in Nepal that almost every restaurant offers it on their menu. It’s also very popular in London, so much so that guests often ask us for the recipe for our chicken, mutton, and vegetarian momos!&nbsp;&nbsp; &nbsp;</p>',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],

        [
            'id'=>2,
            'title'=>'HOW TO MAKE MOMOS IN NEPALI WAY',
            'slug'=>'how-to-make-momos-in-nepali-way',   
            'user_id'=>'1',             
            'description'=>'
            <p>There are three steps to making momo: You will first need to have prepare fillings, then the wrappers, and finally you can cook them. Honestly momos take a bit of time to make, especially if you are not familiar with the recipe, but we assure you the end result is worth it. So let’s get to it!</p>
            <p>You will need:</p><ul>
            <li>500 gm of minced meat</li>
            <li>1 grated onion</li>
            <li>Some finely chopped coriander</li>
            <li>2 tablespoons of ginger and garlic paste each</li>
            <li>Half a tablespoon of coriander powder</li>
            <li>Half a tablespoon of turmeric</li>
            <li>Half a tablespoon of cumin powder</li>
            <li>2 tablespoons of grated chilli</li>
            <li>2 tablespoons of vegetable oil</li>
            <li>2 tablespoons of salt</li>
            <li>1 kg of flour</li></ul>',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],

        [
            'id'=>3,
            'title'=>'How to Make Any Burger in 5 Steps',
            'slug'=>'how-to-make-any-burger-in-5-steps',
            'user_id'=>'1',
            'description'=>'
            <p>Brief About How to Make Burger</p>
            <p>Some tasks in the kitchen involve skill, coordination, and a little bit of luck; they, like making a towering souffle or turning a carrot, require practice, patience, and precision.</p>
            <p>Making burgers is not one of these.</p>
            <p>If you can form meat into shapes and move them around on a hot surface, you can make a burger. You can make any burger, and throw a barbecue, or a party, or simply eat them for dinner and feel accomplished and sated and happy. Here\'s how.</p>
            <p><br></p>
            <p><strong>How to Make Any Burger in 5 Steps</strong></p>
            <p>1. Dump your ground meat into a bowl. (We go for ground meat with around 20% fat.) Season it with salt, pepper, and whatever else you want; you can add spices, perhaps, or Worcestershire sauce, or shallots, or chiles.</p>
            ',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],
    
    ]);

       Blog::all()->map(function ($services) {
        $services->addMedia(public_path('demo_images/font-banner/banner-02.jpg'))->preservingOriginal()->toMediaCollection('image');

    });
}
}