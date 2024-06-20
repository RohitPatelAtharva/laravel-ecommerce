<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\OrderReturn;
use App\Models\OrderReturnMain;
use Illuminate\Http\Request;

class OrderReturmController extends Controller
{
    public function returnOrder(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $orderItems = Order_item::where('order_id', $orderId)->get();

        // Calculate the amounts for each order item
        foreach ($orderItems as $item) {
            $amountBeforeDiscount = (($item->price * $item->qty) + ($item->price * $item->qty) * 0.18); // 19% tax
            $discountAmount = ($amountBeforeDiscount * $item->discount) / 100;
            $discountedAmount = $amountBeforeDiscount - $discountAmount;
            $totalAmount = round($discountedAmount, 2);

            // Add calculated amounts to the item object
            $item->amountBeforeDiscount = $amountBeforeDiscount;
            $item->discountAmount = $discountAmount;
            $item->totalAmount = $totalAmount;
        }

        return view('admin.invoice.returnorder.invoiceReturn', compact('order', 'orderItems'));
    }
    public function storeReturnOrder(Request $request)
    {
        // Retrieve the order
        $order = Order::findOrFail($request->order_id);
    
        // Check if a return order already exists for this order
        $return = OrderReturnMain::where('order_id', $order->id)->first();
    
        if ($return) {
            // Update the existing return order
            $return->update([
                'client_id' => $order->client_id,
                'total_tax' => $request->totalTax,
                'total_discount' => $request->totalDiscount,
                'subtotal' => $request->subtotal,
                'grand_total' => $request->grandTotal,
                'status' => 'Return'
            ]);
        } else {
            // Create a new return order
            $return = OrderReturnMain::create([
                'order_id' => $order->id,
                'client_id' => $order->client_id,
                'total_tax' => $request->totalTax,
                'total_discount' => $request->totalDiscount,
                'subtotal' => $request->subtotal,
                'grand_total' => $request->grandTotal,
                'status' => 'Return'
            ]);
        }
    
        // Save order return items
        foreach ($request->items as $itemData) {
            $product_id = isset($itemData['product_id']) ? $itemData['product_id'] : null;
            OrderReturn::updateOrCreate(
                ['order_id' => $order->id, 'product_id' => $product_id],
                [
                    'return_id' => $return->id,
                    'item_name' => $itemData['item_name'],
                    'quantity' => $itemData['quantity'],
                    'rate' => $itemData['rate'],
                    'discount' => $itemData['discount'],
                    'amount' => $itemData['amount'],
                    // 'reason' => $itemData['reason'],
                    // 'remark' => $itemData['remark'],
                ]
            );
        }
    
        // Redirect or return response
        return redirect()->route('return.invoice.bill', $order->id)->with('success', 'Order return has been processed successfully.');
    }

    public function return_invoice(Request $request) {
        // Retrieve the order details
        $order = Order::findOrFail($request->order_id);
        
        // Retrieve the order return details
        $orderReturn = OrderReturnMain::where('order_id', $request->order_id)->first();
        
        // Retrieve the items associated with the return order
        $returnItems = OrderReturn::where('return_id', $orderReturn->id)->get();
        
        // Retrieve the client details
        $client = Client::findOrFail($orderReturn->client_id);

        // dd($orderReturn,$returnItems,$client);
        
        return view('admin.invoice.returnorder.invoicepage', [
            'order' => $order,
            'orderReturn' => $orderReturn,
            'returnItems' => $returnItems,
            'client' => $client,
        ]);
    }
}
