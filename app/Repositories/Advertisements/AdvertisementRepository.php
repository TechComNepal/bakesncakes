<?php

namespace App\Repositories\Advertisements;

use App\Contracts\Advertisements\AdvertisementContract;
use App\Models\Brand;
use App\Models\Advertisement;
use InvalidArgumentException;
use App\Repositories\BaseRepository;
use App\Models\AdvertisementPlacement;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdvertisementRepository extends BaseRepository implements AdvertisementContract
{
    public function __construct(Advertisement $model)
    {
        parent::__construct($model);
        $this->model=$model;
    }

    public function listAdvertisements(string $order, string $sort, array $columns=['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function getAdvertisementById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function listActiveBrands()
    {
        return Brand::where('status', true)->get();
    }
    public function listActivePlacements()
    {
        return AdvertisementPlacement::where('status', true)->get();
    }

    public function storeAdvertisement(array $params)
    {
        try {
            $advertisement = $this->model->create(
                $this->manipulateRequestData($params)->all()
            );
            return $advertisement;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateAdvertisement(int $id, array $params)
    {
        $advertisement=$this->getAdvertisementById($id);
        $advertisement->update(
            $this->manipulateRequestData($params)->all()
        );
        return $advertisement;
    }

    private function manipulateRequestData($request)
    {
        $collection = collect($request)->except('image_url');

        $rank = ($collection->has('rank') && $collection['rank'] != null) ? $collection['rank'] : (Advertisement::last()->exists() ? Advertisement::last()->id + 1 : 1);

        return $collection->merge(compact('rank'));
    }

    public function toggleAdvertisementStatus(array $params)
    {
        $advertisement = $this->getAdvertisementById($params['advertisement_id']);
        $advertisement->status = $params['is_status'];
        return $advertisement->update();
    }
}
