public function search(Request $request)
{
    $term = $request->input('term');

    // Perform the search based on the first_name and id fields and include order items
    $billingAddresses = Order::with('items')
                             ->where('first_name', 'like', '%' . $term . '%')
                             ->orWhere('id', 'like', '%' . $term . '%')
                             ->get();
    
    // Append the client_id to each order object
    $billingAddresses->each(function ($order) {
        $order->client_id = $order->id;
    });

    return response()->json($billingAddresses);
}
