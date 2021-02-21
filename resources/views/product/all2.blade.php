@extends("layouts.app")
@section("content")
<h2 class="text-center m3">All Products</h2>
<hr>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="">
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
        ( function () {
            $('#protable').DataTable();
        })();
        </script>
<table id="protable" class="display">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr>
        </tbody>
    </table>
@if(count($products)>0)

<div class="row p-5">
    @foreach ($products as $product)
    <div class="col-md-4">
    <img src="{{asset('product_images/'.$product->image)}}" style='height:230px;'>
    <a href="{{url('product/'.$product->slug)}}"><h2 class='p-2'>{{$product->name}}</h2></a>
    <p class='p-1'>{{$product->description}}</p>
    <h3 class='pb-1 text-primary'>Rs:{{$product->price}}</h3>
    <form method="POST" action="{{url('editproduct')}}" style="display:inline;">
        @csrf
    <input type="hidden" value="{{$product->id}}" name='id'>
    <input type="submit" class="btn btn-primary  mb-2" value="Edit">
    </form>
    <form method="POST" action="{{url('delproduct')}}" style="display:inline;">
            @csrf
            {{method_field('delete')}}
        <input type="hidden" value="{{$product->id}}" name='id'>
        <input type="submit" class="btn btn-danger mb-2" value="Delete">
        </form>
    </div>
      <br>  
    @endforeach
</div>

@else

@endif


@endsection