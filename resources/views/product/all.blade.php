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
        <h1 class="h3 mb-2 text-gray-800">View all Products</h1>
        <a href="{{url('/addproduct')}}" class="btn btn-primary mb-2">Add new</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
          </div>
          <div class="card-body">
              @if(count($products)>0)
            <div class="table-responsive">
              <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>Product</th>
                    <th><i class="far fa-star"></i></th>
                    <th>Price</th>
                    <th>Sale price</th>
                    <th>Stock</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>Product</th>
                    <th><i class="far fa-star"></i></th>
                    <th>Price</th>
                    <th>Sale price</th>
                    <th>Stock</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
                <tbody>
                @foreach($products as $product)
                  <tr>
                  <td><img src="{{asset('product_img/'.$product->image)}}" alt="{{$product->name}}" style="height:50px;width:50px;"></td>
                  <td><h5><a href="{{url('product/'.$product->slug)}}">{{$product->name}}</a></h5></td>
                  <td >
                    <div class="spinner-grow" role="status" id='{{'sp-'.$product->id}}' style="display:none;">
                      <span class="sr-only">Loading...</span>
                    </div>
                  <i class="@if ($product->featured)fas @else far @endif fa-star text-primary" onclick="togglefeat({{$product->id}},this)" style="cursor: pointer;"></i>
                  
                  </td>
                  <td>Rs. {{$product->reg_price}}</td>
                  <td>{{$product->sale_price ?? '-'}}</td>
                  <td>{{$product->stock_quantity ?? '-'}}</td>
                    <td><a href="{{url('editproduct/'.$product->id)}}" class="btn btn-primary  mb-2">Edit</a></td>
                    <td><form method="POST" action="{{url('delproduct')}}" style="display:inline;">
                            @csrf
                            {{method_field('delete')}}
                        <input type="hidden" value="{{$product->id}}" name='id'>
                        <input type="submit" class="btn btn-danger mb-2" value="Delete">
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
@section('scripts')
    <script>
      function togglefeat(id,v){
        console.log(id)
        let url="{{url('togglefeatured')}}";
        let sp='#sp-'+id;
        $(sp).show();
        $(v).hide();
        $.ajaxSetup({
	    headers: {
	    'X-CSRF-TOKEN': '{{csrf_token()}}'
	    }
	});
		  $.ajax({
		  type: 'POST',
		  url: url,
		  data: {
			pid:id
		   },
		  cache: false, 
		  success: function(response){ 
        console.log(response);
		    if(response.data=='200'){
        if($(v).hasClass('far')){
          $(v).removeClass('far');
          $(v).addClass('fas')
        }
        else{
          $(v).removeClass('fas');
          $(v).addClass('far')
        }} 
        $(v).show();
        $(sp).hide();
	    },
		catch :function(response){
		  alert('an error occured');
		 },
			
     
		//   },
		  dataType: 'json'
		  
	  });
    
      }
    </script>
@endsection
