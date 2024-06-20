<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{


    public function index()
    {
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
            ->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id');

        // dd($categories);

        $subCategories = $subCategories->paginate(5);

        return view('admin.sub_category.list', compact('subCategories'));
    }

    public function create()
    {

        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;

        // dd($categories);

        return view('admin.sub_category.create', $data);
    }


    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'stuts' => 'required'

        ]);

        if ($validator) {

            $product = new SubCategory();

            $product->category_id = $request->category_id;

            $product->name = $request->name;

            $product->slug = Str::slug($request->slug);

            $product->status = $request->status;
            $product->showhome = $request->showhome;

            // dd($product);

            $product->save();
            return redirect()->route('sub-category.create')->with('success', ' Sub_Category added successfully');
        } else {
            return redirect()->route('sub-category.create')->withErrors($validator)->withInput($request->only('name'));
        }
    }

    public function edit($id, Request $request)
{
     $subCategory=SubCategory::find($id);

     if (empty($subCategory)) {
        $request->session()->flash('error', 'Record Not Found');
        return redirect()->route('sub-categories.index');
    }
    $categories=Category::orderBy('name','ASC')->get();
    $data['categories']=$categories;
    $data['subCategory']=$subCategory;


    return view('admin.sub_category.edit', $data);
}
public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required ',
            'stuts' => 'required',
            'showhome' => 'required|in:Yes,No',

        ]);

        if ($validator->passes()){

        $subCategory = SubCategory::where('id',$id)->first();



        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;

        $subCategory->slug = Str::slug($request->slug);

        $subCategory->status = $request->status;
        $subCategory->showhome = $request->showhome;

            dd( $subCategory);
            $subCategory->save();

        return redirect()->route('sub-categories.index')->with('success', 'Sub-Category updated successfully');
    }
    
}
public function destroy($id)
{
    $page=SubCategory::find($id);
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
