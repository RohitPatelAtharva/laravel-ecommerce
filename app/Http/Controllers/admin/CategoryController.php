<?php

namespace App\Http\Controllers\admin;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index(){
        $categories=Category::latest()->paginate(6);
        // dd($categories);
           return view('admin.category.list',compact('categories'));

     }

     public function create(){
        return view('admin.category.create');

     }

     public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories'

        ]);
        if ($validator->passes()){
            $product = new Category();

             $product->name=$request->name;

             $product->slug = Str::slug($request->slug);
            //  if($request->hasfile('image'))
            //  {
            //        $file=$request->file('image');
            //        $extention = $file->getClientOriginalExtension();
            //        $filename = time().".".$extention;
            //        $file->move(public_path('admin-assets/images/'),$filename);
            //        $product->image = $filename;

            //  }

             $product->status=$request->status;
             $product->showhome=$request->showhome;









             if(!empty($request->image_id)){
               

                $tempImage=TempImage::find($request->image_id);
                $extArray=explode('.',$tempImage->name);
                 
                $ext =last($extArray);
                $newImageName=$product->id.'_';
                
                $sPath=public_path().'/temp/'.$tempImage->name;
              
                $dPath=public_path().'/uploads/category/'.$newImageName.$tempImage->name;
                File::move($sPath,$dPath);
                $product->image=$newImageName;
             }
        // dd($product);
              $product->save();

             return redirect()->route('categories.create')->with('success', ' Category added successfully');

             ;


        }else{
            return redirect()->route('categories.create')->withErrors($validator)->withInput($request->only('name'));
        }



     }


     public function edit($id,Request $request){
        $category=Category::Find($id);
        if(!empty($categories)){
        return redirect()->route('categories.index');
        }
        return view('admin.category.edit',compact('category'));
     }

     public function destroy($id)
     {
         $page=Category::find($id);
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
