<?php

namespace App\Http\Controllers;
use App\Product;
use App\Flavour;
use App\Category;
use App\CategoryProduct;
use Illuminate\Support\Facades\Cookie;
use App\Cart;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $cart_no;
    public function __construct(){
        
        //dd($this->cart_no);
    }

    public function cart(){
        $value = Cookie::get('cart');
        $items=[];
        $product=[];
        $cart_no=0;
        //dd(count($items));
        if($value!=null){
            // dd(Cart::where('cookie','=',$value)->take(1)->get());
             //if(count(Cart::where('cookie','=',$value)->take(1))>0){
                $items=Cart::where('cookie','=',$value)->orderBy('created_at','DESC')->get();
            //}
            //dd($product);
                foreach($items as $item)
                {
                    $cart_no+=$item->quantity;
                }
        }
        
        $this->cart_no = $cart_no;
       // dd("alright");
        return;
    }

    public function index(Request $r){
        $this->cart();
        $pagination=27;
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
        
        return view('product.index')->with(['products'=>$products,'categories'=>$categories,'cart_no'=>$this->cart_no]);
    }

    public function view($slug){

        $this->cart();

        $prod=Product::where('slug','=',$slug)->first();
        //
        $similarprods=Product::inRandomOrder()->limit(4)->get();
        if($prod!=null)
        return view('product.view')->with(['product'=>$prod,'similar_prods'=>$similarprods,'cart_no'=>$this->cart_no]);
        abort(404); 
    }
}
