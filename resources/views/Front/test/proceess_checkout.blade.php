public function processCheckout(Request $request)
{
    ##########apply validator###
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|min:5',
        'last_name' => 'required',
        'email' => 'required|email',
        'country' => 'required',
        'address' => 'required|min: 30',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'mobile' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'massage' => ' Please fix the errors',
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    //   save  details
    $userId = Auth::user();

    Customer_addresses::updateOrCreate(
        ['user_id' => $userId->id],
        [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'countries_id' => $request->country,
            'address' => $request->address,
            'apartment' => $request->appartment,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,

        ]
    );

    //store data in order table

    if ($request->payment_method == 'cod') {
        $userId = Auth::id();

        // Calculate Subtotal
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();


        $subtotal = 0;



        // Shipping Cost
        $shippingCost = 20;

        $itemm = [];
        foreach ($cartItems as $item) {
            // Calculate subtotal
            $subtotal += $item->product->price * $item->quantity;

            // Create a new Order_item
            $orderItem = new Order_item();
            $orderItem->order_id = NULL; // This should be set to the actual order ID when available
            $orderItem->product_id = $item->product_id; // Corrected 'id' to 'product_id'
            $orderItem->name = $item->product->title; // Assuming the product has a 'title' attribute
            $orderItem->qty = $item->quantity;
            $orderItem->price = $item->product->price;
            $orderItem->total = $item->product->price * $item->quantity;
            $orderItem->save();

            ##########update product stock#############

            // Find the product data
            $productData = Product::find($item->product_id); // Corrected $item->id to $item->product_id

            // Check if the product data is found and it tracks quantity
            if ($productData !== null && $productData->track_qty == 'Yes') {
                $currentQty = $productData->qty;
                $updateQty = $currentQty - $item->quantity; // Corrected quantity update logic
                $productData->qty = $updateQty;
                $productData->save();
            } else {
            }

            // Collect order item IDs
            $itemm[] = $orderItem->id;
        }

        

    }
    $grandtotal = $subtotal + $shippingCost;
    // Create Order
    $order = new Order();
    $order->subtotal = $subtotal;
    $order->shipping = $shippingCost;
    $order->grand_total = $grandtotal;
    $order->payment_status = 'not paid';
    $order->status = 'pending';

    $order->user_id = $userId;
    $order->first_name = $request->first_name;
    $order->last_name = $request->last_name;
    $order->email = $request->email;
    $order->mobile = $request->mobile;
    $order->address = $request->address;
    $order->apartment = $request->apartment; // Corrected 'appartment' typo
    $order->state = $request->state;
    $order->city = $request->city;
    $order->zip = $request->zip;
    $order->note = $request->note;
    $order->countries_id = $request->country;
    $order->save();


    // Create Order Items

    Order_item::whereIn('id', $itemm)->update(["order_id" => $order->id]);
    // Clear Cart
    // Assuming you have a method to clear the cart, you can call it here
    Cart::where('user_id', $userId)->delete();
    // Flash success message
    session()->flash('success', 'You have successfully placed your order');
    orderEmail($userId->id);
    // Return JSON response with order details

    return response()->json([
        'message' => 'Order saved successfully',
        'orderId' => $order->id,
        'status' => true,
    ]);
}
