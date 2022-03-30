<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;
use App\Models\AdvertisementPlacement;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
Advertisement::insert([
    [
        'name'                       =>'National Geographic',
        'brand_id'                   => 1,
        'clicks'                     => 0,
        'rank'                       => 1,
        'advertisement_placement_id' => 1,
        'status'                     => 1,
        'link'                        => 'https://www.nationalgeographic.com/',
        'created_at'                 => now(),
        'updated_at'                 => now(),

    ]
    ]);
        $placements = AdvertisementPlacement::where('status', true)->get();

        $placements->each(function ($placement) {
            $advertisements = Advertisement::factory()->count(rand(1, 2))->create();
            $placement->advertisements()->saveMany($advertisements);
        });

        Advertisement::all()->map(function ($advertisement) {
            $advertisement->addMedia(public_path('demo_images/font-banner/banner-0' . rand(1, 5) . '.jpg'))->preservingOriginal()->toMediaCollection('image');
        });
    }
}
