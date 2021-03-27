<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Illuminate\Support\Facades\Cookie;
use App\Cart;
use App\Order;
use App\OrderProduct;
use App\Coupon;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function checkout(){
        $value = Cookie::get('cart');
        //dd($value);
        $items=[];
        $product=[];
        $cart_no=0;
        if($value!=null){
             //dd(Cart::where('cookie','=',$value)->take(1)->get());
             if(Cart::where('cookie','=',$value)->take(1)->count()>0){
                $items=Cart::where('cookie','=',$value)->orderBy('created_at','DESC')->get();
                $cart_no=0;
                foreach($items as $item)
                {
                    $cart_no+=$item->quantity;
                }
                //dd($value);
                return view('product.checkout')->with(['items'=>$items,'cart_no'=>$cart_no]);

            }
            //dd($product);
            //dd($items);
        }
       //dd("hi new user" );
        return redirect('cart')->with('items',$items);
    }

    public function placeorder(Request $request){
        if(Auth::check() && Auth::user()->email_verified_at){
            
        $this->validate($request,[
          'first_name'=>'required',
          'last_name'=>'required',
          'billing_address'=>'required',
          'email'=>'required|email',
          'phone'=>'required',
          'city'=>'required',
          'state'=>'required',
          'payment-method'=>'required'
        ]);
        //dd($request->all());
        $value = Cookie::get('cart');
        
        $items=[];
        $product=[];
        if($value!=null){
             //dd(Cart::where('cookie','=',$value)->take(1)->get());
             if(count(Cart::where('cookie','=',$value)->take(1)->get())>0){
                $items=Cart::where('cookie','=',$value)->orderBy('created_at','DESC')->get();
                //dd($items);

                $order= new Order;
                $order->user_id=Auth::user()->id;
                $order->billing_name=$request['first_name'] . " " . $request['last_name'];
                $order->billing_address=$request['billing_address'];
                $order->billing_email=$request['email'];
                $order->billing_phone=$request['phone'];
                $order->billing_city=$request['city'];
                $order->billing_province=$request['state'];
                $order->billing_postalcode='3337';
                $order->order_notes=$request['order_notes'];
                if($request['payment-method']=='1'){
                    $order->payment_gateway='Cash on Delivery';

            }
            if($request['payment-method']=='2'){
                $order->payment_gateway='Bank Voucher';
            }
        if($request['payment-method']=='3'){
            $order->payment_gateway='Esewa';

    }
        $billing_subtotal=0;
        $billing_total=0;
        $billing_discount=0;
        foreach($items as $item){
            $billing_subtotal+=ceil($item->quantity * $item->product->price() * $item->weight );
        }
$res=$this->applycoupon($billing_subtotal);
$billing_discount=$res['dis_val'];
$billing_total=$billing_subtotal-$billing_discount;
if($billing_discount>0){
    $order->billing_discount_code=$res['c_code'];
    $order->billing_discount=$billing_discount;
}
$order->billing_subtotal=$billing_subtotal;
$order->billing_total=$billing_total;
$order->save();//saved in orders



foreach($items as $item){
    $order_product=new OrderProduct;
    $order_product->order_id=$order->id;
    $order_product->product_id=$item->product->id;
    $order_product->product_price=$item->product->price();
    $order_product->weight=$item->weight;
    $order_product->message=$item->message;
    $prod=$item->product;
    dump($prod);
    if($item->product->m_stock) 
    if($prod->stock_quantity <= $item->quantity){
        $order_product->quantity=$item->product->stock_quantity;
        $prod->stock_quantity=0;
        $prod->save();
        
    }
    else{
        $order_product->quantity=$item->quantity;
        $prod->stock_quantity=$prod->stock_quantity-$item->quantity;
        $prod->save(); 
    }
    else
    $order_product->quantity=$item->quantity;
    //dump($prod);
    $order_product->save();
    $item->delete();
}
dd('spop');
session()->forget('coupon');
return redirect('/dashboard')->with('success','Congratulations your order has been placed succesfully');

        }
    } 
}
return redirect('/dashboard')->with('success','Congratulations your order has been placed succesfully');
}

public function applycoupon($subtotal){
    $error=0;
    $code = null; 
    $dis_val=0;
    if(session()->has('coupon')){
        $coupon= session()->get('coupon');
    

    $error=0;
    $code = $coupon['coupon_code']; 
    $dis_val=0;
    
    $coupon=Coupon::where('coupon_code',$code)->first();//dd(time().'  '.strtotime($coupon->start_time));
    if($coupon){
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
    if($coupon->limit_per_customer){
        $orders_by_cust=Order::where('billing_discount_code',$coupon->coupon_code)->where('canceled','0')->where('user_id',Auth::user()->id)->count();
        //dd($orders_by_cust);
        if($orders_by_cust >=$coupon->limit_per_customer){
            $error=1;
        }
        }
    if($error==1){
    session()->forget('coupon');
    $dis_val=0;
    }
    else{
    if($coupon->discount_type=='0'){ 
    if($coupon->minimum_order_value && $coupon->minimum_order_value > $subtotal)
                              $dis_val=0;
    else
                            $dis_val=$coupon->discount_value;
                            //echo $dis_val;
    } 
    else
                         
        $dis_val=floor($coupon->discount_percent/100 * $subtotal);
        if($coupon->maximum_discount_value && $dis_val > $coupon->maximum_discount_value)
        $dis_val=floor($coupon->maximum_discount_value);
        if($coupon->minimum_order_value && $coupon->minimum_order_value > $subtotal)
        $dis_val=0;
        //echo $dis_val; 

    }
    //session()->put('coupon',$coupon);
}
}
$res=[];
$res['dis_val']=$dis_val;
$res['c_code']=$code;
//dd($res);
     return $res;
}

}
