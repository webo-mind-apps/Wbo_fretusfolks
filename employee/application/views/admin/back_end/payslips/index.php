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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>admin_assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>admin_assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>admin_assets/assets/css/bootstrap_limitless.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>admin_assets/assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>admin_assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>admin_assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url();?>admin_assets/global_assets/js/main/jquery.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js">
    </script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js">
    </script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?php echo base_url();?>admin_assets/assets/js/app.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/dashboard.js"></script>
    <script src="<?php echo base_url();?>admin_assets/global_assets/js/demo_pages/form_floating_labels.js"></script>

    <style>
    #divLoading {
        display: none;
    }

    #divLoading.show {
        display: block;
        position: fixed;
        z-index: 100;
        background-image: url('<?php echo base_url();?>admin_assets/3.gif');
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
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Payslips</span>
                        </h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                </div>
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="<?php echo site_url('home/dashboard');?>" class="breadcrumb-item"><i
                                    class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Payslips</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <!-- /page header -->

            <?php
							if($this->session->flashdata('abc','error'))
							{
						?>
            <div class="alert bg-danger alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"></button>
                <span class="text-semibold">Opps!</span> Try agin!
            </div>
            <?php	
							}
						?>
            <!-- Content area -->
            <div class="content">

                <?php
									if($this->session->flashdata('success','success'))
									{
								?>
                <div class="alert bg-success alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <span class="text-semibold">Payslip Uploaded Successfully</span>
                </div>
                <?php	
									}
								?>
                <?php
									if($this->session->flashdata('abc','error'))
									{
								?>
                <div class="alert bg-danger alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <span class="text-semibold">Opps!</span> Try agin!
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
                                <h5 class="card-title">Payslips</h5>
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
                                        <th>Emp ID</th>
                                        <th>Emp Name</th>
                                        <th>Designation</th>
                                        <th>Client Name</th>
                                        <th style="width:15%">Date of Update</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="get_details">
                                    <?php 
								$i=1;
								foreach($payslips as $row)
								{
									$status="";
									
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.$row['emp_id'].'</td>
												<td>'.$row['emp_name'].'</td>
												<td >'.$row['designation'].'</td>
												<td>'.$row['client_name'].'</td>
												<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
												<td class="text-center">
													<div class="list-icons">
														<div class="dropdown">
															<a href="#" class="list-icons-item" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="'.site_url('payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-eye"></i> Print Payslip</a>
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


</body>

</html>
