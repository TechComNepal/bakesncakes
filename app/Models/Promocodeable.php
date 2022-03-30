<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Promocodeable extends MorphPivot
{
    use HasFactory;

    protected $table='promocodeables';
    protected $guarded=['id'];
}
