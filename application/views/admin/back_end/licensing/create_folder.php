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
	<link href="<?php echo base_url(); ?>admin_assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->

	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/jquery-ui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<!-- ---css datepicker -->
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>admin_assets/assets/css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">

	<!-- <script src="<?php //echo base_url(); 
						?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script> -->
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/assets/js/app.js"></script>
	<!-- <script src="<?php //echo base_url(); 
						?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" > -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- /theme JS files -->
	
	<style>
		#divLoading {
			display: none;
		}

		.down {
			float: left;
		}

		#divLoading.show {
			display: block;
			position: fixed;
			z-index: 100;
			background-image: url('<?php echo base_url(); ?>admin_assets/3.gif');
			background-color: #666;
			opacity: 0.4;
			background-repeat: no-repeat;
			background-position: center;
			left: 0;
			bottom: 0;
			right: 0;
			top: 0;
		}
		.ui-datepicker-prev {
			position: absolute;
			top: 50% !important;
			margin-top: -.9375rem;
			line-height: 1;
			color: #333;
			padding: .4375rem;
			cursor: pointer;
			border-radius: .1875rem;
		}

		.ui-datepicker-next {
			position: absolute;
			top: 50% !important;
			margin-top: -.9375rem;
			line-height: 1;
			color: #333;
			padding: .4375rem;
			cursor: pointer;
			border-radius: .1875rem;
		}

		#loadinggif.show {
			left: 50%;
			top: 50%;
			position: absolute;
			z-index: 101;
			width: 32px;
			height: 32px;
			margin-left: -16px;
			margin-top: -16px;
		}

		div.content {
			width: 100%;
			height: 100%;
		}

		.right {
			float: right;
		}

		.dataTables_length {
			float: right;
			display: inline-block;
			margin: 0 1.5rem 1.25rem 1.25rem;
		}

		.table-bordered {
			border-top: 1px solid #b7b7b7 !important;
			border-bottom: 1px solid #b7b7b7 !important;
			margin-bottom: 10px;
		}

		#dynamic_table_info {
			margin-left: 20px;
		}
	</style>
	<script>
		function view_backend_team_details(id) {
			$("div#divLoading").addClass('show');
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/backend_team/view_backend_team_details",
				datatype: "text",
				data: {
					id: id,
					<?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>'
				},
				success: function(response) {
					$('#client_details').empty();
					$('#client_details').append(response);
					$("div#divLoading").removeClass('show');
					$('#modal_theme_primary').modal('show');
				},
				error: function(xhr, ajaxOptions, thrownError) {}
			});
		}

		function delete_backend_team(id) {
			r = confirm("Are you sure to delete ?");
			if (r == true) {
				$("div#divLoading").addClass('show');
				jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>" + "index.php/backend_team/delete_backend_team",
					datatype: "text",
					data: {
						id: id,
						<?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>'
					},
					success: function(response) {
						$('#get_details').empty();
						$('#get_details').append(response);
						$("div#divLoading").removeClass('show');
						$("#dynamic_table").DataTable().ajax.reload();

					},
					error: function(xhr, ajaxOptions, thrownError) {}
				});
			}
		}
	</script>
	<script>
		$(function() {
			$("#From").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				showOtherMonths: true,
				yearRange: '1947:2100',
				onClose: function(selectedDate) {
					$("#To").datepicker("option", "minDate", selectedDate);
				}
			});
			$("#To").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				showOtherMonths: true,
				yearRange: '1947:2100',
				onClose: function(selectedDate) {
					$("#From").datepicker("option", "maxDate", selectedDate);
				}
			});

			$('#button').click(function() {
				//e.preventDefault();
				$('#fetchData').modal('toggle'); //or  $('#IDModal').modal('hide');

			});
		});
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Create Folder</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<?php

				if ($this->session->flashdata('no_data', 'No datas founded')) {
				?>
					<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<span class="text-semibold">No datas found..!</span>
					</div>
				<?php
				}
				?>
				<?php

					if ($this->session->flashdata('take_time', 'Large size')) {
					?>
						<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span class="text-semibold">The selected file is too large and is causing the form to exceed the amount allowable resources...!!</span>
						</div>
					<?php
					}
					?>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Create Folder</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				
				<div class="row">
					<div class="col-md-6">
					<?php

				if ($this->session->tempdata('folder-success')) {
				?>
					<div class="alert bg-success alert-styled-left" style="margin: 10 20px;">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<span class="text-semibold"><?= $this->session->tempdata('folder-success'); ?></span>
					</div>
				<?php
				}
				?>
				<?php

				if ($this->session->tempdata('folder-failed')) {
				?>
					<div class="alert bg-danger alert-styled-left" style="margin: 10 20px;">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<span class="text-semibold"><?= $this->session->tempdata('folder-failed'); ?></span>
					</div>
				<?php
				}
				?>
					 <form class="form-horizontal" id="my_form" action="<?php echo base_url('save-folder');?>" method="POST" enctype="multipart/form-data">
					     
					     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					     
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">New Folder</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-10">
										<div class="form-group">
											<label>Company</label>
											<div class="input-group">
												<select class="form-control" name="company_name" id="company_name" required autocomplete="off">
												<option value="">Select Company</option>
												<?php
													foreach($company as $row){
														?>
														<option value="<?= $row['id'];?>"><?= $row['client_name'];?></option>
														<?php
													}
												?>
													
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-10">
										<div class="form-group">
											<label>Folder Name</label>
											<div class="input-group">
												<input type="text" class="form-control" name="folder_name" id="folder_name" required placeholder="Folder Name" autocomplete="off" maxlength="50">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<button type="submit" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="fa fa-folder" aria-hidden="true" style="font-size: 16px;"></i></b> Save</button>
										</div>
									</div>
								</div>	
								
							
							</div>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</form>
					
					</div>
				</div>
			
</body>

</html>
