<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Dcs_approval extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/Dcs_approval_db', 'candidate');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			// $data['candidate_info'] = $this->candidate->get_all_candidate_info();
			$this->load->view('admin/back_end/dcs_approval/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->candidate->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';
			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->emp_name;
				$sub_array[] = $row->phone1;
				$status = "";
				$approval = "";
				if ($row->dcs_approval == 1) {
					$approval = "checked";
				}
				if ($row->data_status == 1) {
					$status = '<span class="badge bg-blue">Completed</span>';
				} else if ($row->data_status == 0) {
					$status = '<span class="badge bg-danger">Pending</span>';
				}
				$sub_array[] = $status;
				$sub_array[] = '
				<td>
					<select id="status_' . $row->id . '" class="form-control" onchange="update_approval(this.id);">
						<option value="">Select</option>
						<option value="1">Approve</option>
						<option value="2">Disapprove</option>
					</select>
				</td>';
				$sub_array[] = '
				<td class="text-center">
					 <div class="list-icons">
					 <div class="dropdown"> 
						 <a href="#" class="list-icons-item" data-toggle="dropdown">
							 <i class="icon-menu9"></i>
						 </a>
						 <div class="dropdown-menu dropdown-menu-right">
							 <a href="javascript:void(0)" id=' . $row->id . ' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
							 <a href="' . site_url('backend_team/edit_backend/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
							 <a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_candidates(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						 </div>
					 </div>
				 </div>
				 </td>
					 ';
				$data[] = $sub_array;
				$i = $i++;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->candidate->get_all_data(),
				"recordsFiltered"     =>     $this->candidate->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	public function update_approval()
	{
		$data1 = $this->candidate->update_approval();
		$data = $this->candidate->get_all_candidate_info();
		$i = 1;
		foreach ($data as $row) {
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
								<option value="2">Rejected</option>
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
	}

	function delete_candidates()
	{
		if ($this->candidate->delete_candidates()) {
			echo "deleted";
		}
	}
	// public function delete_candidates()
	// {
	// 	$data1 = $this->candidate->delete_candidates();
	// 	$data = $this->candidate->get_all_candidate_info();
	// 	$i = 1;
	// 	foreach ($data as $row) {
	// 		$status = "";
	// 		$approval = "";
	// 		if ($row['dcs_approval'] == 1) {
	// 			$approval = "checked";
	// 		}
	// 		if ($row['data_status'] == 1) {
	// 			$status = '<span class="badge bg-blue">Completed</span>';
	// 		} else if ($row['data_status'] == 0) {
	// 			$status = '<span class="badge bg-danger">Pending</span>';
	// 		}
	// 		echo '
	// 				<tr>
	// 					<td>' . $i . '</td>
	// 					<td>' . $row['client_name'] . '</td>
	// 					<td>' . $row['emp_name'] . '</td>
	// 					<td>' . $row['phone1'] . '</td>
	// 					<td>' . $status . '</td>
	// 					<td>
	// 						<select id="status_' . $row['id'] . '" class="form-control" onchange="update_approval(this.id);">
	// 							<option value="">Select</option>
	// 							<option value="1">Approve</option>
	// 							<option value="2">Rejected</option>
	// 						</select>
	// 					</td>
	// 					<td class="text-center">
	// 						<div class="list-icons">
	// 							<div class="dropdown">
	// 								<a href="#" class="list-icons-item" data-toggle="dropdown">
	// 									<i class="icon-menu9"></i>
	// 								</a>
	// 								<div class="dropdown-menu dropdown-menu-right">
	// 									<a href="javascript:void(0)" id=' . $row['id'] . ' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
	// 									<a href="' . site_url('candidate_system/edit_candidate/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
	// 									<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_candidates(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
	// 								</div>
	// 							</div>
	// 						</div>
	// 					</td>
	// 				</tr>';
	// 		$i++;
	// 	}
	// }
	function view_candidate_details()
	{
		$id = $this->input->post('id');
		$data = $this->candidate->get_candidate_details($id);

		$joining_date = "";
		$interview_date = "";
		$dob = "";
		$created_at = "";
		$gender = "";

		if ($data[0]['joining_date'] != "0000-00-00") {
			$joining_date = date("d-m-Y", strtotime($data[0]['joining_date']));
		}
		if ($data[0]['interview_date'] != "0000-00-00") {
			$interview_date = date("d-m-Y", strtotime($data[0]['interview_date']));
		}
		if ($data[0]['dob'] != "0000-00-00") {
			$dob = date("d-m-Y", strtotime($data[0]['dob']));
		}
		if ($data[0]['created_at'] != "0000-00-00") {
			$created_at = date("d-m-Y", strtotime($data[0]['created_at']));
		}
		if ($data[0]['gender'] == 1) {
			$gender = "Male";
		} else if ($data[0]['gender'] == 2) {
			$gender = "Female";
		}
		echo '
					<div class="modal-header bg-primary">
						<h6 class="modal-title">' . ucwords($data[0]['emp_name']) . '</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Employee Name :</b> <span>' . ucwords($data[0]['emp_name']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>' . ucwords($data[0]['client_name']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone:</b> <span>' . ucwords($data[0]['phone1']) . '</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>' . $data[0]['email'] . '</span></p>
								<p><b>State:</b> <span>' . ucwords($data[0]['state_name']) . '</span></p>								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Interview Date :</b> <span>' . $interview_date . '</span></p>
								<p><b>Location:</b> <span>' . ucwords($data[0]['location']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Joining Date :</b> <span>' . $joining_date . '</span></p>
								<p><b>Designation :</b> <span>' . ucwords($data[0]['designation']) . '</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Department :</b> <span>' . ucwords($data[0]['department']) . '</span></p>
								<p><b>Aadhar No:</b> <span>' . $data[0]['aadhar_no'] . '</span></p>
								<p><b><a href="' . base_url() . $data[0]['aadhar_path'] . '" target="_blank"><i class="fa fa-book"></i> Aadhar Card</a></b></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No:</b> <span>' . $data[0]['driving_license_no'] . '</span></p>
								<p><b><a href="' . base_url() . $data[0]['driving_license_path'] . '" target="_blank"><i class="fa fa-book"></i> Driving License</a></b></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b><a href="' . base_url() . $data[0]['photo'] . '" target="_blank"><i class="fa fa-book"></i> Photo</a></b></p>
								<p><b><a href="' . base_url() . $data[0]['resume'] . '" target="_blank"><i class="fa fa-book"></i> Resume</a></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Uploaded By :</b> <span>' . ucwords($data[0]['username']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Date of Upload:</b> <span>' . $created_at . '</span></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>
					</div>';
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
