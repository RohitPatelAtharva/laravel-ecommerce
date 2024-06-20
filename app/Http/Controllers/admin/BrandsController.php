<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    public function index(){
        $brand = Brand::latest()->paginate(6);
        $data['categories']=$brand;
        // dd($categories);
           return view('admin.brands.list',compact('brand'));

     }

     public function create(){
        return view('admin.brands.create');
     }

     public function store(Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'status'=>'required',
            'slug' => 'required|unique:brands'


        ]);
        if ($validator){
            $brand = new Brand();

            $brand->name = $request->name;

            $brand->slug = Str::slug($request->slug);
            // dd($brand);

            $brand->status=$request->status;

            $brand->save();

            return redirect()->route('brands.create')->with('success', '  Brand added successfully');

     }else {
        return redirect()->route('brands.create')->withErrors($validator)->withInput($request->only('name'));
    }
}

public function destroy($id)
{
    $page=Brand::find($id);
    if($page == null){
        session()->flash('error','Page not found');
        return response()->json([
            'status'=>true,
        ]);
    }
   $page->delete();
   $message = "Page deleted successfully";
   session()->flash('success',$message);
   return response()->json([
    'status'=>true,
    'message'=>$message,
]);

}
}
