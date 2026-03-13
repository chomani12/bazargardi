<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'customer_phone', 'customer_address', 'latitude', 'longitude', 'notes', 'total_amount', 'delivery_fee', 'status'];

    protected $casts = [
        'total_amount' => 'integer',
        'delivery_fee' => 'integer',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getGrandTotalAttribute()
    {
        return $this->total_amount + $this->delivery_fee;
    }
}
