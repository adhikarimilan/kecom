@extends('layouts.app')
@section('content')
@if($orderprods[0]->order->canceled==1)
<h3 class="m-3 text-center alert-danger alert">This order has been canceled</h3>
@elseif($orderprods[0]->order->shipped)
<h3 class="m-3 text-center alert-info alert">This order has been shipped</h3>
@else
<h3 class="m-3 text-center">{{$orderprods[0]->order->verified==1?'This order has been Verified':'This order is not verified yet'}}</h3>
@endif
@if(count($orderprods)>0)
<div class="table-responsive">
<table class="table  table-striped m-2" border='1'>
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
            <td><b><a href="{{url('/product/'.$orderprod->product->slug)}}">{{$orderprod->product->name}}</a></b><br>
                </td>
            <td>Rs. {{$orderprod->product_price}}</td>
            <td>{{$orderprod->quantity}}</td>
            <td>{{ceil($orderprod->product_price*$orderprod->quantity * $orderprod->weight )}}</td>
            
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
<td><b>Grand Total</b></td>
<td></td>
<td></td>
<td></td>
<td>{{$orderprod->order->billing_total}}</td>
        </tbody>
</table>
</div>
<h3 class="m-3">&nbsp;</h3>

@if ($orderprod->order->order_notes)   
<div class="m-3">
<h4>Order notes:</h4>
<p>{{$orderprod->order->order_notes}}</p>
</div>
@endif
<h3 class="m-3">&nbsp;</h3>


@if($orderprods[0]->order->verified==0 && $orderprods[0]->order->canceled==0)
<form action="{{url('/verifyorder')}}" method="post">
        @csrf
<input type="hidden" name="oid" value="{{$orderprods[0]->order->id}}">
<input type="submit" value="Verify Order" class="btn btn-primary btn-lg m-2">
<h5 class="alert alert-info mt-2">Note: please make sure everything is Ok before clicking the verify button</h5>
</form>
@endif
@if($orderprods[0]->order->canceled==0 )
<form action="{{route('order.cancel')}}" method="post">
        @csrf
<input type="hidden" name="oid" value="{{$orderprods[0]->order->id}}">
<input type="submit" value="Cancel Order" class="btn btn-danger btn-lg m-2">
</form>
@else 
<form action="{{route('order.cancel')}}" method="post">
        @csrf
<input type="hidden" name="oid" value="{{$orderprods[0]->order->id}}">
<input type="submit" value="Uncancel Order" class="btn btn-info btn-lg m-2">
</form>
@endif
@if($orderprods[0]->order->shipped==0 && $orderprods[0]->order->verified==1)
<form action="{{url('/markasshipped')}}" method="post">
        @csrf
<input type="hidden" name="oid" value="{{$orderprods[0]->order->id}}">
<input type="submit" value="Mark as Shipped" class="btn btn-primary btn-lg m-2">
<h5 class="alert alert-info mt-2">Note: please make sure everything is Ok before clicking the Mark as Shipped button</h5>
</form>
@endif
@endif
@endsection