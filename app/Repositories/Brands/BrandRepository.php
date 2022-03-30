<?php

namespace App\Repositories\Brands;

use App\Models\Brand;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Brands\BrandContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandRepository extends BaseRepository implements BrandContract
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
        $this->model=$model;
    }

    public function listBrands(string $order='id', string $sort='desc', array $columns= ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findBrandById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function storeBrand(array $params)
    {

        try {
            $collection = collect($params)->except(['image', 'category_id']);
            $user_id=Auth::user()->id;

            $merge=$collection->merge(compact('user_id'));
            $brand=$this->model->create($merge->all());

            if (Arr::exists($params,'category_id')) {
                $brand->categories()->sync($params['category_id']);
            }
            return $brand;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateBrand(int $id, array $params)
    {

        $brand=$this->findBrandById($id);
        $collection=collect($params)->except('category_id', 'image');
        $user_id=Auth::user()->id;
        $merge=$collection->merge(compact('user_id'));
        $brand->update($merge->all());

        if (Arr::exists($params,'category_id')) {
            $brand->categories()->sync($params['category_id']);
        }else{
            $brand->categories()->detach();
        }
        return $brand;
    }

    public function updateBrandStatus(array $params)
    {
        $brand=$this->findBrandById($params['brand_id']);
        $brand->status = $params['is_status'];
        return $brand->update();
    }
}
