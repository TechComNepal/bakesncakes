<?php

namespace App\Repositories\Categories;

use App\Contracts\Categories\CategoryContract;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Categories\CategoryRepositoryInterface;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class CategoryRepository extends BaseRepository implements CategoryContract
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findCategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function storeCategory(array $params)
    {
        try {
            $collection = collect($params)->except('_token', 'image');

            if (!is_null($collection['parent_id'])){
                $category = Category::find($collection['parent_id']);
                $level = $category->level + 1;
            }else{
                $level = NULL;
            }
            $user_id = Auth::user()->id;
            $merge = $collection->merge(compact('level', 'user_id'));
            $category = $this->model->create($merge->all());
            return $category;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateCategory(int $id, array $params)
    {
        $category = $this->findCategoryById($id);
        $collection = collect($params)->except('_token');

        if (!is_null($collection['parent_id'])){
            $category = Category::find($collection['parent_id']);
            $level = $category->level + 1;
        }else{
            $level = NULL;
        }
        $user_id = Auth::user()->id;
        $merge = $collection->merge(compact('level', 'user_id'));

        return $category->update($merge->all());
    }

    public function deleteCategory(int $id)
    {
        $category = $this->findCategoryById($id);
        $category->deactivate()->notFeatured()->save();
        return $category;
    }


    public function updateCategoryStatus(array $params)
    {
        $category = $this->findCategoryById($params['category_id']);
        $boolean = ($params['is_status'] == 'on' ?  true  : false);
        return ($boolean ? $category->activate()->save() : $category->deactivate()->save());
    }

    public function updateCategoryFeature(array $params)
    {
        $category = $this->findCategoryById($params['category_id']);
        $boolean = ($params['is_featured'] == 'on' ?  true  : false);
        return ($boolean ? $category->featured()->save() : $category->notFeatured()->save());

    }

    public function updateCategoryMenu(array $params)
    {
        $category = $this->findCategoryById($params['category_id']);
        $category->in_menu=$params['in_menu'];
        return $category->update();
    }

    private function uploadImage(int $id, string $collection)
    {
        $category = $this->findCategoryById($id);
        $category
            ->addMediaFromRequest('image')
            ->preservingOriginal()
            ->toMediaCollection($collection);
    }
}
