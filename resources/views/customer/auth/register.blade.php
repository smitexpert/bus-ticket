
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Agent Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('backend/agent/login') }}/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/agent/login') }}/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-20 p-b-20">
				<form class="login100-form validate-form" action="{{ route('customer.account.create') }}" method="POST">
                    @csrf
                    <span class="login100-form-title text-center p-b-20">
						Welcome To Jatra
					</span>
					<span class="login100-form-avatar">
						<img src="{{ asset('logo') }}/jatra_logo.jpg" alt="AVATAR">
					</span>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
					@endif
					@if(Session::has('error'))
						<div class="m-t-20 m-b-20">
							<div class="alert alert-danger">
								<strong>Error!</strong> {{ Session::get('error') }}
							</div>
						</div>
					@endif

					<div class="wrap-input100 validate-input m-b-35" data-validate = "Enter Name">
						<input class="input100" type="text" name="name" required>
						<span class="focus-input100" data-placeholder="Name"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-35" data-validate = "Enter Phone Number">
						<input class="input100" type="text" name="phone" required>
						<span class="focus-input100" data-placeholder="Phone Number"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password" required>
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<ul class="login-more p-t-20">
						<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a href="{{ route('customer.password.request') }}" class="txt2">
								Password?
							</a>
						</li>
						<li class="m-b-8">
							<span class="txt1">
								Login
							</span>

							<a href="{{ route('customer.login') }}" class="txt2">
								Account?
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('backend/agent/login') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/vendor/daterangepicker/moment.min.js"></script>
	<script src="{{ asset('backend/agent/login') }}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('backend/agent/login') }}/js/main.js"></script>

</body>
</html>