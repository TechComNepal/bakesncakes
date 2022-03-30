<?php

namespace App\Contracts\Products;

interface ProductContract
{
    public function listProducts(string $order = 'id', string $sort = "asc", array $columns = ['*']);

    public function findProductById(int $id);

    public function storeProduct(array $params);

    public function updateProduct(int $id, array $params);

    public function deleteProduct(int $id);

    public function deleteGallery(int $id);
}
