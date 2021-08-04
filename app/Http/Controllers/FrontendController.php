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
}
