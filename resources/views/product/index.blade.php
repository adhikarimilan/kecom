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
            <h2 class="prod-side-title d-flex justify-content-between align-items-center"><span style="flex:1">Category</span> <a href="javascript:void(0)" class="d-md-none cat-toggle btn" style="font-size:30px;padding:5px !important;">+</a>
              <div class="clearfix"></div></h2>
            <div class="prod-side-list d-hide">
              <ul class="list-unstyled">
                @if(count($categories))
                @foreach ($categories as $category)
                <li><a href="{{url('product?cat='.$category->slug)}}">{{$category->name}}</a>
                </li> 
                @if ($category->children && count($category->children))
                @foreach ($category->children as $child)
                <li><a href="{{url('product?cat='.$child->slug)}}">&nbsp; {{$child->name}}</a>
                </li>  
                @endforeach
                @endif 
                @endforeach
                @endif
              </ul>
              <hr class="my-4" style="border-bottom:1px solid #382611">
              <ul class="list-unstyled">
                <li><a href="{{url('product')}}">All Products</a></li>
                <li><a href="{{url('product?type=onsale')}}">Onsale Products</a></li>
                <li><a href="{{url('product?type=featured')}}">Featured Products</a></li>
              </ul>
              <hr class="my-4" style="border-bottom:1px solid #382611">
						<form method="get" >
							<div class="input-group mb-3">
							  <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2" name="q" value="{{request('q')}}">
							  <div class="input-group-append">
							    <button class="btn btn1" type="submit">Search</button>
							  </div>
							</div>
						</form>
						<hr class="my-4 d-md-none" style="border-bottom:1px solid #382611">
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
              {{-- <span>sort by:</span>
              <a class="sort-btn" href="#">Popularity</a>
            <a class="sort-btn" href="{{ request()->fullUrlWithQuery(['sort' =>'low_to_high'])}}">Price (Low to High)</a>
              <a class="sort-btn" href="{{ request()->fullUrlWithQuery(['sort' =>'high_to_low'])}}">Price (High to Low)</a> --}}
              <span class="d-inline-block">sort by </span>
							<div class="sort-dropdown d-lg-inline-block">
                  <a class="sort-btn" href="#">Popularity</a>
                  <a class="sort-btn" href="{{ request()->fullUrlWithQuery(['sort' =>'low_to_high'])}}">Price (Low to High)</a>
                    <a class="sort-btn" href="{{ request()->fullUrlWithQuery(['sort' =>'high_to_low'])}}">Price (High to Low)</a>
							</div>
              </div>
            </div>
            <style>
               .products_and_filter .prod-sidebar-wrapper .prod-side-list ul li a:active {
                  color: #e53135;
              }
              @media(max-width:768px){
                .sortby-wrapper{
                  position:relative;
                }
                .sortby-wrapper span{
                  background-color:white;
                  border-radius:4px;
                  padding:5px 15px;
                  display: inline-block;
                }
                .sortby-wrapper span:hover{
                  cursor:pointer;
                }
                .sortby-wrapper span:after{
                  content:"";
                  display: inline-block;
                  vertical-align: middle;
                  margin-top:-2px;
                  width:8px;
                  height:8px;
                  border-left:1px solid #444;
                  border-bottom:1px solid #444;
                  transform: rotate(-45deg);
                }
                .sort-dropdown{
                  position: absolute;
                  top:30px;
                  right:0;
                  background:white;
                  border-radius:4px;
                  padding:15px;
                  min-width:250px;
                  box-shadow: 0 0 15px rgba(90,90,90,0.3);
                  z-index:1;
                  display:none;
                }
                .sort-dropdown.show{
                  display:block;
                }
                .sort-dropdown a{
                  display:block;
                  margin-top:5px;
                  margin:0;
                  background-color:transparent !important; 
                }
                .sort-btn:active, .sort-btn:hover{
                    background-color:#e53135 !important;
                }
                .prod-side-list{
                  transition: 0.4s all linear;
                }
                .prod-side-list.d-hide{
                  visibility: hidden;
                  opacity:0;
                  height:0;
                }
              }
            </style>
            <script type="text/javascript">
              document.querySelector(".sortby-wrapper span").onclick = function(){
                document.querySelector(".sort-dropdown").classList.toggle("show");
              }
              document.querySelector(".cat-toggle").onclick = function(){
                document.querySelector(".prod-side-list").classList.toggle("d-hide");
              }
            </script>
            @if(request('q'))
            <div class="row alert alert-info mx-1">
              <div class="">
                <span class="p-4">Showing the results of &quot;{{ request('q') }}&quot;</span>
              </div>
            </div>
            @endif
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
                    <div class="prod-price">
                      @if ($product->sale_price)
								<del class="text-dark">Rs.{{$product->reg_price}}</del>
									<span class="prod-price">Rs.{{$product->sale_price}}</span>	
								@else
								<span class="prod-price">Rs.{{$product->price()}}</span>	
								@endif
                      </div>
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