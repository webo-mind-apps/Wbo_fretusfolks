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
								url:"<?php echo base_url(); ?>" + "index.php/cms_labour/add_doc_div",
								datatype:"text",
								data:{counter:counter,<?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>'},
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
						<h4><a href="<?php echo site_url('cms_labour/');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">Compliance Management System</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					
				</div>
				
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Compliance Management System Labour Notice</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						 <form class="form-horizontal" id="my_form" action="<?php echo site_url('cms_labour/update_labour/'.$cms_details[0]['id']);?>" method="POST" enctype="multipart/form-data">
						     
						     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						     
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Edit CMS Labour Notice</h5>
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
																if($res['id']==$cms_details[0]['client_id'])
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
											<div class="col-md-6">
												<div class="form-group">
													<label>Select State: <span class="text-danger">*</span></label>
													<select class="form-control select-search" name="state" id="state" required data-fouc>
														<option value="">Select State</option>
														<?php
															$i=1;
															foreach($state as $res1)
															{
																if($res1['id']==$cms_details[0]['state_id'])
																{
																	echo '<option value="'.$res1['id'].'" selected>'.$res1['state_name'].'</option> ';
																}
																else
																{
																	echo '<option value="'.$res1['id'].'">'.$res1['state_name'].'</option> ';
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
													<label>Location: <span class="text-danger">*</span></label>
													<input type="text" name="location" id="location" required class="form-control" value="<?php echo $cms_details[0]['location'];?>" autocomplete="off">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Notice Received Date: <span class="text-danger">*</span></label>
													<input type="text" name="received_date" id="received_date" required class="form-control datepicker" autocomplete="off" value="<?php if($cms_details[0]['notice_received_date']!="0000-00-00"){ echo date("d-m-Y",strtotime($cms_details[0]['notice_received_date']));}?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Notice Document: <span class="text-danger">*</span></label>
													<input type="file" name="file" id="file" class="form-control" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Closure Date:</label>
													<input type="text" name="closure_date" id="closure_date" class="form-control datepicker" value="<?php if($cms_details[0]['closure_date']!="0000-00-00"){ echo date("d-m-Y",strtotime($cms_details[0]['closure_date']));}?>" autocomplete="off">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Closure Document:</label>
													<input type="file" name="closure_file" id="closure_file" class="form-control" autocomplete="off">
												</div>
											</div>
										</div>
										<div style="margin-top:2%">
											<button type="submit" class="btn btn-primary" name="upload_now" id="upload_now">Save</button>
										</div>
								</div>
							</div>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
						</form>
					</div>
				</div>
			</div>
				<!-- /floating labels -->
			<!-- content area -->
</body>
</html>
