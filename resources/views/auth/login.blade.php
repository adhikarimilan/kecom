@extends('layout.app')

@section('content')
<section class="login-section login-background font-2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="login-signup-form">
					<form method="POST" action="{{ route('login') }}">
                        @csrf
						<h2>Login</h2>
						<div class="form-group">
							<label>Email</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter your email"  value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password"  value="{{ old('password') }}" required autofocus>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <button type="submit" class="btn btn1">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                    <a class='float-right' href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
						</div>
                        <hr />
                        @if (Route::has('register'))
                        <div class="text-center"><a href="{{ route('register') }}">Don't have an account? Signup now</a></div>
                        @endif
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
