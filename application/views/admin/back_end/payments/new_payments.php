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
		function get_invoice_amount()
		{
			inv=$("#invoice_no").val();
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/payments/get_invoice_amount",
				datatype:"text",
				data:{inv:inv},
				success:function(response)
				{
					a=response.split("***");
					$('#total_gst').val(""+a[0]);
					$('#total_amount').val(""+a[1]);
					$('#amt_received').val(""+a[2]);
					$('#amount_balanced').val(""+a[3]);
					$("div#divLoading").removeClass('show');
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		}
		function get_tds_amount()
		{
			var amount = isNaN(parseInt($("#total_gst").val())) ? 0 : parseInt($("#total_gst").val());
			var tds = isNaN(parseInt($("#tds_percentage").val())) ? 0 : parseInt($("#tds_percentage").val());
			
			tds_amount=(amount*tds)/100;
			$("#tds_amount").val(tds_amount);
			
		}
		function get_balance_amount()
		{
			var amount = isNaN(parseInt($("#amount_balanced").val())) ? 0 : parseInt($("#amount_balanced").val());
			var tds = isNaN(parseInt($("#tds_amount").val())) ? 0 : parseInt($("#tds_amount").val());
			var paid = isNaN(parseInt($("#amount_paid").val())) ? 0 : parseInt($("#amount_paid").val());
			balance_amount=(amount-tds)-paid;
			$("#balance_amount").val(balance_amount);
			
			
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
						<h4><a href="<?php echo site_url('payments/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Receipts Details</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Receipts</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
					 <form class="form-horizontal" action="<?php echo site_url('payments/save_payments');?>" method="POST" enctype="multipart/form-data">
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					     
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">New Receipts Details</h5>
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
											<label>Client Name: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="client" id="client" onchange="get_client_invoice();" required data-fouc>
												<option value="">Select Client</option>
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
									<div class="col-md-4">
										<div class="form-group">
											<label>Invoice: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="invoice_no" id="invoice_no" onchange="get_invoice_amount();" required data-fouc>
												<option value="">Select Client</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Total Amount(Without GST): <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="total_gst" id="total_gst" readonly required data-fouc>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Total Amount (With GST): <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="total_amount" id="total_amount" readonly required data-fouc>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Previous Amount Received: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="amt_received" id="amt_received" readonly required data-fouc>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Balance Amount: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="amount_balanced" id="amount_balanced" readonly required data-fouc>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Payment Received Date: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control datepicker" name="payment_date" id="payment_date" autocomplete="off" required data-fouc>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Month: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="month" id="month" required data-fouc>
												<option value="">Select Month</option>
												<option value="January">January</option>
												<option value="February">February</option>
												<option value="March">March</option>
												<option value="April">April</option>
												<option value="May">May</option>
												<option value="June">June</option>
												<option value="July">July</option>
												<option value="August">August</option>
												<option value="September">September</option>
												<option value="October">October</option>
												<option value="November">November</option>
												<option value="December">December</option>
											</select>
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>TDS Code: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="tds_code" id="tds_code" data-fouc>
												<option value="">Select</option>
												<?php
													$i=1;
													foreach($tds_code as $res1)
													{
														echo '<option value="'.$res1['id'].'">'.$res1['code'].'</option> ';
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>TDS (%): <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="tds_percentage" id="tds_percentage" onchange="get_tds_amount();" data-fouc>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>TDS Amount: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="tds_amount" id="tds_amount" readonly data-fouc>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Amount Received: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="amount_paid" id="amount_paid" onchange="get_balance_amount();" required data-fouc>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Balance Amount: <span class="text-danger">*</span></label>
											<input type="textbox" class="form-control" name="balance_amount" id="balance_amount" readonly required data-fouc>
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
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</form>
				</div>
			</div>
				<!-- /floating labels -->
			<!-- content area -->
</body>
</html>
