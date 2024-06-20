<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_tag;
use App\Models\ProductRating;
use App\Models\Tag;
use App\Models\Review;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];



        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands =   Brand::orderBy('name', 'ASC')->where('status', 1)->get();
        $products = Product::where('status', 1);
        ## apply filter here

        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }
        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('brand_id', $brandsArray);
        }
        if ($request->filled('price_max') && $request->filled('price_min')) {
            if ($request->input('price_max') == 1000) {
                $products = $products->whereBetween('price', [intval($request->input('price_min')), 100000]);
            } else {
                $products = $products->whereBetween('price', [intval($request->input('price_min')), intval($request->input('price_max'))]);
            }
        }
        // search
        if (!empty($request->get('search'))) {
            $searchTerm = $request->get('search');

            $products = $products->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('tags', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'latest') {
                $products = $products->orderBy('id', 'DESC');
            } elseif ($request->get('sort') == 'price_asc') {
                $products = $products->orderBy('price', 'ASC');
            } else {
                $products = $products->orderBy('price', 'DESC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }

        $products = $products->orderBy('price', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(6);
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['sort'] = $request->get('sort');
        return view('Front.shop', $data);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->withCount('product_ratings')
            ->withSum('product_ratings', 'rating')->with('product_ratings')->first();
        //  dd($product);
        if ($product == null) {
            abort(404);
        }
        $relatedProducts = [];
        $relatedProducts = Product::whereIn('id', Product_tag::whereIn('tag_id', Product_tag::where('product_id', $product->id)->pluck('tag_id')->toArray())->pluck('product_id')->toArray())->where('id', '!=', $product->id)->where('status', 1)->get();

        // rating calculate 

        // product rating count
        $avgRating = 0.00;
        $avgRatingPer = 0;
        if ($product->product_ratings_count > 0) {
            number_format(($avgRating = $product->product_ratings_sum_rating / $product->product_ratings_count), 2);
            $avgRatingPer = ($avgRating * 100) / 5;
        }


        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->get();
        }
        $data['avgRating'] = $avgRating;
        $data['avgRatingPer'] = $avgRatingPer;
        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;
        return view('Front.product', $data);
    }


    public function saveRating(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'comment' => 'required|min:10',
            'rating' => 'required|',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        $count = ProductRating::where('email', $request->email)->count(); // Count records with the same email

        if ($count > 0) {
            session()->flash('error', 'You have already rated this product.');
            return response()->json([
                'status' => true, // Indicate failure
                'message' => 'You have already rated this product.'
            ]);
        }

        $productRating = new ProductRating();
        $productRating->product_id = $id;
        $productRating->username = $request->name;
        $productRating->email = $request->email;
        $productRating->comment = $request->comment;
        $productRating->rating = $request->rating;
        $productRating->status = 0;
        $productRating->save();

        session()->flash('message', 'Thanks for your rating.');
        return response()->json([
            'status' => true,
            'message' => 'Thanks for your rating.'
        ]);
    }
}
    
        // public function show($id)
        // {
        //     $product = Product::findOrFail($id);
            
        //     $relatedProducts = $product->relatedProducts();
          
        //     return view('Front.product', compact('product', 'relatedProductsByTag'));
        // }
