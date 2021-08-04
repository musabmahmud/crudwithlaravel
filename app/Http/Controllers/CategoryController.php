<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    

    function category(){
        $cats = Category::OrderBy('category_name', 'Asc')->paginate(10);
        return view('backend.category.category_view',compact('cats'));
    }
    function addcategory(){
        return view('backend.category.category_add');
    }

    function postcategory(Request $request){
        $request->validate([
            'category_name' => ['required','min:3','max:10','unique:categories'],
            'slug' => ['required','unique:categories'],
        ]);

        $cat = new Category;
        $cat->category_name = $request->category_name;

        $cat->slug = Str::slug($request->slug);
        $cat->save();
        return back()->with('success','Data Successfully Inserted.');
    }
    

    function deletecategory($data){
        $cat = Category::findOrFail($data);
        if($cat->subcategory->count() == 0){
            Category::findOrFail($data)->delete();
            return back()->with('success','Category Trashed Successfully');
        }
        else{
            return back()->with('error','Category has Sub Category');
        }
        
    }
    
    function editcategory($data){
        return view('backend.category.category_edit',[
            'cat' => Category::findOrFail($data)
        ]);
    }

    
    function updatecategory(Request $request){
        $cat = Category::findOrFail($request->cat_id);
        $cat->category_name = $request->category_name;

        $cat->slug = Str::slug($request->category_name);
        $cat->save();
        return back()->with('success','Category Updated Successfully');
    }
    function trashedcategory(){
        return view('backend.category.category_trashed',[
            'categories' => Category::onlyTrashed()->paginate(10)
        ]);
    }
    function restorecategory($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Category Restored Successfully');
    }

    // function permanentcategory($id){
    //     Category::onlyTrashed()->findOrFail($id)->forceDelete();
    //     return back()->with('success','Category Permanently Deleted Successfully');
    // }
    
    // function permanentcategory($id){
    //     Category::onlyTrashed()->findOrFail($id)->forceDelete();
    //     return back()->with('success','Category Permanently Delete Successfully');
    // }
}
