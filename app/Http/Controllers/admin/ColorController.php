<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'color' => 'required|string|max:7' // Assuming color code is a string of max length 7 (e.g., #RRGGBB)
        ]);

        // Create a new color record
        $color = new Color();
        $color->code = $request->color; // Save the color code from the request
        $color->save();

        // return response()->json(['message' => 'Color saved successfully']);
    }
}
