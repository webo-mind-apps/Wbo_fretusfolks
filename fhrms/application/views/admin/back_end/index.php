<?php
$active_menu="index";
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
	<!-- /theme JS files -->
<!-- Theme JS files -->
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/anytime.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

	<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
	<!-- /theme JS files -->
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							
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

						<div class="card">
							<div class="card-header header-elements-inline">
								<h3 class="card-title">Employee Details&nbsp;</h3>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body" style="font-size: 13px;">
							
								<div class="row"> 
								 
									<div class="col-md-4">
										<div class="form-group">
											<label><b>Employee Name: </b><span><?php echo $employee[0]['emp_name'];?></span> </label><br/>
											<label><b>DOJ: </b><span><?php echo date('d-m-Y',strtotime($employee[0]['joining_date']));?></span> </label> <br/>
											<label><b>Department: </b><span><?php echo $employee[0]['department'];?></span> </label> <br/>
											<label><b>UAN No: </b><span><?php echo $employee[0]['uan_no'];?></span> </label> <br/>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label><b>Employee Id(FFI ID): </b><span><?php echo $employee[0]['ffi_emp_id'];?></span> </label><br/>
											<label><b>Designation: </b><span><?php echo $employee[0]['designation'];?></span> </label><br/>
											<label><b>Location: </b><span><?php echo $employee[0]['location'];?></span> </label><br/>
										 
											
										</div>
									</div> 
									<div class="col-md-4">
										<div class="form-group">
											<label><b>DOB: </b><span><?php echo date('d-m-Y',strtotime($employee[0]['dob']));?></span> </label><br/> 
											<label><b>Employee Contact No: </b><span><?php echo $employee[0]['phone1'];?></span> </label><br/>
											<label><b>Adhar No: </b><span><?php echo $employee[0]['aadhar_no'];?></span> </label><br/>
											
										</div>
									</div>
								</div> 
								
					 
								
							</div>
						</div>
					</div>
				</div>
				<!-- /floating labels -->

		
			<!-- content area -->


	

			
</body>
</html>
