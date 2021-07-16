<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    function subcategory(){
        return view('backend.subcategory.subcategory_view',[
            'subcats' => SubCategory::paginate(10)
        ]);
    }
    function addsubcategory(){
        return view('backend.subcategory.subcategory_add',[
            'categories' => Category::orderBy('category_name','Asc')->get()
        ]);
    }
    function postsubcategory(Request $request){
        $request->validate([
            'subcategory_name' => ['required','min:3','unique:sub_categories'],
            'slug' => ['required','unique:sub_categories'],
            'category_id' => ['required','min:1'],
        ]);
        $scat = new SubCategory;
        $scat->subcategory_name = $request->subcategory_name;
        $scat->slug = Str::slug($request->slug);
        $scat->category_id = $request->category_id;
        $scat->save();
        return back()->with('success','Data Successfully Inserted.');
    }
    
    function allsubcategorydelete(Request $request){
    
        foreach($request->delete as $delete){
            SubCategory::findOrFail($delete)->delete();
        }
        return back()->with('success','Data Delete Successfully.');
    }
    
    function trashedsubcategory(){
        return view('backend.subcategory.subcategory_trashed',[
            'subcats' => SubCategory::onlyTrashed()->paginate(10)
        ]);
    }
}
