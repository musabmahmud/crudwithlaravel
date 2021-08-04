<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;

class SubCategoryController extends Controller
{
    function subcategory(){
        return view('backend.subcategory.subcategory_view',[
            'subcats' => SubCategory::with('category')->paginate(10)
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
    
    function deletesubcategory($sub_id){
        $scat = Product::where('subcategory_id', $sub_id);
        if($scat->count() == 0){
            SubCategory::findOrFail($sub_id)->delete();
            return back()->with('success','SubCategory Delete Successfully');
        }
        else{
            return redirect('sub-category')->with('error','Sub Category has Products');
        }
    }
    function allsubcategorydelete(Request $request){
    
        foreach($request->delete as $delete){
            $scat = Product::where('subcategory_id', $delete);
            if($scat->count() == 0){
                SubCategory::findOrFail($delete)->delete();
                return back()->with('success','All SubCategory Delete Successfully');
            }
            else{
                return redirect('sub-category')->with('error','Some Sub Category has Products');
            }
        }
    }
    
    function trashedsubcategory(){
        return view('backend.subcategory.subcategory_trashed',[
            'subcats' => SubCategory::onlyTrashed()->paginate(10)
        ]);
    }
}
