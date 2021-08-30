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
            <div class="row" id="coupon">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif
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
                                @php
                                    $subtotal = 0
                                @endphp
                                
                            <form action="{{route('cartupdate')}}" method="POST">
                                @csrf
                                @forelse ($carts as $cart)
                                <input type="hidden" name="cart_id[]" value="{{$cart->id}}">
                                <tr>
                                    <td class="images"><img src="{{ asset('productImage/' . $cart->product->thumbnail) }}" alt="{{ $cart->product->title }}"></td>
                                    <td class="product"><a href="{{ url('product/'.$cart->product->slug)}}">{{ $cart->product->title }}</a></td>
                                    <td>{{ $cart->color->color_name }}</td>
                                    <td>{{ $cart->size->size_name}}</td>
                                    <td class="ptice">
                                        @php
                                            $price = cart_price($cart) * $cart->quantity;
                                            $subtotal = $price + $subtotal;
                                        @endphp
                                        ${{ $price }}
                                    </td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" name="quantity[]" value="{{ $cart->quantity}}" />
                                    </td>
                                    <td class="total">${{ $cart->quantity * $price}}</td>
                                    <td class="remove"><a href="{{route('cartremove',$cart->id)}}"><i class="fa fa-times"></i></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50"><span class="alert">No Product Added to Cart</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                            </form>
                                        <li><a href="shop.html">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input id="coupon_name" @isset($coupon)
                                                value="{{$coupon->coupon_name}}"
                                            @endisset
                                        type="text" placeholder="Coupon Code">
                                        <button id="coupon_apply">Apply Coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        @if(isset($coupon))
                                            <li><span class="pull-left">Subtotal </span>${{ $subtotal }}</li>
                                            <li><span class="pull-left">Coupon Name</span><a href="{{url('cart')}}" class="discount">{{$coupon->coupon_name}} &#x2715;</a></li>
                                            <li><span class="pull-left">Discount ({{$coupon->coupon_amount}}%)</span>${{$discount = $coupon->coupon_amount * $subtotal/100}}</li>
                                            <li><span class="pull-left"> Total </span> ${{round($total = $subtotal - $discount)}}</li>
                                        @else
                                            <li><span class="pull-left">Subtotal </span>${{ $subtotal }}</li>
                                            <li><span class="pull-left"> Total </span> ${{$subtotal}}</li>
                                        @endif
                                    </ul>
                                    <a class="checkout" href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
@section('footer_js')
    <script>
        $(document).ready(function(){
            $('#coupon_apply').click(function(){
                var coupon_name = $('#coupon_name').val();
                var couponUrl = "{{ url('cart/coupon') }}/" + coupon_name;
                window.location.href = couponUrl;
            });
        });


    // $(document).ready(function(){
        
    //     $('#coupon_apply').click(function(){
    //         var coupon_name = $('#coupon_name').val();
    //         if(coupon_name){
    //             $.ajax({
    //                 type: "GET",
    //                 url: "{{ url('api/get-coupon-name') }}/" + coupon_name,
    //                 success: function(res) {
    //                     if (res) {
    //                         $("#discount_add").empty();
    //                         $("#discount_add").append('<span> (' + value.coupon_name +
    //                                 '%)' + value.coupon_name + '</span>');
    //                     }
    //                 }
    //             })
    //         }
    //     });
        
    // });
    </script>


@endsection