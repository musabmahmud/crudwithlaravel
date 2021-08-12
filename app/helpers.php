<?php 
    function cart_price($cart){
       return App\Models\Attribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->sale_price;
    }
    function cart_amount(){
        $cookie = Illuminate\Support\Facades\Cookie::get('generate_id');
        $carts_amount = App\Models\Cart::Where('cookie_id',$cookie)->count();
        return $carts_amount;
    }
    function cart_product(){
        $cookie = Illuminate\Support\Facades\Cookie::get('generate_id');
        $carts_products =  App\Models\Cart::Where('cookie_id',$cookie)->get();
        return $carts_products;
    }
?>