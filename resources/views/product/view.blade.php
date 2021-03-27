@extends('layout.app')
@section('content')

<section class="product-banner-section img_wrapper">
        <img src="{{asset('img/service-back.jpg')}}">
        <div class="pb-caption text-center">
            <span>Our</span>
            <h1>Products</h1>
        </div>
    </section>
    <section class="single-product-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="prod-gallery-wrapper">
                        <div class="gallery-thumbs">
                            <div class="gallery-thumb active">
                                <a href="#"><img src="{{asset('product_images/'.$product->image)}}" class="img-fluid"></a>
                            </div>
                            @if($product->images!="")
                            <?php $images=explode(" ",$product->images)?>
                            @foreach($images as $img)
                            <div class="gallery-thumb">
                                <a href="#"><img src="{{asset('extra_images/'.$img)}}" class="img-fluid"></a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="gallery-main-img" style="flex:1;">
                            <img src="{{asset('product_images/'.$product->image)}}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="prod-detail-wrapper">
                            <form action="{{url('/addtocart')}}" method="post" id='cart-form'>
                                @csrf
                            <h2 class="prod-title">{{$product->name}}</h2>
                            <div class="prod-price mt-3" data-mainPrice="{{$product->price()}}"><span id="money"> @if ($product->sale_price)
								<span class="prod-price">Rs.{{$product->sale_price}}</span>
                                <del class="text-dark">Rs.{{$product->reg_price}}</del>	
                                <span class="centoff text-muted">-{{ceil((1-$product->price()/$product->reg_price) * 100)}}%</span>
								@else
								<span class="prod-price">Rs.{{$product->price()}}</span>	
								@endif </span></div>
                            <div class="form-group mt-3 text-muted">
                                <label class="font-weight-bold">Quantity @if ($product->m_stock && $product->stock_quantity<5)
                                    <span class="stock_rem">{{$product->stock_quantity. " items left"}}</span>
                                @endif </label>
                                <select id="prod-weight" name="quantity" class="form-control">
                                    @if ($product->m_stock && $product->stock_quantity<5)
                                    @if ($product->stock_quantity<1)
                                    <option value="0">0 </option>  
                                    @else
                                        
                                    
                                    @php
                                    for($i=0;$i<$product->stock_quantity;$i++){
                                      echo "<option value='".($i+1)."'>".($i+1)." </option>";
                                    //echo $i+1;
                                    }
                                        
                                    @endphp @endif
                                    @else 
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                    @endif
                                    
                                </select>
                            </div>
                            
                            @if($product->details)
                               <div class="form-group">
                                <label class="font-weight-bold text-muted">Details</label>
                                <div>{{$product->details}}</div>
                            </div> 
                            @endif
                            
                            <div class="form-group">
                                <label class="font-weight-bold text-muted">Category: </label>
                                <span>
                                @php
                                 $i=0;   
                                @endphp
                                @foreach ($product->category_product as $cat)
                                @if($i!=0), @endif
                                <a href="{{url('product?cat='.$cat->category->slug)}}">{{$cat->category->name}} </a> 
                                @php
                                    $i++;
                                @endphp 
                                @endforeach
                                </span>
                            </div>
                            <input type="hidden" name='id' value='{{$product->id}}'>
                            <button type="button" class="btn btn1 btn-block btn-sb" onclick="disable()" id='btn-sb' @if ($product->m_stock && $product->stock_quantity<1) disabled @endif>ADD TO CART</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">

				<hr class="mt-5">

				<h4 class="prod-title mt-4">Description</h4>
				<div class="my-3">{!!$product->description!!}</div>
			</div>

            </div>
        </div>
    </section>
    <section class="similar-product-section pb-5">
        <div class="container">
            <div class="section-header text-center">
                <h2>Similar Products</h2>
            </div>
            @if(count($similar_prods))
         <div class="row">
             @foreach($similar_prods as $prod)
             <div class="col-md-3">
             <a href="{{url('product/'.$prod->slug)}}" class="product-wrapper">
                        <div class="img-wrapper">
                            <img src="{{asset('product_img/'.$prod->image)}}">
                        </div>
                        <div class="prod-detail">
                        <h3 class="prod-title">{{$prod->name}}</h3>
                        <div class="prod-price">Rs. {{$prod->price()}}</div>
                        </div>
                    </a>
                </div>
           @endforeach 
        </div>
        @endif
        </div>
    </section>
{{-- <div class="row">
<div class="col-lg-6 p-5">
<img src="{{asset('product_images/'.$product->image)}}" alt="{{$product->name}}" class="img img-fluid">
</div>
<div class="col-lg-6 p-5">
<h3 class=''>{{$product->name}}</h3>
<hr>
<h5 class='mt-3 mb-3'>{{$product->details}}</h5>
<hr>
<h2>Price: &nbsp;{{$product->price}}</h2>
<form action="{{url('/addtocart')}}" method="post">
    @csrf
<h2>Weight: &nbsp;
    <select class="" id="weight" name="weight">
        <option value="1">1 Pound</option>
        <option value="2">2 Pound</option>
        <option value="3">3 Pound</option>
        <option value="4">4 Pound</option>
        <option value="5">5 Pound</option>
    </select>
</h2>
<h2>Flavor: &nbsp;
<select class="" id="flavour" name="flavor" >
            <option value="1">Select Flavor</option>
            @if(count($flavours)>0)
            @foreach ($flavours as $flavour)
<option data-value="{{$flavour->id}}" value="{{$flavour->id}}" onclick="alert('hello')">{{$flavour->name}}</option> 
            @endforeach
            @endif
          </select>
</h2>
<input type="text" value="" id="flav-id">
<input type="hidden" name='id' value='{{$product->id}}'>
<h2>Message</h2>
<textarea name="message" id="" cols="40" rows="4" placeholder="message on cake or gift" style="font-size:1rem;"></textarea>
<br>
<input type="submit" class="btn btn-primary mt-2 mb-2" value="ADD TO CART">
</form>
</div>
</div> --}}
@endsection
@section('scripts')
<script>
function disable(){
    document.getElementById('btn-sb').disabled = true;
		//alert("Button ");
		document.getElementById('cart-form').submit();
}
</script>
<style>
    .btn1:disabled , .btn1[disabled] {
    opacity: 1;
}
.centoff{
    padding: 0.1em;
    font-size: 0.7em;
    color: wheat;
    background: gold;
}
.stock_rem{
    font-size: 0.6em;
    padding:5px;
    font-style: italic;
    background: gold;
}
</style>

@endsection