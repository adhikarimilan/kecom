<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
Use Intervention\Image\Facades\Image;
use App\Cart;
use App\OrderProduct;
use App\Order;
use App\Flavour;
use App\Category;
use App\CategoryProduct;
use App\Message;
use App\User;
use App\FileUpload;
use File;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private $msgs;
    private $unseen;
    public function msgs(){
        $msgs=Message::orderBy('created_at','desc')->limit(4)->get();
        $this->msgs=$msgs;
        $unseen=count(Message::where('seen','=','0')->get());
        $this->unseen=$unseen;
    }
    public function index()
    {
        $this->msgs();
        $today=date('Y-m-d');
               // calculating today's earnings
        $today=date('Y-m-d');
        $shippedtoday=Order::where([['shipped','=','1'],['updated_at','like',"$today%"]])->get();
        //dd($shippedtoday);
        $todayearning=0;
        foreach($shippedtoday as $data){
            $todayearning+=$data->billing_total;
        }
        //calculating today's orders in number
        $orderstoday=Order::where('created_at','like',"$today%")->where('canceled','0')->get();
        $todayorders=0;
        if($orderstoday!=null){
            $todayorders=count($orderstoday);
        }
        //dd($todayorders);
        //dd($todayearning);
        //calculating this month earning
        $thismonth=date('Y-m-');
        $shippedinmonth=Order::where([['shipped','=','1'],['updated_at','like',"$thismonth%"]])->get();
        $monthlyearning=0;
        foreach($shippedinmonth as $data){
            $monthlyearning+=$data->billing_total;
        }
        //dd($monthlyearning);

        //calculating orders to be shipped
        $ordertobeshipped=Order::where([['shipped','=','0'],['verified','=',"1"]])->get();
        $ordertoship=$ordertobeshipped!=null?count($ordertobeshipped):0;
       // dd($ordertobeshipped);
        return view('home')->with(['msgs'=>$this->msgs,'unseen'=>$this->unseen,'todayearning'=>$todayearning,'todayorders'=>$todayorders,'monthlyearning'=>$monthlyearning,'ordertoship'=>$ordertoship]);
    }

    public function viewproducts(){
        $this->msgs();
        $products=Product::orderBy('created_at','DESC')->get();
        return view('product.all')->with(['products'=>$products,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
    }

    public function addproduct(){
        $this->msgs();
        $categories=Category::orderBy('created_at')->get();
        return view("product.add")->with(['categories'=>$categories,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
    }

    public function saveproduct(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'details'=>'nullable',
            'price'=>'required|integer',
            'description'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:5125',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5125'
        ]);

        $product = new Product;
        $product->name=$request['name'];
        $slug=Str::slug($request['name']);
        $n=1;
        $slu=$slug;
        while(Product::where('slug','=',$slu)->first()!=null){
            $slu=$slug.'-'.$n;
            $n++;
        }
        $product->slug=$slu;
        $product->details=$request['details'];
        $product->price=$request['price'];
        $product->description=$request['description'];
        if($request['featured']=="1")
        $product->featured='1';
        if($request['has_flavours']=="1")
        $product->has_flavours='1';
         //dd($request->all());
        // Handle File Upload
        // if($request->hasFile('image')){
        //     // Get filename with the extension
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();
        //     // Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just ext
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     // Filename to store
        //     $pre="cov_";
        //     $fileNameToStore= $pre . date("Ymd_His").'.'.$extension;
        //     //dd(public_path('../../extra_img'));
        //     //dd(asset('/extra_img/'));
        //     // Upload Image
        //     $path = $request->file('image')->move('product_images', $fileNameToStore);
        //     //dd($fileNameToStore);
        //     ini_set('memory_limit', '256M');
        //     $image=Image::make(asset("product_images/".$fileNameToStore))->widen(800, function ($constraint) {
        //         $constraint->upsize();
        //     });
        //     //dd('here');
        //     $img=Image::make(asset("product_images/{$fileNameToStore}"))->widen(300, function ($constraint) {
        //         $constraint->upsize();
        //     });
        //     //dd(public_path("/home2/truebuilt/test.truebuilt.com.np/product_img/".$fileNameToStore));

        //     $path = public_path('product_img');
        //     $img->save($path.'/'.$fileNameToStore);
        //     //dd('alrighy');
        //     $path = public_path('product_images');
        //     $image->save($path.'/'.$fileNameToStore);
        //     //dd('saved');
        // }
        if($request->hasFile('image')){ 
            $uploadedFile = $request->file('image');
            if ($uploadedFile->isValid()) {
                $pre="cov_".date("Ymd_his");
                $product->image=FileUpload::pphoto($request,'image',$pre,'product_images',800,500);
                $product->image=FileUpload::pphoto($request,'image',$pre,'product_img',300,300);
            }
        }
         else {
            dd('noimage');
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasfile('images'))
         {
            $n=1;
            foreach($request->file('images') as $image)
            {
                $ext=$image->getClientOriginalExtension();
                $pre="e".$n."_";
                $name=$pre . date("Ymd_His").'.'.$ext;

                $img=Image::make($image->getRealPath())->widen(800, function ($constraint) {
                    $constraint->upsize();
                }); 
                $img->save("extra_images/{$name}");

                // $path = public_path('extra_images');
                // $img->save($path."/".$name);
                $data[] = $name;
                $n++;  
            }
             $product->images=implode(" ",$data);
            //dd($product->images);
         }
         

        $product->image=$fileNameToStore;
        $product->save();

        if($request['category']!=null && $request['category'][0]!='0'){
            //dd("inside if ");
            $cats=$request['category'];
           // dd($cats);
            foreach($cats as $cat){
                $catpro= new CategoryProduct;
                $catpro->product_id=$product->id;
                $catpro->category_id=$cat;
                $catpro->save();
            }
        }
        return redirect('/products')->with('success','product successfully saved');

    }

    public function editproduct(Request $request,$id){
        
        $product=Product::findOrFail($id);
         $categories = Category::with('products')->whereHas('products', function ($query) {
             $query->where('products.id', request()->id);
         });
        //dd($product->categories);
        $categories=$categories->get();
        $cats=Category::orderBy('created_at');
        foreach($categories as $category){
        $id=$category->id;
        $cats=$cats->where('id','<>',$id)->orderBy('created_at');
        //dd($ids);
        }
        $cats=$cats->get();
        $this->msgs();
        return view("product.edit")->with(['categories'=>$categories,'cats'=>$cats, 'product'=>$product,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
    }

    public function updateproduct(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'id'=>'required',
            'name'=>'required',
            'details'=>'nullable',
            'reg_price'=>'required|integer',
            'sale_price'=>'nullable|integer',
            'description'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg|max:5125',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5125'
        ]);
        $id=$request['id'];
        if($request['reg_price'] <= $request['sale_price']){
             return redirect()->back()->with('error','Regular price should be greater than Sale price.')->withInput();
        }
        $product = Product::findOrFail($id);
        $product->name=$request['name'];
        $product->details=$request['details'];
        $product->reg_price=$request['reg_price'];
        $product->sale_price=$request['sale_price'];
        $product->description=$request['description'];
        if($request['featured']=="1")
        $product->featured='1';
        else
        $product->featured='0';
        if($request['has_flavours']=="1")
        $product->has_flavours='1';
        else
        $product->has_flavours='0';
         //dd($request->all());
        // Handle File Upload
        // if($request->hasFile('image')){
        //     // Get filename with the extension
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();
        //     // Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just ext
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     // Filename to store
        //     $pre="cov_";
        //     $fileNameToStore= $pre . date("Ymd_His").'.'.$extension;
        //    // dd($fileNameToStore);
        //     // Upload Image
        //     $path = $request->file('image')->move('product_images', $fileNameToStore);
        //     ini_set('memory_limit', '256M');
        //     $image=Image::make(public_path("product_images/{$fileNameToStore}"))->widen(800, function ($constraint) {
        //         $constraint->upsize();
        //     });
        //     $img=Image::make(public_path("product_images/{$fileNameToStore}"))->widen(300, function ($constraint) {
        //         $constraint->upsize();
        //     });
        //     $img->save(public_path("product_img/{$fileNameToStore}"));
        //     $image->save();
        //     unlink("product_img/{$product->image}");
        //     unlink("product_images/{$product->image}");
        //     $product->image=$fileNameToStore;
        // } 
        if($request->hasFile('image')){ 
            $uploadedFile = $request->file('image');
            if ($uploadedFile->isValid()) {
                $pre="cov_".date("Ymd_his");
                $oldpic=$product->image;
                $product->image=FileUpload::pphoto($request,'image',$pre,'product_images',800,500);
                $product->image=FileUpload::pphoto($request,'image',$pre,'product_img',300,300);

                if($oldpic && File::exists('product_img/'.$oldpic)){
                    unlink('product_img/'.$oldpic);
                }
                if($oldpic && File::exists('product_images/'.$oldpic)){
                    unlink('product_images/'.$oldpic);
                }
            }
        }
        else {
             //dd('noimage');
           // $
        }

        if($request->hasfile('images'))
         {
            $n=1;
            foreach($request->file('images') as $image)
            {
                $ext=$image->getClientOriginalExtension();
                $pre="e".$n."_";
                $name=$pre . date("Ymd_His").'.'.$ext;
                //$image->move(public_path().'/extra_images/', $name); 
                //ini_set('memory_limit', '256M');
                $img=Image::make($image->getRealPath())->widen(800, function ($constraint) {
                    $constraint->upsize();
                }); 
                $img->save("extra_images/{$name}");
                $data[] = $name;
                $n++;  
            }
            if($product->image!=null){
                $e_images=explode(' ',$product->images);
                foreach($e_images as $e_image){
                    unlink("extra_images/{$e_image}");
                }
            }
            $product->images=implode(" ",$data);
            //dd($product->images);
         }
         

        $product->save();
         $categories=CategoryProduct::where('product_id','=',$product->id);
         $categories->delete();
         if($request['category'] && count($request['category']) && $request['category'][0]!='0'){
             //dd("inside if ");
             $cats=$request['category'];
             foreach($cats as $cat){
                $catpro= new CategoryProduct;
                $catpro->product_id=$product->id;
                 $catpro->category_id=$cat;
                 $catpro->save();
            }
         }
        return redirect('/products')->with('success','product successfully Updated');

}

    public function deleteproduct(Request $r){
        $id=$r['id'];
        $product=Product::find($id);
        $product->delete();
        return redirect("products")->with("success","Product Deleted");
    }
    public function togglefeatured(Request $r){
        $product=Product::find($r['pid']);
        $data=['data'=>'200'];
        if(!$product){
            $data=['data'=>'404'];
           
        }
        else{
           $product->featured=!$product->featured;
            $product->save(); 
        }
        return $data;

    }
    
   public function orders(Request $request){
       $this->msgs();
       $msg=null;
       if(isset($request['cat']) && $request['cat']!=""){
           if($request['cat']=="verified"){
            $msg="verified";
            $orders=Order::where('verified','1')->where('canceled','0')->orderBy('created_at','DESC')->get(); 
            //return view('auth.orders')->with('orders',$orders);
        }
        else if($request['cat']=="not-verified"){
            $msg="non-verified";
            $orders=Order::where('verified','=','0')->where('canceled','0')->orderBy('created_at','DESC')->get(); 
            //return view('auth.orders')->with('orders',$orders);
       }
       else if($request['cat']=="shipped"){
        $msg="shipped";
        $orders=Order::where('shipped','=','1')->where('canceled','0')->orderBy('created_at','DESC')->get(); 
        //return view('auth.orders')->with('orders',$orders);
   }
   else if($request['cat']=="canceled"){
    $msg="canceled";
    $orders=Order::where('canceled','1')->orderBy('created_at','DESC')->get(); 
    //return view('auth.orders')->with('orders',$orders);
}
   else
   $orders=Order::orderBy('created_at','DESC')->where('canceled','0')->get();
    
    }else{
       $orders=Order::orderBy('created_at','DESC')->where('canceled','0')->get();
    }
       return view('auth.orders')->with(['orders'=>$orders,'msgs'=>$this->msgs,'unseen'=>$this->unseen,'cat'=>$msg]);
   }

   public function orderdet(Request $request){
       $this->msgs();
       $oid=$request['id'];
        $orderprod=OrderProduct::where('order_id','=',$oid)->get();
        if(count($orderprod)>0){
        return view('auth.orderdetails')->with(['orderprods'=>$orderprod,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
        }
        abort('403','Sorry Something went wrong');
   }
   public function verifyorder(Request $request){
      $oid=$request['oid'];
      //dd($oid);
      $order=Order::Find($oid);
      //dd($order);
      if($order!=null){
          $order->verified='1';
          $order->save();
          return redirect('orders')->with("success",'Successfully verified');
          
      }
      abort('404');
   }

   public function cancelorder(Request $request){
    $oid=$request['oid'];
    //dd($oid);
    $order=Order::findOrFail($oid);
    //dd($order);
        $order->canceled=1;
        $order->shipped=0;
        $order->verefied=0;
        $order->save();
        return redirect('orders')->with("success",'Successfully verified');
        
 }

   public function markasshipped(Request $request){
    $oid=$request['oid'];
    //dd($oid);
    $order=Order::Find($oid);
    //dd($order);
    if($order!=null){
        $order->shipped='1';
        $order->save();
        return redirect('orders')->with("success",'Successfully marked as shipped');
        
    }
    abort('404');
 }

 public function categories(){
     $this->msgs();
     $categories=Category::orderBy('created_at')->get();
     return view('auth.categories')->with(['categories'=>$categories,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
 }
 public function addcategory(Request $request){
     $this->validate($request,[
         'name'=>'required',
         'pic'=>'nullable|image|mimes:jpeg,png,jpg|max:1125'
     ]);
    $category = new Category;
    $category->name=$request['name'];
    $category->featured=$request['featured'];
     $slug=Str::slug($request['name']);
     $n=1;
     $slu=$slug;
     while(Category::where('slug','=',$slu)->first()!=null){
         $slu=$slug.'-'.$n;
         $n++;
     }
     $category->slug=$slu;
     $category->order='2';
     if($request->hasFile('pic')){ 
        $uploadedFile = $request->file('pic');
        if ($uploadedFile->isValid()) {
            $category->photo=FileUpload::photo($request,'pic','cat','cats',800,800);
             }
    }
     if($request['parent']!=0 ){
         $category->parent_id=$request['parent'];
     }
     $category->save();
    return redirect('categories')->with("success","Successfully saved");
}

public function updatecategory(Request $request){
    $this->validate($request,[
        'name'=>'required',
        'pic'=>'nullable|image|mimes:jpeg,png,jpg|max:1125'
    ]);
    //dd($request['id']);
   $category = Category::findOrFail($request['id']);
   $category->name=$request['name'];
    $slug=Str::slug($request['name']);
    $n=1;
    $slu=$slug;
    while(Category::where('slug','=',$slu)->first()!=null){
        $slu=$slug.'-'.$n;
        $n++;
    }
    $category->slug=$slu;
    $category->order='2';
    if($request->hasFile('pic')){ 
       $uploadedFile = $request->file('pic');
       $oldpic=$category->photo;
       
       if ($uploadedFile->isValid()) {
           $category->photo=FileUpload::photo($request,'pic','cat','cats',800,800);
            }

            if($oldpic && File::exists($oldpic)){
                unlink($oldpic);
            }
   }
   if($request['parent']==0)
    $category->parent_id=null;
    else if($request['parent'] != $category->id){
        $category->parent_id=$request['parent'];
    }
    else{}
    $category->save();
   return redirect('categories')->with("success","Successfully updated");
}
public function editcategory($id){
    $this->msgs();
    $category=Category::findOrFail($id);
    $categories=Category::orderBy('created_at')->where('id','<>',$id)->get();
    return view('auth.editcategory')->with(['categories'=>$categories,'msgs'=>$this->msgs,'unseen'=>$this->unseen,'category'=>$category]);
}
public function cattogglefeatured(Request $r){
    $category=Category::find($r['pid']);
    $data=['data'=>'200'];
    if(!$category){
        $data=['data'=>'404'];
       
    }
    else{
       $category->featured=!$category->featured;
        $category->save(); 
    }
    return $data;

}
public function delcategory(Request $r){
    if($r['id']!='1'){
    $cat=Category::find($r['id']);
    if($cat!=null)
    $cat->delete();
    }
    return redirect('/categories')->with('success','category deleted');
}
public function messages(){
    $msgs=Message::orderBy('created_at','desc')->get();
    $unseen=count(Message::where('seen','=','0')->get());
    return view('messages')->with(['msgs'=>$msgs,'unseen'=>$unseen]);
}
public function message($id){
    $this->msgs();
    $msg=Message::findOrFail($id);
    if(!$msg->seen){
        $msg->seen='1';
        $msg->save();}
    //dd($msg);
    return view('message')->with(['mes'=>$msg,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
    
}

public function users(){
    $this->msgs();
    $users=User::orderBy('created_at')->get();
    return view('auth.allusers')->with(['users'=>$users,'msgs'=>$this->msgs,'unseen'=>$this->unseen]);
}

}
