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
    	<style>
			.switch {
			  position: relative;
			  display: inline-block;
			  width: 60px;
			  height: 27px;
			}

			.switch input {display:none;}

			.slider {
			  position: absolute;
			  cursor: pointer;
			  top: 0;
			  left: 0;
			  right: 0;
			  bottom: 0;
			  background-color: #ccc;
			  -webkit-transition: .4s;
			  transition: .4s;
			}

			.slider:before {
			  position: absolute;
			  content: "";
			  height: 18px;
			  width: 18px;
			  left: 4px;
			  bottom: 4px;
			  background-color: white;
			  -webkit-transition: .4s;
			  transition: .4s;
			}

			input:checked + .slider {
			  background-color: #2196F3;
			}

			input:focus + .slider {
			  box-shadow: 0 0 1px #2196F3;
			}

			input:checked + .slider:before {
			  -webkit-transform: translateX(26px);
			  -ms-transform: translateX(26px);
			  transform: translateX(26px);
			}

			/* Rounded sliders */
			.slider.round {
			  border-radius: 8px;
			}

			.slider.round:before {
			  border-radius: 50%;
			}
		</style>
	<script>
    function change_status(id)
		{
			value=1;
			if ($('#'+id).is(':checked')) 
					{
						value=0;
					}
			r=confirm("Are you sure to change the status ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/user_master/change_status",
					datatype:"text",
					data:{id:id,value:value},
					success:function(response)
					{
						alert("Updated Successfully");
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
			}
			else
			{
				$('#'+id).prop('checked', true); 
			}
		}

		function delete_user_master(id){
			r=confirm("Are you sure you want to delete title ?");
			if(r==true)
			{
				jQuery.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>" + "index.php/user_master/delete_user_master",
					datatype:"text",
					data:{id:id},
					success:function(response)
					{
						alert("Deleted Successfully");
						location.reload();
					},
					error:function (xhr, ajaxOptions, thrownError){}
					});
			}
			else
			{
				$('#'+id).prop('checked', true); 
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User Master</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
							<a href="<?php echo site_url('user_master/new_user_master');?>" class="btn btn-labeled btn-labeled-right bg-primary">Add new User<b><i class="fa fa-plus" aria-hidden="true"></i></b></a>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">User master</span>
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
						<h5 class="card-title">User Master Details</h5>
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
								<th>Name</th>	
								<th>Username</th>	
                                <th>Password</th>							
								<th> Date</th>
                                <th>User Type</th>
                                <th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody id="get_details">
							<?php 
                                $i=1;
                                
								foreach($user_master as $row)
								{   $user_type="";  
                                    if($row['user_type']==0)
                                    {
                                        $user_type="Admin";
                                    }
									else if($row['user_type']==1)
                                    {
                                        $user_type="Finance";
                                    }
									else if($row['user_type']==2)
                                    {
                                        $user_type="HR Operations";
                                    }
									else if($row['user_type']==3)
                                    {
                                        $user_type="Compliance";
                                    }
									else if($row['user_type']==4)
                                    {
                                        $user_type="Recruitment";
                                    }
									else if($row['user_type']==5)
                                    {
                                        $user_type="Sales";
                                    }

                                    $status="";
									if($row['status']==0)
									{
										$status="checked";
									}
									echo '
											<tr>
												<td>'.$i.'</td>												
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['username'].'</td>
                                                <td>'.$row['password'].'</td>
                                                <td style="width:15%">'.date("d-m-Y",strtotime($row['date'])).'</td>	
                                                <td>'.$user_type.'</td>
                                                <td>
													<label class="switch">
													<input type="checkbox" id="'.$row['id'].'" '.$status.' onclick="change_status(this.id);">
													<span class="slider round"></span>
													</label>
												</td>
																							
												
												<td class="text-center">
													<div class="list-icons">
														<div class="dropdown">
															<a href="#" class="list-icons-item" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">															
																<a href="'.site_url('user_master/edit_user_master/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
																<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_user_master('.$row['id'].');" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
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
