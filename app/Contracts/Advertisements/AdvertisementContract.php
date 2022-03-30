<?php

namespace App\Contracts\Advertisements;

interface AdvertisementContract
{
    public function listAdvertisements(string $order, string $sort, array $columns=['*']);
    public function getAdvertisementById(int $id);
    public function listActiveBrands();
    public function listActivePlacements();
    public function storeAdvertisement(array $params);
    public function updateAdvertisement(int $id, array $params);
    public function toggleAdvertisementStatus(array $params);
}
