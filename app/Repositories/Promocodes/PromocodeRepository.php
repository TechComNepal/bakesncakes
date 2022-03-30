<?php

namespace App\Repositories\Promocodes;

use App\Contracts\Promocodes\PromocodeContract;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promocode;
use InvalidArgumentException;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PromocodeRepository extends BaseRepository implements PromocodeContract
{
    public function __construct(Promocode $model)
    {
        parent::__construct($model);
        $this->model=$model;
    }

    public function listPromocodes(string $order='id', string $sort="desc", array $columns=['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function listProducts()
    {
        return Product::orderBy('created_at', 'desc')->get();
    }

    public function listActiveCategories()
    {
        return Category::where('status', true)->get();
    }

    public function storePromocode(array $params)
    {
        try {
            if (!is_null($params['product_id'])) {
                $data = Product::findOrFail($params['product_id']);
            }


            if (!is_null($params['category_id'])) {
                $data = Category::findOrFail($params['category_id']);
            }
            $promocode= $this->model->create($params);
            $data->promocodes()->attach($promocode);

            return $promocode;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
