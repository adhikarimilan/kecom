<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\OrderProduct;
use App\Order;
use App\Category;
use Illuminate\Support\Facades\Cookie;


use Illuminate\Http\Request;

class UserController extends Controller
{
    private $cart_no;
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function cart(){
        $value = Cookie::get('cart');
       // dd($value);
        $items=[];
        $product=[];
        $cart_no=0;
        if($value!=null){
            //dd(count(Cart::where('cookie','=',$value)->take(1)));
            //  if(count(Cart::where('cookie','=',$value)->take(1))>0){
                $items=Cart::where('cookie','=',$value)->orderBy('created_at','DESC')->get();
                //dd($items);
            // }
                foreach($items as $item)
                {
                    $cart_no+=$item->quantity;
                }
        }
        //dd(count($items));
        $this->cart_no = $cart_no;
        return;
    }

    public function dashboard(){
        $this->cart();

        $orders=Order::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('auth.dashboard')->with(['orders'=>$orders,'cart_no'=>$this->cart_no]);
    }

    public function orderdet(Request $request){
        $this->cart();

        $id=$request['id'];
        $orderprods=OrderProduct::where('order_id','=',$id)->orderBy('created_at','DESC')->get();
        return view('product.orderdet')->with(['orderprods'=>$orderprods,'cart_no'=>$this->cart_no]);
    }
}
