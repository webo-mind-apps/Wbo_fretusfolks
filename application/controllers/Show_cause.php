<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Show_cause extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Show_cause_db', 'show_cause');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			//$data['pip_letter']=$this->show_cause->get_all_termination_letter();
			$this->load->view('admin/back_end/show_cause/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->show_cause->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';

			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->emp_id;
				$sub_array[] = $row->emp_name;
				$sub_array[] = date('d M, Y', strtotime($row->date));
				$sub_array[] = $row->phone1;
				$sub_array[] = $row->designation;

				$sub_array[] = '
					 <div class="list-icons">
					 <div class="dropdown">
						 <a href="#" class="list-icons-item" data-toggle="dropdown">
							 <i class="icon-menu9"></i>
						 </a>
						 <div class="dropdown-menu dropdown-menu-right">
						 <a href="' . site_url('show_cause/view_showcause_letter/' . $row->id) . '" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
						 <a href="' . site_url('show_cause/edit_show_cause/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
						 <a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_show_cause_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						 </div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->show_cause->get_all_data(),
				"recordsFiltered"     =>     $this->show_cause->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}


	function new_show_cause()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			$data['employee'] = $this->show_cause->get_all_employee();
			$data['letter_content'] = $this->show_cause->get_letter_content();
			$this->load->view('admin/back_end/show_cause/new_show_cause', $data);
		} else {
			redirect('home/index');
		}
	}
	function edit_show_cause()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			$id = $this->uri->segment(3);
			$data['pip_info'] = $this->show_cause->get_termination_info($id);
			$this->load->view('admin/back_end/show_cause/edit_show_cause', $data);
		} else {
			redirect('home/index');
		}
	}
	function save_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->show_cause->save_letter();
			redirect('show_cause/');
		} else {
			redirect('home/index');
		}
	}
	function update_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->show_cause->update_letter();
			redirect('show_cause/');
		} else {
			redirect('home/index');
		}
	}
	function get_emp_details()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->show_cause->get_emp_details();
			if ($data) {
				if ($data[0]['data_status'] == 1) {
					echo $data[0]['emp_name'] . "****" . $data[0]['designation'];
				} else {
					echo "0";
				}
			} else {
				echo "failed";
			}
		}
	}
	function view_showcause_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data['pip'] = $this->show_cause->view_showcause_letter();
			$this->load->view('admin/back_end/show_cause/print_showcause', $data);
		} else {
			redirect('home/index');
		}
	}
	function delete_show_cause_letter()
	{
		$this->show_cause->delete_show_cause_letter();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
