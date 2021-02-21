@extends('layout.app')
@section('content')
<section class="product-banner-section img_wrapper">
    <img src="img/service-back.jpg">
    <div class="pb-caption text-center">
      <h1>Cart</h1>
    </div>
  </section>
  
  <section class="cart-section py-5">
    <div class="container">
      <div class="row">
          @if(count($items)>0)
        <div class="col-md-10 mx-auto">
          <div class="cart-items">
            @include('inc.messages')
            @foreach ($items as $item)
            
           <div class="cart-item d-flex align-items-center justify-content-between">
              <div class="img-wrapper">
                <img src="{{asset('product_images/'.$item->product->image)}}">
              </div>
              <div class="prod-info">
                <div class="prod-title">
                    <a href="{{url('/product/'.$item->product->slug)}}">{{$item->product->name}}</a>
                </div>
                <div class="prod-price">
                  <span>Price: </span>{{$item->product->price()}}
                </div>
                <div class="prod-weight">
                  <span>Quantity: </span>{{$item->quantity}}
                </div>
                
                <div class="prod-total-price">
                  <span>Total Price: </span>{{ceil($item->product->price()  * $item->quantity)}}
                </div>
              </div>
              <div class="prod-remove">
                  <form action="{{url('delfromcart')}}" method="post">
                      <input type="hidden" value="{{$item->id}}" name='id'>
                      @csrf
                        <button type='submit' class='btn'>
                            <span></span>
                            <span></span>
                        </button>
                      </form>
              </div>
            </div>
            @endforeach
        </div>
        </div> 
        <div class="col-md-10 mx-auto">
          <div class="row">
            <div class="col-lg-5 mr-auto">
              <div class="cart-subtotal-wrapper clearfix">
                <span class="float-left">Subtotal</span>
                <span class="float-right">Rs. <?php
                  $subtotal=0; 
                  foreach($items as $item){
                      $subtotal+= ceil($item->weight * $item->product->price() * $item->quantity  );
                  }
                  echo $subtotal;
              ?></span>
              </div>
            @if (session()->has('coupon'))
            <form action="{{route('coupon.remove')}}" method="post" class="d-none" id="remove-coupon">
              @csrf
            </form>
            @php
                $coupon= session()->get('coupon');
            @endphp
            <div class="cart-subtotal-wrapper clearfix">
              <span class="float-left">Discount({{$coupon['coupon_code']}}) <button id="rem-btn">remove</button> </span>
              <span class="float-right">Rs.
                @if($coupon->discount_type=='0')
                   <?php 
                   if($coupon->minimum_order_value && $coupon->minimum_order_value > $subtotal)
                     $dis_val=0;
                  else
                   $dis_val=$coupon->discount_value;
                   echo $dis_val;
                   ?> 
                @else
                @php
                    $dis_val=floor($coupon->discount_percent/100 * $subtotal);
                    if($coupon->maximum_discount_value && $dis_val > $coupon->maximum_discount_value)
                    $dis_val=floor($coupon->maximum_discount_value);
                    if($coupon->minimum_order_value && $coupon->minimum_order_value > $subtotal)
                     $dis_val=0;
                    echo $dis_val; 
                @endphp
                @endif
              </span>
            </div>
            <div class="cart-subtotal-wrapper clearfix">
              <span class="float-left">Total</span>
              <span class="float-right">Rs. 
                <?php 
                  $total=0;
                   $total=$subtotal - $dis_val;
                   if($total<0) $total=0;
                   echo $total;
                   ?> 
              </span>
            </div>
          </div>
              {{-- session()->get('coupon')['id'] --}}  
            @else
          </div>
              <div class="col-lg-5 ml-auto py-4">
              <h6>Have a coupon?</h6>
            <form action="{{route('coupon.apply')}}" method="post">
                @csrf
                <input type="text" name="ccode" id="" class="btn-secondary">
                <input type="submit" value="Apply" class="btn btn-info">
              </form>
            </div>  
            @endif
             
          </div>
              <div class="mt-3">
                <form>
                  <a title="Checkout" href="{{url('/product')}}" class="btn btn1 mt-3 ">Shop More</a>
                    @guest
                    <a title="Checkout" href="{{url('/checkout')}}" class="btn btn1 mt-3 float-right">Login to Checkout</a>  
                    @else
                    <a title="Checkout"  href="{{url('/checkout')}}" class="btn btn1 mt-3 float-right">Proceed to Checkout</a>  
                    @endguest
                </form>
              </div>
        </div>
        @else
          <h1 class="text-center m-3">Currently Your Cart is empty</h1>
          <div class="col-lg-12">
          <a href="{{url('/product')}}" class="btn btn1">Go Shopping</a>
        </div>
          @endif

      </div>
    </div>
  </section>
  <section class="similar-product-section pb-5 mt-5">
    <div class="container">
        <div class="section-header text-center">
            <h2>Products You May Like</h2>
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
@endsection

@section('styles')
    <style>
     #rem-btn{
       border:navajowhite;
       background:red;
       border-radius: 4px;
       padding:2px;
       font-size:12px;
       cursor: pointer;
       color: #fff;
     }
    </style>
@endsection
@section('scripts')
    <script>
    $('#rem-btn').click(function(){
      $('#remove-coupon').submit();
    });
    </script>
@endsection