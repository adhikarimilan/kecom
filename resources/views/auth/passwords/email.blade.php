@extends('layout.app')

@section('content')
<section class="login-section login-background font-2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="login-signup-form">
					<form method="POST" action="{{ route('password.email') }}">
                        @csrf
						<h2>Reset Password</h2>
						<div class="form-group">
							<label>Email</label>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter your email" id="email" required value="{{old('email')}}">
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
						</div>
						<hr />
                    <div class="text-center"><a href="{{route('register')}}">Don't have an account? Signup now</a></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
