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
						<h4><a href="<?php echo site_url('candidate_system');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Candidate First Information System</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Candidate First Information System</span>
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
					 <form class="form-horizontal" action="<?php echo site_url('candidate_system/save_candidate');?>" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">New Candidate Details</h5>
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
											<label>Enter Associate Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="emp_name" id="emp_name" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Employee Mobile: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="phone" id="phone" onkeypress="return isNumber(event)" maxlength="10" autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Employee Email ID: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" id="email" autocomplete="off" required>
											</div>
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
											<input type="text" class="form-control" name="location" id="location" autocomplete="off" required>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Designation: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="designation" id="designation" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Department: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="department" id="department" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Date of Interview : <span class="text-danger">*</span></label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" name="interview_date" id="interview_date" required 
												placeholder="Date of Interview" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date of Joining :</label>
											<div class="input-group">
												<span class="input-group-prepend"><span class="input-group-text"><i class="icon-calendar5"></i></span></span>
												<input type="text" class="form-control datepicker" name="joining_date" id="joining_date" placeholder="Date of Joining " autocomplete="off">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Adhar Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="aadhar_no" id="aadhar_no" onkeypress="return isNumber(event)" maxlength="12" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Adhaar Card: <span class="text-danger">*</span></label>
											<input type="file" id="file" name="file_aadhar" class="form-input-styled" data-fouc required onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Driving License No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="driving_license" id="driving_license" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Driving License: <span class="text-danger"></span></label>
											<input type="file" id="file_license" name="file_license" class="form-input-styled" data-fouc  onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Photo: <span class="text-danger">*</span></label>
											<input type="file" id="photo" name="photo" class="form-input-styled" data-fouc required  onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Resume: <span class="text-danger">*</span></label>
											<input type="file" id="resume" name="resume" class="form-input-styled" data-fouc required onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
								</div>
							</div>
						</div>
						<!-- /other inputs -->
					</form>
					</div>
				</div>
				<!-- /floating labels -->
			<!-- content area -->
</body>
</html>
