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
	
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_floating_labels.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>	
	<!-- /theme JS files -->
	<!-- Theme JS files -->	
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>

	<script src="<?php echo base_url();?>admin_assets/assets/js/custom.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_select2.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_layouts.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/date/jquery-ui.js"></script>
	
   <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
   <script>
   
   tinymce.init({
			selector: '.editor',
			themes: "modern", 
			  menubar:false,
    statusbar: false,
			height:150,
			plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen table"],
			 fontsize_formats: "12px 14px 16px 18px 24px 28px 30px 36px 40px",
			toolbar: "fontsizeselect | fontselect | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link table"
			
		  });
   
   </script> 
	
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
		function get_emp_details()
		{
			emp_id=$("#employee").val();
			if(emp_id!="")
			{
				 $("div#divLoading").addClass('show');	
					jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/ffi_pip_letter/get_emp_details",
					datatype:"text",
					data:{emp_id:emp_id},
					success:function(response)
					{
						if(response =="0")
						{
							alert("Employee Details Not Updated");
							$("#employee").val("");
						}
						else if(response =="failed")
						{
							alert("Employee Not Found");
							$("#employee").val("");
						}
						else
						{
							a=response.split("****");
							$("#emp_name").val(""+a[0]);
							$("#designation").val(""+a[1]);							
							$("div#divLoading").removeClass('show');
						}
						
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


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><a href="<?php echo site_url('ffi_pip_letter');?>"><i class="icon-arrow-left52 mr-2"></i></a> <span class="font-weight-semibold">FFI PIP Letter</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">FFI PIP Letter</span>
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
						 <form class="form-horizontal" action="<?php echo site_url('ffi_pip_letter/save_letter');?>" method="POST" enctype="multipart/form-data">
						     
						     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						     
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">New PIP Letter Details</h5>
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
												<label>From : <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="from_name" id="from_name" autocomplete="off" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>EMP ID : <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="employee" id="employee" onchange="get_emp_details();" autocomplete="off" required>
											</div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Emp Name : </label>
												<input type="text" class="form-control" name="emp_name" id="emp_name" autocomplete="off" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Designation : </label>
												<input type="text" class="form-control" name="designation" id="designation" autocomplete="off" readonly>
											</div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
													<label>Date : <span class="text-danger">*</span></label>
												<div class="input-group">
													<span class="input-group-prepend">
														<span class="input-group-text"><i class="icon-calendar5"></i></span>
													</span>
													<input type="text" class="form-control datepicker" name="date" id="date" required 
													placeholder="Date" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Content: <span class="text-danger">*</span></label>
												<textarea id="content" name="content" class="form-control form-input-styled editor" data-fouc><p style="text-align: justify;">The purpose of this Performance Improvement Plan (PIP) is to define serious areas of concern, gaps in your work performance, reiterate at Hiveloop Technology Pvt Ltd. expectations, and allow you the opportunity to demonstrate improvement and commitment.</p>
<p style="text-align: justify;">&nbsp;</p></textarea>
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Observations, Previous Discussions or Counseling : <span class="text-danger">*</span></label>
												<textarea id="observation" name="observation" class="form-control form-input-styled editor" data-fouc><p style="text-align: justify;">In spite of constant follow-up, motivation and warnings, since last 6 weeks, the performance is observed below mark. So intend to put you on pip.</p></textarea>
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Improvement Goals : <span class="text-danger">*</span></label>
												<textarea id="goals" name="goals" class="form-control form-input-styled editor" data-fouc><p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%; height: 72px; margin-left: auto; margin-right: auto;" border="1">
<tbody>
<tr style="height: 36px;">
<td style="width: 17.8899%; height: 36px; text-align: center;">1</td>
<td style="width: 82.1101%; height: 36px; text-align: center;">No of Listings created &ndash; 1000</td>
</tr>
<tr style="height: 36px; text-align: center;">
<td style="width: 17.8899%; height: 36px; text-align: center;">2</td>
<td style="width: 82.1101%; height: 36px; text-align: center;">New sellers added &ndash; 10</td>
</tr>
</tbody>
</table></textarea>
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Follow-up Updates : <span class="text-danger">*</span></label>
												<textarea id="updates" name="updates" class="form-control form-input-styled editor" data-fouc><table style="border-collapse: collapse; width: 98.2671%; height: 146px;" border="1">
<tbody>
<tr style="height: 41px;">
<td style="width: 20%; height: 41px; text-align: center;"><span style="font-size: 10pt;">Date Scheduled</span></td>
<td style="width: 20%; height: 41px; text-align: center;"><span style="font-size: 10pt;">Activity</span></td>
<td style="width: 20%; height: 41px; text-align: center;"><span style="font-size: 10pt;">Conducted By</span></td>
<td style="width: 20%; height: 41px; text-align: center;"><span style="font-size: 10pt;">Completion Date</span></td>
<td style="width: 20%; height: 41px; text-align: center;"><span style="font-size: 10pt;">Remarks</span></td>
</tr>
<tr style="height: 37px;">
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">10th August&rsquo;2018</span></td>
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">1st review</span></td>
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">[Supervisor/Manager]</span></td>
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">10th August&rsquo;2018</span></td>
<td style="width: 20%; height: 37px; text-align: justify;"><span style="font-size: 10pt;">Review report needs to share with the employee.</span></td>
</tr>
<tr style="height: 37px;">
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">10th August&rsquo;2018</span></td>
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">1st review</span></td>
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">[Supervisor/Manager]</span></td>
<td style="width: 20%; height: 37px; text-align: center;"><span style="font-size: 10pt;">10th August&rsquo;2018</span></td>
<td style="width: 20%; height: 37px; text-align: justify;"><span style="font-size: 10pt;">Review report needs to share with the employee.</span></td>
</tr>
<tr style="height: 31px; text-align: center;">
<td style="width: 20%; height: 31px;"><span style="font-size: 10pt;">10th August&rsquo;2018</span></td>
<td style="width: 20%; height: 31px;"><span style="font-size: 10pt;">1st review</span></td>
<td style="width: 20%; height: 31px;"><span style="font-size: 10pt;">[Supervisor/Manager]</span></td>
<td style="width: 20%; height: 31px;"><span style="font-size: 10pt;">10th August&rsquo;2018</span></td>
<td style="width: 20%; height: 31px; text-align: justify;"><span style="font-size: 10pt;">Review report needs to share with the employee.</span></td>
</tr>
</tbody>
</table></textarea>
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Timeline for Improvement, Consequences & Expectations : <span class="text-danger">*</span></label>
												<textarea id="timeline" name="timeline" class="form-control form-input-styled editor" data-fouc><p>Effective immediately, you are placed on a (15 days) PIP, that is from 06.08.2018 onwards. During this time you will be expected to make regular progress on the plan outlined above. Failure to meet or exceed these expectations, or any display of gross misconduct will result in further disciplinary action, up to and including separation.</p>
<p>The PIP does not alter the employment-at-will relationship. Additionally, the contents of this PIP are to remain confidential. Should you have questions or concerns regarding the content, you will be expected to follow up directly with the reporting manager or with us.</p>
<p>We will meet again on as noted above to discuss your Performance Improvement Plan. Please schedule accordingly.</p></textarea>
												
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary" name="upload_now" id="h-default-basic-start">Save</button>
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
