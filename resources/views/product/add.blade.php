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
   <h2 class="text-center mt-3 mb-3">Add a Product</h2>
   <hr>
   @include('inc.messages')
   <div class="container mt-5">
   <form action="{{url('product/save')}}" method="post" enctype="multipart/form-data">
        <div class="form-section">
            @csrf
        <h5>plese fill the form below and click the submit button</h5>
        <div class="form-wrap">
        <div class="form-row">
            <div class="form-group col-lg-4">
              <label for="">Product Name</label>
              <input type="text" class="form-control" id="name"  name="name">
            </div>
        
            <div class="form-group col-lg-4">
              <label>Price</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                        <span class="input-group-text" id="rs-addon">Rs</span>
                      </div>
                  <input type="number" class="form-control" id="price"  aria-describedby="rs-addon" name="reg_price" value="">
                    </div>
            </div>
            <div class="form-group col-lg-4">
              <label>Sale Price</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                        <span class="input-group-text" id="rs-addon">Rs</span>
                      </div>
                  <input type="number" class="form-control" id="price" aria-describedby="rs-addon" name="sale_price" value="">
                    </div>
            </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-6">
          <label for="">Details</label>
          <textarea  rows="3" class="form-control" id="details" placeholder="enter the product's small details " name="details"></textarea>
        </div>
        <div class="form-group col-lg-6 pt-3 pl-3" >
          <input type="checkbox" name="m_stock" value='1' id="m_stock" class="" style="transform:scale(2,2);width:20px;" onchange="changed(this);">
          <label for="m_stock" >
          Manage Stock
        </label><br>
        <span id="stock" style="display: none;">
          <input type="number" name="stock_quantity" value='1' id="stock_quantity" min="0" style="width:50px;" max="100">
          <label for="stock_quantity" >
          Stock Quantity
        </label>
        </span>
        
        </div>
              <div class="form-group col-lg-12">
                      <label for="">Description</label>
                      <textarea  rows="12" class="form-control" id="description" placeholder="enter the product's description" name="description" style="height:90px;"></textarea>
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
        <div class="form-row">
        <div class="form-group col-lg-6 pt-5" id="msg">
          <input type="checkbox" name="featured" value='1' id='cb' class="" style="transform:scale(2,2);width:20px;">
          <label for="cb">
          Set as Featured
        </label><br>
        </div>
        @if(count($categories)>0)
        <div class="form-group col-lg-2 pt-5">
          <label for="category">Choose a Category</label>
        </div>
        <div class="form-group col-lg-4 pt-5">
        {{-- <select name="category[]" id="category" class="form-control" multiple="multiple"> --}}
          
          <legend>
          @foreach($categories as $category)
          <input type="checkbox" name="category[]" id="{{$category->name}}" class="cb" value="{{$category->id}}" @if($category->id==1) {{"checked"}} @endif>
          <label for="{{$category->name}}">{{$category->name}}</label><br>
        {{-- <option value="{{$category->id}}" @if($category->id==1) {{"selected"}} @endif>{{$category->name}}</option> --}}
        @endforeach
      </legend>
        
        {{-- </select> --}}
        </div>
        @endif
        </div>
        <div class="form-row form-group pt-4">
          <div class="col-lg-8"></div>
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
    $('#stock_quantity').val('0');
  }
}

</script>

@endsection