<h2 class="text-center">Cart page</h2>
@if(count($items)>0)
<div class="container">
<table class="table  table-striped" border='1'>
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Total</th>
        <th scope="col">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
@foreach ($items as $item)

      <tr>
        <td><img src="{{asset('product_images/'.$item->product->image)}}" style='height:180px;'></td>
      <td><b><a href="{{url('/product/'.$item->product->slug)}}">{{$item->product->name}}</a></b><br>
          <ul>
            <li>{{$item->weight}} lbs</li>
            <li>{{$item->flavour->name}}</li>
          <li>{{$item->message!=""?$item->message:'Not provided'}}</li>
          </ul>
        </td>
        <td>Rs. {{$item->product->price * $item->weight}}</td>
        <td>{{$item->quantity}}</td>
        <td>Rs. {{$item->quantity * $item->product->price * $item->weight}}</td>
        <td>
        <form action="{{url('delfromcart')}}" method="post">
        <input type="hidden" value="{{$item->id}}" name='id'>
        @csrf
          <button type='submit' class='btn btn-danger'>&times;</button>
        </form>
        </td>
      </tr>
@endforeach
    </tbody>
    </table>
</div>
    <div class="row m-10">
        <div class="col-lg-8">&nbsp;</div>
        <div class="col-lg-4 p-5">
          <h3>Cart Total</h3> 
        <h4>Rs. <?php
            $total=0; 
            foreach($items as $item){
                $total+=$item['weight'] * $item['product']['price'] * $item['quantity'] ;
            }
            echo $total;
        ?></h4> 
        <br>
        @guest
        <a title="Checkout" href="{{url('/checkout')}}" class="btn btn-primary text-white btn-lg">Login to Checkout</a>  
        @else
        <a title="Checkout"  href="{{url('/checkout')}}" class="btn btn-primary text-white btn-lg">Proceed to Checkout</a>  
        @endguest
        
        </div>
    </div>
    <script>
        document.getElementById('cart-badge').innerHTML={{count($items)}};
    </script>
@else
<h1 class="text-center">Currently Your Cart is empty</h1>
<a href="{{url('/product')}}" class="btn btn-primary btn-lg">Go Shopping</a>
@endif
