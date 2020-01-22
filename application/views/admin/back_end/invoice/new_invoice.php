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
		function get_client_location()
		{
			client=$("#client").val();
			
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/fcms/get_client_location",
				datatype:"text",
				data:{client:client},
				success:function(response)
				{
					$('#location').empty();
					$('#location').append(response);
					$('#gst_no').val("");
					$("div#divLoading").removeClass('show');
					
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		}
		function get_client_gst()
		{
			client=$("#client").val();
			client_location=$("#location").val();
			if(client !="" && client_location !="")
			{
				$("div#divLoading").addClass('show');	
					jQuery.ajax({
						type:"POST",
						url:"<?php echo base_url(); ?>" + "index.php/fcms/get_client_gst",
						datatype:"text",
						data:{client:client,client_location:client_location},
						success:function(response)
						{
							$('#gst_no').val(""+response);
							$("div#divLoading").removeClass('show');
						},
						error:function (xhr, ajaxOptions, thrownError){}
						});
			}
		}
		function get_calculate_total()
		{
			
			var gross_value = isNaN(parseInt($("#gross_value").val())) ? 0 : parseInt($("#gross_value").val());
			var service_fees = isNaN(parseInt($("#service_fees").val())) ? 0 : parseInt($("#service_fees").val());
			var source_fees = isNaN(parseInt($("#source_fees").val())) ? 0 : parseInt($("#source_fees").val());
			
			total=parseInt(gross_value)+parseInt(service_fees)+parseInt(source_fees);
			$("#total").val(""+total);
			get_tax_amt();
		}
		function get_tax_amt()
		{
			var total = isNaN(parseInt($("#total").val())) ? 0 : parseInt($("#total").val());
			
			var cgst = isNaN(parseInt($("#cgst").val())) ? 0 : parseInt($("#cgst").val());
			var sgst = isNaN(parseInt($("#sgst").val())) ? 0 : parseInt($("#sgst").val());
			var igst = isNaN(parseInt($("#igst").val())) ? 0 : parseInt($("#igst").val());
			
			cgst_amt=(total*cgst)/100;
			sgst_amt=(total*sgst)/100;
			igst_amt=(total*igst)/100;
			
			$("#cgst_amt").val(""+cgst_amt);
			$("#sgst_amt").val(""+sgst_amt);
			$("#igst_amt").val(""+igst_amt);
			
			total_tax=cgst_amt+sgst_amt+igst_amt;
			$("#total_tax").val(""+total_tax);
			get_inv_total();
		}
		function get_inv_total()
		{
			var total = isNaN(parseInt($("#total").val())) ? 0 : parseInt($("#total").val());
			var total_tax = isNaN(parseInt($("#total_tax").val())) ? 0 : parseInt($("#total_tax").val());
			
			inv_total=total+total_tax;
			$("#inv_total").val(""+inv_total);
			get_grand_total();
		}
		function get_grand_total()
		{
			var inv_total = isNaN(parseInt($("#inv_total").val())) ? 0 : parseInt($("#inv_total").val());
			var credit_amt= isNaN(parseInt($("#credit_note").val())) ? 0 : parseInt($("#credit_note").val());
			var debit_amt = isNaN(parseInt($("#debit_note").val())) ? 0 : parseInt($("#debit_note").val());
			
			total=inv_total-credit_amt;
			
			grand_total=total+debit_amt;
			$("#grand_total").val(""+grand_total);
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
						<h4><a href="<?php echo site_url('fcms/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Client Invoice Management System</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Client Invoice Management System</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
					 <form class="form-horizontal" action="<?php echo site_url('fcms/save_invoice');?>" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">New Invoice Details</h5>
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
									<div class="col-md-5">
										<div class="form-group">
											<label>Client Name: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="client" id="client" onchange="get_client_location();" required data-fouc>
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
									<div class="col-md-5">
										<div class="form-group">
											<label>Client Location: <span class="text-danger">*</span></label>
											<select class="form-control select-search" name="location" id="location" onchange="get_client_gst();" required data-fouc>
												<option value="">Select Client</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>GST No: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="gst_no" id="gst_no" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Invoice Number: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="invoice_no" id="invoice_no" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Gross Value: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="gross_value" id="gross_value" onchange="get_calculate_total();" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Service fees: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="service_fees" id="service_fees" onchange="get_calculate_total();" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Sourcing fees: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="source_fees" id="source_fees" onchange="get_calculate_total();" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label>Total: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="total" id="total" onchange="get_calculate_total();" autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-5">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>CGST: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="cgst" id="cgst" placeholder="CGST %" onchange="get_tax_amt();" autocomplete="off" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>CGST Amt: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="cgst_amt" id="cgst_amt" placeholder="CGST Amt" readonly autocomplete="off" required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>SGST: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="sgst" id="sgst" placeholder="SGST %" onchange="get_tax_amt();" autocomplete="off" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>SGST Amt: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="sgst_amt" id="sgst_amt" placeholder="SGST Amt" readonly autocomplete="off" required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									
									<div class="col-md-5">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>IGST: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="igst" id="igst" placeholder="IGST %" onchange="get_tax_amt();" autocomplete="off" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>IGST Amt: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="igst_amt" id="igst_amt" placeholder="IGST Amt" autocomplete="off" readonly required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Total Tax: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="total_tax" id="total_tax" placeholder="Total Tax" autocomplete="off" readonly required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Invoice Amount: <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="inv_total" id="inv_total" placeholder="Invoice Amount" autocomplete="off" readonly required>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Credit Note: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="credit_note" id="credit_note" onchange="get_grand_total()" autocomplete="off" value="0" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Debit Note: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="debit_note" id="debit_note" onchange="get_grand_total()" autocomplete="off" value="0" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Grand Total</label>
											<input type="text" class="form-control" name="grand_total" id="grand_total" placeholder="Grand Total" autocomplete="off" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Total No of Employee: <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="total_employee" id="total_employee" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Invoice Date: <span class="text-danger">*</span></label>
											<input type="text" class="form-control datepicker" name="inv_date" id="inv_date" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>For the month: <span class="text-danger">*</span></label>
											<select class="form-control" name="inv_month" id="inv_month" autocomplete="off" required>
												<option value="">Select</option>
												<?php
													for($i=1;$i<=12;$i++)
													{
														echo '<option value="'.date("F",strtotime("01-".$i."-2018")).'">'.date("F",strtotime("01-".$i."-2018")).'</option>';
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Attach File:(Max file size 5 Mb)</label>
											<input type="file" id="file" name="file" class="form-input-styled" data-fouc onchange="validate_file()">
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
