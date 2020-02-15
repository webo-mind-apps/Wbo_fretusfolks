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
	<script src="<?php echo base_url(); ?>admin_assets/assets/js/app.js"></script>
	<!-- <script src="<?php //echo base_url(); 
						?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

		.right {
			float: right;
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
					id: id
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
						id: id
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Back End Managementsadf</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


					<div class="header-elements d-none">
						<!--	<a href="<?php //echo site_url('backend_team/new_backend_team');
											?>" class="btn btn-labeled btn-labeled-right bg-primary">New Back End <b><i class="fa fa-plus" aria-hidden="true"></i></b></a>-->
					</div>
					<div class="right text-center">
						<button type="button" class="btn btn-primary" id="import_file">Import Excel &nbsp;&nbsp; <i class="fa fa-download" aria-hidden="true"></i></button>
						</br>
						<!-- <a href="<?php //echo base_url() ?>admin_assets/exel-formate/ADMS_DOC.xlsx" download >Download Format</a> -->
						<a href="<?php echo base_url() ?>doc-formate" >Download Format</a>
						<form enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>adms-doc-import" id="import_form" style="display:none">
							<input id="import" type="file" name="import" accept=".xls, .xlt, .xlm, .xlsx, .xlsm, .xltx, .xltm, .xlsb, .xla, .xlam, .xll, .xlw">
						</form>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Back End Management</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div> 
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

			<?php

			if ($this->session->flashdata('success')) {
			?>
				<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<span class="text-semibold"><?php echo $this->session->flashdata('success'); ?></span>
				</div>
			<?php
			}
			?>
			<?php

			if ($this->session->flashdata('no_file')) {
			?>
				<div class="alert bg-success alert-styled-left" style="margin: 0 20px;">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<span class="text-semibold">Please Choose Valid file formate</span>
				</div>
			<?php
			}
			?>

				<!-- Floating labels -->
				<div class="row">

					<div class="col-md-12">

						<!-- Style combinations -->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Back End Details</h5>
								<div class="header-elements">
									<div class="list-icons">
										<a href="<?php echo site_url('backend_team/download_backend_details'); ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
										<a class="list-icons-item" data-action="reload"></a>
									</div>
								</div>
							</div>

							<table id="dynamic_table" class="table datatable-basic table-bordered table-striped table-hover cell-border compact stripe">
								<thead>
									<tr>
										<th>Si No</th>
										<th>Client Name</th>
										<th>Emp ID</th>
										<th>Emp Name</th>
										<th>Joining Date</th>
										<th style="width:15%">Phone</th>
										<th>Status</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>

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
			
					var DatatableAdvanced = function() {

						// Basic Datatable examples
						var _componentDatatableAdvanced = function() {
							if (!$().DataTable) {
								console.warn('Warning - datatables.min.js is not loaded.');
								return;
							}

							// Setting datatable defaults
							$.extend($.fn.dataTable.defaults, {
								autoWidth: false,
								columnDefs: [{
									orderable: false,
									width: 100,
									targets: [5]
								}],
								dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
								language: {
									search: '<span>Filter:</span> _INPUT_',
									searchPlaceholder: 'Type to filter...',
									lengthMenu: '<span>Show:</span> _MENU_',
									paginate: {
										'first': 'First',
										'last': 'Last',
										'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
										'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
									}
								}
							});

							var dataTable = $('#dynamic_table').DataTable({
								'processing': true,
								'serverSide': true,
								'order': [], 
								'ajax': {
									'url': "<?php echo base_url() . 'Backend_team/get_all_data' ?>",
									'type': 'POST'
								},
								'columnDefs': [{
									"targets": [7],
									"orderable": false,
								}],

							})
                           
							// Datatable 'length' options
							$('.datatable-show-all').DataTable({
								lengthMenu: [
									[10, 25, 50, -1],
									[10, 25, 50, "All"]
								]
							});

							// DOM positioning
							$('.datatable-dom-position').DataTable({
								dom: '<"datatable-header length-left"lp><"datatable-scroll"t><"datatable-footer info-right"fi>',
							});

							// Highlighting rows and columns on mouseover
							var lastIdx = null;
							var table = $('.datatable-highlight').DataTable();

							$('.datatable-highlight tbody').on('mouseover', 'td', function() {
								var colIdx = table.cell(this).index().column;

								if (colIdx !== lastIdx) {
									$(table.cells().nodes()).removeClass('active');
									$(table.column(colIdx).nodes()).addClass('active');
								}
							}).on('mouseleave', function() {
								$(table.cells().nodes()).removeClass('active');
							});

							// Columns rendering
							$('.datatable-columns').dataTable({
								columnDefs: [{
										// The `data` parameter refers to the data for the cell (defined by the
										// `data` option, which defaults to the column being worked with, in
										// this case `data: 0`.
										render: function(data, type, row) {
											return data + ' (' + row[3] + ')';
										},
										targets: 0
									},
									{
										visible: false,
										targets: [3]
									}
								]
							});

						};
						//
						// Return objects assigned to module
						//
						return {
							init: function() {
								_componentDatatableAdvanced();
							}
						}
					}();

					document.addEventListener('DOMContentLoaded', function() {
						DatatableAdvanced.init()
					});
				</script>
				<!-- ----- -->
</body>

</html>