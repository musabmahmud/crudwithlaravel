<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Color;


class ColorController extends Controller
{
    function addcolor(){
        return view('backend.colors.add_color');
    }
    function viewcolor(){
        return view('backend.colors.color_view',[
            'colors' => Color::paginate(10)
        ]);
    }
    function postcolor(Request $request){
        $request->validate([
            'color_name' => ['required','min:3','unique:colors'],
            'slug' => ['required','unique:colors'],
        ]);
        $color = new Color;
        $color->color_name = $request->color_name;
        $color->slug = Str::slug($request->slug);
        $color->save();
        return redirect('view-color')->with('success','Data Successfully Inserted.');
    }
}
