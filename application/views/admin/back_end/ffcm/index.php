<?php
$active_menu="index";
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
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/jquery.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
		<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
		<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script>
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
		function search_expenses(id)
		{
			month=$("#month").val();
			year=$("#year").val();
			 $("div#divLoading").addClass('show');	
				jQuery.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>" + "index.php/ffcm/search_expenses",
				datatype:"text",
				data:{month:month,year:year},
				success:function(response)
				{
					$("#datatable-header").css("display","none");
					$("#datatable-footer").css("display","none");
					$('#get_details').empty();
					$('#get_details').append(response);
					$("div#divLoading").removeClass('show');
				},
				error:function (xhr, ajaxOptions, thrownError){}
				});
		}
		function delete_expenses(id)
		{
			var r=confirm("Are you sure to Delete ?");
			if(r==true)
			{
				month=$("#month").val();
				year=$("#year").val();
				$("div#divLoading").addClass('show');	
					jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/ffcm/delete_expenses",
					datatype:"text",
					data:{id:id,month:month,year:year},
					success:function(response)
					{
						$('#get_details').empty();
						$('#get_details').append(response);
						$("div#divLoading").removeClass('show');
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

	<div id="divLoading"> 
    </div>
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Fretus Folks Cost Management</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
							<a href="<?php echo site_url('ffcm/new_expenses');?>" class="btn btn-labeled btn-labeled-right bg-primary">New Expenses<b><i class="fa fa-plus" aria-hidden="true"></i></b></a>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">FFI Cost Management</span>
						</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
								<div class="row">
					<div class="col-md-12">
					 <form class="form-horizontal" id="my_form" action="<?php echo site_url('ffcm/download_expenses');?>" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Search Expenses</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		</div>
			                	</div>
							</div>
							<div class="card-body">
								<div class="row">
										
										<label class="control-label col-lg-1" style="padding-top:1%">Month</label>
										<div class="col-md-3">
											<select name="month" id="month" class="form-control" required>
												<option value="">Select Month</option>
												<?php
													for($i=1;$i<=12;$i++)
													{
														if(date('m')==$i)
														{
															echo '<option value="'.$i.'" selected>'.date("F",strtotime("12-$i-2017")).'</option>';
														}
														else
														{
															echo '<option value="'.$i.'">'.date("F",strtotime("12-$i-2017")).'</option>';
														}
													}
												?>
											</select>
										</div>	
										<label class="control-label col-lg-1" style="padding-top:1%">Year</label>
											<div class="col-md-3">
													<select name="year" id="year" class="form-control" required>
														<option value="">Select Year</option>
														<?php
															for($i=2018;$i<=date("Y");$i++)
															{
																if(date('Y')==$i)
																{
																	echo '<option value="'.$i.'" selected>'.$i.'</option>';
																}
																else
																{
																	echo '<option value="'.$i.'">'.$i.'</option>';	
																}
															}
														?>
													</select>
											</div>
								</div>
								<div class="row">
									<div class="col-md-3" style="margin-top:2%">
										<div class="form-group">
											<button type="button" class="btn btn-primary btn-labeled btn-labeled-left" onclick="search_expenses();"><b><i class="fa fa-search" aria-hidden="true" style="font-size: 16px;"></i></b> Search</button>
											<button type="submit" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="fa fa-download" aria-hidden="true" style="font-size: 16px;"></i></b> Download</button>
										</div>
									</div>
								</div>	
								
							</div>
							
						</div>
					</form>
					</div>
				</div>
				<!-- Floating labels -->
				<div class="row">
				
					<div class="col-md-12">

										<!-- Style combinations -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Expenses Details</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="reload"></a>
		                	</div>
	                	</div>
					</div>
					
					<table class="table datatable-basic table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Si No</th>
								<th>Date</th>
								<th>Month</th>
								<th>Nature of Expenses</th>
								<th style="width:15%">Amount</th>
								<th class="text-center">Actions</th>
							</tr>
							
						</thead>
						<tbody id="get_details">
							
							<?php 
								$i=1;
								foreach($expenses as $row)
								{
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.date("d-m-Y",strtotime($row['date'])).'</td>
												<td>'.$row['month'].'</td>
												<td>'.$row['nature_expenses'].'</td>
												<td style="width:15%">Rs. '.$row['amount'].'</td>
												<td class="text-center">
													<div class="list-icons">
														<div class="dropdown">
															<a href="#" class="list-icons-item" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="'.site_url('ffcm/edit_expenses/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>';
																if($this->session->userdata('admin_type')==0)
																{
																	echo '<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_expenses(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
																}
													echo '	</div>
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

			
</body>
</html>
