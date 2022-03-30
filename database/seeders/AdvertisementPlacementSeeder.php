<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdvertisementPlacement;

class AdvertisementPlacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homePagePlacements = [
            'Below Slider',
            'Below Featured Categories',
            'Below Placement 3',
            'Above NewsLetter',
        ];
        for ($i = 0; $i < count($homePagePlacements); $i++) {
            AdvertisementPlacement::create([
                'name' => $homePagePlacements[$i],
            ]);
        }
    }
}
