@extends('layouts.app')
@section('content')
 <script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
@include('inc.messages')
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">View all Coupons</h1>
        <a href="{{route('coupons.create')}}" class="btn btn-primary mb-2">Add new</a>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
          </div>
          <div class="card-body">
              @if(count($coupons)>0)
            <div class="table-responsive">
              <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>coupon name</th>
                    <th>coupon code</th>
                    <th>Discount</th>
                    <th>Start time</th>
                    <th>End Time</th>
                    <th>Max Orders</th>
                    <th>per customer</th>
                    <th>Min Order value</th>
                    <th>Max Dis value</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>coupon name</th>
                    <th>coupon code</th>
                    <th>Discount</th>
                    <th>Start time</th>
                    <th>End Time</th>
                    <th>Max Orders</th>
                    <th>per customer</th>
                    <th>Min Order value</th>
                    <th>Max Dis value</th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
                <tbody>
                @foreach($coupons as $coupon)
                  <tr>
                  <td>{{$coupon->name}}</td>
                  <td>{{$coupon->coupon_code}}</td>
                  <td>
                    @if (!$coupon->discount_type)
                    Rs. {{$coupon->discount_value}}
                    @else 
                    {{$coupon->discount_percent}} %
                    @endif</td>
                    <td>{{$coupon->start_time}}</td>
                    <td>{{$coupon->end_time}}</td>
                    <td>{{$coupon->max_number_orders}}</td>
                    <td>{{$coupon->limit_per_customer}}</td>
                    <td>{{$coupon->minimum_order_value}}</td>
                    <td>{{$coupon->maximum_discount_value}}</td>
                    <td>
                    <a href="{{route('coupons.edit',['id'=>$coupon->id])}}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{route('coupons.destroy',['id'=>$coupon->id])}}" style="display:inline;">
                            @csrf
                            {{method_field('delete')}}
                        <input type="hidden" value="{{$coupon->id}}" name='id'>
                        <input type="submit" class="btn btn-danger " value="Delete">
                        </form></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>

      </div>

@endsection
