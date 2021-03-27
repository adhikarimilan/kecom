<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Cookie;
use App\Cart;
use App\Message;
use App\Category;
use App\Banner;

class IndexPageController extends Controller
{
    private $cart_no;
    public function __construct(){
        
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
                foreach($items as $item)
                {
                    $cart_no+=$item->quantity;
                }
            // }
        }
        //dd(count($items));
        $this->cart_no = $cart_no;
        return;
    }

    public function index(){

        $this->cart();
        $categories=Category::where('featured','=','1')->inRandomOrder()->limit(4)->get();
        $banners=Banner::where('status','=','1')->orderBy('border')->get();
        $featured=Product::where('featured','=','1')->limit(6)->get();
        $onsale=Product::where('sale_price','>','1')->limit(6)->get();
        $recents=Product::orderBy('created_at','desc')->limit(6)->get();
        return view('welcome')->with(['recents'=>$recents,'cart_no'=>$this->cart_no,'onsale'=>$onsale,'featured'=>$featured,'categories'=>$categories,'banners'=>$banners]);
    }

    public function contact(){
        $this->cart();
        return view('contact')->with('cart_no',$this->cart_no);
    }
    public function savemsg(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'contact'=>'required',
            'email'=>'required|email',
            'description'=>'required'
        ]);
        $msg=new Message;
        $msg->name=$request['name'];
        $msg->address=$request['address'];
        $msg->contact=$request['contact'];
        $msg->email=$request['email'];
        $msg->description=$request['description'];
        $msg->save();
        return redirect('contact')->with('success','true');
    }
}
