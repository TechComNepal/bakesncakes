<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\AdvertisementPlacement;

class Advertisement extends Component
{
    public $placement;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placement)
    {
        $this->placement=$placement;
    }

    public function getAdvertisement()
    {
        $advertisementPlacement = AdvertisementPlacement::query()
            ->with(['advertisements' => function ($query) {
                $query->orderBy('rank')->orderBy('updated_at', 'desc');
            }])
            ->where('name', $this->placement)
            ->first();
        $advertisements = $advertisementPlacement->advertisements;
        return $advertisements;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.advertisement');
    }
}
