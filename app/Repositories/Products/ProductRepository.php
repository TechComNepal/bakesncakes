<?php

namespace App\Repositories\Products;

use App\Models\Product;

use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use App\Contracts\Products\ProductContract;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ProductRepository extends BaseRepository implements ProductContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProducts(string $order = 'id', string $sort = "asc", array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function storeProduct(array $params)
    {
        try {
            $collection = collect($params)->except('_token');
            $order_custom_msg = $collection->has('order_custom_msg') ? 1 : 0;
            $user_id = Auth::user()->id;
            $merge = $collection->merge(compact('order_custom_msg', 'user_id'));

            $product = new Product($merge->all());
            $product->save();

            return $product;
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    public function updateProduct(int $id, array $params)
    {
        $product = $this->findProductById($id);
        $collection = collect($params)->except('_token');
        $order_custom_msg = $collection->has('order_custom_msg') ? 1 : 0;
        $user_id = Auth::user()->id;

        $merge = $collection->merge(compact('order_custom_msg', 'user_id'));
        return $product->update($merge->all());
    }

    public function deleteProduct(int $id)
    {
        $product = $this->findProductById($id);
        $product->delete();
        return $product;
    }

    public function deleteGallery(int $id)
    {
        $media = Media::find($id);
        $media->delete();
        return $media;
    }

    public function updateProductTaxable(array $params)
    {
        $product = $this->findProductById($params['product_id']);
        $product->is_taxable=$params['is_taxable'];
        return $product->update();
    }

    public function updateProductFeature(array $params)
    {
        $product = $this->findProductById($params['product_id']);
        $product->is_featured=$params['is_featured'];
        return $product->update();
    }

    public function updateProductRefundable(array $params)
    {
        $product = $this->findProductById($params['product_id']);
        $product->is_refundable=$params['is_refundable'];
        return $product->update();
    }

    public function updateProductTrending(array $params)
    {
        $product = $this->findProductById($params['product_id']);
        $product->is_trending=$params['is_trending'];
        return $product->update();
    }

    public function updateProductSellable(array $params)
    {
        $product = $this->findProductById($params['product_id']);
        $product->is_sellable=$params['is_sellable'];
        return $product->update();
    }
}
