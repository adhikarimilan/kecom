@extends('layout.app')
@section('content')

<section class="products-slider owl-carousel">
	@foreach ($banners as $banner)
		<div class="product-slide img_wrapper">
		<img src="{{asset($banner->photo)}}" alt="">
		<div class="slide-caption">
			<h3 class="text-center mt-2">{{$banner->title}}</h3>
			<a href="{{$banner->btn_link ?? '#'}}" class="button btn1 px-4 py-2 mt-3">{{$banner->btn_title}}</a>
		</div>
	</div>
	@endforeach
</section>
@if (count($categories) )
<section class="catagories row my-2 mx-1 p-1">
	@foreach ($categories as $category)
	<div class="col-3 img_wrapper cats" style="height:200px;align-items: center;position: relative; display: flex;justify-content: center;cursor: pointer;" onclick="location.href='{{url('product?cat='.$category->slug)}}';">
		<img src="{{asset($category->photo ?? 'cats/no-img.jpg')}}" alt="{{$category->name}}" >
		<div class="slide-caption text-white pt-4" >
			<h3 class="text-center " style='text-transform:capitalize;font-weight:bolder;font-size:25px;'>{{$category->name}}</h3>
			<h5 class="text-center mt-2">Items: {{count($category->products)}}</h5>
		</div>
	</div>
	@endforeach
	
</section>	
@endif

	{{-- <section class="products-section">
		<div class="container">
			<div class="section-header text-center">
				<span>Our Sweet</span>
				<h2>Products</h2>
			</div>
			<div class="section-content mt-5">
				<div class="container">
					<div class="row">
						<div class="col-md-4 mb-4 mb-sm-0">
							<div class="product-block">
								<div class="product-img img_wrapper">
									<img src="img/cakes.jpg" alt="">
								</div>
								<div class="product-name">
									<h3>Cakes</h3>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-4 mb-sm-0">
							<div class="product-block">
								<div class="product-img img_wrapper">
									<img src="img/cup-cakes.jpg" alt="">
								</div>
								<div class="product-name">
									<h3>Cup Cakes</h3>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="product-block">
								<div class="product-img img_wrapper">
									<img src="img/ice-creams.jpg" alt="">
								</div>
								<div class="product-name">
									<h3>Ice Creams</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center mt-5"><a href="services" class="btn btn1">Learn More</a></div>
				</div>
			</div>
		</div>
	</section> --}}
	@if(count($recents))
	<section class="products-section">
			<div class="container">
				<div class="section-header text-center">
					<span>Our</span>
					<h2>Recent Products</h2>
				</div>
				<div class="section-content mt-5 font-2">
					<div class="container">
						<div class="row">
							@foreach ($recents as $recent)
							<div class="col-md-4">
							<a href="{{url('product/'.$recent->slug)}}" class="hp-product">
									<div class="product-block">
										<div class="product-img img_wrapper">
											<img src="{{asset('product_img/'.$recent->image)}}" alt="">
										</div>
	
									</div>
									<div class="product-name">
									<h3 class="prod-title">{{$recent->name}}</h3>
									@if ($recent->sale_price)
									<del >Rs.{{$recent->reg_price}}</del>
										<span class="prod-price">Rs.{{$recent->sale_price}}</span>	
									@else
									<span class="prod-price">Rs.{{$recent->price()}}</span>	
									@endif
									
										
									</div>
								</a>
							</div>
							@endforeach
							</div>							
						</div>
						<div class="text-center mt-5"><a href="{{url('/product')}}" class="btn btn1">View More</a></div>
					</div>
				</div>
			</div>
		</section>
	@endif
	@if(count($onsale))
	<section class="products-section">
			<div class="container">
				<div class="section-header text-center">
					<span>Our</span>
					<h2>Onsale Products</h2>
				</div>
				<div class="section-content mt-5 font-2">
					<div class="container">
						<div class="row">
							@foreach ($onsale as $sale)
							<div class="col-md-4">
							<a href="{{url('product/'.$sale->slug)}}" class="hp-product">
									<div class="product-block">
										<div class="product-img img_wrapper">
											<img src="{{asset('product_img/'.$sale->image)}}" alt="">
										</div>
	
									</div>
									<div class="product-name">
									<h3 class="prod-title">{{$sale->name}}</h3>
										<del >Rs.{{$sale->reg_price}}</del>
										<span class="prod-price">Rs.{{$sale->sale_price}}</span>
									</div>
								</a>
							</div>
							@endforeach
							</div>							
						</div>
						<div class="text-center mt-5"><a href="{{url('/product?type=onsale')}}" class="btn btn1">View More</a></div>
					</div>
				</div>
			</div>
		</section>
	@endif
	@if (count($featured))
	<section class="products-section" style="background:white;">
		<div class="container">
			<div class="section-header text-center">
				<span>Our</span>
				<h2>Featured Products</h2>
			</div>
			<div class="section-content mt-5 font-2 ">
				<div class="">
					<div class="row products-slide owl-carousel">
						@foreach ($featured as $feature)
						<div class="">
						<a href="{{url('product/'.$recent->slug)}}" class="hp-product">
								<div class="product-block">
									<div class="product-img img_wrapper">
										<img src="{{asset('product_img/'.$feature->image)}}" alt="">
									</div>

								</div>
								<div class="product-name">
								<h3 class="prod-title">{{$feature->name}}</h3>
								@if ($feature->sale_price)
								<del >Rs.{{$feature->reg_price}}</del>
									<span class="prod-price">Rs.{{$feature->sale_price}}</span>	
								@else
								<span class="prod-price">Rs.{{$feature->price()}}</span>	
								@endif
								
									
								</div>
							</a>
						</div>
						@endforeach
						</div>							
					</div>
					<div class="text-center mt-5"><a href="{{url('/product?type=featured')}}" class="btn btn1">View More</a></div>
				</div>
			</div>
		</div>
	</section>
	
	@endif
	<section class="services-section">
		<div class="container">
			<div class="section-header text-center">
				<span>Our Awesome</span>
				<h2>Services</h2>
			</div>
			<div class="section-content mt-5">
				<div class="row">
					<div class="col-md-3 mb-4 mb-sm-0">
						<div class="service-block">
							<i class="fab fa-cc-mastercard fa-5x"></i>
							<div class="service-title">Safe payments</div>
						</div>
					</div>
					<div class="col-md-3 mb-4 mb-sm-0">
						<div class="service-block">
							<i class="fas fa-comments fa-5x"></i>
							<div class="service-title">Quick Response</div>
						</div>
					</div>
					<div class="col-md-3 mb-4 mb-sm-0">
						<div class="service-block">
							<i class="fas fa-star fa-5x"></i>
							<div class="service-title">Genuine Products</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service-block">
							<i class="flaticon-van"></i>
							<div class="service-title">Home Delivery</div>
						</div>
					</div>
				</div>{{--
				<div class="text-center mt-5"><a href="services" class="btn btn2">Learn More</a></div>--}}
			</div>
		</div>
	</section>
	{{-- <section class="section-separator">
		<div class="container">
			<span class="sep-line">
				<span class="sep-icon"><i class="flaticon-pancake"></i></span>
			</span>
		</div>
	</section> --}}
	<section class="visit-us">
		<div class="container">
			<div class="section-header text-center">
				<span>Come</span>
				<h2>Visit Us</h2>
			</div>
			<div class="section-content">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3571.287531795418!2d87.27723591342318!3d26.478685483316426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef7472f9bcc871%3A0x4b858f2e58f89754!2sKanya%20Marg%2C%20Biratnagar%2056613!5e0!3m2!1sen!2snp!4v1613828602230!5m2!1sen!2snp"  height="auto" style="border:0;width:100%;" allowfullscreen="" loading="lazy"></iframe>
						</div>
						<div class="col-md-6">
							<div class="contact-details">
								<p><i class="flaticon-placeholder"></i> Kanya Marg, Biratnagar</p>
								<p><i class="flaticon-telephone"></i> 9842123423</p>
								<h4>Opening Hours</h4>
								<p><i class="flaticon-clock"></i> SUN - SAT: 8 A.M. - 9 P.M.</p>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>
	</section>
	

@endsection
@section('scripts')
<script >
		
	$('.products-slide').owlCarousel({
		loop:true,
		margin:3,
		nav:false,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true,
		lazyLoad: true,
		smartSpeed: 2500,
		 responsive:{
			 0:{
				 items:1
			 },
			 600:{
				 items:3
			 },
			 1000:{
				 items:4
			 }
		 }
	})
	</script>
@endsection
@section('styles')
<style>
	.slide-caption{
		transition: cubic-bezier(0.075, 0.82, 0.165, 1) .8s;
	}
	.cats:hover > .slide-caption{
		background:rgba(0,0,0,0.5);
		width: 100%;
		height: 100%;
	}
	a:hover{
		text-decoration:none;
	}
	.button{
		padding: 5px 8px;
		border-radius: 10%;
	}
</style>
	
@endsection
