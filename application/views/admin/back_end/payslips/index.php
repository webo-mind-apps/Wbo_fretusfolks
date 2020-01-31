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
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
		<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/dashboard.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_floating_labels.js"></script>
	
	<style>

.loader {
  border: 4px solid #f3f3f3;
  border-radius: 50%;
  border-top: 4px solid red;
  border-bottom: 4px solid red;
  border-left: 4px solid blue;
  width: 28px;
  height: 28px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
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
		function search_payslip()
		{
			emp_id=$("#emp_id").val();
			month=$("#month").val();
			year=$("#year").val();
			
			if(emp_id=="" && month=="" && year=="")
			{
				alert("Please Fill Any One Field To Search");
				return;
			}
			
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/payslips/search_payslip",
				datatype:"text",
				data:{emp_id:emp_id,month:month,year:year},
				success:function(response)
				{
					$('#payslip_table').css("display","block");
					$('#get_details').empty();
					$('#get_details').append(response);
					$("div#divLoading").removeClass('show');
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		}
		function delete_payslip(id)
		{
			emp_id=$("#emp_id").val();
			month=$("#month").val();
			year=$("#year").val();
			r=confirm("Are you sure to Delete ?");
			{
				$("div#divLoading").addClass('show');	
					jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/payslips/delete_payslip",
					datatype:"text",
					data:{id:id,emp_id:emp_id,month:month,year:year},
					success:function(response)
					{
						$('#get_details').empty();
						$('#get_details').append(response);
						$("div#divLoading").removeClass('show');
					},
					error:function (xhr, ajaxOptions, thrownError){}
				});
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

	<div id="divLoading"> 
    </div>
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Payslips</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Payslips</span>
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
						
							<div class="card">

								<ul class="nav nav-tabs" id="myTab" role="tablist">
									  <li class="nav-item">
										<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upload Payslips</a>
									  </li>
									  <li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Download Payslips</a>
									  </li>
									  
									</ul>
									<div class="tab-content" id="myTabContent">
									  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									  <div class="card-header header-elements-inline">
									<h5 class="card-title">Upload Excel Sheet :[<a href="<?php echo base_url()."downloads/salary_slip.xlsx";?>" target="_blank">Sample Format</a>]</h5>
									
								</div>
								<form class="form-horizontal" id="my_form" action="<?php  echo site_url('payslips/upload_payslips');?>" method="POST" enctype="multipart/form-data">

								<div class="card-body">
								
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>Month <span class="text-danger">*</span></label>
												<select name="payslip_month" id="payslip_month" class="form-control" required>
														<option value="">Select Month</option>
														<?php
															for($i=1;$i<=12;$i++)
															{
																echo '<option value="'.$i.'">'.date("F",strtotime("12-$i-2017")).'</option>';
															}
														?>
												</select>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label>Year: <span class="text-danger">*</span></label>
												<select name="payslip_year" id="payslip_year" class="form-control" required>
													<option value="">Select Year</option>
													<?php
														for($i=2018;$i<=date("Y");$i++)
														{
															echo '<option value="'.$i.'">'.$i.'</option>';
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-10">
											<div class="form-group form-group-float">
												<input type="file" name="file" id="file" class="form-control-uniform" required data-fouc>
											</div>
										</div>
									</div>
									<div>
										<button type="submit" class="btn btn-primary" name="upload_now" id="upload_now">Upload</button>
									</div>
								</div>
									  </div>
									  </form>


									  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									  <div class="card-header header-elements-inline">
									<h5 class="card-title">Download Excel Sheet:<div class="loader" style="display:none"></div></h5>
									
									
									
								</div>
											
								<div class="card-body">

								<form class="form-horizontal" id="my_form" action="<?php  echo site_url('payslips/download_payslips');?>" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Month <span class="text-danger">*</span></label>
												<select name="payslip_download_month" id="payslip_month" class="form-control" required>
														<option value="">Select Month</option>
														<?php
															for($i=1;$i<=12;$i++)
															{
																echo '<option value="'.$i.'">'.date("F",strtotime("12-$i-2017")).'</option>';
															}
														?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Year: <span class="text-danger">*</span></label>
												<select name="payslip_download_year" id="payslip_year" class="form-control" required>
													<option value="">Select Year</option>
													<?php
														for($i=2018;$i<=date("Y");$i++)
														{
															echo '<option value="'.$i.'">'.$i.'</option>';
														}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Clinent Name<span class="text-danger">*</span></label>
												<select name="payslip_download_client" id="payslip_client" class="form-control" required>
														<option value="">Select Name</option>
														<?php
															foreach($client_management as $row)
															{
																echo '<option value="'.$row['client_name'].'">'.$row['client_name'].'</option>';
															}
														?>
												</select>
											</div>
										</div>
									
									</div>
								
									<div>
										<button type="submit" class="btn btn-primary" name="download_now" id="download_now">Download</button>
									</div>
									
									
								</div>
							</div>
							<!-- /other inputs -->
						</form>
					</div>
				</div>
				</div>
					
				<div class="row">
					<div class="col-md-12">
					 <form class="form-horizontal" id="my_form" action="" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Search Payslips</h5>
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
												<input type="text" name="emp_id" id="emp_id" class="form-control" placeholder="Employee ID" required>
											</div>
										</div>	
										<label class="control-label col-lg-1" style="padding-top:1%">Month</label>
										<div class="col-md-3">
											<select name="month" id="month" class="form-control" required>
												<option value="">Select Month</option>
												<?php
													for($i=1;$i<=12;$i++)
													{
														echo '<option value="'.$i.'">'.date("F",strtotime("12-$i-2017")).'</option>';
													}
												?>
											</select>
										</div>	
										<label class="control-label col-lg-1" style="padding-top:1%">Year</label>
											<div class="col-md-3">
													<select name="year" id="year" class="form-control" required>
														<option value="">Select Year</option>
														<?php
															for($i=2018;$i<=date("Y");$i++)
															{
																echo '<option value="'.$i.'">'.$i.'</option>';
															}
														?>
													</select>
											</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<button type="button" class="btn btn-primary btn-labeled btn-labeled-left" onclick="search_payslip();"><b><i class="fa fa-search" aria-hidden="true" style="font-size: 16px;"></i></b> Search</button>
										</div>
									</div>
								</div>	
								
							</div>
							
						</div>
					</form>
					</div>
				</div>
				
				
				<div class="card" id="payslip_table" style="display:none">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Payslip Details</h5>
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
								<th>EMP ID</th>
								<th>EMP Name</th>
								<th>Designation</th>
								<th>Client</th>
								<th style="width:15%">Date</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody id="get_details">
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
				<script >
	jQuery(document).ready(function() {
	
  $("#download_now").click(function(){

	$(".loader").css("display","block");
	
        
    });
  });
    
</script>
			
</body>
</html>
