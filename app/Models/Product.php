<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\ProductRating;

class Product extends Model
{
    use HasFactory;

     
    // Method to retrieve related products based on tags
//     public function tags()
//     {
//         return $this->belongsToMany(Tag::class);
//     }
//     public function relatedProductsByTag()
// {
//     return Product::whereHas('tags', function ($query) {
//         $query->whereIn('id', $this->tags()->pluck('id'));
//     })->where('id', '!=', $this->id)->get();
// }

public function product_ratings(){
   return $this->hasMany(ProductRating::class)->where('status',1);
}
public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

}
