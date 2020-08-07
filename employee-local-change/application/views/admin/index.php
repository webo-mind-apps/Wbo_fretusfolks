<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Fretus Folks India Pvt Ltd </title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="<?php echo base_url(); ?>admin_assets/assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/demo_pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content login-cover" style="background: url(<?php echo base_url(); ?>admin_assets/global_assets/images/backgrounds/login_cover.jpg) no-repeat;   
    background-size: cover;">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form wmin-sm-400" action="<?php echo site_url('home/process_login'); ?>" method="POST">
					<div class="card mb-0">


						<div class="tab-content card-body">
							<div class="tab-pane fade show active" id="login-tab1">
								<div class="text-center mb-3">
									<img src="<?php echo base_url(); ?>admin_assets/assets/images/logo.png" style="margin-bottom: 5%;border: solid #e6e2e2 1px;padding: 5%;" />
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Your credentials</span>
								</div>
								<?php
								if ($this->session->flashdata('abc', 'error')) {
								?>
									<div class="alert bg-danger alert-styled-left">
										<button type="button" class="close" data-dismiss="alert"></button>
										<span class="text-semibold">Opps!</span> Try agin!
									</div>
								<?php
								}
								?>
								<?php
								if ($this->session->flashdata('password_modifed', 'updated')) {
								?>
									<div class="alert bg-success alert-styled-left">
										<button type="button" class="close" data-dismiss="alert"></button>
										<span class="text-semibold">Password Reset Successfully, </span>Login With New Password
									</div>
								<?php
								}
								?>
								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="email" class="form-control" placeholder="EMP email id" name="iusbkjdsbjkss" id="" required>
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" class="form-control" placeholder="Password" name="njsdhfisieejk" id="" required>
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>


								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-primary btn-block">Sign in</button>
								</div>
								<div style="text-align:center;">
									<a href="<?php echo site_url('home/forgot_password'); ?>">Forgot Password</a>
								</div>
								<!-- Done by Madhusudhan -->
								<span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
							</div>
						</div>
					</div>
			</div>
			</form>
			<!-- /login form -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

</html>
