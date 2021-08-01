<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Size;

class SizeController extends Controller
{
    function addsize()
    {
        return view('backend.size.add_size');
    }
    function viewsize()
    {
        return view('backend.size.view_size', [
            'sizes' => Size::paginate(10)
        ]);
    }
    function postsize(Request $request)
    {
        $request->validate([
            'size_name' => ['required','unique:sizes'],
            'slug' => ['required', 'unique:sizes'],
        ]);
        $size = new Size;
        $size->size_name = $request->size_name;
        $size->slug = Str::slug($request->slug);
        $size->save();
        return redirect('view-size')->with('success', 'Data Successfully Inserted.');
    }
}
