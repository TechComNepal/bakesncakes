<?php

namespace App\Contracts\Profiles;

interface AdminProfileContract
{
    public function findUserById(int $id);
    
    public function updateProfile(int $id, array $params);
}
