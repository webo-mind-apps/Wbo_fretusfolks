<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
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
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/jquery.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
		<!-- <script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
	<style>
				#divLoading
				{
					display : none;
				}
				#divLoading.show
				{
					display : block;
					position : fixed;
					z-index: 100;
					background-image : url('<?php echo base_url();?>admin_assets/3.gif');
					background-color:#666;
					opacity : 0.4;
					background-repeat : no-repeat;
					background-position : center;
					left : 0;
					bottom : 0;
					right : 0;
					top : 0;
				}
				#loadinggif.show
				{
					left : 50%;
					top : 50%;
					position : absolute;
					z-index : 101;
					width : 32px;
					height : 32px;
					margin-left : -16px;
					margin-top : -16px;
				}
				div.content {
				   width : 100%;
				   height : 100%;
				}
	</style>
	<script>
	// For making Active
	function status_active_checks(id){

	  //$("#inactive_btn").attr('disabled','disabled');
	 // $("#active_btn").removeAttr('disabled'); 
	  var checked = $('input[name="checkbox[]"]:checked'); 
	  var id = [];
	  $.each(checked, function (index, value) { 
	  id[index] = $(value).val();
		
	  });
	  console.log(id);
	  
      if(confirm("Are you sure to Active ?")){
        $.ajax({
          type:"POST",
          url: "<?php echo base_url(); ?>" + "index.php/bulk_update/active_update",
          data: {
			  id:id,
			  status:1
			},
          success: function(data)
          {  
            $("#dtable").DataTable().ajax.reload();
          },
		  error: function(xhr, ajaxOptions, thrownError) {}
        });
      }     
    }


	// For making Inactive
	function status_inactive_checks(id){

	 // $("#active_btn").attr('disabled','disabled');
	 // $("#inactive_btn").removeAttr('disabled'); 
	  var checked = $('input[name="checkbox[]"]:checked'); 
	  var id = [];
	  $.each(checked, function (index, value) { 
	  id[index] = $(value).val();
		
	  });
	  console.log(id);
	  
      if(confirm("Are you sure to Inactive ?")){
        $.ajax({
          type:"POST",
          url: "<?php echo base_url(); ?>" + "index.php/bulk_update/inactive_update",
          data: {
			  id:id,
			  status:0
			},
          success: function(data)
          {  
            $("#dtable").DataTable().ajax.reload();
          },
		  error: function(xhr, ajaxOptions, thrownError) {}
        });
      }     
    }
	</script>

<script>
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

							//For datatables
							var dataTable = $('#dtable').DataTable({
								'processing': true,
								'serverSide': true,
								'order' : [],
								'ajax': {
									'url': "<?php echo base_url() . 'bulk_update/get_all_data' ?>",
									'type': 'POST'
								},
								'columnDefs': [{
									"targets": [0],
									"orderable": false
								}],
							});
							
							//For select all  
							$(document).on('change', '#selectAll', function(){
								if($(this).prop('checked')){
								$('.checkbox').prop('checked', true);
								}else{
								$('.checkbox').prop('checked', false);
								}
								});
							
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Bulk Update</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Bulk Update</span>
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

										<!-- Style combinations -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Bulk Updates</h5>
						<div class="header-elements">
							<div class="list-icons">
								<button type="button" class="btn-success btn btn-sm" onclick="status_active_checks(this.id)" id="active_btn" >Active</button>
		                		<button type="button" class="btn-danger btn btn-sm" onclick="status_inactive_checks(this.id)" id="inactive_btn">Inactive</button>
								
		                	</div>
	                	</div>
					</div>
					
					<table id="dtable" class="table datatable-basic table-bordered table-striped table-hover">
						<thead>
							<tr>
							<th style="width: 30px;"><center><input type="checkbox" id="selectAll" style="width:20px !important; height:20px !important;" /></th></center>
								<th>SI No</th>
								<th>Emp ID</th>
								<th>Emp Name</th>
								<th class="text-center">Status</th>
							</tr>
						</thead>
						
					</table>
				</div>
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
 <!-- <script>
$(document).ready(function() {

$('#selectAll').click(function() {
	$('button[type="button"]').attr('disabled','disabled');

 });
	$("#status").show();
});
});
</script> -->
</body>
</html>
