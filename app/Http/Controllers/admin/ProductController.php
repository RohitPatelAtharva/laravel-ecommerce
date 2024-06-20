<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_tag;
use App\Models\ProductRating;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->paginate(6);
        return view('admin.products.list', compact('products'));
    }

    public function create()
    {
        $data = [];
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['tags'] = Tag::get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.products.create', $data);
    }


    public function store(Request $request)

    {




        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:brands',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ]);




        $product = new Product();
        $product->title = $request->title;




        $product->slug = Str::slug($request->slug);

        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->shipping_returns = $request->shipping_returns;
        $product->price = $request->price / 83.36;
        $product->compare_price = $request->compare_price / 83.36;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->track_qty = $request->has('track_qty') ? 'Yes' : 'No';
        $product->qty = $request->qty;
        $product->status = $request->status;


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . "." . $extention;
            $file->move(public_path('admin-assets/products_img/'), $filename);
            $product->image = $filename;
        }

        $product->category_id = $request->category;
        // dd($product);
        $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->brand;
        $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
        $product->is_featured = $request->has('is_featured') ? 'Yes' : 'No';
        // dd($product);



        $product->save();
            foreach ($request->related_tags as $tag_id) {
                    $tag = new Product_tag();
                    $tag->product_id = $product->id;
                    $tag->tag_id = $tag_id;

                    $tag->save();

            }



        return redirect()->back()->with('success', 'Product saved successfully');


        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'error' => $validator->errors()
        //     ]);
    }

    public function edit($id, Request $request)
    {
        $product = Product::find($id);
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $relatedProducts = [];
        ##### fetch related product######
        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->get();
        }

        $data = [];
        $data['product'] = $product;
        $data['subCategories'] = $subCategories;
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $tagNames = Product_tag::where('product_id', $product->id)
        ->join('tags', 'product_tags.tag_id', '=', 'tags.id')
        ->pluck('tags.name')
        ->toArray();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['tagNames']=$tagNames;

        $data['relatedProducts'] = $relatedProducts;

        return view('admin.products.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:brands',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ]);

        //  dd($validator);

        //     if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
        //         $rules['qty'] = 'required|numeric';
        //     }


        // if ($validator->passes()) {


        $product = Product::where('id', $id)->first();
        $product->title = $request->title;




        $product->slug = Str::slug($request->slug);

        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->shipping_returns = $request->shipping_returns;
        $product->price = $request->price / 83.36;
        $product->compare_price = $request->compare_price / 83.36;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->track_qty = $request->has('track_qty') ? 'Yes' : 'No';
        $product->qty = $request->qty;
        $product->status = $request->status;


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . "." . $extention;
            $file->move(public_path('admin-assets/products_img/'), $filename);
            $product->image = $filename;
        }

        $product->category_id = $request->category;
        // dd($product);
        $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->brand;
        $product->is_featured = $request->has('is_featured') ? 'Yes' : 'No';
        $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
        // dd($product);


        $product->save();
        foreach ($request->related_tags as $tag_name) {
            // Find the tag by its name
            $tag = Tag::where('name', $tag_name)->first();

            // If the tag exists, save the product_tag relationship
            if ($tag) {
                $productTag = new Product_tag();
                $productTag->product_id = $product->id;
                $productTag->tag_id = $tag->id;
                $productTag->save();
            }
        }



        return redirect()->back()->with('success', 'Product updated ......... successfully');;
    }
    public function getProducts(Request $request)
    {
        $tempProduct = [];
        if ($request->term != "") {
            $products = Product::where('title', 'like', '%' . $request->term . '%')->get();

            if ($products != null) {
                foreach ($products as $product) {
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
                }
            }
        }
        return response()->json([
            'tags' => $tempProduct,
            'status' => true,
        ]);
    }
    public function getTags(Request $request)
    {
        // Initializing an empty array (not being used in this function)
        $tempProduct = [];

        // Retrieving tags based on the search term from the request
        $tags = Tag::where('name', 'like', '%' . $request->term . '%')->get();

        // Returning the tags in a JSON response
        return response()->json(['tags' => $tags]);
    }

    public function productRating(){
        $ratings = ProductRating::select('product_ratings.*', 'products.title as productTitle')
        ->leftJoin('products', 'products.id', '=', 'product_ratings.product_id')
        ->orderBy('product_ratings.created_at', 'DESC')
        ->paginate(10);
        return view('admin.products.ratings',compact('ratings'));
    }
    public function changeratingStatus(Request $request){
        $productRating=ProductRating::find($request->id);
        $productRating->status=$request->status;
        $productRating->save();

        session()->flash('success','status change successfully');
        return response()->json([
            'status'=>true,
        ]);
    }


    public function destroy($id)
    {
        $page=Product::find($id);
        if($page == null){
            session()->flash('error','products not found');
            return response()->json([
                'status'=>true,
            ]);
        }
       $page->delete();
       $message = "products deleted successfully";
       session()->flash('success',$message);
       return response()->json([
        'status'=>true,
        'message'=>$message,
    ]);

    }
}
