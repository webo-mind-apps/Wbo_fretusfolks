<?php
$active_menu="index";

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

	
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
	
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


	<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>

	<script src="<?php echo base_url();?>admin_assets/assets/js/custom.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_layouts.js"></script>
		
		
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/date/jquery-ui.js"></script>
		<script>
		   $( function() 
		   {
				var d = new Date();
				d.setFullYear(d.getFullYear());
		   
				var date = $('.datepicker').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
				changeYear: true}).val();
		   } );
		</script>
		<script>
		$(document).ready(function()
			{
				var counter = 1;
				
				$("#addButton").click(function () 
				{
					$("div#divLoading").addClass('show');	
						jQuery.ajax({
									type:"POST",
									url:"<?php echo base_url(); ?>" + "index.php/client_management/add_gstn_row",
									datatype:"text",
									data:{counter:counter},
									success:function(response)
									{
										$("#gstn_div").append(response);
										$("div#divLoading").removeClass('show');
										counter++;
									},
									error:function (xhr, ajaxOptions, thrownError){}
							});
				}); 
			
		  });
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
		  function remove_cycle_div(id)
		  {
			  r=confirm("Are You Sure...?");
			  if(r==true)
			  {
				$("#row_"+id).empty();
			  }
		  }
		  
	</script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
						<h4><a href="<?php echo site_url('client_management/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Client Database Management System</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Client Database Management System</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
			<?php
				if ($this->session->flashdata('insert-status')) {
				?>
					<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<span class="text-semibold"><?php echo $this->session->flashdata('insert-status');?></span>
					</div>
				<?php
				}
				?>
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
					 <form class="form-horizontal" action="<?php echo site_url("client_management/save_client");?>" method="POST" enctype="multipart/form-data">
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        
						<!-- Other inputs -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">New Client Details</h5>
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
											<label>Enter Client Code: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="client_code" id="client_code" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Client Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="client" id="client" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Office Land-line Number: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="land_line" id="land_line" maxlength="50" onkeypress="return isNumber(event)" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Client Mail ID: <span class="text-danger">*</span></label>
											<input type="email" class="form-control" name="client_email" id="client_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Contact Person Name: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="contact_person" id="contact_person" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Contact Person Mobile Number: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" maxlength="10" onkeypress="return isNumber(event)" autocomplete="off" name="contact_person_mobile" id="contact_person_mobile" required>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Contact Person Mail ID: <span class="text-danger">*</span></label>
											<input type="email" class="form-control" name="contact_person_email" id="contact_person_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Contact Person Name (Communication): <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="contact_person_comm" id="contact_person_comm"  autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Contact Person Phone (Communication): <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="contact_person_phone_comm" id="contact_person_phone_comm" maxlength="10" onkeypress="return isNumber(event)" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Contact Person Mail (Communication): <span class="text-danger">*</span></label>
											<input type="email" class="form-control" name="contact_person_email_comm" id="contact_person_email_comm" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Registered Address: <span class="text-danger">*</span></label>
											<textarea rows="5" cols="5" class="form-control" placeholder="Enter Address" autocomplete="off" name="registered_address" id="registered_address" required></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Communication  Address: <span class="text-danger">*</span></label>
											<textarea rows="5" cols="5" class="form-control" name="communication_address" autocomplete="off" id="communication_address" required placeholder="Enter Address"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Client PAN Number: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="pan_no" id="pan_no" maxlength="10"  style="text-transform:uppercase" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Enter Client TAN Number: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="tan_no" id="tan_no" maxlength="10"  style="text-transform:uppercase" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>State</th>
													<th>GSTN No</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
											<tbody id="gstn_div">
													<tr id="row_1">
														<td>
															<select class="form-control required" name="state[]" id="state_1" required>
																<option value="">Select State</option>
																<?php 
																	foreach($states as $row)
																	{
																		echo '<option value="'.$row['id'].'">'.$row['state_name'].'</option>';
																	}
																
																?>
															</select>
														</td>
														<td>
															<input type="text" name="gstn[]" id="gstn" class="form-control" maxlength="15" style="text-transform:uppercase" autocomplete="off" required>
																
														</td>
														<td><a href="javascript:void(0);" id="addButton"><i class="fa fa-plus-square" aria-hidden="true"></i></td>
													</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row" style="margin-top: 2%;">
									<!--<div class="col-md-6">
										<div class="form-group">
											<label>Enter GSTN: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="gstn" id="gstn" maxlength="15" required>
										</div>
									</div>-->
									<div class="col-md-4">
										<div class="form-group">
											<label>Enter Client website URL: <span class="text-danger">*</span></label>
											<input type="url" class="form-control" name="website" id="website" autocomplete="off">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Service Location:</label>
											<select class="form-control" name="region" id="region">
												<option value="">Select Zone</option>
												<option value="North">North</option>
												<option value="South">South</option>
												<option value="East">East</option>
												<option value="West">West</option>
												<option value="PAN India">PAN India</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>&nbsp;</label>
											<select class="form-control" name="state_service" id="state_service">
												<option value="">Select State</option>
													<?php 
														foreach($states as $row)
														{
															echo '<option value="'.$row['id'].'">'.$row['state_name'].'</option>';
														}
													?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
												<label class="d-block">Mode of Agreement: <span class="text-danger">*</span></label>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="agreement_mode" value="1" class="form-check-input-styled" checked data-fouc required>
														LOI
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="agreement_mode" value="2" class="form-check-input-styled" data-fouc required>
														Agreement
													</label>
												</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Type of Agreement:</label>
											<div class="form-check form-check-inline">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="agreement_type" id="agreement_type" value="1" onchange="check_agreement_type();" class="form-check-input-styled" checked data-fouc required>
														One Time Sourcing
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="agreement_type" id="agreement_type" value="2" onchange="check_agreement_type();" class="form-check-input-styled" data-fouc required>
														Contractual
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="agreement_type" id="agreement_type" value="3" onchange="check_agreement_type();" class="form-check-input-styled" data-fouc required>
														Other
													</label>
												</div>
											</div>
										</div>
										<div class="form-group" id="men_agreement" style="display:none">
											<label>Other Agreement:</label>
											<input type="text" class="form-control" name="other_agreement" id="other_agreement">
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Attach Agreement Documents:<span class="text-danger">(.doc,.jpg,.jpeg,.pdf)</span></label>
											<input type="file" id="file" name="file" class="form-input-styled" data-fouc required onchange="validate_file()">
											<span class="form-text text-muted">Max file size 5 Mb</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Contract Start Date:</label>

										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text"><i class="icon-calendar5"></i></span>
											</span>
											<input type="text" name="start_date" id="start_date"  required class="form-control datepicker" autocomplete="off" placeholder="Contract Start Date">
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="d-block">Contract End Date:</label>

										<div class="input-group">
											<span class="input-group-prepend">
												<span class="input-group-text"><i class="icon-calendar5"></i></span>
											</span>
											<input type="text" name="end_date" id="end_date" class="form-control datepicker" autocomplete="off" placeholder="Contract End Date">
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h5 class="card-title">Commercial</h5></div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Rate:</label>
												<input type="text" class="form-control" name="rate" id="rate" autocomplete="off" onkeypress="return isNumberKey(this, event);" required>
											</div> 
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Commercial Type:</label>
													<select class="form-control" name="commercial_type" id="commercial_type">
														<option value="1">%</option> 
														<option value="2">Rs</option> 
													</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Remark:</label>
												<input type="text" class="form-control" name="remark" id="remark" autocomplete="off" required>
											</div>
										</div>
								</div>
								
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
										</div>
									</div>
								</div>
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
