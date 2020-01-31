<?php
$active_menu = "index";
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

	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>admin_assets/global_assets/js/demo_pages/dashboard.js"></script>




	<!-- /theme JS files -->
	<style>
		#divLoading {
			display: none;
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
	</style>
	<script>
		function delete_offer_letter(id) {
			r = confirm("Are you sure to Delete ?");
			if (r == true) {
				$("div#divLoading").addClass('show');
				jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>" + "index.php/offer_letter/delete_offer_letter",
					datatype: "text",
					data: {
						id: id
					},
					success: function(response) {
						$('#get_details').empty();
						$('#get_details').append(response);
						$("div#divLoading").removeClass('show');
					},
					error: function(xhr, ajaxOptions, thrownError) {}
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Offer Letters</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					<div class="right text-center " style="width:550px;">
						<div class="row">
							<div class="col-md-2"  > 
								
							</div>
							<div class="col-md-3"  > 
									<a href="<?php echo site_url('offer_letter/pdf_offer_letter/'); ?>" class="btn btn-labeled btn-labeled-right bg-primary">Export  <b><i class="fa fa-download" aria-hidden="true"></i></b></a> 
							</div>
							<div class="col-md-3"  >
								<button type="button" class="btn btn-primary" id="import_file">Import &nbsp;&nbsp;&nbsp; <b><i class="fa fa-download" aria-hidden="true"></i></b></button></br>

								<a href="<?php echo base_url() ?>admin_assets/exel-formate/ADMS_OFFER_LETTER.xlsx" download>Sample Format</a> 

								<form enctype="multipart/form-data" method="post" action="<?php echo site_url('adms-offer-letter-import'); ?>" id="import_form" style="display:none">
									<input id="import" type="file" name="import" accept=".xls, .xlt, .xlm, .xlsx, .xlsm, .xltx, .xltm, .xlsb, .xla, .xlam, .xll, .xlw">
								</form>
							</div>
							<div class="col-md-4"  >
								<!-- <div class="header-elements d-none"> -->
									<a  href="<?php echo site_url('offer_letter/new_offer_letter'); ?>" class="btn btn-labeled btn-labeled-right bg-primary">New Offer Letter <b><i class="fa fa-plus" aria-hidden="true"></i></b></a>
								<!-- </div> -->
							</div>
						</div>
					</div>

				</div>


				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Offer Letters</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


				</div>
			</div>
			<!-- /page header -->
			<?php

			if ($this->session->flashdata('success', 'Import successfully')) {
			?>
				<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<span class="text-semibold">Import successfully..!</span>
				</div>
			<?php
			}
			?>

			<?php

			if ($this->session->flashdata('error', 'Please Choose Valid file formate ')) {
			?>
				<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<span class="text-semibold">Please Choose Valid file formate ..!</span>
				</div>
			<?php
			}
			?>

			<!-- Content area -->
			<div class="content">



				<!-- Floating labels -->
				<div class="row">

					<div class="col-md-12">



						<!-- Style combinations -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Offer Letters Details</h5>

								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item" data-action="reload"></a>
									</div>
								</div>
							</div>

							<table class="table datatable-basic table-bordered table-striped table-hover">

								<thead>
									<a href="<?php echo base_url() ?>admin_assets/exel-formate/ADMS_OFFER_LETTER.xlsx">Sample excel file</a>
									<tr>
										<th>Si No</th>
										<th>Employee ID</th>
										<th style="width:15%">Client Name</th>
										<th>Employee Name</th>
										<th style="width:15%">Offer Letter Created on</th>
										<th>Phone</th>
										<th style="width:10%">Email</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody id="get_details">
									<?php
									$i = 1;
									foreach ($offer_letter as $row) {
										$status = "";

										echo '
											<tr>
												<td>' . $i . '</td>
												<td>' . $row['employee_id'] . '</td>
												<td style="width:15%">' . $row['client_name'] . '</td>
												<td>' . $row['emp_name'] . '</td>
												<td style="width:15%">' . date("d-m-Y", strtotime($row['date'])) . '</td>
												<td>' . $row['phone1'] . '</td>
												<td>' . $row['email'] . '</td>
												<td class="text-center">
													<div class="list-icons">
														<div class="dropdown">
															<a href="#" class="list-icons-item" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="' . site_url('offer_letter/view_offer_letter/' . $row['id']) . '" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
																<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_offer_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
															</div>
														</div>
													</div>
												</td>
											</tr>';
										$i++;
									}
									?>
								</tbody>
							</table>

						</div>
						<!-- /style combinations -->



					</div>
				</div>
				<!-- /floating labels -->


				<!-- content area -->


				<div id="modal_theme_primary" class="modal fade" tabindex="-1">
					<div class="modal-dialog modal-lg">
						<div class="modal-content" id="client_details">

						</div>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						$('#import_file').click(function(e) {
							e.preventDefault();
							$('#import').trigger('click');
						});

						$('#import').change(function(e) {

							$('#import_form').submit()
						});
					});
				</script>

</body>

</html>