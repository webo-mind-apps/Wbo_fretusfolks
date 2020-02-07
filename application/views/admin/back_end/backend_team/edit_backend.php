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
			
			action_url="<?php echo site_url('backend_team/update_team_pending/'.$client[0]['id']);?>";
			 $('#my_form').attr('action', action_url).submit();
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

		function calculate_gross_salary()
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
		function remove_voter_id(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/remove_voter_id",
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
		function remove_emp_form(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/remove_emp_form",
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
		function remove_pf_esic(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/remove_pf_esic",
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
		function remove_payslip(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/remove_payslip",
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
		function remove_exp_letter(id)
		{
			r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/remove_exp_letter",
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
		function validate_ffi()
		{
			emp_id=$("#ffi_emp_id").val();
			
			jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/backend_team/validate_ffi",
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

	<style>
		.right{
			float:right;
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
						<h4><a href="<?php echo site_url('backend_team');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Back End Management</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					<div class="right text-center">
						<button type="button" class="btn btn-primary" id="import_file">Import Excel &nbsp;&nbsp; <i class="fa fa-download" aria-hidden="true"></i></button>
						</br>
						<a href="<?php echo base_url() ?>doc-formate" download >Download Format</a>
						<form enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>adms-doc-import" id="import_form" style="display:none">
							<input id="import" type="file" name="import" accept=".xls, .xlt, .xlm, .xlsx, .xlsm, .xltx, .xltm, .xlsb, .xla, .xlam, .xll, .xlw">
						</form>
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
											<label>Entity Name: <span class="text-danger">*</span></label>
											<input type="text" name="entity_name" id="entity_name" required class="form-control" autocomplete="off" value="<?php echo $client[0]['entity_name'];?>">
										</div>
									</div>
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
								</div>
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter FFI Employee ID: <span class="text-danger">*</span></label>
											<input type="text" name="ffi_emp_id" id="ffi_emp_id" required class="form-control" autocomplete="off" value="<?php echo $client[0]['ffi_emp_id'];?>" onchange="validate_ffi();">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Console ID: <span class="text-danger"></span></label>
											<input type="text" name="console_id" id="console_id" class="form-control" autocomplete="off" value="<?php echo $client[0]['console_id'];?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Client Employee ID: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="client_emp_id" id="client_emp_id" autocomplete="off" value="<?php echo $client[0]['client_emp_id'];?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Grade: <span class="text-danger"></span></label>
											<input type="text" name="grade" id="grade" class="form-control" autocomplete="off" value="<?php echo $client[0]['grade'];?>">
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Enter Employee Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="emp_name" id="emp_name" autocomplete="off" value="<?php echo $client[0]['emp_name'];?>" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Middle Name: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="middle_name" id="middle_name" autocomplete="off" value="<?php echo $client[0]['middle_name'];?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Last Name: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="last_name" id="last_name" autocomplete="off" value="<?php echo $client[0]['last_name'];?>" >
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
												value="<?php if($client[0]['interview_date'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['interview_date']));}?>" required placeholder="Interview Date" autocomplete="off">
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
												value="<?php if($client[0]['joining_date'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['joining_date']));}?>" required placeholder="Joining Date" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
												<label>DOL <span class="text-danger"></span></label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" name="contact_end_date" id="contact_end_date" 
												value="<?php if($client[0]['contract_date'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['contract_date']));}?>"  placeholder="DOL" autocomplete="off">
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
											<label>Enter Department: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="department" id="department" autocomplete="off" value="<?php echo $client[0]['department'];?>">
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
											<label class="d-block">Branch: <span class="text-danger"></span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="branch" id="branch" autocomplete="off" value="<?php echo $client[0]['branch'];?>">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
													<label>DOB: <span class="text-danger">*</span></label>
													<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" placeholder="Date of Birth" name="dob" id="dob" 
												value="<?php if($client[0]['dob'] !="0000-00-00"){ echo date("d-m-Y",strtotime($client[0]['dob']));}?>" required autocomplete="off">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
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
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Father Name: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $client[0]['father_name'];?>" autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="d-block">Mother Name: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="mname" id="mname" value="<?php echo $client[0]['mother_name'];?>" autocomplete="off" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Religion: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="religion" id="religion" value="<?php echo $client[0]['religion'];?>" autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Languages: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="languages" id="languages" value="<?php echo $client[0]['languages'];?>" autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Mother Tongue: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="mother_tongue" id="mother_tongue" value="<?php echo $client[0]['mother_tongue'];?>" autocomplete="off" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Marital Status: <span class="text-danger">*</span></label>
											<div class="input-group">
												<select class="form-control" name="marital_status" id="marital_status" required>
													<option value="">Select</option>
													<option value="Single" <?php if($client[0]['maritial_status']=="Single"){ echo "selected";}?>>Single</option> 
													<option value="Married" <?php if($client[0]['maritial_status']=="Married"){ echo "selected";}?>>Married</option> 
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Emergency Contact Person: <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="emer_contact_no" id="emer_contact_no" autocomplete="off" value="<?php echo $client[0]['emer_contact_no'];?>" required>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Spouse Name:</label>
											<div class="input-group">
												<input type="text" class="form-control" name="spouse_name" id="spouse_name" autocomplete="off" value="<?php echo $client[0]['spouse_name'];?>">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">No of Children:</label>
											<div class="input-group">
												<input type="text" class="form-control" name="no_of_childrens" id="no_of_childrens" autocomplete="off" value="<?php echo $client[0]['no_of_childrens'];?>">
											</div>
										</div>
									</div>
									<div class="col-md-4">
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
											<label class="d-block">Phone 1: <span class="text-danger">*</span></label>

										<div class="input-group">
											<input type="text" class="form-control" name="phone1" id="phone1" autocomplete="off" value="<?php echo $client[0]['phone1'];?>" maxlength="10"  onkeypress="return isNumber(event)" required>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Phone 2: <span class="text-danger"></span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="phone2" id="phone2" value="<?php echo $client[0]['phone2'];?>" maxlength="10" onkeypress="return isNumber(event)" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Email ID: </label>
											<div class="input-group">
												<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" id="email" value="<?php echo $client[0]['email'];?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="d-block">Official Email ID: </label>
											<div class="input-group">
												<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="official_email" id="official_email" value="<?php echo $client[0]['official_mail_id'];?>" autocomplete="off">
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
											<label>Enter PAN Card No: <span class="text-danger"></span></label>
											<input type="text" class="form-control" maxlength="10" pattern="^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$" name="pan_no" id="pan_no" value="<?php echo $client[0]['pan_no'];?>" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach PAN: <?php if($client[0]['pan_path']!=""){ echo '<a href="'.base_url().$client[0]['pan_path'].'" target="_blank">[Click Here]</a>';}?></label>
											<input type="file" id="file_pan" name="file_pan" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php //if($client[0]['pan_path']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Adhar Card No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" onkeypress="return isNumber(event)" maxlength="12" name="aadhar_no" id="aadhar_no" value="<?php echo $client[0]['aadhar_no'];?>" required autocomplete="off" maxlength="12">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Adhaar Card: <?php if($client[0]['aadhar_path']!=""){ echo '<a href="'.base_url().$client[0]['aadhar_path'].'">[Click Here]</a>';}?></label>
											<input type="file" id="file" name="file_aadhar" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['aadhar_path']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Driving License No: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="driving_license" id="driving_license" value="<?php echo $client[0]['driving_license_no'];?>" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Driving License:<?php if($client[0]['driving_license_path']!=""){ echo '<a href="'.base_url().$client[0]['driving_license_path'].'" target="_blank">[Click Here]</a>';}?></label>
											<input type="file" id="file_license" name="file_license" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php //if($client[0]['driving_license_path']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Photo: <span class="text-danger">*</span><?php if($client[0]['photo']!=""){ echo '<a href="'.base_url().$client[0]['photo'].'" target="_blank">[Click Here]</a>';}?></label>
											<input type="file" id="photo" name="photo" class="form-input-styled" <?php if($client[0]['photo']==""){ echo "required";}?> data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Resume: <span class="text-danger">*</span><?php if($client[0]['resume']!=""){ echo '<a href="'.base_url().$client[0]['resume'].'" target="_blank">[Click Here]</a>';}?></label>
											<input type="file" id="resume" name="resume" class="form-input-styled" <?php if($client[0]['resume']==""){ echo "required";}?> data-fouc onchange="validate_file(this.id)">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Name: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="bank_name" id="bank_name" value="<?php echo $client[0]['bank_name'];?>" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Bank Document: <?php if($client[0]['bank_document']!=""){ echo '<a href="'.base_url().$client[0]['bank_document'].'" target="_blank">[Click Here]</a>';}?></label>
											<input type="file" id="file_document" name="file_document" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php //if($client[0]['bank_document']==""){ echo "required";}?>>
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank Account No: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="bank_account_no" onkeypress="return isNumber(event)" id="bank_account_no" value="<?php echo $client[0]['bank_account_no'];?>" onchange="check_bank_account();" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Repeat Bank Account No: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="repeat_acc_no" id="repeat_acc_no" value="<?php echo $client[0]['bank_account_no'];?>" onchange="check_bank_account();" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Bank IFSC CODE: <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?php echo $client[0]['bank_ifsc_code'];?>" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>UAN No:</label>
											<input type="text" class="form-control" name="uan_no" id="uan_no" value="<?php echo $client[0]['uan_no'];?>" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>ESIC No:</label>
											<input type="text" class="form-control" name="esic_no" id="esic_no" value="<?php echo $client[0]['esic_no'];?>" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status:</label>
											<select class="form-control" name="status" id="status">
													<option value="0" <?php if($client[0]['status']=="0"){ echo "selected";}?>>Active</option> 
													<option value="1" <?php if($client[0]['status']=="1"){ echo "selected";}?>>Inactive</option> 
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
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="basic_salary" id="basic_salary" value="<?php if($client[0]['basic_salary'] !=0){ echo $client[0]['basic_salary'];}?>" required autocomplete="off">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>HRA: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="hra" onkeypress="return isNumber(event)" id="hra" value="<?php if($client[0]['hra'] !=0){echo $client[0]['hra'];}?>" autocomplete="off" required>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Conveyance: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="conveyance" id="conveyance" value="<?php if($client[0]['conveyance'] !=0){echo $client[0]['conveyance'];}?>" autocomplete="off" required >
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Medical Reimbursement: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="medical" onkeypress="return isNumber(event)" id="medical" value="<?php if($client[0]['medical_reimbursement'] !=0){echo $client[0]['medical_reimbursement'];}?>" autocomplete="off" required >
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Special Allowance: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="special_allowance" id="special_allowance" value="<?php if($client[0]['special_allowance'] !=0){echo $client[0]['special_allowance'];}?>" required autocomplete="off" >
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>ST: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="st_bonus" id="st_bonus" value="<?php if($client[0]['st_bonus'] !=0){echo $client[0]['st_bonus'];}?>" autocomplete="off" required>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Other Allowance: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" onkeypress="return isNumber(event)" name="other_allowance" id="other_allowance" value="<?php if($client[0]['other_allowance'] !=0){echo $client[0]['other_allowance'];}?>" autocomplete="off" required >
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Gross Salary: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="gross_salary" id="gross_salary" value="<?php if($client[0]['gross_salary'] !=0){echo $client[0]['gross_salary'];}?>" autocomplete="off" required>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Employee PF : <span class="text-danger">*</span></label>
												<div class="form-group">
													<div class="row">
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="emp_pf" id="emp_pf" value="<?php if($client[0]['emp_pf'] !=0){echo $client[0]['emp_pf'];}?>" required autocomplete="off" placeholder="Employee PF" >
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<label>Employee ESIC : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)"  name="emp_esic" id="emp_esic" value="<?php if($client[0]['emp_esic'] !=0){echo $client[0]['emp_esic'];}?>" required autocomplete="off" placeholder="Employee ESIC" >
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="form-group">
														<label>PT: <span class="text-danger">*</span></label>
														<input type="text" class="form-control"  onkeypress="return isNumber(event)"  name="pt" id="pt" value="<?php if($client[0]['pt'] !=0){echo $client[0]['pt'];}?>" autocomplete="off" required>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Total Deduction: <span class="text-danger">*</span></label>
														<input type="text" class="form-control"  onkeypress="return isNumber(event)"  name="total_deduction" id="total_deduction" value="<?php if($client[0]['total_deduction'] !=0){echo $client[0]['total_deduction'];}?>" autocomplete="off" required >
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Take Home Salary: <span class="text-danger">*</span></label>
														<input type="text" class="form-control"  onkeypress="return isNumber(event)"  name="take_home" id="take_home" value="<?php if($client[0]['take_home'] !=0){echo $client[0]['take_home'];}?>" autocomplete="off" required >
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
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="employer_pf" id="employer_pf" value="<?php if($client[0]['employer_pf'] !=0){echo $client[0]['employer_pf'];}?>" required autocomplete="off" placeholder="Employee PF" >
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-4">
												<label>Employer ESIC : <span class="text-danger">*</span></label>
													<div class="form-group">
													<div class="row">
														
														<div class="col-md-12">
															<input type="text" class="form-control" onkeypress="return isNumber(event)" name="employer_esic" id="employer_esic" value="<?php if($client[0]['employer_esic'] !=0){echo $client[0]['employer_esic'];}?>" required autocomplete="off" placeholder="Employee ESIC" >														
														</div>
													</div>
													</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="form-group">
														<label>Mediclaim Insurance: <span class="text-danger">*</span></label>
														<input type="text" class="form-control" onkeypress="return isNumber(event)" name="mediclaim" id="mediclaim" value="<?php if($client[0]['mediclaim'] !=0){echo $client[0]['mediclaim'];}?>" autocomplete="off" required >
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="form-group">
														<label>Grand Total: <span class="text-danger">*</span></label>
														<input type="text" class="form-control"  onkeypress="return isNumber(event)" name="ctc" id="ctc" value="<?php if($client[0]['ctc'] !=0){ echo $client[0]['ctc'];}?>" autocomplete="off" required>
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
												<label>Attach Voter ID: <?php if($client[0]['voter_id']!=""){ echo '<a href="'.base_url().$client[0]['voter_id'].'" target="_blank">[Click Here]</a>';}?></label>
												<input type="file" id="voter_id" name="voter_id" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php //if($client[0]['voter_id']==""){ echo "required";}?>>
												<span class="form-text text-muted">Max file size 5 Mb</span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Attach Employee Form: <?php if($client[0]['emp_form']!=""){ echo '<a href="'.base_url().$client[0]['emp_form'].'" target="_blank">[Click Here]</a>';}?></label>
												<input type="file" id="emp_form" name="emp_form" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['emp_form']==""){ echo "required";}?>>
												<span class="form-text text-muted">Max file size 5 Mb</span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Education Certificate:</label>
												<input type="file" id="edu_certificate" name="edu_certificate[]" multiple class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>PF Form / ESIC: <?php if($client[0]['pf_esic_form']!=""){ echo '<a href="'.base_url().$client[0]['pf_esic_form'].'" target="_blank">[Click Here]</a>';}?></label>
												<input type="file" id="pf_doc" name="pf_doc" class="form-input-styled" data-fouc onchange="validate_file(this.id)" <?php if($client[0]['pf_esic_form']==""){ echo "required";}?>>
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
												<label>Payslip: <?php if($client[0]['payslip']!=""){ echo '<a href="'.base_url().$client[0]['payslip'].'" target="_blank">[Click Here]</a>';}?></label>
												<input type="file" id="payslip_doc" name="payslip_doc" class="form-input-styled" data-fouc onchange="validate_file(this.id)">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Exp Letter: <?php if($client[0]['exp_letter']!=""){ echo '<a href="'.base_url().$client[0]['exp_letter'].'" target="_blank">[Click Here]</a>';}?></label>
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
														<input type="text" class="form-control" name="password" id="password" 
														value="<?php if($client[0]['psd']){ echo $client[0]['psd'];} else { echo "ffemp@123";} ?>" required autocomplete="off">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="d-block">Active Status: <span class="text-danger">*</span></label>
													<div class="input-group"> 
														<select class="form-control" name="active" id="active" required>
															<option value="">Select</option> 
															<option value="0" <?php if($client[0]['active_status']=="0"){ echo "selected";}?>>Active</option>
															<option value="1" <?php if($client[0]['active_status']=="1"){ echo "selected";}?>>Deactive</option>
														</select>
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
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Certificates</h5>
								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item" data-action="reload"></a>
									</div>
								</div>
							</div>
							<table class="table datatable-basic table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Certificate</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if($client[0]['voter_id']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$client[0]['voter_id'].'" target="_blank"><i class="fa fa-file"></i> Voter ID</a></td>
													<td><a href="javascript:void(0);" id='.$client[0]['id'].' onclick="remove_voter_id(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
										}
										if($client[0]['emp_form']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$client[0]['emp_form'].'" target="_blank"><i class="fa fa-file"></i> Employee Form</a></td>
													<td><a href="javascript:void(0);" id='.$client[0]['id'].' onclick="remove_emp_form(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
										}
										if($client[0]['pf_esic_form']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$client[0]['pf_esic_form'].'" target="_blank"><i class="fa fa-file"></i> PF / ESIC Form</a></td>
													<td><a href="javascript:void(0);" id='.$client[0]['id'].' onclick="remove_pf_esic(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
										}
										if($client[0]['payslip']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$client[0]['payslip'].'" target="_blank"><i class="fa fa-file"></i> Payslip</a></td>
													<td><a href="javascript:void(0);" id='.$client[0]['id'].' onclick="remove_payslip(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
										}
										if($client[0]['exp_letter']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$client[0]['exp_letter'].'" target="_blank"><i class="fa fa-file"></i> Experience Letter</a></td>
													<td><a href="javascript:void(0);" id='.$client[0]['id'].' onclick="remove_exp_letter(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
							
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Education Certificate</h5>
								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item" data-action="reload"></a>
									</div>
								</div>
							</div>
							<table class="table datatable-basic table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Si No</th>
										<th>Certificate</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody id="edu_certificate">
									<?php 
										$i=1;
										foreach($edu_certificate as $res1)
										{
											echo '
												<tr>
													<td>'.$i.'</td>
													<td><a href="'.base_url().$res1['path'].'" target="_blank"><i class="fa fa-file"></i> Document</a></td>
													<td><a href="javascript:void(0);" id='.$res1['id'].' onclick="delete_education_certificate(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
											$i++;
										}
									?>
								</tbody>
							</table>
						</div>
						
						
						
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Other Certificate</h5>
								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item" data-action="reload"></a>
									</div>
								</div>
							</div>
							<table class="table datatable-basic table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Si No</th>
										<th>Certificate</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody id="other_certificate">
									<?php 
										$i=1;
										foreach($other_certificate as $res2)
										{
											echo '
												<tr>
													<td>'.$i.'</td>
													<td><a href="'.base_url().$res2['path'].'" target="_blank"><i class="fa fa-file"></i> Document</a></td>
													<td><a href="javascript:void(0);" id='.$res2['id'].' onclick="delete_other_certificate(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
												</tr>';
											$i++;
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
				<!-- /floating labels -->

		
			<!-- content area -->


	<script>
	$(document).ready(function () {
		$('#import_file').click(function (e) { 
			e.preventDefault();
			$('#import').trigger('click');
		});

		$('#import').change(function (e) { 
			$('#import_form').submit()
		});
	});
	</script>

			
</body>
</html>
