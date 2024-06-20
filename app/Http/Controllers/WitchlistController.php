<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WitchlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (auth()->check()) {
            // Add to database wishlist
           Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->input('product_id')
            ]);
        } else {
            // Add to session wishlist
            $productId = $request->input('product_id');
            $wishlist = session('wishlist', []);
            $wishlist[] = $productId;
            session(['wishlist' => $wishlist]);
        }
        return redirect()->back()->with('message', 'Item added to wishlist');
    }
    public function addItem(Request $request)
    {
        // Retrieve item ID from the request
        $itemId = $request->input('itemId');
        
        // Check if the user is authenticated
        if (auth()->check()) {
            // Add item to the database wishlist
            Wishlist::create([
                'user_id' => auth()->id(),
                'item_id' => $itemId, // Assuming 'item_id' is the column name in your 'wishlists' table
            ]);
        } else {
            // If the user is not authenticated, you may want to handle adding the item to a session wishlist
            // Implement your logic here to add the item to a session wishlist
            return response()->json(['message' => true, 'message' => 'Please login to add wishlist']);
        }
        
        // Return JSON response indicating success
        return response()->json(['success' => true, 'message' => 'Item added to wishlist']);
    }
}
