@extends('layouts.app')
@section('content')

   <h2 class="text-center mt-3 mb-3">Edit Coupon</h2>
   <hr>
   <div class="container mt-5">
   <form action="{{route ('coupons.update',['id'=>$coupon->id])}}" method="post" enctype="multipart/form-data">
        <div class="form-section">
          {{ method_field('patch')}}
            @csrf
        <h5>please fill the form below and click the submit button</h5>
        <div class="form-wrap">
        <div class="form-row">
            <div class="form-group col-lg-4">
              <label for="">Coupon Name</label>
            <input type="text" class="form-control" id="name" placeholder="dewali special" name="name" required value="{{$coupon->name}}">
            </div>
        
            <div class="form-group col-lg-4">
              <label for="">Coupon code</label>
              <input type="text" class="form-control" id="details" placeholder="dewalispecial12" name="coupon_code" required value="{{$coupon->coupon_code}}">
            </div>
            <div class="form-group col-lg-4">
                <label>Limit Per Customer</label>
                <div class="input-group mb-3">
                 
                        <input type="number" class="form-control" id="" placeholder="" min='1'  max="25" value="{{$coupon->limit_per_customer}}" aria-describedby="basic-addon1" name="limit_per_customer">
                         <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon1">times</span>
                        </div>
                      </div>
              </div>
        </div>
        <div class="form-row">
          <div class="form-group col-lg-4">
            <label for="">Minimum Order value </label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon2">Rs. </span>
            </div>
            <input type="number" class="form-control" id="minimum_order_value" placeholder="" name="minimum_order_value" required value="{{$coupon->minimum_order_value}}">
            </div>
          </div>
      
          <div class="form-group col-lg-4">
            <label for="">Maximum no of Orders</label>
            <input type="number" class="form-control" id="details" placeholder="" name="max_number_orders" value="{{$coupon->max_number_orders}}">
          </div>
      </div>
        <div class="form-row">
                <div class="form-group col-lg-12">
                        <label for="">Discount type</label><br>
                        <label for="dis1"><input type="radio" name="discount_type" id="dis1" class="rd" value="0" 
                          @if($coupon->discount_type=='0')checked @endif onchange="changed(this)">Value based</label>
                        <label for="dis2"><input type="radio" name="discount_type" id="dis2" class="rd" value="1" onchange="changed(this)" @if($coupon->discount_type=='1')checked @endif >Percentage based</label>
                      </div>
        </div>

        <div class="form-row value">
          <div class="form-group col-lg-4">
              <label>Discount Value</label>
              <div class="input-group mb-3">
               <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1">Rs. </span>
                      </div>
                      <input type="number" class="form-control disval" id="price" placeholder="" min='1'   aria-describedby="basic-addon1" name="discount_value" value="{{$coupon->discount_value}}">
                 </div>
            </div>
      </div>
      <div class="form-row percent">
        <div class="form-group col-lg-4">
            <label for="">Discount Percentage</label>
            <div class="input-group mb-3">
            <input type="text" class="form-control perc" id="details" placeholder="" name="discount_percent" min="1" max="99" value="{{$coupon->discount_percent}}">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon1">%</span>
            </div>
          </div> 
          </div>
          <div class="form-group col-lg-4">
              <label>Maximum Discount Value</label>
              <div class="input-group mb-3">
               <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1">Rs. </span>
                      </div>
                      <input type="text" class="form-control perc" id="pr" placeholder="" min='1'   aria-describedby="basic-addon1" name="maximum_discount_value" value="{{$coupon->maximum_discount_value}}">
                 </div>
            </div>
      </div>

        <div class="form-row">
        <div class="form-group col-lg-4 pt-5" id="msg">
          <input type="checkbox" name="time_based" value='1' id='cb' class="" style="transform:scale(2,2);width:20px;" 
          @if($coupon->time_based)checked @endif
          onchange="cbchanged(this);" >
          <label for="cb">
          Set timer
        </label>
      </div>
      <div class="form-group col-lg-4 pt-5 timer" >
        <label for="">from: </label>
        <input @if($coupon->start_time) type="datetime" @else type="datetime-local" @endif name="start_time" id="" class="dtime" value="{{$coupon->start_time}}">
      </div> 
      <div class="form-group col-lg-4 pt-5 timer" >
        <label for="">to: </label>
        <input @if($coupon->end_time) type="datetime" @else type="datetime-local" @endif name="end_time" id="" placeholder="end time" class="dtime" value="{{$coupon->end_time}}">
      </div>
        </div>
        <div class="form-row form-group pt-4">
          <div class="col-lg-8"></div>
          <div class="col-lg-4">
        <button type="submit" id="submit" class="btn btn-primary form-control btn-lg">SUBMIT</button>
      </div>
      </div>
        </div>
   </form>
   </div>
   <script>
   function changed(hi){
     if(hi.value=='1'){//percentage
      $('.value').hide();
      $('.percent').show();
      //$('.disval').val('');
     }
     else
     {
      $('.percent').hide();
      $('.value').show();
      //$('.perc').val('');
     }
}
function cbchanged(arg){
  if(arg.checked){
    $('.timer').show();
  }
  else{
    $('.timer').hide();
    //$('.dtime').val('');
  }
}

$(document).ready(function(){
  let distype = $("input[name='discount_type']:checked").val();
  //let cb=$("input[name='time_based']:checked");
  //console.log(cb);
  if(distype=='0'){
   $('.percent').hide(); 
  }
  else{
    $('.value').hide();
  }
})
   </script>
@endsection