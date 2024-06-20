<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Client;
use App\Models\Customer_addresses;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BillingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'b_name' => 'required',
            'b_email' => 'required|email',
            'b_phone' => 'required|numeric',
            's_name' => 'required',
            's_phone' => 'required|numeric', // Assuming s_phone should also be numeric
            's_email' => 'required|email', // Assuming s_email should also be an email
        ]);
    
        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Create a new client record
        $client = Client::create([
            'name' => $request->b_name,
            'email' => $request->b_email,
            'phone_number' => $request->b_phone,
            'address' => $request->b_address,
            'city' => $request->b_city,
            'zip' => $request->b_zip,
            'company' => $request->b_company,

            
        ]);
      
    
        // Create a new customer address record for billing address
        
    
        // Create a new customer address record for shipping address
        Customer_addresses::create([
            'user_id' => $client->id, // Use the client's id as the user_id
            'address_type' => 'shipping',
            'first_name' => $request->s_name,
            'email' => $request->s_email,
            'mobile' => $request->s_phone,
            'address' => $request->s_address,
            'city' => $request->s_city,
            'country' => $request->s_country,
            'zip' => $request->s_zip,
            'state' => $request->s_zip, // Is 'state' supposed to be the same as 'zip'?
            'company' => $request->s_company,
        ]);
    
        // Return success response
        $message = "Addresses saved successfully";
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function search(Request $request)
{
    $name = $request->input('term');

    // Perform the search based on the name field
    $billingAddresses = Client::where('name', 'like', '%'.$name.'%')->get();

    return response()->json($billingAddresses);
}




public function getsearch(Request $request){
    $term = $request->input('term');

    // Perform the search based on the first_name and id fields and include order items
    $billingAddresses = Order::with('items')
                             ->where(function ($query) use ($term) {
                                 $query->where('first_name', 'like', '%' . $term . '%')
                                       ->orWhere('id', 'like', '%' . $term . '%');
                             })
                             ->whereNotNull('client_id')
                             ->get();

    return response()->json($billingAddresses);
}


















################test

public function bill(){
    return view("admin.pdf.pdfview");
}
}
 
