<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'name'=>'BakenCake',
                'slug'=>'bake_cake',
                'short_description'=>'Bakes and Cakes',
                'user_id'=> User::get()->random()->id,
                'status'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

             [
                'name'=>'Himalaya Udhyog',
                'slug'=>'himalaya_udhog',
                'short_description'=>'Himalayan Udhyog',
                'user_id'=> User::get()->random()->id,
                'status'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

             [
                'name'=>'Chaudhary Bakes',
                'slug'=>'chaudhary_bakes',
                'short_description'=>'CG bakery',
                'user_id'=> User::get()->random()->id,
                'status'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

             [
                'name'=>'Khajuri',
                'slug'=>'khajiuri',
                'short_description'=>'Khajurico',
                'user_id'=> User::get()->random()->id,
                'status'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

        ]);

    }
}
