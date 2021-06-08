<?php

function cart_total_products(){
    return App\Models\Cart::where('ip_address',request()->ip())->count();
}

function cart_products(){
    return App\Models\Cart::where('ip_address',request()->ip())->get();
}

function cart_subtotal(){
    $sub_total=0;
    foreach(cart_products() as $cart_product){
        $sub_total+=$cart_product->relationtoproduct->product_price * $cart_product->amount;

    }
    return $sub_total;
}