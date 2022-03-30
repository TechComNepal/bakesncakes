<?php

namespace App\Contracts\Promocodes;

interface PromocodeContract
{
    public function listPromocodes(string $order='id', string $sort="desc", array $columns=['*']);

    public function listProducts();

    public function listActiveCategories();

    public function storePromocode(array $params);
}
