<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;
use App\Models\TopSection;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_tag;
use Illuminate\Http\Request;

class TopSectionController extends Controller
{

    public function index()
    {
        $topsections = TopSection::select('top_sections.*', 'tags.name as tag_name')

            ->leftJoin('tags', 'tags.id', '=', 'top_sections.tag')
            ->paginate(10);




        return view('admin.section.child_section.list', compact('topsections'));
    }
    public function create()
    {
        $getsection = Section::get();

        return view('admin.section.child_section.create', compact('getsection'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'section_id' => 'required',
            // Add validation rules for other fields
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store the top section in the database
        $topSection = new TopSection();
        $topSection->section_id = $request->section_id;
        $topSection->title = $request->title;
        $topSection->description = $request->description;
        $topSection->discount = $request->discount;
        $topSection->image_url = $request->image_url;

        // Set other fields as needed
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . "." . $extention;
            $file->move(public_path('admin-assets/products_img/'), $filename);
            $topSection->image = $filename;
        }
        $topSection->tag = implode(',', $request->related_tags);
        $topSection->select=$request->select;
        $topSection->related=$request->related;


        $topSection->image_alt_text = $request->image_text;
        // dd($topSection);
        $topSection->save();


        return redirect()->route('topsection.create')->with('success', 'Top section created successfully');
    }
    public function destroy($id)
    {
        // Find the section by ID
        $topsection = TopSection::find($id);

        // Check if the section exists
        if (!$topsection) {
            return redirect()->route('Topsections.index')->with('error', 'Section not found.');
        }

        // Delete the section
        $topsection->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('Topsections.index')->with('success', 'Section deleted successfully');
    }
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories]);
    }
    public function getProducts()
    {
        $products = Product::all();

        return response()->json(['products' => $products]);
    }

    public function getTags()
    {
        $tags = Tag::all();

        return response()->json(['tags' => $tags]);
    }
}
