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
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_floating_labels.js"></script>
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
		$(document).ready(function()
			{
				var counter = 1;
				
				$("#addButton").click(function () {
					
					jQuery.ajax({
								type:"POST",
								url:"<?php echo base_url(); ?>" + "index.php/cms_lwf/add_doc_div",
								datatype:"text",
								data:{counter:counter},
								success:function(response)
								{
										$("#cycles").append(response);
										$(".date").datepicker({ dateFormat: "dd-mm-yy",maxDate: 0}).val();
										counter++;
								},
								error:function (xhr, ajaxOptions, thrownError){}
							});
			 }); 
		  });
		  
		  function remove_cycle_div(id)
		  {
			  r=confirm("Are You Sure to Remove");
			  if(r==true)
			  {
				$("#row_"+id).empty();
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


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><a href="<?php echo site_url('cms_lwf/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Compliance Management System</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					
				</div>
				
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Compliance Management System LWF Challan</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						 <form class="form-horizontal" id="my_form" action="<?php echo site_url('cms_lwf/save_lwf');?>" method="POST" enctype="multipart/form-data">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">New CMS LWF Challan</h5>
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
													<label>Enter Client Name: <span class="text-danger">*</span></label>
													<select class="form-control select-search" name="client" id="client" required data-fouc>
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
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Select State: <span class="text-danger">*</span></label>
													<select class="form-control select-search" name="state" id="state" required data-fouc>
														<option value="">Select State</option>
														<?php
															$i=1;
															foreach($state as $res1)
															{
																echo '<option value="'.$res1['id'].'">'.$res1['state_name'].'</option> ';
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Month</th>
														<th>Year</th>
														<th>Document</th>
														<th class="text-center">Actions</th>
													</tr>
												</thead>
												<tbody id="cycles">
													<tr id="row_1">
														<td>
															<select name="month[]" id="month_1" class="form-control" required>
																	<option value="">Select Month</option>
																	<?php
																		for($i=1;$i<=12;$i++)
																		{
																			echo '<option value="'.$i.'">'.date("F",strtotime("12-$i-2017")).'</option>';
																		}
																	?>
															</select>	
														</td>
														<td>
															<select name="year[]" id="year_1" class="form-control" required>
																<option value="">Select Year</option>
																<?php
																	for($i=2018;$i<=date("Y");$i++)
																	{
																		echo '<option value="'.$i.'">'.$i.'</option>';
																	}
																?>
															</select>
														</td>
														
														<td>
																<input type="file" name="file[]" id="file_1" class="form-control"  required >
														</td>
														<td><a href="javascript:void(0);" id="addButton"><i class="fa fa-plus-square" aria-hidden="true"></i></td>
													</tr>
												</tbody>
												</thead>
											</table>
										</div>
										<div style="margin-top:2%">
											<button type="submit" class="btn btn-primary" name="upload_now" id="upload_now">Upload</button>
										</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
				<!-- /floating labels -->
			<!-- content area -->
</body>
</html>
