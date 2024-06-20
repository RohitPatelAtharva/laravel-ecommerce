<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::paginate(10);
        
        return view('admin.section.list', compact('sections'));
    }
    public function create()
    {
        return view('admin.section.create');
    }
   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:20',
            'slug' => 'required|unique:sections,slug',
            'max_quantity' => 'required|numeric|max:10',
            'status' => 'required'
        ]);
        
    
        if ($validator->passes()) {
            $section = new Section();
            $section->title = $request->title;
            $section->slug = Str::slug($request->slug);
            $section->description = $request->description; // Assign description from request
            $section->max_quantity = $request->max_quantity; // Assign max_quantity from request
            $section->status = $request->status;
            $section->save();
            
            // Redirect to the appropriate route after saving the section
            return redirect()->route('sections.create')->with('success', 'Section added successfully');
        } else {
            return redirect()->route('sections.create')->withErrors($validator)->withInput($request->only('title', 'slug', 'description', 'max_quantity', 'status'));
        }
    }
    public function edit(Section $slug)
    {
        return view('admin.section.edit', compact('slug'));
    }
    public function destroy($id)
    {
        $page=Section::find($id);
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
