<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvertisementPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'status' => 'bool',
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
