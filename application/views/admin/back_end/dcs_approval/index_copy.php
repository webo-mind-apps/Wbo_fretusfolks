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
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/main/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/demo_pages/picker_date.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/assets/js/app.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/global_assets/js/demo_pages/datatables_basic.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 27px;
        }

        .switch input {
            display: none;
        }

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

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
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
        function view_backend_team_details(id) {
            $("div#divLoading").addClass('show');
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/candidate_system/view_candidate_details",
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

        function update_approval(this_id) {

            value = $("#" + this_id).val();
            res = this_id.split("_");
            id = res[1];
            r = confirm("Are you sure ?");
            if (r == true) {
                $("div#divLoading").addClass('show');
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/dcs_approval/update_approval",
                    datatype: "text",
                    data: {
                        id: id,
                        value: value
                    },
                    success: function(response) {
                        $('#get_details').empty();
                        $('#get_details').append(response);
                        $("div#divLoading").removeClass('show');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {}
                });
            } else {
                $("#" + this_id).val("");
            }
        }

        function delete_candidates(id) {
            r = confirm("Are you sure to delete ?");
            if (r == true) {
                $("div#divLoading").addClass('show');
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/dcs_approval/delete_candidates",
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
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">DCS Approval</span></h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="<?php echo site_url('home/dashboard'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">DCS Approval</span>
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
                                <h5 class="card-title">Candidate Details</h5>
                                <div class="header-elements">

                                </div>
                            </div>

                            <table class="table datatable-basic table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:5%">Si No</th>
                                        <th style="width:25%">Client Name</th>
                                        <th style="width:15%">Employee Name</th>
                                        <th style="width:15%">Phone</th>
                                        <th style="width:10%">Status</th>
                                        <th style="width:10%">DCS Approval</th>
                                        <th style="width:5%" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="get_details">
                                    <?php
                                    $i = 1;
                                    foreach ($candidate_info as $row) {
                                        $status = "";
                                        $approval = "";
                                        if ($row['dcs_approval'] == 1) {
                                            $approval = "checked";
                                        }
                                        if ($row['data_status'] == 1) {
                                            $status = '<span class="badge bg-blue">Completed</span>';
                                        } else if ($row['data_status'] == 0) {
                                            $status = '<span class="badge bg-danger">Pending</span>';
                                        }
                                        echo '
											<tr>
												<td>' . $i . '</td>
												<td>' . $row['client_name'] . '</td>
												<td>' . $row['emp_name'] . '</td>
												<td>' . $row['phone1'] . '</td>
												<td>' . $status . '</td>
												<td>
													<select id="status_' . $row['id'] . '" class="form-control" onchange="update_approval(this.id);">
														<option value="">Select</option>
														<option value="1">Approve</option>
														<option value="2">Disapprove</option>
													</select>
												</td>
												<td class="text-center">
													<div class="list-icons">
														<div class="dropdown">
															<a href="#" class="list-icons-item" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="javascript:void(0)" id=' . $row['id'] . ' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
																<a href="' . site_url('candidate_system/edit_candidate/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
																<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_candidates(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
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