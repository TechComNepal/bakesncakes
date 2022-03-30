<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasPermissions;

class Module extends Model
{
    use HasFactory, HasPermissions;

    protected $guard_name = 'web';

    protected $guarded = ['id'];
}
