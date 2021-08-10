@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="total">Color</th>
                                    <th class="total">Size</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Add Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <td class="images"><img src="{{ asset('productImage/' . $cart->product->thumbnail) }}" alt="{{ $cart->product->title }}"></td>
                                    <td class="product"><a href="{{ url('product/'.$cart->product->slug)}}">{{ $cart->product->title }}</a></td>
                                    <td>{{ $cart->color->color_name }}</td>
                                    <td>{{ $cart->size->size_name}}</td>
                                    <td class="ptice">
                                        @php
                                            $price = App\Models\Attribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->sale_price;
                                        @endphp
                                        ${{ $price }}
                                    </td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{ $cart->quantity}}" />
                                    </td>
                                    <td class="total">${{ $cart->quantity * $price}}</td>
                                    <td class="remove"><i class="fa fa-times"></i></td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="shop.html">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code">
                                        <button>Apply Cupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>$380.00</li>
                                        <li><span class="pull-left"> Total </span> $380.00</li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection