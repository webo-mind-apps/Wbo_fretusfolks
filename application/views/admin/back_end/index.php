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
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>

	<script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
	<script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/dashboard.js"></script>
	<!-- /theme JS files -->
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
				<div class="row">
					<div class="col-xl-8">
				<?php
					if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1)
					{
				?>
				<!-- Dashboard content -->
						<div class="card" style="padding: 2%;">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">CDMS Reports</h6>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="card bg-teal-400">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="font-weight-semibold mb-0"><?php echo $cdms_report['total_client'];?></h3>
												<span class="badge badge-pill align-self-center ml-auto"><a class="list-icons-item" data-action="reload"></a></span>
											</div>
											<div>
												Total Client
												<div class="font-size-sm opacity-75">In CDMA</div>
											</div>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card bg-pink-400">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="font-weight-semibold mb-0"><?php echo $cdms_report['active_client'];?></h3>
												<div class="list-icons ml-auto">
													<div class="list-icons-item dropdown">
														<a class="list-icons-item" data-action="reload"></a>
													</div>
												</div>
											</div>
											<div>
												Active Client
												<div class="font-size-sm opacity-75">In CDMA</div>
											</div>
										</div>
										<div id="server-load"></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card bg-blue-400">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="font-weight-semibold mb-0"><?php echo $cdms_report['inactive_client'];?></h3>
												<div class="list-icons ml-auto">
													<a class="list-icons-item" data-action="reload"></a>
												</div>
											</div>
											<div>
												Inactive Client
												<div class="font-size-sm opacity-75">In CDMA</div>
											</div>
										</div>
										<div id="today-revenue"></div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
							if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==2)
							{
						?>
							<!-- Marketing campaigns -->
						<div class="card" style="height: 360px;">
							<div class="card-header header-elements-sm-inline">
								<h6 class="card-title">Company Details</h6>
								<div class="header-elements">
									<span class="badge bg-success badge-pill">Total Employee : <?php echo $total_employee;?></span>
									<div class="list-icons ml-3">
				                		<div class="list-icons-item dropdown">
				                			<a class="list-icons-item" data-action="reload"></a>
				                		</div>
				                	</div>
			                	</div>
							</div>

							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>Company Name</th>
											<th>Total Employee</th>
											<th>Active Employee</th>
											<th>Inactive Employee</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
											
											foreach($employee_details as $res1)
											{
												$total_emp=$res1['active_emp']+$res1['inactive_emp'];
												echo '
													<tr>
														<td>
															<div class="d-flex align-items-center">
																<div class="mr-3">
																	<a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
																		<span class="letter-icon"></span>
																	</a>
																</div>
																
																<div>
																	<a href="#" class="text-default font-weight-semibold letter-icon-title">'.$res1['client_name'].'</a>
																	<div class="text-muted font-size-sm">
																		  
																	</div>
																</div>
															</div>
														</td>
														<td style="text-align:center"><span class="text-success-600">'.$total_emp.'</span></td>
														<td style="text-align:center"><span class="text-success-600"> '.$res1['active_emp'].'</span></td>
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['inactive_emp'].'</h6></td>
														
														
													</tr>';
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /marketing campaigns -->
						<?php
							}
							
						?>
					</div>
					
					
					<div class="col-xl-4">
						<?php
							if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1)
							{
						?>
								<div class="card" style="height: 275px;">
									<div class="card-header header-elements-inline">
										<h6 class="card-title">SLA Ending</h6>
										<div class="header-elements">
											<span class="font-weight-bold text-danger-600 ml-2">Max 30 Days</span>
											<div class="list-icons ml-3">
												<a class="list-icons-item" data-action="reload"></a>
											</div>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table text-nowrap">
											<thead>
												<tr>
													<th class="w-100">Client Name</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Agreement Type</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($contract_details as $res)
													{
														$agree_type="";
														
														if($res['agreement_type']==1)
														{
															$agree_type="One Time Sourcing";
														}
														else if($res['agreement_type']==2)
														{
															$agree_type="Contractual";
														}
														else if($res['agreement_type']==3)
														{
															$agree_type="Other (".$res['other_agreement']." )";
														}
														
														echo '
															<tr>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="mr-3">
																			<a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
																				<span class="letter-icon"></span>
																			</a>
																		</div>
																		<div>
																			
																			<a class="text-default font-weight-semibold letter-icon-title">'.$res['client_name'].'</a>
																		</div>
																	</div>
																</td>
																<td>
																	<span class="font-weight-semibold mb-0">'.date('d-m-Y',strtotime($res['contract_start'])).'</span>
																</td>
																<td>
																	<a class="font-weight-semibold mb-0">'.date('d-m-Y',strtotime($res['contract_end'])).'</a>
																</td>
																<td>
																	<a class="font-weight-semibold mb-0">'.$agree_type.'</a>
																</td>
															</tr>';
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
					<?php
							}
							if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==2)
							{
					?>					
					<!-- Progress counters -->
						<div class="card" style="background: none;border: none;margin-top: -6%;box-shadow: none;">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">FHRMS Details</h6>
								<div class="header-elements">
									<span class="font-weight-bold text-danger-600 ml-2">Total Employee : <?php echo $fhrms_details[0]['total'];?></span>
									<div class="list-icons ml-3">
				                		<a class="list-icons-item" data-action="reload"></a>
				                	</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="card text-center">
										<div class="card-body">
											<div class="svg-center position-relative" id="hours-available-progress1"><svg width="76" height="76"><g transform="translate(38,38)"><path class="d3-progress-background" d="M0,38A38,38 0 1,1 0,-38A38,38 0 1,1 0,38M0,36A36,36 0 1,0 0,-36A36,36 0 1,0 0,36Z" style="fill: rgb(238, 238, 238);"></path><path class="d3-progress-foreground" filter="url(#blur)" d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.38342799370878,16.179613079472677L-32.57377388877674,15.328054496342538A36,36 0 1,0 2.204364238465236e-15,-36Z" style="fill: rgb(240, 98, 146); stroke: rgb(240, 98, 146);"></path><path class="d3-progress-front" d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.38342799370878,16.179613079472677L-32.57377388877674,15.328054496342538A36,36 0 1,0 2.204364238465236e-15,-36Z" style="fill: rgb(240, 98, 146); fill-opacity: 1;"></path></g></svg><h2 class="pt-1 mt-2 mb-1"><?php echo $fhrms_details[0]['active'];?></h2><i class="icon-watch text-pink-400 counter-icon" style="top: 22px"></i><div>Active Employee</div></div>
											<div id="hours-available-bars"></div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card text-center">
										<div class="card-body">
											<div class="svg-center position-relative" id="goal-progress1"><svg width="76" height="76"><g transform="translate(38,38)"><path class="d3-progress-background" d="M0,38A38,38 0 1,1 0,-38A38,38 0 1,1 0,38M0,36A36,36 0 1,0 0,-36A36,36 0 1,0 0,36Z" style="fill: rgb(238, 238, 238);"></path><path class="d3-progress-foreground" filter="url(#blur)" d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.3834279937087,-16.179613079472855L-32.573773888776664,-15.328054496342704A36,36 0 1,0 2.204364238465236e-15,-36Z" style="fill: rgb(92, 107, 192); stroke: rgb(92, 107, 192);"></path><path class="d3-progress-front" d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.3834279937087,-16.179613079472855L-32.573773888776664,-15.328054496342704A36,36 0 1,0 2.204364238465236e-15,-36Z" style="fill: rgb(92, 107, 192); fill-opacity: 1;"></path></g></svg><h2 class="pt-1 mt-2 mb-1"><?php echo $fhrms_details[0]['inactive'];?></h2><i class="icon-trophy3 text-indigo-400 counter-icon" style="top: 22px"></i><div>Inactive Employee</div></div>
											<div id="goal-bars"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					
				<?php
					}
				?>
				</div>
				</div>
				<?php
					if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==4)
					{
				?>
				<div class="row">
					<div class="col-xl-8">
						<div class="card" style="height: 400px;">
							<div class="card-header header-elements-sm-inline">
								<h6 class="card-title">CFIS Details</h6>
								<div class="header-elements">
									<div class="list-icons ml-3">
				                		<div class="list-icons-item dropdown">
				                			<a class="list-icons-item" data-action="reload"></a>
				                		</div>
				                	</div>
			                	</div>
							</div>

							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>Company Name</th> 
											<th>Total Lineups</th>
											<th>Selected</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
											foreach($cfis_report as $res1)
											{
												if($res1['client_name'])
												{
													echo '
													<tr>
														<td>
															<div class="d-flex align-items-center">
																<div class="mr-3">
																	<a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
																		<span class="letter-icon"></span>
																	</a>
																</div>
																
																<div>
																	<a href="#" class="text-default font-weight-semibold letter-icon-title">'.$res1['client_name'].'</a>
																	<div class="text-muted font-size-sm">
																		 
																	</div>
																</div>
															</div>
														</td>
														 
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['lineups'].'</h6></td>
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['selected'].'</h6></td>
														
														
													</tr>';
												}
												
											}
										
										?>
										

									</tbody>
								</table>
							</div>
						</div>
					
					</div>	
					
					<div class="col-xl-4"> 
					
						
				 	<div class="card" style="height: 275px;">
									<div class="card-header header-elements-inline">
										<h6 class="card-title">Today's Birthday</h6>
										<div class="header-elements">
											<span class="font-weight-bold text-danger-600 ml-2"></span>
											<div class="list-icons ml-3">
												<a class="list-icons-item" data-action="reload"></a>
											</div>
										</div>
									</div>
									<div class="table-responsive">
									
									<?php
										$i=1;
										foreach($backend_team as $row)
										{
											echo '
												<div class="card card-body bg-blue-400 has-bg-image">
												<div class="media">
													<div class="media-body">
														<h3 class="mb-0">Birthday</h3>
														<span class="text-uppercase font-size-xs">'.$row['emp_name'].'</span><br/>
														<span class="text-uppercase font-size-xs">'.$row['phone1'].'</span><br/>
														<span class="text-uppercase font-size-xs">'.date("d-m-Y",strtotime($row['dob'])).'</span>
													</div>

													<div class="ml-3 align-self-center">
														<i class="icon-bubbles4 icon-3x opacity-75"></i>
													</div>
												</div> 
											</div>
												';
										}
									?>
									 
									<!--<div class="card card-body bg-danger-400 has-bg-image">
										<div class="media">
											<div class="media-body">
												<h3 class="mb-0">389,438</h3>
												<span class="text-uppercase font-size-xs">total orders</span>
											</div>

											<div class="ml-3 align-self-center">
												<i class="icon-bubbles4 icon-3x opacity-75"></i>
											</div>
										</div>
									</div> -->
				 
										 	  
									</div>
								</div>
					</div>  
				</div>
				<?php 
					}
				if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==2)
					{
				?>
				<div class="row">
					<!--<div class="col-xl-6">
						<div class="card" style="height: 360px;">
							<div class="card-header header-elements-sm-inline">
								<h6 class="card-title">DCS Details</h6>
								<div class="header-elements">
									<div class="list-icons ml-3">
				                		<div class="list-icons-item dropdown">
				                			<a class="list-icons-item" data-action="reload"></a>
				                		</div>
				                	</div>
			                	</div>
							</div>
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>Company Name</th>
											<th>Location</th>
											<th>Active</th>
											<th>Inactive</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
											foreach($dcs_report as $res1)
											{
												echo '
													<tr>
														<td>
															<div class="d-flex align-items-center">
																<div class="mr-3">
																	<a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
																		<span class="letter-icon"></span>
																	</a>
																</div>
																<div>
																	<a href="#" class="text-default font-weight-semibold letter-icon-title">'.$res1['client_name'].'</a>
																	<div class="text-muted font-size-sm">
																		<span class="badge badge-mark border-blue mr-1"></span>
																		'.$res1['state_name'].'
																	</div>
																</div>
															</div>
														</td>
														<td style="text-align:center"><span class="text-success-600"> '.$res1['location'].'</span></td>
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['active'].'</h6></td>
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['inactive'].'</h6></td>			
													</tr>';
											}
										?>
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div> 
					<div class="col-xl-6">
						<div class="card" style="height: 360px;">
							<div class="card-header header-elements-sm-inline">
								<h6 class="card-title">FHRMS Details</h6>
								<div class="header-elements">
									<div class="list-icons ml-3">
				                		<div class="list-icons-item dropdown">
				                			<a class="list-icons-item" data-action="reload"></a>
				                		</div>
				                	</div>
			                	</div>
							</div>
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>Company Name</th>
											
											<th>Location</th>
											<th>Active</th>
											<th>Inactive</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
											foreach($fhrms_report as $res1)
											{
												echo '
													<tr>
														<td>
															<div class="d-flex align-items-center">
																<div class="mr-3">
																	<a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
																		<span class="letter-icon"></span>
																	</a>
																</div>
																<div>
																	<a href="#" class="text-default font-weight-semibold letter-icon-title">Fretus Folks</a>
																	<div class="text-muted font-size-sm">
																		<span class="badge badge-mark border-blue mr-1"></span>
																		'.$res1['state_name'].'
																	</div>
																</div>
															</div>
														</td>
														<td style="text-align:center"><span class="text-success-600"> '.$res1['location'].'</span></td>
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['active'].'</h6></td>
														<td style="text-align:center"><h6 class="font-weight-semibold mb-0">'.$res1['inactive'].'</h6></td>			
													</tr>';
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>	-->
				</div>
				
				<div class="row">

				</div>
				<?php 
					}
				if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3)
					{
				?>
				<div class="row">
					<div class="col-xl-12">
						<div class="card" style="height: 400px;">
							<div class="card-header header-elements-sm-inline">
								<h6 class="card-title">Labour Notice Details</h6>
								<div class="header-elements">
									<div class="list-icons ml-3">
				                		<div class="list-icons-item dropdown">
				                			<a class="list-icons-item" data-action="reload"></a>
				                		</div>
				                	</div>
			                	</div>
							</div>
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>Si No</th>
											<th>Client Name</th>
											<th>State Name</th> 
											<th>Notice Date</th>
											<th>Closure Date</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=1;
											foreach($labour_notice as $row)
											{
												$notice_date="";
												$closure_date="";
												$status="";
												if($row['notice_received_date']!="0000-00-00")
												{
													$notice_date=date("d-m-Y",strtotime($row['notice_received_date']));
												}
												if($row['closure_date']!="0000-00-00")
												{
													$closure_date=date("d-m-Y",strtotime($row['closure_date']));
												}
												if($row['status']==0)
												{
													$status='<span class="badge bg-danger">Pending</span>';
												}
												if($row['status']==1)
												{
													$status='<span class="badge bg-blue">Completed</span>';
												}
												echo '
													<tr>
														<td>'.$i.'</td>
														<td>'.$row['client_name'].'</td>
														<td>'.$row['state_name'].'</td> 
														<td>'.$notice_date.'</td>
														<td>'.$closure_date.'</td>
														<td>'.$status.'</td>
													</tr>
												';
												$i++;
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>	
				</div>
				<?php 
					
					}
				if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==5)
					{
			
				?>
			<!--	<div class="card" style="height: 400px;overflow-x: scroll;">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Invoice Details</h5>
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
								<th>Client Name</th>
								<th>Invoice No</th>
								<th>State</th>
								<th style="width:15%">Grand Total</th>
								<th>Received Amount</th>
								<th>Balance Amount</th>								
							</tr>
						</thead>
						<tbody id="get_details">
							<?php 
								$i=1;
								foreach($cims_details as $row)
								{
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.$row['client_name'].'</td>
												<td>'.$row['invoice_no'].'</td>
												<td>'.$row['state_name'].'</td>
												<td style="width:15%">Rs. '.$row['total_value'].'</td>
												<td style="width:15%">Rs. '.$row['amount_received'].'</td>
												<td style="width:15%">Rs. '.$row['balance_amount'].'</td>
												
											</tr>';
									$i++;
								}
							?>
						</tbody>
					</table>
				</div> -->
				<!--<div class="card" style="height: 400px;overflow-x: scroll;">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Assets Details</h5>
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
								<th >Emp Name</th>
								<th >Asset Name</th>
								<th >Asset Code</th>
								<th >Issued On</th>
								<th >Status</th>
							</tr>
						</thead>
						<tbody id="get_details">
							<?php 
								$i=1;
								foreach($asset_details as $row)
								{
									$db_date1="";
									$db_date2="";
									$status="";
										if($row['issued_date'] !="0000-00-00")
										{
											$db_date1=date("d-m-Y",strtotime($row['issued_date']));
										}
										if($row['status']==0)
										{
											$status="Issued";
										}
										if($row['status']==1)
										{
											$status="Returned";
										}
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.$row['emp_name'].'</td>
												<td>'.$row['asset_name'].'</td>
												<td>'.$row['asset_code'].'</td>
												<td style="width:15%">'.$db_date1.'</td>
												<td style="width:15%">'.$status.'</td>
											</tr>';
									$i++;
								}
							?>
						</tbody>
					</table>
				</div> -->
				<!--<div class="card" style="height: 400px;overflow-x: scroll;">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">TDS Details</h5>
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
								<th>Client Name</th>
								<th>Invoice No</th>
								<th>TDS Code</th>
								<th style="width:15%">Grand Total</th>
								<th>TDS Amount</th>							
								<th>INV Date</th>							
							</tr>
						</thead>
						<tbody id="get_details">
							<?php 
								$i=1;
								foreach($tds_details as $row)
								{
									$inv_date="";
									if($row['date']!="0000-00-00")
									{
										$inv_date=date("d-m-Y",strtotime($row['date']));
									}
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.$row['client_name'].'</td>
												<td>'.$row['invoice_no'].'</td>
												<td>'.$row['code'].'</td>
												<td style="width:15%">Rs. '.$row['total_value'].'</td>
												<td style="width:15%">Rs. '.$row['tds_amount'].'</td>
												<td style="width:15%">'.$inv_date.'</td>
											</tr>';
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>-->
				<?php 
				
					}
				?>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->
				<!-- /floating labels -->

		
			<!-- content area -->

		</div>
	

			
</body>
</html>
