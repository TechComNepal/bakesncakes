<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $dates=['delivery_date'];


    protected $casts=[
        'shipping_address'=>'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
         ->withPivot('user_id', 'price', 'quantity', 'total', 'status', 'tax', 'delivery_date', 'user_note')
         ->withTimestamps();
    }
}
