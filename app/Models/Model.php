<?php

namespace App\Models;

use App\Models\Concerns\HasActiveState;
use App\Models\Concerns\HasFeatured;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    use HasActiveState;
    use HasFeatured;
}
