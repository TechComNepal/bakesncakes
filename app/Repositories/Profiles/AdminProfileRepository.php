<?php

namespace App\Repositories\Profiles;

use App\Contracts\Profiles\AdminProfileContract;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminProfileRepository extends BaseRepository implements AdminProfileContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model=$model;
    }

    public function findUserById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function updateProfile(int $id, array $params)
    {
        $user=$this->findUserById($id);
        $collection= collect($params)->except('avatar');
        $user->update($collection->all());
        return $user;
    }
}
