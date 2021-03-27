<?php

namespace App\Http\Controllers\Auth\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\OrderProduct;
use App\Order;
use App\Category;
use App\Product;
use App\CategoryProduct;

class ApiController extends Controller
{
    public function dashboard(){

        $orders=Order::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return response()->json_encode($orders);
    }

    public function orderdet(Request $request){
        $id=$request['id'];
        $order=Order::where(['id'=>$id,'user_id','=',Auth::user()->id])->orderBy('created_at','DESC')->first();
        if(!order)
        return response()->json(['error'=>'An error occured']);
        $orderprods=OrderProduct::where('order_id','=',$id)->orderBy('created_at','DESC')->get();
        return response()->json_encode($orderprods);
    }
    public function placeorder(Request $request){
        if(Auth::user() && Auth::user()->email_verified_at){ 
        $this->validate($request,[
          'name'=>'required',
          'billing_address'=>'required',
          'email'=>'required|email',
          'phone'=>'required',
          'city'=>'required',
          'state'=>'required',
          'payment-method'=>'required',
          'cart'=>'required'
        ]);
        
        $cartitems=json_decode($request['cart']);
        
        $items=[];
             //dd(Cart::where('cookie','=',$value)->take(1)->get());
             if(count($cartitems)>0){

                $order= new Order;
                $order->user_id=Auth::user()->id;
                $order->billing_name=$request['name'] ;
                $order->billing_address=$request['billing_address'];
                $order->billing_email=$request['email'];
                $order->billing_phone=$request['phone'];
                $order->billing_city=$request['city'];
                $order->billing_province=$request['state'];
                $order->billing_postalcode=$request['postcode'];
                $order->order_notes=$request['order_notes'];
                if($request['payment_method']=='1'){
                    $order->payment_gateway='Cash on Delivery';

            }
            if($request['payment_method']=='2'){
                $order->payment_gateway='Bank Voucher';
            }
        if($request['payment_method']=='3'){
            $order->payment_gateway='Esewa';

    }
        $billing_subtotal=0;
        $billing_total=0;
        $billing_discount=0;
        foreach($cartitems as $item){
            $product=Product::find($item->id);
            if($product)
            $billing_subtotal+=ceil($product->price() * $item->weight );
        }
$billing_discount=0;
$billing_total=$billing_subtotal-$billing_discount;
if($billing_discount>0){
    $order->billing_discount_code=$res['c_code'];
    $order->billing_discount=$billing_discount;
}
$order->billing_subtotal=$billing_subtotal;
$order->billing_total=$billing_total;
$order->save();//saved in orders



foreach($cartitems as $item){
    $order_product=new OrderProduct;
    
    $product=Product::find($item->id);
    $order_product->order_id=$order->id;
    $order_product->product_id=$product->id;
    $order_product->product_price=$product->price();
    $order_product->weight=$item->weight;
    $order_product->message=$item->message;
    //$prod=$item->product;
    
    
     
    $order_product->quantity=1;
    //dump($prod);
    $order_product->save();
}
 return response()->json(['success'=>'Congratulations your order has been placed succesfully','message'=>'success'], 200);

        }
    
}
return response()->json(['message'=>'error','error'=>'An error occured'], 403);
}

public function getproducts(Request $r){
    $pagination=10;
    $categories=Category::where('parent_id',null)->orderBy('created_at','DESC')->get();
    //search query
    if(isset($r['q']) && trim($r['q'])!=""){
        $products=Product::where('name','like',"%".$r['q']."%");//->paginate($pagination);
        //return view('product.index')->with(['products'=>$products,'categories'=>$categories,'cart_no'=>$this->cart_no]);
    }
    //search query end
    if(isset($r['cat']) && trim($r['cat'])!=""){
        $products = Product::with('categories')->whereHas('categories', function ($query) {
            $query->where('slug', request()->cat);
        });
        // $cat=Category::where('slug','=',$r['cat'])->first();
        // if(count($cat)<1) abort(404);
        // $catpros=$cat->categories_products;
        // $products=[];
        // foreach($catpros as $catpro){
        //     //dd($catpro->product);
        //     $products[]=$catpro->product;
        // }
        //return view('product.index')->with(['products'=>$products,'categories'=>$categories]);
//          $catpro=CategoryProduct::where('category_id','=',$cat->id)->get();
        //dd($catpro);
    }
    
   else if(isset($r['type']) && trim($r['type'])!=""){
       if($r['type']=='onsale'){
        $products=Product::where('sale_price','>','1');
       } 
       else if($r['type']=='featured'){
        $products=Product::where('featured','1');
       }
       else{
        $products=Product::where('id','>','0');  
       }
    }
    
    else if( trim($r['q'])==""){
        $products=Product::where('id','>','0');
       // dd($products);
    }
    else{

    }
    if(isset($r['sort']) && trim($r['sort'])!=""){
        if($r['sort']=="low_to_high"){
            $products=$products->orderBy('sale_price')->orderby('reg_price')->paginate($pagination);
            //dd($products);
        }
        if($r['sort']=="high_to_low"){
            $products=$products->orderBy('sale_price','DESC')->paginate($pagination);  
        }

    }
    else{
        $products=$products->paginate($pagination);  
    }
    
    return response()->json(['products'=>$products,'success'=>'Products fetched successfully'], 200);
}

}
