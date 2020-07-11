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

		<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/jquery.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
		
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
		<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/dashboard.js"></script>
	
	<script src="<?php echo base_url();?>admin_assets/assets/js/custom.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_layouts.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_multiselect.js"></script>
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
	
	<style>
				#divLoading
				{
					display : none;
				}
				#divLoading.show
				{
					display : block;
					position : fixed;
					z-index: 100;
					background-image : url('<?php echo base_url();?>admin_assets/3.gif');
					background-color:#666;
					opacity : 0.4;
					background-repeat : no-repeat;
					background-position : center;
					left : 0;
					bottom : 0;
					right : 0;
					top : 0;
				}
				#loadinggif.show
				{
					left : 50%;
					top : 50%;
					position : absolute;
					z-index : 101;
					width : 32px;
					height : 32px;
					margin-left : -16px;
					margin-top : -16px;
				}
				div.content {
				   width : 100%;
				   height : 100%;
				}
	</style>
	<script>
		function search_dcs_details()
		{
			client=$("#client").val();
			from_date=$("#from_date").val();
			to_date=$("#to_date").val();
			data=$("#data").val();
			state=$("#state").val();
			emp_location=$("#location").val();
			active_status=$("#active_status").val();
			
			if(client=="" && from_date=="" && to_date=="" && data=="" && state=="" && emp_location=="" && active_status=="")
			{
				alert("Please Fill Any One Field To Search");
				return;
			}
			
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/dcs_report/search_dcs_details",
				datatype:"text",
				data:{client:client,from_date:from_date,to_date:to_date,data:data,state:state,emp_location:emp_location,active_status:active_status},
				success:function(response)
				{
					
					str="<label><span>Filters:</span> <input type='search' id='custom_filter'   placeholder='Type to filter...'></label><span><button type='button' class='btn btn-primary btn-labeled btn-labeled-left' onclick='custom_filter_search_details();'><b><i class='fa fa-search' aria-hidden='true' style='font-size: 16px;'></i></b> Search</button></span>";
					
					$('#get_details_filter').empty();
					$('#get_details_filter').append(str);
					
					$('#payslip_table').css("display","block");
					$('#get_details').empty();
					$('#get_details').append(response);
					$("div#divLoading").removeClass('show');
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		}
		
		function custom_filter_search_details()
		{
			search_val=$("#custom_filter").val();
			client=$("#client").val();
			from_date=$("#from_date").val();
			to_date=$("#to_date").val();
			data=$("#data").val();
			state=$("#state").val();
			emp_location=$("#location").val();
			active_status=$("#active_status").val();
			
			 jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url();?>" + "index.php/dcs_report/custom_filter_search_details",
				datatype:"text",
				data:{search_val:search_val,client:client,from_date:from_date,to_date:to_date,data:data,state:state,emp_location:emp_location,active_status:active_status},
				success:function(response)
				{
					 
					$('#get_details').empty();
					$('#get_details').append(response);
					$("div#divLoading").removeClass('show');
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		 
			  
		} 
	</script>
	<script>
		function view_backend_team_details(id)
		{
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/backend_team/view_backend_team_details",
				datatype:"text",
				data:{id:id},
				success:function(response)
				{
					$('#client_details').empty();
					$('#client_details').append(response);
					$("div#divLoading").removeClass('show');
					$('#modal_theme_primary').modal('show');
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

	<div id="divLoading"> 
    </div>
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">DCS Reports</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">DCS Reports</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->
			<!-- Content area -->
			<div class="content">		
					<?php
						if($this->session->flashdata('success','success'))
						{
					?>
							<div class="alert bg-success alert-styled-left">
								<button type="button" class="close" data-dismiss="alert"></button>
								<span class="text-semibold">Payslip Uploaded Successfully</span>
							</div>	
					<?php	
						}
					?>
					<?php
						if($this->session->flashdata('abc','error'))
						{
					?>
							<div class="alert bg-danger alert-styled-left">
								<button type="button" class="close" data-dismiss="alert"></button>
								<span class="text-semibold">Opps!</span> Try agin!
							</div>
					<?php	
						}
					?>
				<!-- Floating labels -->
				<div class="row">
					<div class="col-md-12">
					 <form class="form-horizontal" id="my_form" action="<?php echo site_url('dcs_report/download_report');?>" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Search</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>From Date</label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text"><i class="icon-calendar5"></i></span>
												</span>
												<input type="text" class="form-control datepicker" name="from_date" id="from_date" 
												placeholder="From Date&hellip;" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>To Date</label>
											<div class="input-group">
												<span class="input-group-prepend"><span class="input-group-text"><i class="icon-calendar5"></i></span></span>
												<input type="text" class="form-control datepicker" name="to_date" id="to_date" placeholder="To Date&hellip;" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Enter Client Name</label>
												<select class="form-control multiselect-select-all-filtering" name="client[]" id="client" multiple="multiple" data-fouc>
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
									<div class="col-md-3">
										<div class="form-group">
											<label>Data</label>
											<select class="form-control multiselect-select-all" name="data[]" id="data" multiple="multiple" data-fouc>
												<option value="entity_name">Entity Name</option>
												<option value="console_id">Console ID</option>
												
												<option value="client_emp_id">Client Employee ID</option> 
												<option value="dob">DOB</option>
												<option value="esic_no">ESIC NO</option>
												
												<option value="basic_salary">Basic Slary</option>
												<option value="hra">HRA</option>
												<option value="conveyance">Conveyance</option>
												<option value="medical_reimbursement">Medical Reimbursement</option>
												<option value="special_allowance">Special Allowance</option>
												<option value="other_allowance">Other Allowance</option>
												<option value="st_bonus">st bonus</option>
												<option value="gross_salary">Gross Salary</option> 
												<option value="emp_pf">Emp pf</option>
												<option value="emp_esic">Emp esic</option>
												<option value="pt">pt</option>
												<option value="total_deduction">Total Deduction</option>
												<option value="take_home">Take Home</option>
												<option value="employer_pf">Employer pf</option>
												<option value="employer_esic">Employer esic</option>
												<option value="mediclaim">Mediclaim</option>
												<option value="ctc">ctc</option>  
												
												<option value="grade">Grade</option>
												<option value="emp_name">Employee Name</option>
												<option value="ffi_emp_id">FFI Emp ID</option>
												<option value="middle_name">Middle Name</option>
												<option value="last_name">Last Name</option>
												<option value="client_name">Company Name</option>
												<option value="designation">Designation</option>
												<option value="department">Department</option>
												<option value="state_name">State</option>
												<option value="location">Location</option>
												<option value="branch">Branch</option>
												<option value="phone1">Phone 1</option>
												<option value="phone2">Phone 2</option>
												<option value="email">Email</option>
												<option value="official_mail_id">Official Mail ID</option>
												<option value="interview_date">Interview Date</option>
												<option value="joining_date">Joining Date</option>
												<option value="contract_date">Contract End Date</option>
												<option value="father_name">Father Name</option>
												<option value="mother_name">Mother Name</option>
												<option value="religion">Religion</option>
												<option value="languages">languages</option>
												<option value="mother_tongue">Mother Tongue</option>
												<option value="maritial_status">Marital Status</option>
												<option value="emer_contact_no">Emergency Contact No</option>
												<option value="spouse_name">Spouse Name</option>
												<option value="no_of_childrens">No of Children</option>
												<option value="blood_group">Blood Group</option>
												<option value="qualification">Qualification</option>
												<option value="permanent_address">Permanent Address</option>
												<option value="present_address">Present Address</option>
												<option value="pan_no">Pan No</option>
												<option value="aadhar_no">Aadhar No</option>
												<option value="driving_license_no">Driving License No</option>
												<option value="bank_name">Bank Name</option>
												<option value="bank_account_no">Bank Account No</option>
												<option value="bank_ifsc_code">Bank IFSC Code</option>
												<option value="uan_no">UAN No</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>State Name</label>
												<select class="form-control multiselect-select-all-filtering" name="state[]" id="state" multiple="multiple" data-fouc>
													<?php
													$i=1;
													foreach($states as $res)
													{
														echo '<option value="'.$res['id'].'">'.$res['state_name'].'</option> ';
													}
												?>
												</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Location</label>
												<select class="form-control multiselect-filtering" name="location" id="location" data-fouc>
													<option value="">Select</option>
													<?php
													$i=1;
													foreach($location as $res1)
													{
														echo '<option value="'.$res1['location'].'">'.$res1['location'].'</option> ';
													}
												?>
												</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Active Status</label>
												<select class="form-control multiselect" name="active_status" id="active_status" data-fouc>
													<option value="">Select</option>
													<option value="0">Active</option>
													<option value="1">Inactive</option>
												</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" style="margin-top: 27px;">
											<button type="button" class="btn btn-primary btn-labeled btn-labeled-left" onclick="search_dcs_details();"><b><i class="fa fa-search" aria-hidden="true" style="font-size: 16px;"></i></b> Search</button>
											<button type="submit" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="fa fa-download" aria-hidden="true" style="font-size: 16px;"></i></b> Download</button>
										</div>
									</div>
								</div>	
								
							
							</div>
						</div>
					</form>
					
				</div>
				</div>
				<div class="card" id="payslip_table" style="display:block">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Report Details</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="reload"></a>
		                	</div>
	                	</div>
					</div>
					
					<table class="table datatable-basic table-bordered table-striped table-hover" id="get_details">
						<thead>
							
						</thead>
						<tbody >
						</tbody>
					</table>
				</div>
					
				
				<!-- /floating labels -->

		
			<!-- content area -->


				<div id="modal_theme_primary" class="modal fade" tabindex="-1">
					<div class="modal-dialog modal-lg">
						<div class="modal-content" id="client_details">
							
						</div>
					</div>
				</div>

			
</body>
</html>
