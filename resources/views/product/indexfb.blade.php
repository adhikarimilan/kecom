@extends('layout.app')
@section('content')
<section class="product-banner-section img_wrapper">
    <img src="img/service-back.jpg">
    <div class="pb-caption text-center">
      <span>Our Sweet</span>
      <h1>Products</h1>
    </div>
  </section>
  <section class="products_and_filter"> 
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="prod-sidebar-wrapper">
            <h2 class="prod-side-title">Category</h2>
            <div class="prod-side-list">
              <ul class="list-unstyled">
                @if(count($categories))
                @foreach ($categories as $category)
                <li><a href="{{url('product?cat='.$category->slug)}}">{{$category->name}}</a></li>  
                @endforeach
                @endif
  
              </ul>
            </div>
          </div>
        </div>
  
        <div class="col-md-9">
          <div class="product-list-wrapper">
            <div class="hor-filters d-flex justify-content-between">
              <div class="prod-list-count">
                {{$products->total()}} products found	
              </div>
              <div class="sortby-wrapper">
                <span>sort by:</span>
                <a class="sort-btn" href="#">Popularity</a>
              <a class="sort-btn" href="{{ request()->fullUrlWithQuery(['sort' =>'low_to_high'])}}">Price (Low to High)</a>
                <a class="sort-btn" href="{{ request()->fullUrlWithQuery(['sort' =>'high_to_low'])}}">Price (High to Low)</a>
              </div>
            </div>
            <div class="row">
                @if(count($products)>0)
                @foreach ($products as $product)
              <div class="col-md-4">
                  <a href="{{url('product/'.$product->slug)}}" class="product-wrapper">
                    <div class="img-wrapper">
                      <img src="{{asset('product_img/'.$product->image)}}">
                    </div>
                    <div class="prod-detail">
                      <h3 class="prod-title">{{$product->name}}</h3>
                    <div class="prod-price">Rs.{{$product->price}}</div>
                    </div>
                  </a>
                </div>
              @endforeach
              {{-- <div class="col-md-12">
                <ul class="pagination mt-5">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul> --}}
              </div>
              <div class="col-md-12 m-4">
                {{$products->links()}}
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
{{-- <h2 class='text-center'>All products</h2>
@if(count($products)>0)
<div class="row container">
    @foreach ($products as $product)
    <div class="col-md-6">
    <img src="{{asset('product_images/'.$product->image)}}" style='height:230px;'>
    <a href="{{url('product/'.$product->slug)}}"><h2 class='p-2'>{{$product->name}}</h2></a>
    <p class='p-1'>{{$product->description}}</p>
    <h3 class='p-1 text-primary'>{{$product->price}}</h3>
    <form method="POST" action="{{url('addtocart')}}">
        @csrf
    <input type="hidden" value="{{$product->id}}" name='id'>
    <input type="number" min='1' max='1000' value='1' name='quantity'>
    <input type="submit" class="btn btn-primary" value="Add to Cart">
    </form>
    </div>
      <br>  
    @endforeach
</div>

@else

@endif --}}
@endsection