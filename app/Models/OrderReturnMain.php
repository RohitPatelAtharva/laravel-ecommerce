<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturnMain extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'client_id', 'total_tax', 'total_discount', 'subtotal', 'grand_total', 'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderReturns()
    {
        return $this->hasMany(OrderReturn::class, 'return_id');
    }
}
