<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cupon;
use Carbon\Carbon;



class CartController extends Controller
{
    public function addtocart(Request $request){
       
        if(Cart::where('ip_address',$request->ip())->where('product_id',$request->product_id)->exists()){
            Cart::where('ip_address',$request->ip())->where('product_id',$request->product_id)->increment('amount',$request->amount);
        }
        else{
            Cart::insert([
                'ip_address'=>$request->ip(),
                'product_id'=>$request->product_id,
                'amount'=>$request->amount,
                'created_at'=>Carbon::now(),
            ]);
        }

       

        return back();
    }
    public function deletefromcart($cart_id){
        Cart::find($cart_id)->delete();

        return back();

    }
    public function cart($cupon_name=""){
        $cupon_name=strtoupper($cupon_name);

      if($cupon_name){
        if(Cupon::where('cupon_name',$cupon_name)->exists()){
            if(Cupon::where('cupon_name',$cupon_name)->first()->validity >= Carbon::now()->format('Y-m-d')){
                $discount = Cupon::where('cupon_name',$cupon_name)->first()->discount;

                return view('frontend.cart',[
                    'discount'=>$discount,
                    'cupon_name'=>Cupon::where('cupon_name',$cupon_name)->first()->cupon_name,
                ]);
            }
            else{
                
                return back()->withErrors('Validity date is over');
            }
        }
        else{
            return back()->withErrors('Invalid cupon');
           
        }
      }
      else{
        return view('frontend.cart');
      }
       
      

    }
 

    public function updatecart(Request $request){
        foreach($request->cart_id as $key=>$id){
            Cart::find($id)->update([
                'amount'=>$request->cart_amount[$key]
            ]);
        }
        return back();
    }
}
