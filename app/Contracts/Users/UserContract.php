<?php

namespace App\Contracts\Users;

interface UserContract
{
    public function listUsers(string $order='id', string $sort='desc', array $columns= ['*']);
    public function findUserById(int $id);
    public function storeUser(array $params);
    public function updateUser(int $id, array $params);
}
