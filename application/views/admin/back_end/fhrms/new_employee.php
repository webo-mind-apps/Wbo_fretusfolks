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
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
			
			action_url="<?php echo site_url('fhrms/save_emp_pending/');?>";
			 $('#my_form').attr('action', action_url).submit();
		}
		function calculate_gross_salary1()
		{
			var basic = isNaN(parseInt($("#basic_salary").val())) ? 0 : parseInt($("#basic_salary").val());
			var hra = isNaN(parseInt($("#hra").val())) ? 0 : parseInt($("#hra").val());
			var conveyance = isNaN(parseInt($("#conveyance").val())) ? 0 : parseInt($("#conveyance").val());
			var medical = isNaN(parseInt($("#medical").val())) ? 0 : parseInt($("#medical").val());
			var special = isNaN(parseInt($("#special_allowance").val())) ? 0 : parseInt($("#special_allowance").val());
			var other = isNaN(parseInt($("#other_allowance").val())) ? 0 : parseInt($("#other_allowance").val());
			var st_bonus = isNaN(parseInt($("#st_bonus").val())) ? 0 : parseInt($("#st_bonus").val());
			
			gross_salary=parseInt(basic)+parseInt(hra)+parseInt(conveyance)+parseInt(medical)+parseInt(special)+parseInt(other)+parseInt(st_bonus);
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
		function delete_education_certificate(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/delete_education_certificate",
					datatype:"text",
					data:{id:id},
					success:function(response)
					{
						location.reload();
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
			}
		}
		function delete_other_certificate(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/delete_other_certificate",
					datatype:"text",
					data:{id:id},
					success:function(response)
					{
						location.reload();
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
			}
		}
	
		function isNumberKey(txt, evt) 
		{
			var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode == 46) 
				{
					//Check if the text already contains the . character
					if (txt.value.indexOf('.') === -1) {
						return true;
					} else {
						return false;
					}
				}
				else 
				{
					if (charCode > 31
						&& (charCode < 48 || charCode > 57))
						return false;
				}
			return true;
		}
		function validate_ffi()
		{
			emp_id=$("#ffi_emp_id").val();
			
			jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/fhrms/validate_ffi",
					datatype:"text",
					data:{emp_id:emp_id},
					success:function(response)
					{
						if(response>=1)
						{
							alert("FFI EMP ID is Already Exists !");
							$("#ffi_emp_id").val("");
							$("#ffi_emp_id").focus();
						}
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
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
						<h4><a href="<?php echo site_url('fhrms/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Fretus HR Management System</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('backend_team');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Fretus HR Management System</span>
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
					 <form id="my_form" class="form-horizontal" action="<?php echo site_url('fhrms/save_employee/');?>" method="POST" enctype="multipart/form-data">
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					     
						<!-- Other inputs -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Employee Details</h5>
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
											<label>Enter FFI Employee ID: <span class="text-danger">*</span></label>
											<input type="text" name="ffi_emp_id" id="ffi_emp_id" required class="form-control" onchange="validate_ffi()" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Employee Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="emp_name" id="emp_name" autocomplete="off" required>
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
												required placeholder="Interview Date" autocomplete="off">
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
												 required placeholder="Joining Date" autocomplete="off">
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
												<input type="text" class="form-control datepicker" name="contact_end_date" id="contact_end_date" required placeholder="Contract End Date" autocomplete="off">
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
										<label>Enter Department: <span class="text-danger"></span></label>
										<input type="text" class="form-control" name="department" id="department" autocomplete="off">
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
											<label>DOB: <span class="text-danger">*</span></label>
											<div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar5"></i></span>
										</span>
										<input type="text" class="form-control datepicker" placeholder="DOB" name="dob" id="dob" required autocomplete="off">
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
											<label class="d-block">Father Name: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="fname" id="fname" autocomplete="off" required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Blood Group: <span class="text-danger">*</span></label>
										<div class="input-group">
											<select class="form-control" name="blood_grp" id="blood_grp" required>
												<option value="">Select</option>
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
											<input type="text" class="form-control" name="qualification" id="qualification" autocomplete="off"  required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Phone1: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="phone1" id="phone1" autocomplete="off"  maxlength="10"  onkeypress="return isNumber(event)" required>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Phone2: <span class="text-danger"></span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="phone2" id="phone2" maxlength="10" onkeypress="return isNumber(event)" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Email ID: <span class="text-danger"></span></label>
											<div class="input-group">
												<input type="text" class="form-control"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" id="email" autocomplete="off">
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
											<label>Enter PAN Card No: </label>
											<input type="text" class="form-control" maxlength="10" name="pan_no" id="pan_no" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach PAN:</label>
											<input type="file" id="file_pan" name="file_pan" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Adhar Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="aadhar_no" id="aadhar_no"  onkeypress="return isNumber(event)" maxlength="12" required autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Adhaar Card:<span class="text-danger">*</span></label>
											<input type="file" id="file" name="file_aadhar" class="form-input-styled" data-fouc onchange="validate_file(this.id)" required>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Driving License No:</label>
											<input type="text" class="form-control" name="driving_license" id="driving_license" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Driving License:</label>
											<input type="file" id="file_license" name="file_license" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Photo: <span class="text-danger">*</span></label>
											<input type="file" id="photo" name="photo" class="form-input-styled" data-fouc onchange="validate_file(this.id)" required>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Resume: <span class="text-danger">*</span></label>
											<input type="file" id="resume" name="resume" class="form-input-styled" data-fouc onchange="validate_file(this.id)" required>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Name: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="bank_name" id="bank_name" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Bank Document:<span class="text-danger"></span></label>
											<input type="file" id="file_document" name="file_document" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Account No: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="bank_account_no" id="bank_account_no" onchange="check_bank_account();" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Repeat Bank Account No: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="repeat_acc_no" id="repeat_acc_no" onchange="check_bank_account();" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank IFSC CODE: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" autocomplete="off">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Enter UAN Generated: </label>
											<input type="text" class="form-control" name="uan" id="uan" autocomplete="off">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>UAN Type:</label>
											<select class="form-control" name="uan_type" id="uan_type">
												<option value="Old">Old</option> 
												<option value="New">New</option> 
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>UAN No:</label>
											<input type="text" class="form-control" name="uan_no" id="uan_no" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status:</label>
											<select class="form-control" name="status" id="status">
													<option value="0">Active</option> 
													<option value="1">Inactive</option> 
												</select>
										</div>
									</div>
								</div>
								<label><strong>Salary Details</strong></label>
								<div style="border: 1px solid #d6c8c8;padding: 2%;margin-bottom: 1%;">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Basic Salary: <span class="text-danger">*</span></label>
													<input type="text" class="form-control"  onkeypress="return isNumber(event)" name="basic_salary" id="basic_salary" required autocomplete="off" onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>HRA: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="hra" id="hra" required onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Conveyance: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="conveyance" id="conveyance" autocomplete="off" required onchange="calculate_gross_salary();">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Medical Reimbursement: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="medical" id="medical" autocomplete="off" required onchange="calculate_gross_salary();">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Special Allowance: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="special_allowance" id="special_allowance" required autocomplete="off" onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>ST: <span class="text-danger">*</span></label>
													<input type="text" class="form-control"  onkeypress="return isNumber(event)" name="st_bonus" id="st_bonus" autocomplete="off" required onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Other Allowance: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="other_allowance" id="other_allowance" autocomplete="off" required onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Gross Salary: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="gross_salary" id="gross_salary"  autocomplete="off" required>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row" style="display:none;"> 
											<div>
												<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="pf_percentage" id="pf_percentage"   autocomplete="off" placeholder="PF %"> 
											</div>
											
											<div>
												<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="esic_percentage" id="esic_percentage" autocomplete="off" placeholder="ESIC %">
											</div> 
										</div>
										
										
										
										<div class="row">
											<div class="col-md-2">
												<label>Employee PF : <span class="text-danger">*</span></label>
												<div class="form-group">
													<div class="row"> 
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="emp_pf" id="emp_pf" required autocomplete="off" placeholder="Employee PF" onchange="calculate_total_deduction();">
														</div>
													</div>
												</div>
											</div>
											 			
											<div class="col-md-2"> 
												<label>Employee ESIC : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="emp_esic" id="emp_esic" required autocomplete="off" placeholder="Employee ESIC" onchange="calculate_total_deduction();">
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="form-group">
														<label>PT: <span class="text-danger">*</span></label>
														 <input type="text" class="form-control" onkeypress="return isNumber(event)" name="pt" id="pt" autocomplete="off" required onchange="calculate_total_deduction();">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Total Deduction: <span class="text-danger">*</span></label>
														 <input type="text" class="form-control" onkeypress="return isNumber(event)" name="total_deduction" id="total_deduction" autocomplete="off" required>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Take Home Salary: <span class="text-danger">*</span></label>
														<input type="text" class="form-control"  onkeypress="return isNumber(event)"  name="take_home" id="take_home"  autocomplete="off" required >
													</div>
												</div>
											</div>
										</div>
										
										
										
										<div class="row">
											<div class="col-md-3">
												<label>Employer PF : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="employer_pf" id="employer_pf" required autocomplete="off" placeholder="Employer PF" onchange="calculate_total_ctc();">
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-4">
												<label>Employer ESIC : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="employer_esic" id="employer_esic" required autocomplete="off" placeholder="Employer ESIC" onchange="calculate_total_ctc();">
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													 <div class="form-group">
														<label>Mediclaim Insurance: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="mediclaim" id="mediclaim" autocomplete="off" required onchange="calculate_total_ctc();">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>CTC: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="ctc" id="ctc" autocomplete="off" required>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row" style="display:none;">
											<div class="col-md-3">
												<label>Employer PF : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														<div class="col-md-5">
															<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="employer_pf_percentage" id="employer_pf_percentage"  autocomplete="off" placeholder="PF %">
														</div>
									
													 
													</div>
													</div>
											</div>
											<div class="col-md-4">
												<label>Employer ESIC : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														<div class="col-md-5">
															<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="employer_esic_percentage" id="employer_esic_percentage" autocomplete="off" placeholder="ESIC %">
														</div>
														
													</div>
													</div>
											</div>
											 
										 
										</div>
										
										 
										
								</div>
								<label><strong>Upload Documents</strong></label>
								<div style="border: 1px solid #d6c8c8;padding: 2%;margin-bottom: 1%;">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Attach Voter ID:</label>
												<input type="file" id="voter_id" name="voter_id" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
												<span class="form-text text-muted">Max file size 5 Mb</span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Attach Employee Form: <span class="text-danger">*</span> </label>
												<input type="file" id="emp_form" name="emp_form" required class="form-input-styled" data-fouc onchange="validate_file(this.id)">
												<span class="form-text text-muted">Max file size 5 Mb</span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Education Certificate: <span class="text-danger"></span></label>
												<input type="file" id="edu_certificate" name="edu_certificate[]" multiple class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>PF Form / ESIC: <span class="text-danger"></span></label>
												<input type="file" id="pf_doc" name="pf_doc" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
												<span class="form-text text-muted">Max file size 5 Mb</span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Others:</label>
												<input type="file" id="others_doc" name="others_doc[]" multiple class="form-input-styled" data-fouc onchange="validate_file(this.id)">
												<span class="form-text text-muted">Max file size 5 Mb</span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Payslip: </label>
												<input type="file" id="payslip_doc" name="payslip_doc" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Exp Letter: </label>
												<input type="file" id="exp_doc" name="exp_doc" class="form-input-styled" data-fouc onchange="validate_file(this.id)" >
											</div>
										</div>
									</div>
								</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="d-block">Password: <span class="text-danger">*</span></label>
													<div class="input-group">
														<input type="text" class="form-control" name="password" id="password" required autocomplete="off" value="ffemp@123">
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
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</form>
				</div>

			</div>
</body>
</html>
