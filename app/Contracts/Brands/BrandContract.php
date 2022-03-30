<?php

namespace App\Contracts\Brands;

interface BrandContract
{
    public function listBrands(string $order='id', string $sort='desc', array $columns= ['*']);

    public function findBrandById(int $id);

    public function storeBrand(array $params);

    public function updateBrand(int $id, array $params);

    public function updateBrandStatus(array $params);
}
