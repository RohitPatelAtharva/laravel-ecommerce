<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Customer_addresses;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use function Ramsey\Uuid\v1;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not authenticated.'], 401);
        }


        $productId = $request->input('id');
        $quantity = $request->input('quantity');


        $product = Product::find($productId);


        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found.']);
        }


        $cartItem = Cart::where('product_id', $productId)->first();

        if ($cartItem) {

            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {

            $cartItem = new Cart([
                'product_id' => $productId,
                'quantity' => $quantity,

            ]);


            $cartItem->user_id = $user->id;


            $cartItem->save();
        }

        return response()->json(['status' => true]);
    }
    public function cart()
    {
        if (auth()->check()) {
            $userId = auth()->id();

            $cartItems = Cart::select('p.*', 'carts.quantity')
                ->leftJoin('products as p', 'p.id', '=', 'carts.product_id')
                ->where('carts.user_id', $userId)
                ->get();

            return view('Front.cart', compact('cartItems'));
        } else {
            return redirect()->route('account.login')->with('error', 'Please login to view your cart.');
        }
    }
    public function updateCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->productId;
        $quantity = $request->quantity;


        $cartItem = Cart::where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();

            // Calculate the total price
            $product = Product::find($productId);
            $totalPrice = $product->price * $quantity;

            // Return a JSON response with the updated total price
            return response()->json([
                'status' => true,
                'totalPrice' => $totalPrice,
            ]);
        }

        // If the cart item is not found, return an error response
        return response()->json([
            'status' => false,
            'message' => 'Cart item not found.',
        ], 404);
    }



    public function cartSummary()
    {
        // Get the authenticated user's cart items
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $totalQuantity = Cart::where('user_id', $userId)->sum('quantity');
        // Calculate subtotal and total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            // Assuming each cart item has a 'product' relationship
            $subtotal += $item->product->price * $item->quantity;
        }

        // You can add shipping cost, taxes, or any other additional costs here if needed
        $shippingCost = 20;
        $total = $subtotal + $shippingCost;

        // Return the subtotal and total in JSON format
        return response()->json([
            'subtotal' => $subtotal,
            'total' => $total,
            'totalQuantity' => $totalQuantity,
        ]);
    }



    public function deleteCartItem($productId)
    {
        // Validate the productId parameter
        // You can use Laravel's validation methods here if needed

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Find the cart item by user ID and product ID
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        // Check if the cart item exists
        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();

            // Get updated cart summary
            $cartSummary = $this->cartSummary($userId);

            // Check if the request is AJAX
            if (request()->ajax()) {
                // Return success JSON response with updated cart summary
                return response()->json(['success' => true, 'cartSummary' => $cartSummary]);
            } else {
                // Return a success redirect response
                return redirect()->route('cart')->with('success', 'Cart item deleted successfully.');
            }
        } else {
            // Check if the request is AJAX
            if (request()->ajax()) {
                // Return an error JSON response
                return response()->json(['success' => false, 'message' => 'Cart item not found.'], 404);
            } else {
                // Return an error redirect response
                return redirect()->route('cart')->with('error', 'Cart item not found.');
            }
        }
    }

    ##################checkout########################

    public function checkout()
    {
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        if (Auth::check() == false) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login');
        }

        $customerAddress = Customer_addresses::where('user_id', Auth::user()->id)->first();

        session()->forget('url.intended');

        if (auth()->check()) {
            $userId = auth()->id();

            $cartItems = Cart::select('p.*', 'carts.quantity')
                ->leftJoin('products as p', 'p.id', '=', 'carts.product_id')
                ->where('carts.user_id', $userId)
                ->get();
            $ammount = Cart::where('user_id', $userId)->with('product')->get();

            $subtotal = 0;
            foreach ($ammount as $item) {
                // Assuming each cart item has a 'product' relationship
                $subtotal += $item->product->price * $item->quantity;
            }
            $shippingCost = 20;
            $total = $subtotal + $shippingCost;
            $countries = Country::orderBy('name', 'ASC')->get();

            return view('Front.checkout', compact('cartItems', 'subtotal', 'total', 'countries', 'customerAddress'));
        }
    }

    public function processCheckout(Request $request)
    {
        // Apply validator
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:5',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|min:10',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Save user address details
        $userId = Auth::id();
    
        Customer_addresses::updateOrCreate(
            ['user_id' => $userId],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'countries_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );
    
        if ($request->payment_method == 'cod') {
            // Calculate subtotal
            $cartItems = Cart::where('user_id', $userId)->with('product')->get();
            $subtotal = 0;
            $shippingCost = 20;
            $orderItemsData = [];
    
            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
    
                // Prepare order items data
                $orderItemsData[] = [
                    'product_id' => $item->product_id,
                    'name' => $item->product->title,
                    'qty' => $item->quantity,
                    'price' => $item->product->price,
                    'total' => $item->product->price * $item->quantity
                ];
    
                // Update product stock
                $productData = Product::find($item->product_id);
                if ($productData && $productData->track_qty == 'Yes') {
                    $productData->qty -= $item->quantity;
                    $productData->save();
                }
            }
    
            // Calculate grand total
            $grandTotal = $subtotal + $shippingCost;
    
            // Create Order
            $order = new Order();
            $order->subtotal = $subtotal;
            $order->shipping = $shippingCost;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'not paid';
            $order->status = 'pending';
            $order->user_id = $userId;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->zip = $request->zip;
            $order->note = $request->note;
            $order->countries_id = $request->country;
            $order->save();
    
            // Attach order items to the order
            foreach ($orderItemsData as &$orderItemData) {
                $orderItemData['order_id'] = $order->id;
            }
            Order_Item::insert($orderItemsData);
    
            // Clear cart
            Cart::where('user_id', $userId)->delete();
    
            // Send order confirmation email
            orderEmail($order->id,'customer');
    
            // Return JSON response with order details
            return response()->json([
                'message' => 'Order saved successfully',
                'orderId' => $order->id,
                'status' => true,
            ]);
        }
    }
    


    public function thankyou($id)
    {
        return view('Front.thankyou', [
            'id' => $id
        ]);
    }
}
