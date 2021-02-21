<a href="{{url('/cart')}}" class="floating-cart">
<span class="f-cart-count">
	@if(isset($cart_no))
	{{$cart_no}}
	@else 
	{{'0'}}
	@endif
</span>
	<img src="{{asset('img/cart-icon.png')}}">
</a>
<footer class="text-center" style="background:rgb(23, 117, 199);">
		<h4>Follow Us On</h4>
		<div class="social-icons">
			<span class="social-icon"><a href="#"><i class="flaticon-facebook-letter-logo"></i></a></span>
			<span class="social-icon"><a href="#"><i class="flaticon-instagram-logo"></i></a></span>
		</div>
		<div class="footer-paaila">
			<p>Crafted with <i class="flaticon-like"></i> by <a href="#">Puset Students</a></p>
		</div>
	</footer>
	<style>
	    .social-icons a:hover{
	        text-decoration:none;
	        opacity:0.9;
	        transition:0.3s all;
	    }
	    .floating-cart{
	    	position: fixed;
	    	bottom: 50px;
	    	right:20px;
	    	z-index: 999;
	    	box-sizing: border-box;
	    	padding: 15px;
	    	border-radius: 50%;
	    	background-color: #fff;
	    	box-shadow: 0 0 15px 10px rgba(0,0,0,0.3);
	    }
	    .floating-cart img{
	    	height: 30px;
	    	width:30px;
	    }
	    .floating-cart .f-cart-count{
	    	height:25px;
	    	width:25px;
	    	line-height: 25px;
	    	font-weight:bold;
	    	font-size:12px;
	    	background-color: red;
	    	color:#fff;
	    	position: absolute;
	    	top:-5px;
	    	right:0px;
	    	text-align:center;
	    	border-radius: 50%;
	    	font-family: 'Nunito', sans-serif;
	    }
	</style>
	<script src="{{asset('js/vendor.js')}}"></script>
	<script src="{{asset('js/main.js')}}"></script>
	<script>
		$(document).ready(function(){
			$(".products-slider").owlCarousel({
				items:1,
				center:true,
				lazyLoad:true,
				loop:true,
				dots:false,
				margin:10,
				autoplay:true	
			})
		});
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMWRSKI_5AoKCq7yxBOeysBFWvOpgmT0E" defer></script>
	<script>
		$(document).ready(function(){
			google.maps.event.addDomListener(window, 'load', init);

			function init() {
				var mapOptions = {
					center: new google.maps.LatLng(26.4541603, 87.2798639),
					zoom: 15,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.DEFAULT,
					},
					disableDoubleClickZoom: false,
					mapTypeControl: true,
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					},
					scaleControl: true,
					scrollwheel: false,
					streetViewControl: true,
					draggable : true,
					overviewMapControl: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					styles: [{stylers:[{saturation:-40},{gamma:1}]},{elementType:"labels.text.stroke",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.text",stylers:[{visibility:"on"}]},{featureType:"poi.business",elementType:"labels.icon",stylers:[{visibility:"on"}]},{featureType:"poi.place_of_worship",elementType:"labels.text",stylers:[{visibility:"on"}]},{featureType:"poi.place_of_worship",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"water",stylers:[{visibility:"on"},{saturation:50},{gamma:0},{hue:"#50a5d1"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{color:"#333333"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{weight:0.5},{color:"#333333"}]},{featureType:"transit.station",elementType:"labels.icon",stylers:[{gamma:1},{saturation:50}]}]
				}
				var map;
				var mapElement;
				mapElement = document.getElementById('map');
				map = new google.maps.Map(mapElement, mapOptions);
				var locations = [
				['Kiran Cake Parlour', 26.4541603, 87.2798639]
				];
				for (i = 0; i < locations.length; i++) {
					marker = new google.maps.Marker({

						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						map: map
					});
				}
			}
		});
	</script> 