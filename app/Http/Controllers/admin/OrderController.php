<?php

namespace App\Http\Controllers\admin;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::latest('orders.created_at')
                        ->select('orders.*', 'users.name as user_name', 'users.email as user_email', 'clients.name as client_name', 'clients.email as client_email')
                        ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                        ->leftJoin('clients', 'clients.id', '=', 'orders.client_id');
    
        // Search functionality
        if ($request->has('keyword') && $request->keyword != "") {
            $keyword = $request->keyword;
            $orders->where(function($query) use ($keyword) {
                $query->where('users.name', 'like', '%' . $keyword . '%')
                      ->orWhere('users.email', 'like', '%' . $keyword . '%')
                      ->orWhere('orders.id', 'like', '%' . $keyword . '%')
                      ->orWhere('clients.name', 'like', '%' . $keyword . '%'); // Search by client name
            });
        }
    
        $orders = $orders->paginate(10);
    
        return view('admin.order.index', [
            'orders' => $orders
        ]);
    }
    public function detail($orderId)
    {
        $order=Order::where('id',$orderId)->first();
        $orderItems=Order_item::where('order_id',$orderId)->get();
        
        return view('admin.order.order-detail',compact('order','orderItems'));
    }

    public function changeOrderStatus(Request $request, $orderId){
        $order = Order::find($orderId);
    
        $order->status = $request->status;
        $order->shipped_date = $request->shipped_date;
    
        $order->save();
    
        $message = 'Order Status Updated successfully';
    
        session()->flash('status', $message);
    
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function sendInvoiceEmail(Request $request ,$orderId){
         orderEmail($orderId,$request->userType);
         $message = 'Order email sent successfully';
    
         session()->flash('success', $message);
     
         return response()->json([
             'status' => true,
             'message' => $message
         ]);

    }

   
}
