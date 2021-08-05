<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class FrontendController extends Controller
{ 
    function frontend(){
        return view('frontend.main',[
            'latests' => Product::latest()->limit(15)->get(),
        ]);
    }
    function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        $attribute = Attribute::where('product_id', $product->id)->get();
        $collection = collect($attribute)->groupBy('color_id');
        return view('frontend.pages.product-details',[
            'product' => $product,
            'groups' => $collection,
        ]);
    }
    function getSize($c_id,$p_id){
        $output = '';
        $sizes = Attribute::with(['product','color','size'])->where('product_id',$p_id)->where('color_id',$c_id)->get();
        foreach($sizes as $key => $size){
            $output = $output.'<input type="radio" data-quantity="'.$size->quantity.'" value="'.$size->id.'" data-price="'.$size->regular_price.'" name="size_id" id="size" class="sizecheck">
            <label for="size">'.$size->size->size_name.'</label> ';
        }
        return response()->json($output);
    }
}
