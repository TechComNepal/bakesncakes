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
            $is_refundable = $collection->has('is_refundable') ? 1 : 0;
            $is_featured = $collection->has('is_featured') ? 1 : 0;
            $is_trending = $collection->has('is_trending') ? 1 : 0;
            $is_sellable = $collection->has('is_sellable') ? 1 : 0;
            $top_selling = $collection->has('top_selling') ? 1 : 0;
            $best_selling = $collection->has('best_selling') ? 1 : 0;
            $order_custom_msg = $collection->has('order_custom_msg') ? 1 : 0;
            $is_taxable = $collection->has('is_taxable') ? 1 : 0;
            $user_id = Auth::user()->id;

            $merge = $collection->merge(compact('is_refundable', 'is_featured', 'is_trending', 'is_sellable', 'order_custom_msg', 'is_taxable', 'user_id', 'top_selling', 'best_selling'));

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

        $is_refundable = $collection->has('is_refundable') ? 1 : 0;
        $is_featured = $collection->has('is_featured') ? 1 : 0;
        $is_trending = $collection->has('is_trending') ? 1 : 0;
        $is_sellable = $collection->has('is_sellable') ? 1 : 0;
        $top_selling = $collection->has('top_selling') ? 1 : 0;
        $best_selling = $collection->has('best_selling') ? 1 : 0;
        $order_custom_msg = $collection->has('order_custom_msg') ? 1 : 0;
        $is_taxable = $collection->has('is_taxable') ? 1 : 0;
        $user_id = Auth::user()->id;


        $merge = $collection->merge(compact('is_refundable', 'is_featured', 'is_trending', 'is_sellable', 'order_custom_msg', 'is_taxable', 'user_id', 'top_selling', 'best_selling'));
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
}
