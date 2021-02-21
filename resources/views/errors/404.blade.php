@extends('layout.app')
@section('content')
<section class="product-banner-section img_wrapper">
        <img src="{{asset('img/service-back.jpg')}}">
        <div class="pb-caption text-center">
        
            <h1>Error</h1>
        </div>
    </section>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div style="padding:30vh 0;">
                <h3>404 Error</h3>
                <p>The page you are looking for was not found.</p>
                <a href="{{url('/product')}}" class="btn btn1">View Product</a>
            </div>
        </div>
    </div>
</div>
@endsection