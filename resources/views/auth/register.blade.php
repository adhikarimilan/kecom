@extends('layout.app')

@section('content')
<section class="signup-section login-background font-2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="login-signup-form">
					<form method="POST" action="{{ route('register') }}">
                        @csrf
						<h2>Signup</h2>
						<div class="form-group">
							<label>Full Name</label>
							<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="full name" id='name'>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
						</div>
						{{-- <div class="form-group">
							<label>Phone Number</label>
							<input type="text" name="phno" class="form-control" placeholder="Enter your phone number">
						</div> --}}
						<div class="form-group">
							<label>Email</label>
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter your email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
						</div>
						
						<div class="form-group">
							<label>Password</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password" id="password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" class="form-control" placeholder="Enter your password" name="password_confirmation" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn1">
                                {{ __('Register') }}
                            </button>
						</div>
						<hr />
                    <div class="text-center"><a href="{{route('login')}}">Already have an account? Login now</a></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection
