<?php
$active_menu="Backendteam";
?>
<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);
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
						<h4><a href="<?php echo site_url('user_master/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">User Master</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="#"  class="breadcrumb-item"><span class="breadcrumb-item active">User Master</span></a>
							
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

					<?php
					if($this->session->tempdata('failed'))
					{
					?>
					<div class="alert bg-danger alert-styled-left" >
						<button type="button" class="close" data-dismiss="alert"></button>
						<span class="text-semibold" class="flash" style="color:white;"><?php echo $this->session->tempdata('failed'); ?></span>
					</div>
					<?php 
					}
				?>
						

					 <form class="form-horizontal" action="<?php echo site_url('user_master/update_user_master/'.$user_master[0]['id']);?>" method="POST" enctype="multipart/form-data">
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        
						<!-- Other inputs -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">User Master</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
                                        <label>User Type: <span class="text-danger">*</span></label>
											<select class="form-control" name="userType" id="userType" required>
												<option value="0" <?php if($user_master[0]['user_type']==0){ echo "selected";}?>>Admin</option>
                                                <option value="1" <?php if($user_master[0]['user_type']==1){ echo "selected";}?>>Finance</option>
                                                <option value="2" <?php if($user_master[0]['user_type']==2){ echo "selected";}?>>HR Operations</option>
                                                <option value="3" <?php if($user_master[0]['user_type']==3){ echo "selected";}?>>Compliance</option>
                                                <option value="4" <?php if($user_master[0]['user_type']==4){ echo "selected";} ?>>Recruitment</option>
                                                <option value="5" <?php if($user_master[0]['user_type']==5){ echo "selected";} ?>>Sales</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Emp ID: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php echo $user_master[0]['emp_id'];?>"  required autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label> Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="name" id="name"  value="<?php echo $user_master[0]['name']?>" required autocomplete="off" onkeypress="return isalpha();">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>User Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="username" id="username"  value="<?php echo $user_master[0]['username']?>" required autocomplete="off" onkeypress="return isalpha();">
										</div>
									</div>
								</div>
                                <div class="row">
									<div class="col-md-6">
										<div class="form-group">
                                        <label>Password: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="password" id="password"  value="<?php echo $user_master[0]['password']?>" onchange="check_password();"  required autocomplete="off">											
										</div>
										<span id="pass-err" class="feild-error">Password should contain alpha, numeric, special charecter, and minimum length 6 digits</span>
									</div> 
									<div class="col-md-6">
										<div class="form-group">
											<label>Confirm Password: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="confirm_password"  id="confirm_password"   required autocomplete="off" value="<?php echo $user_master[0]['password']?>">
										</div> 
									</div>
									<span id="conpass-err" class="feild-error">Password and conformation password is mismatched</span>
								</div>
                                <div class="row">
									<div class="col-md-6">
										<div class="form-group">
                                        <label>Status: <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status">
										<option value="0" <?php if($user_master[0]['status']==0){ echo "selected";}?> >Active</option>
										<option value="1" <?php if($user_master[0]['status']==1){ echo "selected";}?>>In-active</option>
									</select>											
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                                        <label>Email id: <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"  id="email"   required autocomplete="off" value="<?php echo $user_master[0]['email']?>" maxlength="50"> 										
										</div>
										<span id="err-email" class="feild-error">Invalid email id <span class="monetary">*</span></span>
									</div>
								</div>
        
									<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Update</button>
								</div>
							</div>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</form>
					</div>
				</div>


				<script>
				function isalpha(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode == 32) {
				return true;
			} else if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) || charCode == 13) {
				return false;
			}

		}
				$(document).ready(function() {

						$("#email").change(function(){
								var userinput = $("#email").val();
							var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

							if(!pattern.test(userinput)){
								$("#err-email").css("display","block");
								$("#email").val("");
								}else{
									$("#err-email").css("display","none");
								}

							});
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
			$("#confirm_password").change(function() {
				var password = $("#password").val();
				var con_password = $("#confirm_password").val();
				if (password != con_password) {
					$("#conpass-err").css("display", "block");
					$("#confirm_password").val("");
				} else {
					$("#conpass-err").css("display", "none");

				}
			})

						})
				</script>
</body>
</html>
