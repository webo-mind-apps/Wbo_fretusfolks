<?php
$active_menu="Backendteam";

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
	<script>
		function check_bank_account()
		{
			acc_no=$("#bank_account_no").val();
			con_acc=$("#repeat_acc_no").val();
			
			if(acc_no !="" && con_acc !="")
			{
				if(acc_no !=con_acc)
				{
					alert("Bank Account No Mismatched....!");
					$("#bank_account_no").val("");
					$("#repeat_acc_no").val("");
					$("#bank_account_no").focus();
				}
			}
		}
	</script>
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
						<h4><a href="<?php echo site_url('backend_team');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Back End Management</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('backend_team');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Back End Management</span>
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
							if($this->session->tempdata('abc'))
							{
							?>
							<div class="alert bg-danger alert-styled-left" >
								<button type="button" class="close" data-dismiss="alert"></button>
								<span class="text-semibold" class="flash" style="color:white;"><?php echo $this->session->tempdata('abc'); ?></span>
							</div>
							<?php 
							}
						?>

					 <form class="form-horizontal" action="<?php echo site_url('backend_team/save_team');?>" method="POST" enctype="multipart/form-data">
					     
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        
						<!-- Other inputs -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Back end Details</h5>
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
										<label>Enter Client Name: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="client" id="client" required data-fouc>
												<option value="">Select Client</option>
												<?php
														$i=1;
														foreach($clients as $res)
														{
															echo '<option value="'.$res['id'].'">'.$res['client_name'].'</option> ';
														}
												?>
											</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter FFI Employee ID: <span class="text-danger">*</span></label>
										<input type="text" name="ffi_emp_id" id="ffi_emp_id" required class="form-control" autocomplete="off">
									</div>
								</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Client Employee ID: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="client_emp_id" id="client_emp_id" required autocomplete="off"> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Employee Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="emp_name" id="emp_name" required autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
											<label>Joining Date: <span class="text-danger">*</span></label>
											<div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar5"></i></span>
										</span>
										<input type="text" class="form-control datepicker" name="joining_date" id="joining_date" autocomplete="off" required placeholder="Try me&hellip;">
									</div>
										</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
											<label>Contract End Date: <span class="text-danger">*</span></label>
											<div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar5"></i></span>
										</span>
										<input type="text" class="form-control datepicker" name="contact_end_date" id="contact_end_date" autocomplete="off" required placeholder="Try me&hellip;">
									</div>
										</div>
								</div> 
								</div>
								
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Designation: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="designation" id="designation" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Department: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="department" id="department" required>
									</div>
								</div>
								</div>
								
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="d-block">State: <span class="text-danger">*</span></label>
										<div class="input-group">
											<select class="form-control" name="state" id="state" required>
													<option value="">Select State</option> 
													<?php
														$i=1;
														foreach($states as $row)
														{
															echo '<option value="'.$row['id'].'">'.$row['state_name'].'</option> ';
														}
													?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="d-block">Location: <span class="text-danger">*</span></label>

									<div class="input-group">
										<input type="text" class="form-control" name="location" id="location" required>
									</div>
									</div>
								</div>
								</div>
								
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
											<label>DOB: <span class="text-danger">*</span></label>
											<div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar5"></i></span>
										</span>
										<input type="text" class="form-control datepicker" placeholder="Try me&hellip;" name="dob" id="dob" required>
									</div>
								</div>
								</div>
									<div class="col-md-6">
										<div class="form-group">
												<label class="d-block">Gender: <span class="text-danger">*</span></label>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="gender" value="1" class="form-check-input-styled" checked data-fouc required>
														Male
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="gender" value="2" class="form-check-input-styled" data-fouc required>
														Female
													</label>
												</div>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Fathers Name: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="fname" id="fname" required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Blood Group: <span class="text-danger">*</span></label>
										<div class="input-group">
											<select class="form-control" name="blood_grp" id="blood_grp" required>
												<option value="O+">O+</option> 
												<option value="O-">O-</option> 
												<option value="A+">A+</option> 
												<option value="A-">A-</option> 
												<option value="B+">B+</option> 
												<option value="B-">B-</option> 
												<option value="AB+">AB+</option> 
												<option value="AB-">AB-</option>
											</select>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Qualification: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="qualification" id="qualification" required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Phone1: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="phone1" id="phone1" onkeypress="return isNumber(event)" maxlength="10" required>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Phone2: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="phone2" id="phone2" onkeypress="return isNumber(event)" maxlength="10" required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Email ID: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="email" id="email" required>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Permanent  Address: <span class="text-danger">*</span></label>
											<textarea rows="5" cols="5" class="form-control" placeholder="Enter Address" name="permanent_address" id="permanent_address" required></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Present Address: <span class="text-danger">*</span></label>
											<textarea rows="5" cols="5" class="form-control" placeholder="Enter Address" name="present_address" id="present_address" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter PAN Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" maxlength="10" name="pan_no" id="pan_no" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach PAN: <span class="text-danger">*</span></label>
											<input type="file" id="file_pan" name="file_pan" class="form-input-styled" data-fouc required onchange="validate_file()">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Adhar Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="aadhar_no" id="aadhar_no" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Adhaar Card: <span class="text-danger">*</span></label>
											<input type="file" id="file" name="file_aadhar" class="form-input-styled" data-fouc required onchange="validate_file()">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Driving License No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="driving_license" id="driving_license" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Driving License: <span class="text-danger">*</span></label>
											<input type="file" id="file_license" name="file_license" class="form-input-styled" data-fouc required onchange="validate_file()">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="bank_name" id="bank_name" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Account No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="bank_account_no" id="bank_account_no" onchange="check_bank_account();" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Repeat Bank Account No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="repeat_acc_no" id="repeat_acc_no" onchange="check_bank_account();" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank IFSC CODE: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Enter UAN Generated: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="uan" id="uan" required>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>UAN Type: <span class="text-danger">*</span></label>
											<select class="form-control" name="uan_type" id="uan_type" required>
													<option value="Old">Old</option> 
													<option value="New">New</option> 
												</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>UAN No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="uan_no" id="uan_no" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status: <span class="text-danger">*</span></label>
											<select class="form-control" name="status" id="status" required>
													<option value="0">Active</option> 
													<option value="1">Inactive</option> 
												</select>
										</div>
									</div>
								</div>
								
								
								<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
								</div>
							</div>
						</div>
						<!-- /other inputs -->
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</form>
					</div>
				</div>
				<!-- /floating labels -->

		
			<!-- content area -->


	

			
</body>
</html>
