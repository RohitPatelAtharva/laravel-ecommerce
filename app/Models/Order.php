<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_tax',
        'discount',
        'subtotal',
        'grand_total',
        'status',
        'payment_terms',
    ];

    // Relationship with order items
    public function items()
    {
        return $this->hasMany(Order_item::class);
    }

    // Relationship with order returns
    public function orderReturns()
    {
        return $this->hasMany(OrderReturn::class, 'order_id');
    }
    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'references')
                    ->withPivot('commission_amount', 'status')
                    ->withTimestamps();
    }
     
}
