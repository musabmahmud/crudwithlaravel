<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function products(){
        // $cats = Category::OrderBy('category_name', 'Asc')->paginate(10);
        return view('backend.product.view_product',[
            'products' => Product::latest()->paginate(20),
        ]);
    }
    function addproducts(){
        // $cats = Category::OrderBy('category_name', 'Asc')->paginate(10);
        return view('backend.product.add_product',[
            'categories' => Category::orderBy('category_name','Asc')->get(),
        ]);
    }

    function getsubcat($id){
       $subcategories = SubCategory::Where('category_id', $id)->get();
        return response()->json($subcategories);
    }

    function postproduct(Request $request){
        $request->validate([
            'title' => ['required','min:3'],
            'slug' => ['required'],
            'category_id' => ['required'],
            'thumbnail' => ['required'],
            'summary' => ['required'],
            'description' => ['required'],
        ]);
        
        $product = new Product();
        $product->title = $request->title;
        $product->slug = Str::slug($request->slug);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;

        $slug = Str::slug($request->slug);
        
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $ext = Str::random(5).'-'.$slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('productImage/'.$ext), 72);
            $product->thumbnail = $ext;
        }
        $product->save();
        return back()->with('success','Data Successfully Inserted.');
    }
    function deleteproduct($data){
        Product::findOrFail($data)->delete();
        return back()->with('success','Product Trashed Successfully');
    }

    function trashedproducts(){
        return view('backend.product.trash_products',[
            'products' => Product::onlyTrashed()->paginate(10)
        ]);
    }

    function recoverproducts($id){
        Product::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Product Restored Successfully');
    }

    function allproductsdelete(Request $request){
        $request->validate();
        foreach($request->delete as $delete){
            Product::findOrFail($delete)->delete();
        }
        return back()->with('success','All Data Delete Successfully.');
    }

    function editproducts($id){
        $product = Product::Where('id',$id)->first();
        return view('backend.product.edit_products',[
            'categories' => Category::orderBy('category_name','Asc')->get(),
            'products'  => $product,
            'scat' => SubCategory::Where('category_id', $product->category_id)->get(),
        ]);
    }
    function productupdate(Request $request){
        $product = Product::findOrFail($request->product_id);
        $product->title = $request->title;
        $product->slug = Str::slug($request->slug);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;

        $slug = Str::slug($request->slug);
        
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');

            $old_image = public_path('productImage/'.$product->thumbnail);
            if(file_exists($old_image)){
                unlink($old_image);
            }

            $ext = Str::random(5).'-'.$slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('productImage/'.$ext), 72);
            $product->thumbnail = $ext;
        }
        $product->save();
        
        return redirect('products')->with('success','Product Updated Successfully');
    }
}
