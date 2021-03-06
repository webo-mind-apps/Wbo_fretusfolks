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
		<script>
		   $( function() 
		   {
				var d = new Date();
				d.setFullYear(d.getFullYear()+10);
		   
				var date = $('.datepicker').datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
				changeYear: true,yearRange: '1970:' + d.getFullYear(),maxDate:0}).val();
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
		function get_client_invoice()
		{
			client=$("#client").val();
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/payments/get_client_invoice",
				datatype:"text",
				data:{client:client},
				success:function(response)
				{
					$('#invoice_no').empty();
					$('#invoice_no').append(response);
					$("div#divLoading").removeClass('show');
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		}
		function get_tds_amount()
		{
			invoice=$("#invoice_no").val();
			tds_percentage=$("#tds_percentage").val();
			
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/payments/get_tds_amount",
				datatype:"text",
				data:{invoice:invoice,tds_percentage:tds_percentage},
				success:function(response)
				{
					$('#tds_amount').val(""+response);
					$("div#divLoading").removeClass('show');
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
						<h4><a href="<?php echo site_url('ffcm/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">FFI Assets Management</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">FFI Assets Management</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
					 <form class="form-horizontal" action="<?php echo site_url('ffi_assets/save_assets');?>" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">New Entry</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Asset Name: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="asset_name" id="asset_name" placeholder="Asset Name" autocomplete="off" required data-fouc>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Asset Code: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="asset_code" id="asset_code" placeholder="Asset Code" autocomplete="off" required data-fouc>
										</div>
									</div>
									
								</div>	
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Employee Name: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="employee" id="employee" required data-fouc>
												<option value="">Select Employee</option>
												<?php
													$i=1;
													foreach($all_employee as $res)
													{
														echo '<option value="'.$res['id'].'">'.$res['emp_name'].'</option> ';
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Date of Issued: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control datepicker" name="issue_date" id="issue_date" placeholder="DD-MM-YYYY" autocomplete="off" required data-fouc>
										</div>
									</div>
									
								</div>	
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Return Date :</label>
											<input type="textbox" class="form-control datepicker" name="return_date" id="return_date" placeholder="DD-MM-YYYY" autocomplete="off" data-fouc>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Damage/Recovery: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="damage" id="damage" data-fouc>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label> Status : <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="status" id="status" autocomplete="off" required data-fouc>
												<option value="">Select Status</option>
												<option value="0">Issued</option>
												<option value="1">Returned</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
				<!-- /floating labels -->
			<!-- content area -->
</body>
</html>
