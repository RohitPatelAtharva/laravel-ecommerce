<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::latest();

        if ($request->keyword != '') {
            $pages = $pages->where('name', 'like', '%' . $request->keyword . '%');
        }
        $pages = $pages->paginate();
        return view('admin.pages.list', ['pages' => $pages]);
    }
    public function create()
    {
        return view('admin.pages.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $page = new Page();
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();
        $message = "Page added successfully";
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
    public function edit($id)
    {
        $page = Page::find($id);
        if ($page == null) {
            session()->flash('error', 'Pages not Found');
            return redirect()->route('pages.index');
        }
        return view('admin.pages.edit', compact('page'));
    }
    public function update(Request $request, $id)
    {
        // Find the page by ID
        $page = Page::find($id);
        if ($page == null) {
            session()->flash('error', 'Page not found');
            return response()->json([
                'status' => false,
                'message' => 'Page not found'
            ]);
        }
    
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Update the page with new data
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();
    
        // Flash a success message and return a JSON response
        $message = "Page updated successfully";
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
    
    public function destroy($id)
    {
        $page=Page::find($id);
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
