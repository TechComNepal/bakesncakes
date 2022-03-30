<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable=['shipping_address','delivery_charge'];

    public function customerShippingAddresses()
    {
        return $this->hasMany(CustomerShippingAddress::class, 'city_id');
    }
}
