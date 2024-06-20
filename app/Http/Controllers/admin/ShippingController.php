<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipping;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function create()
    {
        $countries = Country::get();

        $data['countries'] = $countries;
        $shippingCharges = ShippingCharge::select('shipping_charges.*', 'countries.name')->leftJoin('countries', 'countries.id', 'shipping_charges.countries_id')->get();
        $data['shippingCharges'] = $shippingCharges;



        return view('admin.shipping.create', $data);
    }

    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric'
        ]);
        if ($validator->passes()) {
            $count= ShippingCharge::where('countries_id',$request->country)->count();
            if($count >0){
                session()->flash('error', 'Shipping already added');
                return response()->json([
                    'status' => true,
                    
                ]);  
            }
            $shipping = new ShippingCharge();
            $shipping->countries_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'Shipping added successfully');

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
    public function edit($id)
    {
        $shippingCharge = ShippingCharge::find($id);
        $countries = Country::get();
        
        $data['countries'] = $countries;
        $data['shippingCharge'] = $shippingCharge;
        return view('admin.shipping.edit', $data);
    }
    public function update(Request $request ,$id){
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric'
        ]);
        if ($validator->passes()) {
            $shipping =ShippingCharge::find($id);
            $shipping->countries_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'Shipping update successfully');

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
    public function destroy($id){
        $shippingCharge = ShippingCharge::find($id);
        if($shippingCharge == null){
            session()->flash('error','Shipping not Found');
            return response()->json([
                'status' => true,
                
            ]);
        }
        $shippingCharge->delete();
         
        return response()->json([
            'status' => true,
            
        ]);
    }
}
