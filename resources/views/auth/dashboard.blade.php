@extends('layout.app')
@section('content')
<section class="product-banner-section img_wrapper">
        <img src="img/service-back.jpg">
        <div class="pb-caption text-center">
            <h1>Dashboard</h1>
        </div>
    </section>
<div class="container">
        @include('inc.messages')
        <h3 class="text-center m-3">Your Orders</h3>
        @if(count($orders)>0)
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <td>Billing Name</td>
                    <td>Billing Address</td>
                    <td>Total</td>
                    <td>Order Placed at</td>
                    <td>Status</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
        @foreach ($orders as $order)
        <tr>
        <td>{{$order->billing_name}}</td>
        <td>{{$order->billing_address}}</td>
        <td>{{$order->billing_total}}</td>
        <td>{{time_date_diff($order->created_at)}}</td>
        @if($order->canceled==1)
        <td><span class="badge badge-pill badge-danger">Canceled</span></td>
        @else
        @if($order->verified==1)
        <td><span class="badge badge-pill badge-success">Verified</span></td>
        @else 
        <td><span class="badge badge-pill badge-warning">verifying</span></td>
        @endif
        @endif
        <td>
        <form action="{{url('orderdet')}}" method="post">
            @csrf
        <input type="hidden" value="{{$order->id}}" name='id'>
           <button type="submit" class="btn btn-default">view</i></button>
        </form>
        </td>
        </tr>
        @endforeach 
            </tbody>
        </table>
        </div>
        @else 
        <h5 class="alert alert-info text-center">currently you don't have any orders</h5>
        @endif
</div>
@endsection