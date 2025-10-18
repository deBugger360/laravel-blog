@extends('admin.layout')

@section('title', 'Login | Admin')

@section('content')
{{-- show alert message --}}
@include('admin.partials._flash')

    <div class="container-fluid pb-5">
        
				<div class="row justify-content-md-center">
					<div class="card-wrapper col-12 col-md-4 mt-5">
						<div class="brand text-center mb-3">
							<a href="/"><img src="{{ asset('admin/img/logo.png') }}"></a>
						</div>
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Login</h4>
								<form action="/admin/authenticate" method="POST">
									@csrf
									<div class="form-group">
										<label for="email">Email Address</label>
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @error('email')
                                            <p class="text-danger mt-1 small">{{ $message }}</p>
                                        @enderror
									</div>

									<div class="form-group">
										<label for="password">Password
										</label>
										<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}"  required>
										{{-- <div class="text-right">
											<a href="password-reset.html" class="small">
												Forgot Your Password?
											</a>
										</div> --}}
                                          @error('password')
                                                <p class="text-danger mt-1 small">{{ $message }}</p>
                                           @enderror
									</div>

									<div class="form-group no-margin">
										<button type="submit" class="btn btn-primary btn-block">Login</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
	</div>
@endsection
@section('scripts')
    @include('admin.partials._footerscripts')
@endsection