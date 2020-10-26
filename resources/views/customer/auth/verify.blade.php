
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Customer Verification</title>
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
				<form class="login100-form validate-form" action="{{ route('customer.account.verify.post') }}" method="POST">
                    @csrf
                    <span class="login100-form-title text-center p-b-20">
						Welcome To Jatra
					</span>
					<span class="login100-form-avatar">
						<img src="{{ asset('logo') }}/jatra_logo.jpg" alt="AVATAR">
                    </span>
                    @if(Session::has('error'))
						<div class="m-t-20 m-b-20">
							<div class="alert alert-danger">
								<strong>Error!</strong> {{ Session::get('error') }}
							</div>
						</div>
					@endif
                    <p class="text-center m-t-20 p-b-40">
                        Enter Verification Code
                    </p>
					<div class="wrap-input100 validate-input m-b-35" data-validate = "Enter Verification Code">
						<input class="input100" type="text" name="verify" minlength="6" maxlength="6" pattern="[0-9]{6}" required>
						<span class="focus-input100" data-placeholder="Verification Code"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
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