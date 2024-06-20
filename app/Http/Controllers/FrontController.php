<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Witchlist;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){


        // Fetch featured products
        $products = Product::where('is_featured', 'Yes')
            ->where('status', 1)
            ->get();
        $data['featuredProducts'] = $products;

        // Return the view with data and cartCount passed to Front.app blade file
        return view('Front.home', $data) ;

    }

    public function countCart()
    {

        if (Auth::check()) {

            $userId = Auth::id();


            $cartCount = Cart::where('user_id', $userId)
                ->distinct('product_id')
                ->count('product_id');


            return response()->json(['cartCount' => $cartCount]);
        }

        // Return 0 if the user is not authenticated
        return response()->json(['cartCount' => 0]);
    }


    public function contact(){
        return view('Front.contact-us');
    }
    public function about(){
        return view('Front.about-us');
    }

    public function addToWishlist(Request $request){
        if(Auth::check()==false){
            session(['url.intended'=>url()->previous()]);
            return response()->json([
                'status'=>false,
            ]);
        }
        $product=Product::where('id',$request->id)->first();
        if($product == null){
            return response()->json([
                'status'=>true,
                'message'=>'<div class="alert alert-danger ">Product  not found </div>'
            ]);
        }
        $wishlist = Witchlist::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->id
            ],
            [
                'user_id' => auth()->id(),
                'product_id' => $request->id
            ]
        );

        // $wishlish= new  Witchlist();
        // $wishlish->user_id =Auth::user()->id;
        // $wishlish->product_id=$request->id;
        // $wishlish->save();
        return response()->json([
            'status'=>true,
            'message' => '<div class="alert alert-success"><strong>'.$product->title.'</strong> Product added successfully </div>'
        ]);



    }
}
