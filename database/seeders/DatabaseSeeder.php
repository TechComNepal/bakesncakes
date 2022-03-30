<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            SliderSeeder::class,
            AdvertisementPlacementSeeder::class,
            AdvertisementSeeder::class,
            TermsAndConditionSeeder::class,
            PrivacyAndPolicySeeder::class,
            AboutUsSeeder::class,
            BlogSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            ModuleSeeder::class,
        ]);
    }
}
