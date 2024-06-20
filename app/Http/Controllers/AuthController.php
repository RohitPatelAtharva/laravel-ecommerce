<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\CancellationReason;
use App\Models\Country;
use App\Models\Customer_addresses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\ShippingCharge;
use App\Models\Witchlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {

        return view('Front.account.login');
    }
    public function register()
    {
        return view('Front.account.register');
    }
    public function processRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);

            $user->save();
            session()->flash('message', 'You are login successfully');
            return response()->json([
                'status' => true,

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);



        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }
                return redirect()->route('account.profile');
                // Authentication successful
            } else {
                // Authentication failed

                return redirect()->route('account.login')
                    ->withInput($request->only('email'))
                    ->with('error', 'Either email/Password is incorrect.');
            }
        } else {

            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function profile()
    {  
        $userId = Auth::user()->id;
        $countries=Country::orderBy('name','ASC')->get();
        $user=User::where('id',$userId)->first();
         $address=Customer_addresses::where('user_id',$userId)->first();
        //  dd($address);

        return view('Front.account.profile',[
            'user'=>$user,
            'countries'=>$countries,
            'address'=>$address
        ]);
    }

    public function updateProfile(Request $request) {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId . ',id',
            'phone' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Handle the case where validation passes
        $user = User::find($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        session()->flash('message', 'Profile updated successfully.');
    
        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.'
        ]);
    }

    public function updateAddress(Request $request) {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:5',
            'last_name' => 'required',
            'email' => 'required|email',
            'country_id' => 'required', // Ensure this matches the field name in your form and database
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required|min:10',
            'mobile' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        
        Customer_addresses::updateOrCreate(
            ['user_id' => $userId],
            [ 
                'user_id' => $userId,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'countries_id' => $request->country_id, // Ensure this matches the validation rule
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );
        session()->flash('message', 'Address updated successfully.');
    
        return response()->json([
            'status' => true,
            'message' => 'Address updated successfully.'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')
            ->with('message', 'You are successfully logout!');
    }
    public function orders()
    {
        // $user = Auth::user();
        // $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        // $data['orders'] = $orders;


        $userOrders = DB::table('orders')
    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    ->join('products', 'order_items.product_id', '=', 'products.id')
    ->select(
        'orders.*',
        'orders.shipped_date', // Include shipped_date
        'order_items.name as item_name',
        'order_items.qty',
        'order_items.price as item_price',
        'order_items.total as item_total',
        'products.title as product_title',
        'products.description as product_description',
        'products.image as product_image'
    )
    ->where('orders.user_id', Auth::id())
    ->get()->groupBy('id'); // Group orders by their IDs;




    // dd($userOrders);

        return view('Front.account.myOrder',  ['groupedOrders' => $userOrders]);
    }

    public function orderDetail($id)
    {
        $data = [];
        $order = Order::where('id', $id)->first();
        // dd($order);
        $data['order'] = $order;
        $orderItems = Order_item::where('order_id', $id)
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_items.*', 'products.image')
            ->get();
        $subtotal = 0;
        foreach ($orderItems as $st) {
            $subtotal += $st->qty * $st->price;
        }



        $ShippingCharge = 20;

        $gtotal = $subtotal + $ShippingCharge;

        $data['orderItems'] = $orderItems;

        $orderItemsCount=Order_item::where('order_id',$id)->count();

        return view('Front.account.order-detail', $data, compact('subtotal', 'gtotal','orderItemsCount'));
    }

    public function wishlist()
    {
        $wishlists = Witchlist::where('user_id', Auth::user()->id)->with('product')->get();
        $data = [];
        $data['wishlists'] = $wishlists;
        return view('Front.account.witchlist', $data);
    }
    public function removeProductfromWishlist(Request $request)
    {
        $wishlist = Witchlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
        if ($wishlist == null) {
            session()->flash('error', 'Product already removed');
            return response()->json([
                'status' => true,
            ]);
        } else {
            $wishlist = Witchlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->delete();
            session()->flash('message', 'Product  removed Successfully');
            return response()->json([
                'status' => true,
            ]);
        }
    }

    public function showchangePaswordForm()
    {
        return view('Front.account.changePasword');
    }
    public function changePasword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->passes()) {
            $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();
            //    dd($user);
            if (!Hash::check($request->old_password, $user->password)) {
                session()->flash('error', 'Your Old Password is incorrect,plese try again');

                return response()->json([
                    'status' => true,

                ]);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            session()->flash('message', 'You have successfully changed your password.');

            return response()->json([
                'status' => true,

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function forgetPassword(){
        return view('Front.account.forgetPassword');
    }
    public function processForgetPassword(Request $request){
         $validator=Validator::make($request->all(),[
            'email'=>'required|exists:users,email'
         ]);

         if($validator->fails()){
            return redirect()->route('front.forgetPassword')->withInput()->withErrors($validator);
         }
         
        $token=Str::random(60);
        DB::table('password_reset_tokens')->where('email',$request->email)->delete();
         DB::table('password_reset_tokens')->insert([
          'email'=>$request->email,
          'token'=>$token,
          'created_at'=>now()

         ]);

         //sent email

         $user=User::where('email',$request->email)->first();
         $formData=[
            'token'=>$token,
            'user'=>$user,
            'mailSubject'=>'You have requested to reset your password'
         ];
         Mail::to($request->email)->send(new ResetPasswordEmail($formData));
         return redirect()->route('front.forgetPassword')->with('success','Please check your inbox to reset your password');

    }

    public function resetPassword($token){
        $tokenExist=DB::table('password_reset_tokens')->where('token',$token)->first();
        if($tokenExist==null){
            return redirect()->route('front.forgetPassword')->with('error','Invalid request.');
        }
       return view('Front.account.reset-password',compact('token')); 
    }
    public function processresetPassword(Request $request){
        $token = $request->token;
        $tokenObj = DB::table('password_reset_tokens')->where('token', $token)->first();
        
        if ($tokenObj == null) {
            return redirect()->route('front.forgetPassword')->with('error', 'Invalid request.');
        }
        
        $user = User::where('email', $tokenObj->email)->first(); // Fetch the user instance from the database
    
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password'
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('front.resetPassword', $token)->withInput()->withErrors($validator);
        }
    
        $user->password = Hash::make($request->new_password); // Update the user's password
        $user->save();
    
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    
        return redirect()->route('account.login')->with('message', 'You have successfully updated your password.');
    }

    public function showCancelForm($orderId)
    {
         
        $order = Order::find($orderId);
        return view('Front.account.cancel', compact('order'));
    }


    public function trackOrder($id) {
        // Retrieve the order by its ID
        $order = Order::find($id);
    
         
        if (!$order) {
            
            return redirect()->back()->with('error', 'Order not found');
        }
    
        // Return the view with the order data
        return view('Front.account.trackOrder', compact('order'));
    }

    // public function Cancelconfirm(){
        
    //     return view('Front.account.confirmCancel');
    // }

     
 
    public function cancelOrder(Request $request, $orderId)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'comments' => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($orderId);

        // Update the status of the order
        $order->status = 'cancelled';
        $order->save();

        // Store the cancellation reason
        $cancellationReason = new CancellationReason();
        $cancellationReason->order_id = $order->id;
        $cancellationReason->reason = $validated['reason'];
        $cancellationReason->comments = $validated['comments'];
        $cancellationReason->save();

        return redirect()->route('cancel.confirm', ['orderId' => $orderId])->with('message', 'Order cancelled successfully.');
    }

    public function Cancelconfirm($orderId)
    {
        // Count the number of canceled items for the order
        $canceledItemCount = DB::table('order_items')
                                ->where('order_id', $orderId)
                                
                                ->count();

        // Pass the count and order ID to the view
        return view('Front.account.confirmCancel', compact('orderId', 'canceledItemCount'));
    }
}

