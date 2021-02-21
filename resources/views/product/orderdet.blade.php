@extends('layout.app')
@section('content')
<section class="product-banner-section img_wrapper">
                <img src="img/service-back.jpg">
                <div class="pb-caption text-center">
                        <h1>Order Details</h1>
                </div>
        </section>

@if(count($orderprods)>0)
@if($orderprods[0]->order->canceled==1)
<h3 class="m-3 text-center alert-danger p-3">Your order was canceled</h3>
@else
<h3 class="m-3 text-center alert-info p-3">{{$orderprods[0]->order->verified==1?'Your order has been Verified':'Your order is not verified yet'}}</h3>
@endif
<div class="table-responsive">
<table class="table  table-striped" border='1'>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
           
          </tr>
        </thead>
        <tbody>
            <tr>
@foreach($orderprods as $orderprod)
        <td><img src="{{asset('product_images/'.$orderprod->product->image)}}" style='height:180px;'></td>
            <td><a href="{{url('/product/'.$orderprod->product->slug)}}">{{$orderprod->product->name}}</a>
        </td>
            <td>Rs. {{ceil($orderprod->product_price )}}</td>
            <td>{{$orderprod->quantity}}</td>
            <td>{{ceil($orderprod->product_price * $orderprod->quantity * $orderprod->weight )}}</td>
          
        </tr>
@endforeach
<tr>
<td>Sub Total</td>
<td></td>
<td></td>
<td></td>
<td>{{$orderprod->order->billing_subtotal}}</td>
</tr>
<tr>
<td>Discount @if($orderprod->order->billing_discount_code)
({{$orderprod->order->billing_discount_code }})
@endif </td>
<td></td>
<td></td>
<td></td>
<td>(-){{$orderprod->order->billing_discount}}</td>
</tr>
<td>Grand Total</td>
<td></td>
<td></td>
<td></td>
<td>{{$orderprod->order->billing_total}}</td>
        </tbody>
</table>
</div>
@endif
@endsection