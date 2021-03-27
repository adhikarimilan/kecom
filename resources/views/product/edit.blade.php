@extends('layouts.app')
@section('content')
<style>
    .dynamic{
      margin-right: 3px;
    }
    legend{
      border:1px solid gray;
      padding: 10px 10px;
    }
    .cb{
      transform: scale(2,2);
      width:20px;
    }
  </style>
   <h2 class="text-center mt-3 mb-3">Edit Product</h2> 
   <hr>
   @include('inc.messages')
   <div class="container mt-5">
   <form action="{{url('updateproduct')}}" method="post" enctype="multipart/form-data">
        <div class="form-section">
            @csrf
            
        <h5>plese fill the form below and click the submit button</h5>
        <div class="form-wrap">
        <div class="form-row">
            <div class="form-group col-lg-4">
              <label for="">Product Name</label>
            <input type="text" class="form-control" id="name" placeholder="Cake Vanilla" name="name" value="{{$product->name}}">
            </div>
        
            
            <div class="form-group col-lg-4">
                <label>Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                          <span class="input-group-text" id="rs-addon">Rs</span>
                        </div>
                    <input type="number" class="form-control" id="price" placeholder="600" aria-describedby="rs-addon" name="reg_price" value="{{$product->reg_price}}">
                      </div>
              </div>
              <div class="form-group col-lg-4">
                <label>Sale Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                          <span class="input-group-text" id="rs-addon">Rs</span>
                        </div>
                    <input type="number" class="form-control" id="price" aria-describedby="rs-addon" name="sale_price" value="{{$product->sale_price}}">
                      </div>
              </div>
        </div>
        <div class="form-row">
          <div class="form-group col-lg-6">
            <label for="">Details</label>
            <textarea  rows="3" class="form-control" id="details" placeholder="enter the product's description" name="details">{{$product->details}}</textarea>
          </div>
         <div class="form-group col-lg-6 pt-3 pl-3" >
          <input type="checkbox" name="m_stock" value='1' id="m_stock" class="" style="transform:scale(2,2);width:20px;" onchange="changed(this);" @if($product->m_stock) checked @endif>
          <label for="m_stock" >
          Manage Stock
        </label><br>
        <span id="stock" @if(!$product->m_stock) style="display: none;" @endif >
          <input type="number" name="stock_quantity" value='{{$product->stock_quantity}}' id="stock_quantity" min="0" style="width:50px;" max="100">
          <label for="stock_quantity" >
          Stock Quantity
        </label>
        </span>
        
        </div>
                <div class="form-group col-lg-12">
                        <label for="">Description</label>
                        <textarea  rows="8" class="form-control" id="description" placeholder="enter the product's description" name="description">{{$product->description}}</textarea>
                      </div>
        </div>
        <div class="form-row">
            <div class="col-lg-4 pt-5">
                <h5>Image:</h5>
                  <label for="image"><i class="far fa-plus-square fa-5x"></i></label>
                  <input type="file" name="image" id="image" style="display:none;" onchange="readURL(this);">
                  <img id="blah" src="#" alt="your image" style="display:none;"/>
                </div>  
              <div class="col-lg-8 pt-5" >
                  <h5>Additional Images:</h5>
                    <label for="images"><i class="far fa-plus-square fa-5x"></i></label>
                    <input type="file" name="images[]" multiple id="images" style="display:none;" onchange="readtURL(this);">
                    <span id="blahblah"  style="display:none;"></span>
                  </div>
        </div>
        <div class="form-row mt-3">
          <div class="col-lg-4">
            <h5>Current Image:</h5>
          <img src="{{asset('product_img/'.$product->image)}}" alt="{{$product->name}}" style="width:100px;height:100px;">
          </div>
          @if($product->images!=null)
          <div class="col-lg-8">
              <h5>Current Additional Images:</h5>
              <?php 
              $images=explode(" ",$product->images);
              ?>
              @foreach($images as $image)
              <img src="{{asset('extra_images/'.$image)}}" alt="{{$product->name}}" style="width:100px;height:100px;margin-right:2px;">
              @endforeach
          </div>
          @endif
        </div>
        <div class="form-row">
        <div class="form-group col-lg-6 pt-5" id="msg">
        <input type="checkbox" name="featured" value='1' id='cb' class="" style="transform:scale(2,2);width:20px;" @if($product->featured) checked="true" @endif>
          <label for="cb">
          Set as Featured
        </label><br><br>
        </div>
        
        <div class="form-group col-lg-2 pt-5">
          <label for="category">Choose a Category</label>
        </div>
        <div class="form-group col-lg-4 pt-5">
          
          <legend>
          @foreach($categories as $category)
          <input type="checkbox" name="category[]" id="{{$category['name']}}" class="cb" value="{{$category['id']}}" checked >
          <label for="{{$category['name']}}">{{$category['name']}}</label><br>
        @endforeach
        
        @if(isset($cats) && count($cats))
        @foreach ($cats as $cat)
        <input type="checkbox" name="category[]" id="{{$cat['name']}}" class="cb" value="{{$cat['id']}}">
        <label for="{{$cat['name']}}">{{$cat['name']}}</label><br> 
        @endforeach
        
          </legend>
        </div>
        @endif
        </div>
        <div class="form-row form-group pt-4">
          <div class="col-lg-8">
          <input type="hidden" name="id" value="{{$product->id}}">
          </div>
          <div class="col-lg-4">
        <button type="submit" id="submit" class="btn btn-primary form-control btn-lg">SUBMIT</button>
      </div>
      </div>
    </div>
        </div>
   </form>
   </div>
   <script>
      function readURL(input) {
        $('#blah').css('display','none');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
      
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            $('#blah').css('display','inline');
      
            reader.readAsDataURL(input.files[0]);
        }
      }
      function readtURL(input) {
        //alert(input.files.length);
        $('#blahblah').empty();
        for(i=0;i<input.files.length;i++){
          var reader = new FileReader();
      
            reader.onload = function (e) {
              var img = $('<img class="dynamic">');
              img.attr('src',  e.target.result)
                    .width(100)
                    .height(100);
              img.appendTo('#blahblah');
                $('#blahblah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            $('#blahblah').css('display','inline');
            reader.readAsDataURL(input.files[i]);
        }
      }
      </script>
      <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
      <script>
        CKEDITOR.replace( 'description' );
      </script>
@endsection

@section('scripts')
<script>
  function changed(arg){
  if(arg.checked){
    $('#stock').show();
  }
  else{
    $('#stock').hide();
    //$('#stock_quantity').val('0');
  }
}

</script>

@endsection