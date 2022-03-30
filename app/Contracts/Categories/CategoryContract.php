<?php

namespace App\Contracts\Categories;

interface CategoryContract
{
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);


    public function findCategoryById(int $id);


    public function storeCategory(array $params);


    public function updateCategory(int $id, array $params);


    public function deleteCategory(int $id);
   
    public function updateCategoryStatus(array $params);
    public function updateCategoryFeature(array $params);
    public function updateCategoryMenu(array $params);
}
