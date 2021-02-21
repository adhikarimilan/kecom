@extends('layout.app')
@section('content')
    <h2 class="mt-3 mb-3">Checkout</h2>
    <div class="row pl-3 pr-3">
        <div class="col-lg-6  pl-3 pr-3">
        <h2 class="mt-2 mb-3">Order Placed By</h2>
        <h3>Name: {{Auth::user()->name}}</h3>
        <h3>Email: {{Auth::user()->email}}</h3>

        <br>
        <h2 class="mt-2 mb-3">Billing Details</h2>
        <form action="{{url('/placeorder')}}" method="post">
            @csrf
        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" value="" placeholder='billing name' class="form-control" name="billing_name">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" placeholder='Address' class="form-control" name="billing_address">
        </div>
        <div class="form-group">
                <label for="">Email</label>
                <input type="text" placeholder='Address' class="form-control" name="email">
            </div>
            <div class="form-group">
                    <label for="">Phone number</label>
                    <input type="text" placeholder='Phone number' class="form-control" name="phone">
                </div>
             <div class="form-group">
                    <label for="">City</label>
                    <input type="text" placeholder='City' class="form-control" name="city">
            </div>
            <div class="form-group">
                    <label for="">State/Zone</label>
                    <input type="text" placeholder='State' class="form-control" name="state">
            </div>
            <div class="form-group mb-5">
                    <label for="order-notes">Order Notes</label><br>
                    <textarea name="order-notes" id="order-notes"  rows="10" placeholder="special notes about your order" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <h3 class="text-dark mt-2 mb-3">Your Order</h3>
    @if(count($items)>0)
            <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <td>Product</td>
                            <td>Price/Unit</td>
                            <td>Weight</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
    @foreach ($items as $item)
    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->product->price}}</td>
                        <td>{{$item->quantity}} lb</td>
                        <td>{{$item->quantity * $item->product->price}}</td>
                    </tr>
                        @endforeach
                    </tbody>
            </table>
            <h3 class="text-right">Total: <?php
                $total=0; 
                foreach($items as $item){
                    $total+=$item['quantity'] * $item['product']['price'];
                }
                echo $total;
            ?></h3>
    @endif
    <style>
       .radio{
        transform:scale(2);
        width:40px;
        position: relative;
        top:-5px;
        cursor: pointer;
       }
       .label-radio{
           font-size:30px;
           cursor: pointer;
       }
       #submit-btn{
           height: 60px;
           font-size:25px;
           text-transform: uppercase;
       }
    </style>
    <h3 class="m-5">&nbsp;</h3>
    <h3>Payment Method</h3>
    <hr>
    <label class="label-radio"><a title="pay with Bank Voucher">
    <input type="radio" name="payment-method" class="radio" value='2'>Bank voucher</a></label>
    <br>
    <label class='label-radio'><a title="pay with cash upon delivery">
    <input type="radio" name="payment-method" class='radio' value='1'>Cash on Delivery</a></label>
    <br>
    <label class='label-radio'><a title="Trasfer money via Esewa">
    <input type="radio" name="payment-method" class='radio' value='3'>Esewa no : 9876543210</a></label>
    <h3 class="m-2">&nbsp;</h3>
    
        <input type="submit" value="place  order" class="btn btn-primary btn-block" height="20px" id='submit-btn'>
    </form>

    </div>
    </div>
@endsection