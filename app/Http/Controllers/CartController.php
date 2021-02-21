<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Coupon;
use App\Order;
use Auth;


class CartController extends Controller
{
    public function __construct(){
       // $this->middleware('verified');
    }
    
    public function index(){
        $value = Cookie::get('cart');
        //dd($value);
        $items=[];
        $product=[];
        if($value!=null){
            // dd(Cart::where('cookie','=',$value)->take(1)->get());
             //if(count(Cart::where('cookie','=',$value)->take(1))>0){
                $items=Cart::where('cookie','=',$value)->orderBy('created_at','DESC')->get();
            //}
            //dd($product);
            //dd($items);
        }
        $similarprods=Product::inRandomOrder()->limit(4)->get();
        return view('cart')->with(['items'=>$items,'cart_no'=>count($items),'similar_prods'=>$similarprods]);
    
}

    public function addtocart(Request $request){
        $min=60*48*10;//20 days time
        $cart= new Cart;
        $cart->product_id=$request['id'];
        $cart->weight='1';
        $cart->quantity=$request['quantity'];
        

        $value = Cookie::get('cart');

        if($value!=null){
           // dd(Cart::where('cookie','=',$value)->take(1)->get());
            if(Cart::where('cookie','=',$value)->first()!=null){
                $cart->cookie=$value;
                //$check=Cart::where([['product_id','=',$cart->product_id],['cookie','=',$value]])->take(1)->get();
                //dd($check);
                // $check=5;
                // if($check){
                //     foreach($check as $chk){
                //     $cart= $chk;
                //     $cart->quantity+=$request['quantity'];
                //     $cart->save();
                //     return redirect('cart');
                //     } 
                // }
                // else{
                    $cart->save();
                    return redirect('cart')->cookie(
                        'cart', $value , $min
                    );;
                              
             }
            else{
                $rand=date('y-m-d-h-i-s_').Str::random('170');
                $n=1;
                $random=$rand;
                while(Cart::where('cookie','=',$random)->first()!=null){
                    $random=$rand.'-'.$n;
                    $n++;
                }
                $cart->cookie=$random;
                $cart->save();
                return redirect('cart')->cookie(
                    'cart', $rand , $min
                );
            }
        }
        else{
        $rand=date('y-m-d-h-i-s_').Str::random('170');
        //if(count(Cart::find($random));
        $cart->cookie=$rand;
        $cart->save();
        return redirect('cart')->cookie(
            'cart', $rand , $min
        );
        }
        

        
        //dd($value);

        

        
       // dd($cart);
    }
public function delete(Request $request){
    $id = $request['id'];
    $cart=Cart::find($id);
    if($cart!=null){
        $cart->delete();
        return redirect('cart');
    }
    return redirect('cart')->with('success','item removed from cart');
}
public function applycoupon(Request $request){
    $error=0;
    $code = $request['ccode']; 
    
    $coupon=Coupon::where('coupon_code',$code)->first();
    
    if(!$coupon)
        return redirect()->back()->with('error','coupon not found');
    if($coupon->time_based){
        //dd(strtotime($coupon->start_time));
        if($coupon->start_time){
            if(strtotime($coupon->start_time)<time()){
                //dd('ok');
            }
            else{
                $error=1;
                
            }
        }
        else {}

        if($coupon->end_time){
            if(strtotime($coupon->end_time)>time()){
               // dd('ok');
            }
            else{ $error=1; }
        }
        else {}
    }
    if($coupon->max_number_orders){
    $orders_with_code=Order::where('billing_discount_code',$coupon->coupon_code)->where('canceled','0')->where('verified','1')->count();
    if($orders_with_code >=$coupon->max_number_orders){
        $error=1;
    }
    }
    if($coupon->limit_per_customer && Auth::user()){
        $orders_by_cust=Order::where('billing_discount_code',$coupon->coupon_code)->where('canceled','0')->where('user_id',Auth::user()->id)->count();
        //dd($orders_by_cust);
        if($orders_by_cust >=$coupon->max_number_orders){
            $error=1;
        }
        }
    if($error==1){
        session()->forget('coupon');
        return redirect()->back()->with('error','coupon not applied either it is expired or reached its maximum limit');
    }
    
    else
    session()->put('coupon',$coupon);

     return redirect()->back();
}

public function removecoupon(Request $request){
    session()->forget('coupon');
    return redirect()->back();
}

public function getcarttotal(){

}
}