<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\BillingAddress;
use App\Models\Client;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function create()
    {
        $agents = Agent::select('id', 'name')->get();
        // dd($agents);
        return view('admin.invoice.create' ,compact('agents'));
    
    }
    public function getProductsdata()
    {
        $products = Product::all() ;// Fetch all products
       

        return response()->json($products);
    }









    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'selectedProduct' => 'required|array',
            'selectedProduct.*' => 'required|integer|exists:products,id',
            'new_Qty' => 'required|array',
            'new_Qty.*' => 'required|integer|min:1',
            'extraDiscount' => 'required|numeric',
            'grandtotal' => 'required|numeric',
            'payment_mode' => 'required|string',
            // Add other validation rules for client details
        ]);
    
        // Retrieve the client
        $client = Client::find($request->client_id);
    
        // Check if the client exists
        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found. Please select a valid client.'
            ], 404);
        }
    
        // Create the order
        $order = new Order();
        $order->client_id = $client->id;
        $order->discount = $request->totalDiscount;
        $order->total_tax = $request->totalTax;
        $order->discount = $request->totalDiscount;
        $order->grand_total = $request->grandtotal;
        $order->subtotal = $request->subtotal;
    
        // Assign client details to order
        $order->first_name = $client->name;
        $order->email = $client->email;
        $order->mobile = $client->phone_number;
        $order->address = $client->address;
        $order->city = $client->city;
        $order->zip = $client->zip;
    
        // Save the order
        $order->save();
    
        // Loop through selected products
        foreach ($request->selectedProduct as $index => $productId) {
            $quantity = $request->new_Qty[$index];
            $product = Product::find($productId);
    
            // Calculate total amount for the product
            $amountBeforeDiscount = ($product->price * $quantity);
            $discountedAmount = $amountBeforeDiscount - ($amountBeforeDiscount * ($request->extraDiscount / 100));
    
            // Create and save order item
            $orderItem = new Order_Item();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productId;
            $orderItem->name = $product->title;
            $orderItem->qty = $quantity;
            $orderItem->discount = $request->extraDiscount;
            $orderItem->price = $product->price;
            $orderItem->total = $discountedAmount;
            $orderItem->save();
        }
    
        // Attach agent to the order
        $agent = Agent::find($request->agent_id);
        if ($agent) {
            $order->agents()->attach($agent->id, [
                'status' => 'approved',
                'commission_amount' => $order->grand_total * 0.02, // Calculate commission amount (2% of grand total)
            ]);
        }

        return redirect()->route('getBill');
        // } catch (\Exception $e) {
        //     // Log the exception
        // Log::error('Error saving order: ' . $e->getMessage());

        //     // Return an error response
        //     return response()->json(['message' => 'An error occurred while processing the order.'], 500);
        // }
        // Your current code here


    }
    //     


    public function getBill()
    {
        // Retrieve the latest order along with its associated items
        $latestOrder = Order::with('items')->latest()->first();

        // Ensure that an order exists
        if ($latestOrder) {
            // Retrieve the order data
            $order = $latestOrder->toArray();

            // Retrieve the order items associated with the order
            $orderItems = $latestOrder->items->toArray();
        } else {
            // If no order exists, set empty arrays
            $order = [];
            $orderItems = [];
        }

        // Combine order data and order items data into a single variable
        $orderData = [
            'order' => $order,
            'orderItems' => $orderItems,
        ];


        // Pass the combined data to the view
        return view('admin.invoice.invoiceBill', compact('orderData'));
    }



    public function  viewPDF()
    {
        $latestOrder = Order::with('items')->latest()->first();

        // Ensure that an order exists
        if ($latestOrder) {
            // Retrieve the order data
            $order = $latestOrder->toArray();

            // Retrieve the order items associated with the order
            $orderItems = $latestOrder->items->toArray();
        } else {
            // If no order exists, set empty arrays
            $order = [];
            $orderItems = [];
        }

        // Combine order data and order items data into a single variable
        $orderData = [
            'order' => $order,
            'orderItems' => $orderItems,
        ];

        $pdf = PDF::loadView('admin.pdf.pdfview', compact('orderData'))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function downloadPDF(){
        $latestOrder = Order::with('items')->latest()->first();

        // Ensure that an order exists
        if ($latestOrder) {
            // Retrieve the order data
            $order = $latestOrder->toArray();

            // Retrieve the order items associated with the order
            $orderItems = $latestOrder->items->toArray();
        } else {
            // If no order exists, set empty arrays
            $order = [];
            $orderItems = [];
        }

        // Combine order data and order items data into a single variable
        $orderData = [
            'order' => $order,
            'orderItems' => $orderItems,
        ];
        $pdf = PDF::loadView('admin.pdf.pdfview', compact('orderData'))->setPaper('a4', 'portrait');
         
        return $pdf->download('admin.pdf.pdfview');

    }




}
