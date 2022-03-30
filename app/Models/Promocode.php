<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promocode extends Model
{
    use HasFactory;

    protected $table='promocodes';

    protected $dates=['start_from','expires_on'];
    protected $guarded=['id'];

    public function products()
    {
        return $this->morphedByMany(Product::class, 'promocodeable')->withTimestamps();
    }
    public function categories()
    {
        return $this->morphedByMany(Category::class, 'promocodeable')->withTimestamps();
    }
   

    public function setCouponCodeAttribute($value)
    {
        return $this->attributes['coupon_code'] = strtoupper($value);
    }
}
