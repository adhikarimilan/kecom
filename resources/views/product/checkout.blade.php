@extends('layout.app')
@section('content')
<section class="product-banner-section img_wrapper">
	<img src="img/service-back.jpg">
	<div class="pb-caption text-center">
		<h1>Checkout</h1>
	</div>
</section>
<div class="checkout_area py-5">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                 @include('inc.messages')
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading mb-30">
                        <h5>Billing Address</h5>
                    </div>

                    <form action="{{url('/placeorder')}}" method="post" id="checkout-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name <span  class="reqrd">*</span></label>
                                <input type="text" class="form-control" id="first_name" value="" required name="first_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name <span class="reqrd">*</span></label>
                                <input type="text" class="form-control" id="last_name" value="" required name="last_name">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="company">Company Name</label>
                                <input type="text" class="form-control" id="company" value="" name="companyname">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="country">Country <span class="reqrd">*</span></label>
                                <select class="w-100 form-control" id="country" disabled>
                                    <option value="usa">Nepal</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Billing Address <span class="reqrd">*</span></label>
                                <input type="text" class="form-control mb-3" id="billing_address" value="" name="billing_address">
                            </div>
                            
                           {{--  <div class="col-12 mb-3">
                                <label for="street_address">Shipping Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" id="shipping_address" value="">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="billing_same">
                                    <label class="custom-control-label" for="billing_same">Same as billing addrress</label>
                                </div>
                            </div> --}}
                            <div class="col-12 mb-3">
                                <label for="postcode">Postcode <span  class="reqrd">*</span></label>
                                <input type="text" class="form-control" id="postcode" value="" name="postalcode">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="city">Town/City <span  class="reqrd">*</span></label>
                                <input type="text" class="form-control" id="city" value="" name="city">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="state">Province <span  class="reqrd">*</span></label>
                                <input type="text" class="form-control" id="state" value="" name="state">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Phone No <span class="reqrd">*</span></label>
                                <input type="number" class="form-control" id="phone_number" min="0" value="" name="phone">
                            </div>
                            <div class="col-12 mb-4">
                                <label for="email_address">Email Address <span class="reqrd">*</span></label>
                                <input type="email" class="form-control" id="email_address" value="" name="email">
                            </div>
                            <div class="col-12 mb-4">
                                <label for="order_notes">Order Notes</label>
                                <textarea class="form-control" name="order_notes"></textarea>
                            </div>

                            <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">I agree to <a href="#">Terms and conitions</a></label>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="order-details-confirmation">

                    <div class="cart-page-heading">
                        <h5>Your Order</h5>
                    </div>
                    @if(count($items)>0)
                    <ul class="order-details-form mb-4">
                        <li class="font-weight-bold"><span>Product</span> <span>weight</span><span>Total</span></li>
                        @foreach ($items as $item)
                    <li><span>{{$item->product->name}} </span> <span>{{$item->weight}} lb</span><span>Rs.{{ ceil($item->quantity * $item->product->price() *  $item->weight )}}</span></li>
                        @endforeach
                        <li><span>Subtotal</span><span></span><span>Rs.<?php
                            $subtotal=0; 
                            foreach($items as $item){
                                $subtotal+= ceil($item->weight * $item->product->price() * $item->quantity  );
                            }
                            echo $subtotal;
                            $dis_val=0;
                            $total=$subtotal;
                        ?></span></li>
                        <li><span>Shipping</span> <span></span><span>Free</span></li>
                        @if (session()->has('coupon'))
                        @php
                        $coupon= session()->get('coupon');
                        @endphp
                        <li><span>Discount({{$coupon['coupon_code']}})</span><span></span><span>Rs.
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
                        </span></li>
                        @endif
                        <li><span>Total</span> <span></span><span>Rs. 
                            <?php 
                  $total=0;
                   $total=$subtotal - $dis_val;
                   if($total<0) $total=0;
                   echo $total;
                   ?> 
                   </span></li>
                    </ul>
                    @endif
                    <style>
                        .order-details-form li span:nth-child(1){
                            width:50%;
                        }
                        .order-details-form li span:nth-child(2){
                            width:20%;
                        }
                        
                        .order-details-form li span:nth-child(3){
                            width:30%;
                            text-align:right;
                        }
                    </style>
                    <div id="accordion" role="tablist" class="mb-4">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                               <div class="custom-control custom-radio d-block mb-2">
                                   <input type="radio" class="custom-control-input" id="customCheck2" value="1"  name="payment-method" checked>
                                   <label class="custom-control-label" for="customCheck2">Cash On Delivery</label>
                               </div>
                              {{--
                               <div class="custom-control custom-radio d-block mb-2">
                                    <input type="radio" class="custom-control-input" id="esewa" value="3"  name="payment-method" >
                                    <label class="custom-control-label" for="esewa">Esewa no:9876543210</label>
                                </div>--}}
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn1" id="btn-sb" onclick="disable()">Place Order</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')


<script>
function disable(){
    document.getElementById('btn-sb').disabled = true;
		//alert("Button ");
		document.getElementById('checkout-form').submit();
}
</script>
<style>
    .btn1:disabled , .btn1[disabled] {
    opacity: 1;
}
.reqrd{
    color:red !important;
    font-size: 16px;
}
</style>


@endsection