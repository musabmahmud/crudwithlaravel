<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class ProductController extends Controller
{
    function products(){
        // $cats = Category::OrderBy('category_name', 'Asc')->paginate(10);
        return view('backend.product.view_product');
    }
    function addproducts(){
        // $cats = Category::OrderBy('category_name', 'Asc')->paginate(10);
        return view('backend.product.add_product',[
            'categories' => Category::orderBy('category_name','Asc')->get(),
            'subcategories' => SubCategory::orderBy('subcategory_name','Asc')->get(),
        ]);
    }
    function postproducts(Request $request){

        $request->validate([
            'title' => ['required','min:3','unique:title'],
            'slug' => ['required'],
            'category_id' => ['required'],
        ]);
    }
}
