@extends('layouts.frontend')


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
                    <form action="{{url('update/cart')}}" method="post">
                    @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach(cart_products() as $cart_product)

                           
                                <tr>
                                    <input type="hidden" value="{{$cart_product->id}}" name="cart_id[]" />

                                    <td class="images"><img src="{{asset('uploads/product_thumbnails')}}/{{$cart_product->relationtoproduct->product_thumbnail_photo}}" alt=" {{$cart_product->relationtoproduct->product_thumbnail_photo}}"></td>
                                    <td class="product"><a href="{{url('product')}}/{{$cart_product->relationtoproduct->product_slug}}" target="_blank">{{$cart_product->relationtoproduct->product_name}}</a></td>
                                    <td class="price">${{$cart_product->relationtoproduct->product_price}}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{$cart_product->amount}}" name="cart_amount[]" />
                                    </td>
                                    <td class="total">${{$cart_product->relationtoproduct->product_price * $cart_product->amount}}</td>
                                    <td class="remove"><a href="{{url('delete/from/cart')}}/{{$cart_product->id}}"><i class="fa fa-times"></i></a></td>
                                </tr>
                            @endforeach
                               
                            </tbody>
                        </table>
                        
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                        
                                        <li><a href="{{url('/')}}">Continue Shopping</a></li>
                                    </ul>
                                    </form>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div>
                                        <input type="text" value="@isset($cupon_name){{$cupon_name}}@endisset" placeholder="Cupon Code" style="padding:4px;margin:1px;" id="cupon-code">
                                        
                                        <!-- problem hoise value nia -->
                                        <a class="btn btn-danger" id="apply-cupon" style="padding:8px;">Apply Cupon</a>

                                    </div><br>
                                    @if($errors->all())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{cart_subtotal()}}</li>
                                        @isset($discount)
                                        <li><span class="pull-left"> Discount </span> {{ $discount }}%</li>
                                        @endisset
                                        <li><span class="pull-left"> Total </span> $380.00</li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection


@section('footer_scripts')
<script>
        $(document).ready(function(){
            $('#apply-cupon').click(function(){
                
                var cupon_code = $('#cupon-code').val();
                var link = "{{url('cart')}}/" + cupon_code;

                window.location.href=link;
                
        });
            
        });
</script>
@endsection