<nav class="navbar navbar-expand-lg custom-nav" style="margin-bottom: 5px;background:rgb(23, 117, 199);">
		<div class="container">
			<a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" alt="" height="50px"></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navb">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item {{request()->path()=='/' ? 'active' : ''}}">
						<a class="nav-link" href="{{url('/')}}">Home</a>
					</li>
					
					<li class="nav-item {{request()->path()=='product' ? 'active' : ''}}">
						<a class="nav-link" href="{{url('/product')}}">Products</a>
					</li>
					
					<li class="nav-item {{request()->path()=='contact' ? 'active' : ''}}">
						<a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
					</li>
				@guest
				    <li class="nav-item {{request()->path()=='login' ? 'active' : ''}}">
						<a class="nav-link"  href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
					<li class="nav-item {{request()->path()=='register' ? 'active' : ''}}">
						<a class="nav-link"  href="{{ route('register') }}">Signup</a>
					</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }}
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						  @if(Auth::user()->role && Auth::user()->role->name=="Admin")
						  <a class="dropdown-item" href="{{url('home')}}">Home</a>
						  @endif
						<a class="dropdown-item" href="{{url('dashboard')}}">Dashboard</a>
						
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
		</div>
	</nav>