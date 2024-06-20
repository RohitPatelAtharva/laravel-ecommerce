<?php

namespace App\Http\Controllers\admin;
use App\Models\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function addTag(Request $request)
    {
        $tagName = $request->input('name');

        // Check if the tag already exists in the database
        $tag = Tag::where('name', $tagName)->first();

        if (!$tag) {
            // If the tag doesn't exist, create a new one
            $tag = Tag::create([
                'name' => $tagName,
            ]);
        }

        // You can return any response you want here
        return response()->json(['tag' => $tag], 201);
    }
}
