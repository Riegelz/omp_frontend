<!DOCTYPE html>
<html lang="en">
<head>
	<title>OMP Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url();?>assets/dist/img/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/css/main.css">
<!--===============================================================================================-->
</head>
<body>

<div id="preloader">
	<div id="statuspreloader" >&nbsp;</div>
</div>
	
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
			<form class="login100-form validate-form" id="ajaxform" name="ajaxform" method="POST" action="<?php echo base_url();?>api/login/?method=api">
				<span class="login100-form-title p-b-55">
					Login
				</span>

				<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid username is required">
					<input class="input100" type="text" name="user" placeholder="Username">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<span class="lnr lnr-envelope"></span>
					</span>
				</div>

				<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
					<input class="input100" type="password" name="pass" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<span class="lnr lnr-lock"></span>
					</span>
				</div>

				<!-- <div class="contact100-form-checkbox m-l-4">
					<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
					<label class="label-checkbox100" for="ckb1">
						Remember me
					</label>
				</div> -->
				
				<div class="container-login100-form-btn p-t-25" id="btn-login" name="btn-login">
					<button class="login100-form-btn">
						Login
					</button>
				</div>

				<!-- <div class="text-center w-full p-t-42 p-b-22">
					<span class="txt1">
						Or login with
					</span>
				</div>

				<a href="#" class="btn-face m-b-10">
					<i class="fa fa-facebook-official"></i>
					Facebook
				</a>

				<a href="#" class="btn-google m-b-10">
					<img src="<?=base_url();?>assets/dist/img/icons/icon-google.png" alt="GOOGLE">
					Google
				</a> -->

				<!-- <div class="text-center w-full p-t-115">
					<span class="txt1">
						Not a member?
					</span>

					<a class="txt1 bo1 hov1" href="#">
						Sign up now							
					</a>
				</div> -->
			</form>
		</div>
	</div>
</div>
	
<script src="<?=base_url();?>assets/dist/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?=base_url();?>assets/dist/vendor/bootstrap/js/popper.js"></script>
<script src="<?=base_url();?>assets/dist/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/dist/vendor/select2/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/dist/js/main.js"></script>
<script src="<?=base_url();?>assets/dist/js/login.js"></script>

<style type="text/css">

#preloader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  opacity:0.4;
  z-index: 9999999;
}

#statuspreloader {
  width: 200px;
  height: 200px;
  position: absolute;
  left: 50%;
  top: 50%;
  background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
  background-repeat: no-repeat;
  background-position: center;
  margin: -100px 0 0 -100px;
}

</style>

</body>
</html>