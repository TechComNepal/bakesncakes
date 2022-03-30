<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'name'=>'Bread',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'bake_cake',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Desserts',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'desserts',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Sweet Goods',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'sweet_goods',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Buns',
                'level'=>1,
                'status'=>true,
                'slug'=>'buns',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 1,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Rolls',
                'level'=>1,
                'status'=>true,
                'slug'=>'rolls',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 1,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Biscuits',
                'level'=>1,
                'status'=>true,
                'slug'=>'biscuits',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 1,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Cakes',
                'level'=>1,
                'status'=>true,
                'slug'=>'cakes',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 2,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Pies',
                'level'=>1,
                'status'=>true,
                'slug'=>'pies',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 2,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Doughnuts',
                'level'=>1,
                'status'=>true,
                'slug'=>'doughnuts',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 3,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Sweet Rools',
                'level'=>1,
                'status'=>true,
                'slug'=>'sweet_rolls',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => 3,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Bars',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'bars',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Cookies',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'cookies',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Muffins',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'muffins',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Pizza',
                'level'=>NULL,
                'status'=>true,
                'slug'=>'pizza',
                'featured' => rand(0,1),
                'in_menu' => rand(0,1),
                'parent_id' => NULL,
                'order_level' => NULL,
                'user_id'=> User::where('name', '!=', 'User')->get()->random()->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);

        $categories = Category::all();

        Category::all()->map(function ($categories) {
            $categories->addMedia(public_path('demo_images/category/cat-' . rand(1, 13) . '.jpg'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}
