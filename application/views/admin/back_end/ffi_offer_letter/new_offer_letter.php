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
	<script>
		function get_employee_detail()
		{
			emp_id=$("#ffi_emp_id").val();
			if(emp_id !="")
			{
				 $("div#divLoading").addClass('show');	
					jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/fhrms/get_emp_details",
					datatype:"text",
					data:{emp_id:emp_id},
					success:function(response)
					{
						if(response =="0")
						{
							alert("Employee Details Not Updated");
							$("#ffi_emp_id").val("");
						}
						else if(response =="failed")
						{
							alert("Employee Not Found");
							$("#ffi_emp_id").val("");
						}
						else
						{
							a=response.split("****");
							
							$("#emp_name").val(""+a[0]);
							$("#joining_date").val(""+a[1]);
							$("#contact_end_date").val(""+a[2]);
							$("#designation").val(""+a[3]);
							$("#location").val(""+a[4]);
							$("#departments").val(""+a[5]);
							
							$("#basic_salary").val(""+a[6]);
							$("#hra").val(""+a[7]);
							$("#conveyance").val(""+a[8]);
							$("#medical").val(""+a[9]);
							$("#special_allowance").val(""+a[10]);
							$("#st_bonus").val(""+a[11]);
							$("#other_allowance").val(""+a[12]);
							$("#gross_salary").val(""+a[13]);
							$("#pf_percentage").val(""+a[14]);
							$("#emp_pf").val(""+a[15]);
							$("#esic_percentage").val(""+a[16]);
							$("#emp_esic").val(""+a[17]);
							$("#pt").val(""+a[18]);
							$("#total_deduction").val(""+a[19]);
							$("#employer_pf_percentage").val(""+a[20]);
							$("#employer_pf").val(""+a[21]);
							$("#employer_esic_percentage").val(""+a[22]);
							$("#employer_esic").val(""+a[23]);
							$("#mediclaim").val(""+a[24]);
							$("#ctc").val(""+a[25]);
							
							$("div#divLoading").removeClass('show');
						}
						
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
			}
		}
		function isNumberKey(txt, evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 46) {
			//Check if the text already contains the . character
			if (txt.value.indexOf('.') === -1) {
				return true;
			} else {
				return false;
			}
		} else {
			if (charCode > 31
				&& (charCode < 48 || charCode > 57))
				return false;
		}
		return true;
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
						<h4><a href="<?php echo site_url('fhrms/ffi_offer_letter/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">New FFI Offer Letter</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="#"  class="breadcrumb-item"><span>FHRMS</span></a>
							<span class="breadcrumb-item active">FFI Offer Letters</span>
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

						
						

					 <form class="form-horizontal" action="<?php echo site_url('fhrms/save_offer_letter');?>" method="POST" enctype="multipart/form-data">
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        
						<!-- Other inputs -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Offer Letter Details</h5>
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
											<input type="text" name="ffi_emp_id" id="ffi_emp_id" required class="form-control" onchange="get_employee_detail();" autocomplete="off" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Employee Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="emp_name" id="emp_name" readonly required autocomplete="off">
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
											<input type="text" class="form-control" name="joining_date" id="joining_date" readonly autocomplete="off" required placeholder="Joining Date">
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
													<input type="text" class="form-control" name="contact_end_date" id="contact_end_date" readonly autocomplete="off" required placeholder="Contract End Date">
												</div>
											</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Departments: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="departments" id="departments" readonly required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Designation: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="designation" id="designation" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Location: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="location" id="location" readonly required>
										</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Offer Letter For: <span class="text-danger">*</span></label>
											<select class="form-control" name="letter_format" id="letter_format" required>
												<option value="">Select</option>
												<option value="1">Format 1</option>
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
													<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="basic_salary" id="basic_salary" required autocomplete="off" onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>HRA: <span class="text-danger">*</span></label>
													<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="hra" id="hra" required onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Conveyance: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="conveyance" id="conveyance" autocomplete="off" required onchange="calculate_gross_salary();">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Medical Reimbursement: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="medical" id="medical" autocomplete="off" required onchange="calculate_gross_salary();">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Special Allowance: <span class="text-danger">*</span></label>
													<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="special_allowance" id="special_allowance" required autocomplete="off" onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>ST: <span class="text-danger">*</span></label>
													<input type="text"   onkeypress="return isNumber(event)" class="form-control" name="st_bonus" id="st_bonus" autocomplete="off" required onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Other Allowance: <span class="text-danger">*</span></label>
													<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="other_allowance" id="other_allowance" autocomplete="off" required onchange="calculate_gross_salary();">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Gross Salary: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="gross_salary" id="gross_salary"  autocomplete="off" required>
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
															<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="pf_percentage" id="pf_percentage"  required autocomplete="off" placeholder="PF %">
														</div>
														<div class="col-md-7">
															<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="emp_pf" id="emp_pf" required autocomplete="off" placeholder="Employee PF" onchange="calculate_total_deduction();">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label>Employee ESIC : <span class="text-danger">*</span></label>
												<div class="form-group">
													<div class="row">
														<div class="col-md-5">
															<input type="text" onkeypress="return isNumberKey(this, event);" class="form-control" name="esic_percentage" id="esic_percentage" required autocomplete="off" placeholder="ESIC %">
														</div>
														<div class="col-md-7">
															<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="emp_esic" id="emp_esic" required autocomplete="off" placeholder="Employee ESIC" onchange="calculate_total_deduction();">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="form-group">
														<label>PT: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="pt" id="pt" autocomplete="off" required onchange="calculate_total_deduction();">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Total Deduction: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="total_deduction" id="total_deduction" autocomplete="off" required>
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
															<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="employer_pf_percentage" id="employer_pf_percentage" required autocomplete="off" placeholder="PF %">
														</div>
									
														<div class="col-md-7">
															<input type="text" class="form-control"   onkeypress="return isNumber(event)" name="employer_pf" id="employer_pf" required autocomplete="off" placeholder="Employee PF" onchange="calculate_total_ctc();">
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-4">
												<label>Employer ESIC : <span class="text-danger">*</span></label>
													<div class="form-group">
														<div class="row">
															<div class="col-md-5">
																<input type="text" class="form-control" onkeypress="return isNumberKey(this, event);" name="employer_esic_percentage" id="employer_esic_percentage" required autocomplete="off" placeholder="ESIC %">
															</div>
															<div class="col-md-7">
																<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="employer_esic" id="employer_esic" required autocomplete="off" placeholder="Employee ESIC" onchange="calculate_total_ctc();">
															</div>
														</div>
													</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="form-group">
														<label>Mediclaim Insurance: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="mediclaim" id="mediclaim" autocomplete="off" required onchange="calculate_total_ctc();">
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>CTC: <span class="text-danger">*</span></label>
														<input type="text"  onkeypress="return isNumber(event)" class="form-control" name="ctc" id="ctc" autocomplete="off" required>
													</div>
												</div>
											</div>
										</div>
								</div>
									<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
								</div>
							</div>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</form>
					</div>
				</div>
</body>
</html>
