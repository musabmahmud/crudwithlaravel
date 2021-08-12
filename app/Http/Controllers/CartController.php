<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Attribute;

class CartController extends Controller
{
    function CartPage()
    {
        $cookie = Cookie::get('generate_id');
        $carts =  Cart::Where('cookie_id', $cookie)->get();
        return view('frontend.pages.cart', compact('carts'));
    }
    function CartDetails(Request $request)
    {
        $request->validate([
            'color_id' => ['required'],
            'color_id.*' => ['required'],

            'size_id' => ['required'],
            'size_id.*' => ['required'],
        ]);
        if ($request->hasCookie('generate_id')) {
            $generate_id = $request->cookie('generate_id');
        }else {
            $generate_id = Cookie::queue('generate_id', Str::random(10), 43200);
        }
        if (Cart::where('cookie_id', $generate_id)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            return back()->with('error','Product already Added');
        }else {
            $cart = new Cart();
            $cart->cookie_id = $generate_id;
            $cart->product_id = $request->product_id;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return back()->with('success','Added To Cart');
        }
    }
    function cartremove($id){
        Cart::findOrFail($id)->delete();
        return back()->with('success','Remove Product Successfully From Cart');
    }
    function cartupdate(Request $request){
        foreach($request->cart_id as $key => $cart_id){
            $cart = Cart::findOrFail($cart_id);
            if($cart->quantity != $request->quantity[$key]){
                $cart->quantity = $request->quantity[$key];
                $cart->save();
            }
        }
        return back();
    }
}
