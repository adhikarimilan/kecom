<!--	START nav  -->
    <nav class="navbar navbar-expand-lg navbar-light " id="navbar" >
	    {{-- <div class="contai"> --}}
		<a class="navbar-brand" href="{{url('/')}}">
		<img class="navbar-brand nav-img" src="{{asset('img/logo.png')}}" >
	      </a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
	        	<li class="nav-item"><a href="{{url('/about')}}" class="nav-link">About</a></li>
	        	<li class="nav-item"><a href="{{url('/product')}}" class="nav-link">Products</a></li>
	        	<li class="nav-item"><a href="{{url('/service')}}" class="nav-link">Services</a></li>
              <li class="nav-item"><a href="{{url('/cart')}}" class="nav-link"><i class='fas fa-shopping-cart fa-2x'></i><b class="badge bg-light text-primary" style="position: relative;top:-15px;border-radius:50%;" id='cart-badge'>0</b></a></li>
	          <li class="nav-item"><a href="{{url('/contact')}}" class="nav-link">Contact</a></li>
	        </ul>
	        
    {{-- Right Side Of Navbar --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- Authentication Links --}}
                        @guest
                        
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> 
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif  
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="{{url('/home')}}">
                                        Home
                                    </a>
                    

                                     <div class="dropdown-item" role="separator"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                 
                                
                                
                            </li>
                        @endguest
                    </ul>
	      </div>
	    {{-- </div> --}}
	  </nav>
    <!-- END nav -->
    <script>
        console.log(window.pageYOffset);
        

        // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
        var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        console.log(width);
        window.onscroll = function() {
            if(width>992){
            //console.log('nok');
            scrollFunction();
            }
        }

        
        
         function scrollFunction() {
            // console.log('nok');
           if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
               console.log('what');
            document.getElementsByClassName("nav-img")[0].setAttribute('id','nav-img');
            document.getElementById('navbar').style.backgroundColor='rgba(0,0,0,0.2)';
            document.getElementById('navbar').style.padding='1px 16px';
            document.getElementById('navbar').classList.add("fixed-top");
            document.getElementById('nav-img').style.padding='1px 0px';
            document.getElementsByClassName("navbar-brand")[0].style.padding='1px 0px'
            //document.getElementById("logo").style.fontSize = "25px";
          } else {
             //document.getElementById("navbar").style.padding = "80px 10px";
             //document.getElementById("logo").style.fontSize = "35px";
           }

           if(window.pageYOffset<'50'){
               if(document.getElementById('navbar').classList.contains("fixed-top")){
                document.getElementById('navbar').classList.remove("fixed-top");
               }
            document.getElementsByClassName("nav-img")[0].removeAttribute('id');
            document.getElementById('navbar').style.backgroundColor='rgba(255,255,255,1)';
           }
         }
        </script>