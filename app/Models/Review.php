<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public function show($id)
{
    // Fetch the product details (you may already have this logic)
    $product = Product::findOrFail($id);

    // Fetch reviews associated with the product
    $reviews = Review::where('product_id', $id)->get();

    // Pass the product and reviews to the view
    return view('Front.product', compact('product', 'reviews'));
}
}
