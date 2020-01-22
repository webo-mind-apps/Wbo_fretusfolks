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
		function pending_update()
		{
			 $("input[type='text']").each(function () 
				 {
					$(this).attr("required",false);					
				 });
			$("#permanent_address").attr("required",false);
			$("#present_address").attr("required",false);
			
			action_url="<?php echo site_url('backend_team/update_team_pending/'.$client[0]['id']);?>";
			 $('#my_form').attr('action', action_url).submit();
		}
		function calculate_gross_salary()
		{
			var basic = isNaN(parseInt($("#basic_salary").val())) ? 0 : parseInt($("#basic_salary").val());
			var hra = isNaN(parseInt($("#hra").val())) ? 0 : parseInt($("#hra").val());
			var conveyance = isNaN(parseInt($("#conveyance").val())) ? 0 : parseInt($("#conveyance").val());
			var medical = isNaN(parseInt($("#medical").val())) ? 0 : parseInt($("#medical").val());
			var special = isNaN(parseInt($("#special_allowance").val())) ? 0 : parseInt($("#special_allowance").val());
			var other = isNaN(parseInt($("#other_allowance").val())) ? 0 : parseInt($("#other_allowance").val());
			
			gross_salary=parseInt(basic)+parseInt(hra)+parseInt(conveyance)+parseInt(medical)+parseInt(special)+parseInt(other);
			$("#gross_salary").val(""+gross_salary);
			calculate_total_ctc();
		}
		function calculate_total_deduction()
		{
			var pt = isNaN(parseInt($("#pt").val())) ? 0 : parseInt($("#pt").val());
			var emp_esic = isNaN(parseInt($("#emp_esic").val())) ? 0 : parseInt($("#emp_esic").val());
			var emp_pf = isNaN(parseInt($("#emp_pf").val())) ? 0 : parseInt($("#emp_pf").val());
			
			total_deduction=parseInt(pt)+parseInt(emp_esic)+parseInt(emp_pf);
			$("#total_deduction").val(""+total_deduction);
			calculate_total_ctc();
		}
		function calculate_total_ctc()
		{
			var employer_pf = isNaN(parseInt($("#employer_pf").val())) ? 0 : parseInt($("#employer_pf").val());
			var employer_esic = isNaN(parseInt($("#employer_esic").val())) ? 0 : parseInt($("#employer_esic").val());
			var mediclaim = isNaN(parseInt($("#mediclaim").val())) ? 0 : parseInt($("#mediclaim").val());
			
			total=parseInt(employer_pf)+parseInt(employer_esic)+parseInt(mediclaim);
			
			gross_salary= isNaN(parseInt($("#gross_salary").val())) ? 0 : parseInt($("#gross_salary").val());
			total_deduction= isNaN(parseInt($("#total_deduction").val())) ? 0 : parseInt($("#total_deduction").val());
			
			ctc=gross_salary+total;
			$("#ctc").val(""+ctc);
			
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
					 <form id="my_form" class="form-horizontal" action="<?php echo site_url('backend_team/update_team/'.$client[0]['id']);?>" method="POST" enctype="multipart/form-data">
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
														foreach($all_clients as $res)
														{
															if($res['id']==$client[0]['client_id'])
															{
																echo '<option value="'.$res['id'].'" selected>'.$res['client_name'].'</option> ';
															}
															else
															{
																echo '<option value="'.$res['id'].'">'.$res['client_name'].'</option> ';
															}
														}
												?>
											</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter FFI Employee ID: <span class="text-danger">*</span></label>
										<input type="text" name="ffi_emp_id" id="ffi_emp_id" required class="form-control" autocomplete="off" value="<?php echo $client[0]['ffi_emp_id'];?>">
									</div>
								</div>
								</div>
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Client Employee ID: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="client_emp_id" id="client_emp_id" autocomplete="off" value="<?php echo $client[0]['client_emp_id'];?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Employee Name: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="emp_name" id="emp_name" autocomplete="off" value="<?php echo $client[0]['emp_name'];?>" required>
									</div>
								</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
												<label>Interview Date: <span class="text-danger">*</span></label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" name="interview_date" id="interview_date" 
												value="<?php if($client[0]['interview_date'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['interview_date']));}?>" required placeholder="Try me&hellip;" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
												<label>Joining Date: <span class="text-danger">*</span></label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" name="joining_date" id="joining_date" 
												value="<?php if($client[0]['joining_date'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['joining_date']));}?>" required placeholder="Try me&hellip;" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
												<label>Contract End Date: <span class="text-danger">*</span></label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" name="contact_end_date" id="contact_end_date" 
												value="<?php if($client[0]['contract_date'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['contract_date']));}?>" required placeholder="Try me&hellip;" autocomplete="off">
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Designation: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="designation" id="designation" autocomplete="off" value="<?php echo $client[0]['designation'];?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Department: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="department" id="department" autocomplete="off" value="<?php echo $client[0]['department'];?>" required>
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
															if($row['id']==$client[0]['state'])
															{
																echo '<option value="'.$row['id'].'" selected>'.$row['state_name'].'</option> ';
															}
															else
															{
																echo '<option value="'.$row['id'].'">'.$row['state_name'].'</option> ';
															}
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
										<input type="text" class="form-control" name="location" id="location" autocomplete="off" value="<?php echo $client[0]['location'];?>" required>
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
										<input type="text" class="form-control datepicker" placeholder="Try me&hellip;" name="dob" id="dob" 
										value="<?php if($client[0]['dob'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['dob']));}?>" required autocomplete="off">
									</div>
								</div>
								</div>
									<div class="col-md-6">
										<div class="form-group">
												<label class="d-block">Gender: <span class="text-danger">*</span></label>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="gender" value="1" <?php if($client[0]['gender']==1){ echo "checked";}?> class="form-check-input-styled" checked data-fouc required>
														Male
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="gender" value="2" <?php if($client[0]['gender']==2){ echo "checked";}?> class="form-check-input-styled" data-fouc required>
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
											<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $client[0]['father_name'];?>" autocomplete="off" required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Blood Group: <span class="text-danger">*</span></label>
										<div class="input-group">
											<select class="form-control" name="blood_grp" id="blood_grp" required>
												<option value="">Select</option>
												<option value="O+" <?php if($client[0]['blood_group']=="O+"){ echo "selected";}?>>O+</option> 
												<option value="O-" <?php if($client[0]['blood_group']=="O-"){ echo "selected";}?>>O-</option> 
												<option value="A+" <?php if($client[0]['blood_group']=="A+"){ echo "selected";}?>>A+</option> 
												<option value="A-" <?php if($client[0]['blood_group']=="A-"){ echo "selected";}?>>A-</option> 
												<option value="B+" <?php if($client[0]['blood_group']=="B+"){ echo "selected";}?>>B+</option> 
												<option value="B-" <?php if($client[0]['blood_group']=="B-"){ echo "selected";}?>>B-</option> 
												<option value="AB+" <?php if($client[0]['blood_group']=="AB+"){ echo "selected";}?>>AB+</option> 
												<option value="AB-" <?php if($client[0]['blood_group']=="AB-"){ echo "selected";}?>>AB-</option>
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
											<input type="text" class="form-control" name="qualification" id="qualification" autocomplete="off" value="<?php echo $client[0]['qualification'];?>" required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Phone1: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="phone1" id="phone1" autocomplete="off" value="<?php echo $client[0]['phone1'];?>" maxlength="10"  onkeypress="return isNumber(event)" required>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Phone2: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="phone2" id="phone2" value="<?php echo $client[0]['phone2'];?>" maxlength="10" onkeypress="return isNumber(event)"  required autocomplete="off">
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Email ID: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="email" id="email" value="<?php echo $client[0]['email'];?>" required autocomplete="off">
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Permanent  Address: <span class="text-danger">*</span></label>
											<textarea rows="5" cols="5" class="form-control" placeholder="Enter Address" name="permanent_address" id="permanent_address" required><?php echo $client[0]['permanent_address'];?></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Present Address: <span class="text-danger">*</span></label>
											<textarea rows="5" cols="5" class="form-control" placeholder="Enter Address" name="present_address" id="present_address" required><?php echo $client[0]['present_address'];?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter PAN Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" maxlength="10" name="pan_no" id="pan_no" value="<?php echo $client[0]['pan_no'];?>" required autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach PAN: </label>
											<input type="file" id="file_pan" name="file_pan" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['pan_path']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Adhar Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="aadhar_no" id="aadhar_no" value="<?php echo $client[0]['aadhar_no'];?>" required autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Adhaar Card:</label>
											<input type="file" id="file" name="file_aadhar" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['aadhar_path']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Driving License No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="driving_license" id="driving_license" value="<?php echo $client[0]['driving_license_no'];?>" required autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Driving License:</label>
											<input type="file" id="file_license" name="file_license" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['driving_license_path']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Photo: <span class="text-danger">*</span></label>
											<input type="file" id="photo" name="photo" class="form-input-styled" <?php if($client[0]['photo']==""){ echo "required";}?> data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Resume: <span class="text-danger">*</span></label>
											<input type="file" id="resume" name="resume" class="form-input-styled" <?php if($client[0]['resume']==""){ echo "required";}?> data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="bank_name" id="bank_name" value="<?php echo $client[0]['bank_name'];?>" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Bank Document:</label>
											<input type="file" id="file_document" name="file_document" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['bank_document']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Account No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="bank_account_no" id="bank_account_no" value="<?php echo $client[0]['bank_account_no'];?>" required onchange="check_bank_account();" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Repeat Bank Account No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="repeat_acc_no" id="repeat_acc_no" value="<?php echo $client[0]['bank_account_no'];?>" required onchange="check_bank_account();" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank IFSC CODE: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?php echo $client[0]['bank_ifsc_code'];?>" required autocomplete="off">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Enter UAN Generated: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="uan" id="uan" value="<?php echo $client[0]['uan_generatted'];?>" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>UAN Type: <span class="text-danger">*</span></label>
											<select class="form-control" name="uan_type" id="uan_type" value="<?php echo $client[0]['uan_type'];?>" required>
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
											<input type="text" class="form-control" name="uan_no" id="uan_no" value="<?php echo $client[0]['uan_no'];?>" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status: <span class="text-danger">*</span></label>
											<select class="form-control" name="status" id="status" required>
													<option value="0" <?php if($client[0]['status']=="0"){ echo "selected";}?>>Active</option> 
													<option value="1" <?php if($client[0]['status']=="1"){ echo "selected";}?>>Inactive</option> 
												</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Basic Salary: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="basic_salary" id="basic_salary" value="<?php echo $client[0]['basic_salary'];?>" required autocomplete="off" onchange="calculate_gross_salary();">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>HRA: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="hra" id="hra" value="<?php echo $client[0]['hra'];?>" autocomplete="off" required onchange="calculate_gross_salary();">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="form-group">
												<label>Conveyance: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="conveyance" id="conveyance" value="<?php echo $client[0]['conveyance'];?>" autocomplete="off" required onchange="calculate_gross_salary();">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="form-group">
												<label>Medical Reimbursement: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="medical" id="medical" value="<?php echo $client[0]['medical_reimbursement'];?>" autocomplete="off" required onchange="calculate_gross_salary();">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Special Allowance: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="special_allowance" id="special_allowance" value="<?php echo $client[0]['special_allowance'];?>" required autocomplete="off" onchange="calculate_gross_salary();">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Other Allowance: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="other_allowance" id="other_allowance" value="<?php echo $client[0]['other_allowance'];?>" autocomplete="off" required onchange="calculate_gross_salary();">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="form-group">
												<label>Gross Salary: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="gross_salary" id="gross_salary" value="<?php echo $client[0]['gross_salary'];?>" autocomplete="off" readonly required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Employee PF : <span class="text-danger">*</span></label>
										<div class="form-group">
											<div class="row">
												<div class="col-md-5">
													<input type="text" class="form-control" name="pf_percentage" id="pf_percentage" value="<?php echo $client[0]['pf_percentage'];?>" required autocomplete="off" placeholder="PF %">
												</div>
												<div class="col-md-7">
													<input type="text" class="form-control" name="emp_pf" id="emp_pf" value="<?php echo $client[0]['emp_pf'];?>" required autocomplete="off" placeholder="Employee PF" onchange="calculate_total_deduction();">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<label>Employee ESIC : <span class="text-danger">*</span></label>
											<div class="form-group">
											<div class="row">
												<div class="col-md-5">
													<input type="text" class="form-control" name="esic_percentage" id="esic_percentage" value="<?php echo $client[0]['esic_percentage'];?>" required autocomplete="off" placeholder="ESIC %">
												</div>
												<div class="col-md-7">
													<input type="text" class="form-control" name="emp_esic" id="emp_esic" value="<?php echo $client[0]['emp_esic'];?>" required autocomplete="off" placeholder="Employee ESIC" onchange="calculate_total_deduction();">
												</div>
											</div>
											</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="form-group">
												<label>PT: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="pt" id="pt" value="<?php echo $client[0]['pt'];?>" autocomplete="off" required onchange="calculate_total_deduction();">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="form-group">
												<label>Total Deduction: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="total_deduction" id="total_deduction" value="<?php echo $client[0]['total_deduction'];?>" autocomplete="off" required readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Employer PF : <span class="text-danger">*</span></label>
											<div class="form-group">
											<div class="row">
												<div class="col-md-5">
													<input type="text" class="form-control" name="employer_pf_percentage" id="employer_pf_percentage" value="<?php echo $client[0]['employer_pf_percentage'];?>" required autocomplete="off" placeholder="PF %">
												</div>
							
												<div class="col-md-7">
													<input type="text" class="form-control" name="employer_pf" id="employer_pf" value="<?php echo $client[0]['employer_pf'];?>" required autocomplete="off" placeholder="Employee PF" onchange="calculate_total_ctc();">
												</div>
											</div>
											</div>
									</div>
									<div class="col-md-4">
										<label>Employer ESIC : <span class="text-danger">*</span></label>
											<div class="form-group">
											<div class="row">
												<div class="col-md-5">
													<input type="text" class="form-control" name="employer_esic_percentage" id="employer_esic_percentage" value="<?php echo $client[0]['employer_esic_percentage'];?>" required autocomplete="off" placeholder="ESIC %">
												</div>
												<div class="col-md-7">
													<input type="text" class="form-control" name="employer_esic" id="employer_esic" value="<?php echo $client[0]['employer_esic'];?>" required autocomplete="off" placeholder="Employee ESIC" onchange="calculate_total_ctc();">
												</div>
											</div>
											</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="form-group">
												<label>Mediclaim Insurance: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="mediclaim" id="mediclaim" value="<?php echo $client[0]['mediclaim'];?>" autocomplete="off" required onchange="calculate_total_ctc();">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="form-group">
												<label>CTC: <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="ctc" id="ctc" value="<?php echo $client[0]['ctc'];?>" autocomplete="off" required readonly>
											</div>
										</div>
									</div>
								</div>
									<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
									<button type="button" class="btn btn-primary" name="upload_now" id="h-default-basic-start" onclick="pending_update();">Pending Save</button>
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
