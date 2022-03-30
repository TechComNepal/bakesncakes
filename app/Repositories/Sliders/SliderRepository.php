<?php

namespace App\Repositories\Sliders;

use App\Contracts\Sliders\SliderContract;
use App\Models\Brand;
use App\Models\Slider;
use InvalidArgumentException;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderRepository extends BaseRepository implements SliderContract
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
        $this->model=$model;
    }

    public function listSliders(string $order='id', string $sort='desc', array $columns= ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findSliderById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function storeSlider(array $params)
    {
        try {
            $collection = collect($params)->except('image');
            $slider=$this->model->create($collection->all());
            return $slider;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateSlider(int $id, array $params)
    {
        $slider=$this->findSliderById($id);
        $collection=collect($params)->except('image');
        $slider->update($collection->all());
        return $slider;
    }

    public function updateSliderStatus(array $params)
    {
        $slider=$this->findSliderById($params['slider_id']);
        $slider->status = $params['is_status'];
        return $slider->update();
    }

    public function updateSliderPopup(array $params)
    {
        $slider=$this->findSliderById($params['slider_id']);
        $slider->is_popup = $params['is_popup'];
        return $slider->update();
    }

    public function listBrands()
    {
        return Brand::orderBy('created_at', 'desc')->get();
    }
}
