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
		function search_payments_details()
		{
			client=$("#client").val();
			from_date=$("#from_date").val();
			to_date=$("#to_date").val();
			req_data=$("#data").val();
			state=$("#state").val();
			active_status=$("#active_status").val();
			tds_code=$("#tds_code").val();
			
			/*
			if(client=="" && from_date=="" && to_date=="" && req_data=="" && state=="" && active_status=="" && tds_code=="")
			{
				alert("Please Fill Any One Field To Search");
				return;
			}
			*/
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/reports_tds/search_tds_details",
				datatype:"text",
				data:{client:client,from_date:from_date,to_date:to_date,req_data:req_data,state:state,active_status:active_status,tds_code:tds_code},
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
	</script>
	<script>
		function view_invoice_details(id)
		{
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/payments/view_invoice_details",
				datatype:"text",
				data:{id:id},
				success:function(response)
				{
					$('#invoice_details').empty();
					$('#invoice_details').append(response);
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">TDS Reports</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">TDS Reports</span>
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
					 <form class="form-horizontal" id="my_form" action="<?php echo site_url('reports_tds/download_report');?>" method="POST" enctype="multipart/form-data">
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
												placeholder="DD-MM-YYYY" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>To Date</label>
											<div class="input-group">
												<span class="input-group-prepend"><span class="input-group-text"><i class="icon-calendar5"></i></span></span>
												<input type="text" class="form-control datepicker" name="to_date" id="to_date" placeholder="DD-MM-YYYY" autocomplete="off">
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
											<label>TDS Code</label>
												<select class="form-control multiselect-select-all-filtering" name="tds_code" id="tds_code" data-fouc>
													<option value="">Select</option>
													<?php 
														foreach($tds_code as $res1)
														{
															echo '<option value="'.$res1['id'].'">'.$res1['code'].'</option>';
														}
													?>
												</select>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Data</label>
											<select class="form-control multiselect-select-all-filtering" name="data[]" id="data" multiple="multiple" data-fouc>
												<option value="invoice_no">Invoice No</option>
												<option value="client_name">Company Name</option>
												<option value="state_name">Service Location</option>
												<option value="payment_received_date">Payment Received Date</option>
												<option value="month">Month</option>
												<option value="code">TDS Code</option>
												<option value="tds_percentage">TDS Percentage</option>
												<option value="tds_amount">TDS Amount</option>
												<option value="amount_received">Amount Received</option>
												<option value="balance_amount">Balance Amount</option>
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
											<button type="button" class="btn btn-primary btn-labeled btn-labeled-left" onclick="search_payments_details();"><b><i class="fa fa-search" aria-hidden="true" style="font-size: 16px;"></i></b> Search</button>
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
						<div class="modal-content" id="invoice_details">
							
						</div>
					</div>
				</div>

			
</body>
</html>
