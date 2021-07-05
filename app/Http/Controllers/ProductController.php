<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function products(){
        // $cats = Category::OrderBy('category_name', 'Asc')->paginate(10);
        return view('backend.product.view_product');
    }
}
