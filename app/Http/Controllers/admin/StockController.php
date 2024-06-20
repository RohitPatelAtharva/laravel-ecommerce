<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function create(){

        $product = Product::select('title')->get();

        return view('admin.stock.create',compact('product'));
    }
    public function store(Request $request){
        // dd($request);



        $validator = [

            'name' => 'required',
            'mrp' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'alert_stock'=>'required|numeric',






        ];

        if ($validator){
            $product = new Stock();
            $product->name=$request->name;
            $product->mrp = $request->mrp;
            $product->selling_price=$request->selling_price;
            $product->sku=$request->sku;
            $product->barcode=$request->barcode;
            $product->alert_stock=$request->alert_stock;
            $product->track_qty = $request->has('track_qty') ? 'Yes' : 'No';
            $product->qty=$request->qty;
            // dd($product);
            $product->save();

            return redirect()->route('stock.create')->with('success', '  Stock added successfully');

     }else {

        return redirect()->route('stock.create')->withErrors($validator)->withInput($request->only('name'));

    }
  }
}
