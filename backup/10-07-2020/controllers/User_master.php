<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class User_master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/User_master_db', 'user_master');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "user_master";
			// $data['user_master'] = $this->user_master->get_all_user_master();
			$this->load->view('admin/back_end/user_master/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->user_master->make_datatables();
			$data = array();
			$i=1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] =$i;
				$sub_array[] = $row->name;
				$sub_array[] = $row->username;
				$sub_array[] = $row->password;
				$sub_array[] = date('d M, Y', strtotime($row->date));
				$user_type = "";
				if ($row->user_type == 0) {
					$user_type = "Admin";
				} else if ($row->user_type == 1) {
					$user_type = "Finance";
				} else if ($row->user_type == 2) {
					$user_type = "HR Operations";
				} else if ($row->user_type == 3) {
					$user_type = "Compliance";
				} else if ($row->user_type == 4) {
					$user_type = "Recruitment";
				} else if ($row->user_type == 5) {
					$user_type = "Sales";
				}
				$sub_array[] = $user_type;

				$status = "";
				if ($row->status == 0) {
					$status = "checked";
				}
				$sub_array[] =
					'<td>
					<label class="switch">
					<input type="checkbox" id="' . $row->id . '" ' . $status . ' onclick="change_status(this.id);">
					<span class="slider round"></span>
					</label>
				</td>';

				$sub_array[] = '
				<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">															
							<a href="' . site_url('user_master/edit_user_master/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
							<a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_user_master(' . $row->id . ');" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						</div>
					</div>
				</div>
			</td>
					 ';
				$data[] = $sub_array;
				$i++;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->user_master->get_all_data(),
				"recordsFiltered"     =>     $this->user_master->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	function new_user_master()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "user_master";
			//$data['employee']=$this->termination->get_all_employee();
			//$data['letter_content']=$this->termination->get_letter_content();
			$this->load->view('admin/back_end/user_master/new_user_master', $data);
		} else {
			redirect('home/index');
		}
	}

	function save_user_master()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->user_master->save_user_master();
			redirect('user_master/');
		} else {
			redirect('home/index');
		}
	}
	function change_status()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->user_master->change_status();
		} else {
			redirect('home/index');
		}
	}

	function edit_user_master()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			$id = $this->uri->segment(3);
			$data['user_master'] = $this->user_master->get_user_master_details($id);
			$this->load->view('admin/back_end/user_master/edit_user_master', $data);
		} else {
			redirect('home/');
		}
	}
	function update_user_master()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->user_master->update_user_master();
			redirect('/user_master');
		} else {
			redirect('home/index');
		}
	}

	function delete_user_master()
	{

		if ($this->session->userdata('admin_login')) {
			$data = $this->user_master->delete_user_master();
			// redirect('/user_master');
		} else {
			redirect('home/');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
