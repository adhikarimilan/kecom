@extends('layouts.app')
@section('content')
{{-- <style>
.order:hover{
    background: rgba(0,0,255,0.1);
}
</style> --}}
<script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                
            });
        } );
</script>
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">View all {{$cat}} Orders</h1>

        <!-- DataTales  -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
          </div>
          <div class="card-body">
             
            <div class="table-responsive">
  <table class="table table-bordered table-striped" id="table_id" width="100%" cellspacing="0">
    <thead>
        <tr role="row">
            <td class="d-none">&nbsp;</td>
            {{-- <td>order id</td> --}}
            <th>Billing Name</th>
            <th>Billing Address</th>
            <th>Billing Email</th>
            <th>Billing Phone</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Shipped</th>
            <th>Order time</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tfoot>
            <tr>
                <td class="d-none">&nbsp;</td>
                {{-- <td>Order id</td> --}}
                <th>Billing Name</th>
                <th>Billing Address</th>
                <th>Billing Email</th>
                <th>Billing Phone</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Shipped</th>
                <th>Order time</th>
                <th>&nbsp;</th>
            </tr>
        </tfoot>
    <tbody>
 @if(count($orders)>0)
@foreach ($orders as $order)
<tr class="order">
{{-- <td>
<form action="{{url('orderdetails')}}" method="post">
    @csrf
<input type="hidden" value="{{$order->id}}" name='id'>
    <button type="submit" class="btn btn-default">{{$order->id}}</i></button>
</form>
    </td> --}}
    <td class="d-none">&nbsp;</td>
<td>{{$order->billing_name}}</td>
<td>{{$order->billing_address}}</td>
<td>{{$order->billing_email}}</td>
<td>{{$order->billing_phone}}</td>
<td>{{$order->billing_total}}</td>
<td>{{$order->payment_gateway}}</td>
@if($order->canceled==1)
<td><span class="badge badge-pill badge-danger">Canceled</span></td>
@else
@if($order->verified==1)
<td><span class="badge badge-success">Verified</span></td>
@else 
<td><span class="badge badge-warning">not Verified</span></td>
@endif
@endif
@if($order->shipped==1)
<td><span class="badge badge-success">true</span></td>
@else 
<td><span class="badge badge-warning">false</span></td>
@endif
<td>{{time_date_diff($order->created_at)}}</td>
<td>
<form action="{{url('orderdetails')}}" method="post">
    @csrf
<input type="hidden" value="{{$order->id}}" name='id'>
   <button type="submit" class="btn btn-default"><i class='far fa-eye'></i></button>
</form>
</td>
</tr> 
@endforeach
@else
<tr>
    <td colspan="11">nothing found</td>
</tr>
@endif

</div>
</div>
</div>
</div>
@endsection