<?php
$active_menu="Backendteam";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Fretus Folks India Pvt Ltd </title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/inputs/inputmask.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/extensions/jquery_ui/core.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/tags/tagsinput.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/tags/tokenfield.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/inputs/maxlength.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/inputs/formatter.min.js"></script>

	
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_floating_labels.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>	
	<!-- /theme JS files -->
<!-- Theme JS files -->

	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	
	<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
	<script src="<?php echo base_url();?>admin_assets/assets/js/custom.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_layouts.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/date/jquery-ui.js"></script>
		<script>
		   $( function() 
		   {
				var d = new Date();
				d.setFullYear(d.getFullYear()+10);
		   
				var date = $('.datepicker').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
				changeYear: true,yearRange: '1970:' + d.getFullYear() }).val();
		   } );
		</script>
	<!-- /theme JS files -->

	<style>
	.feild-error{
		color:red;
		display:none;
	}
	</style>
</head>

<body>

	<!-- Main navbar -->
<?php 
	$this->load->view('admin/back_end/topbar');
?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
	<?php $this->load->view('admin/back_end/menu'); ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><a href="<?php echo site_url('home/dashboard');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Change Password</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Change Password</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<!-- Floating labels -->
				<div class="row">
				
					<div class="col-md-12">

						
						

					 <form class="form-horizontal" action="<?php echo site_url('home/change_psd');?>" method="POST" enctype="multipart/form-data">
                        
						<!-- Other inputs -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">&nbsp;</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Password: <span class="text-danger">*</span></label>
											<input type="password" name="password" id="password" required class="form-control" autocomplete="off" >
										</div>
										<span id="pass-err" class="feild-error">Password should contain alpha, numeric, special charecter, and minimum length 6 digits</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Retype Password: <span class="text-danger">*</span></label>
											<input type="password" class="form-control" name="cpass" id="cpass" required autocomplete="off" >
										</div>
										<span id="conpass-err" class="feild-error">Password and conformation password is mismatched</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
			<script>
$(document).ready(function() {

	$("#password").change(function() {
				var password = $("#password").val();
				// var alpha=/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
				var strength = 0;

				// If password contains both lower and uppercase characters, increase strength value.  
				if (password.match(/([a-zA-Z])/)) strength += 1
				// If it has numbers and characters, increase strength value.  
				if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
				// If it has one special character, increase strength value.  
				if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
				// If it has two special characters, increase strength value.  
				if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
				// Calculated strength value, we can return messages  
				// If value is less than 2  

				if (password.length > 6) {
					if (strength > 2) {

						$("#pass-err").css("display", "none");
					} else {
						$("#pass-err").css("display", "block");
						$("#password").val("");
					}
				} else {

					$("#pass-err").css("display", "block");
					$("#password").val("");

				}

			})
			$("#cpass").change(function() {
				var password = $("#password").val();
				var con_password = $("#cpass").val();
				if (password != con_password) {
					$("#conpass-err").css("display", "block");
					$("#cpass").val("");
				} else {
					$("#conpass-err").css("display", "none");

				}
			})
		
})

</script>
</body>
</html>
