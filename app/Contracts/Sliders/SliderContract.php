<?php

namespace App\Contracts\Sliders;

interface SliderContract
{
    public function listSliders(string $order='id', string $sort='desc', array $columns= ['*']);
    public function findSliderById(int $id);
    public function storeSlider(array $params);
    public function updateSlider(int $id, array $params);
    public function updateSliderStatus(array $params);
    public function updateSliderPopup(array $params);
    public function listBrands();
}
