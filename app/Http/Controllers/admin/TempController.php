<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product_image;
use App\Models\TempImage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class TempController extends Controller
{
    public function create(Request $request){
        $image=$request->image;
        if (!empty($image)) {
            // $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $newName=time().'.'.$ext;

            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            // $imageName = $tempImage->id.'.'.$ext;

            // $tempImage->name = $imageName;
            $tempImage->save();

            $image->move(public_path().'/temp',$newName);

            // Create Thumbnail
            // $sourcePath = public_path('uploads/temp/'.$imageName);
            // $destPath = public_path('uploads/temp/thumb/'.$imageName);
            // $img = Image::make($sourcePath);
            // $img->fit(350,300);
            // $img->save($destPath);

            return response()->json([
                // dd('hello'),
                'status' => true,
                'image_id' =>$tempImage->id,
                // 'name' => $imageName,
                // 'imagePath' => asset('uploads/temp/thumb/'.$imageName)
                'message'=>'image uploded succesfully'
            ]);
        }
    }
}
