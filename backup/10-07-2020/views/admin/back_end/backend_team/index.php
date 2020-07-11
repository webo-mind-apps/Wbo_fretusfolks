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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Back End Management</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


					<div class="header-elements d-none">
						<!--	<a href="<?php //echo site_url('backend_team/new_backend_team');
											?>" class="btn btn-labeled btn-labeled-right bg-primary">New Back End <b><i class="fa fa-plus" aria-hidden="true"></i></b></a>-->
					</div>
					<div class="right text-center">
						<div class="row">
							<div class="col-md-5">
								<!-- <a href="<?php //echo base_url(); 
												?>backend_team/download_backend_details" > -->
								<button type="button" class="btn btn-labeled btn-labeled-right bg-primary" data-toggle="modal" data-target="#fetchData">&nbsp;&nbsp;Download&nbsp;<b> <i class="fa fa-download" aria-hidden="true"></i></b></button>
								<!-- </a> -->
								<div class="modal fade" role="dialog" id="fetchData">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="content">
												<div class="modal-body">
													<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>backend_team/download_backend_details" name="certform">
														<label class="down"><b>Clinent Name</b></label>
														<div class="form-group">

															<select name="backend_download_client" class="form-control">
																<option value=""><b>Select Name</b></option>
																<?php
																foreach ($client_management as $row) {
																	echo '<option value="' . $row['id'] . '">' . $row['client_name'] . '</option>';
																}
																?>
															</select>
														</div>
														<label class="down"><b>Active Status</b></label>
														<div class="form-group">

															<select name="emp_status" class="form-control">
																<option value=""><b>Select</b></option>
																<option value="0"><b>Active</b></option>
																<option value="1"><b>Inactive</b></option>

															</select>
														</div>
														<div class="form-group">
															<label class="down"><b>Employee Joining Date</b>
															</label><br>
															<div style="display: flex;width:100%">
																<span style="margin-right:5px;padding-top:9px;">From:</span>
																<input id="From" type="text" name="backend_download_date" class="form-control" autocomplete="off"><br>
															</div><br>
															<div style="display:flex;">
																<span style="margin-right:21px;padding-top:9px">To: </span>
																<input id="To" type="text" name="backend_download_date2" class="form-control" autocomplete="off"><br>
															</div>
														</div>

												</div>
												<div class="modal-footer down">
													<button type="submit" name="download" id="button" class="btn btn-success ">Download</button>
												</div>
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-5">
								<button type="button" class="btn btn-labeled btn-labeled-right bg-primary" id="import_file">&nbsp;&nbsp;Import &nbsp;<b><i class="fa fa-reply" aria-hidden="true"></i></b></button>
							</div>
						</div>
						<!-- <a href="<?php //echo base_url() 
										?>admin_assets/exel-formate/ADMS_DOC.xlsx" download >Download Format</a> -->
						<!-- <a href="<?php echo base_url() ?>doc-formate" >Download Format</a> -->
						<form enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>adms-doc-import" id="import_form" style="display:none">
							<input id="import" type="file" name="import" accept=".xls, .xlt, .xlm, .xlsx, .xlsm, .xltx, .xltm, .xlsb, .xla, .xlam, .xll, .xlw">
						</form>
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
							<span class="breadcrumb-item active">Back End Management</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					<span style="float:right"><a href="<?php echo base_url() ?>doc-formate">Download Sample Format</a></span>
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

							</div>

							<table id="dynamic_table" class="table datatable-basic table-bordered table-striped table-hover cell-border compact stripe datatable-row-basic">
								<thead>
									<tr>
										<th>Si No</th>
										<th>Client Name</th>
										<th>Emp ID</th>
										<th>Emp Name</th>
										<th>Joining Date</th>
										<th style="width:15%">Phone</th>
										<th>Status</th>
										<th>Active Status</th>
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
									targets: [6]
								}],
								// dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
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
					// $(function(){
					// 	$(window).bind('beforeunload',function(){
					// });
					// // $(document).on('load',function(){
					// // 	alert('hi')
					// // });
					// if(document.readyState=="loading")
					// 	$('body').css('background-color','red');
					// 	alert("test")
					// })
				</script>
				<!-- ----- -->
</body>

</html>