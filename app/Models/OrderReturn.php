<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'return_id', 'product_id', 'item_name', 'quantity', 'rate', 'discount', 'amount', 'reason', 'remark'
    ];

    public function return()
    {
        return $this->belongsTo(OrderReturnMain::class, 'return_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
