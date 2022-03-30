<?php

namespace App\Repositories\Users;

use App\Contracts\Users\UserContract;
use App\Models\User;
use InvalidArgumentException;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model=$model;
    }

    public function listUsers(string $order='id', string $sort='desc', array $columns= ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findUserById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function storeUser(array $params)
    {
        try {
            $collection = collect($params)->except('image');
            $role=\Spatie\Permission\Models\Role::where('id', $params['role_id'])->pluck('name')->first();
            $user = $this->model->create($collection->all())
                        ->assignRole($role);
            return $user;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateUser(int $id, array $params)
    {
        $collection=collect($params)->except('image');
        $user=$this->findUserById($id);
        $user->update($collection->all());
        $role=\Spatie\Permission\Models\Role::where('id', $params['role_id'])->pluck('name')->first();
        $user->syncRoles($role);

        return $user;
    }
}
