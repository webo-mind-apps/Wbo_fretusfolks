<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Ffi_pip_letter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/Ffi_pip_db', 'pip');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "fhrms";
			//$data['pip_letter']=$this->pip->get_all_pip_letter();
			$this->load->view('admin/back_end/ffi_pip_letter/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->pip->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';

			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->from_name;
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
						 <a href="' . site_url('ffi_pip_letter/view_pip_letter/' . $row->id) . '" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
						 <a href="' . site_url('ffi_pip_letter/edit_pip_letter/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
						 <a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_ffi_pip_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						 </div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->pip->get_all_data(),
				"recordsFiltered"     =>     $this->pip->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	function new_pip_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "fhrms";
			$data['employee'] = $this->pip->get_all_employee();
			$this->load->view('admin/back_end/ffi_pip_letter/new_pip_letter', $data);
		} else {
			redirect('home/index');
		}
	}
	function edit_pip_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "fhrms";
			$id = $this->uri->segment(3);
			$data['pip_info'] = $this->pip->get_pip_info($id);
			$this->load->view('admin/back_end/ffi_pip_letter/edit_pip_letter', $data);
		} else {
			redirect('home/index');
		}
	}
	function save_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->pip->save_letter();
			redirect('ffi_pip_letter/');
		} else {
			redirect('home/index');
		}
	}
	function update_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->pip->update_letter();
			redirect('ffi_pip_letter/');
		} else {
			redirect('home/index');
		}
	}
	function delete_ffi_pip_letter()
	{
		$data1 = $this->pip->delete_pip_letter();
		$data = $this->pip->get_all_pip_letter();
		$i = 1;
		foreach ($data as $row) {
			echo '
						<tr>
							<td>' . $i . '</td>
							<td>' . $row['from_name'] . '</td>
							<td>' . $row['emp_id'] . '</td>
							<td>' . $row['emp_name'] . '</td>
							<td style="width:15%">' . date("d-m-Y", strtotime($row['date'])) . '</td>
							<td>' . $row['phone1'] . '</td>
							<td style="width:15%">' . $row['designation'] . '</td>
							<td class="text-center">
								<div class="list-icons">
									<div class="dropdown">
										<a href="#" class="list-icons-item" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="' . site_url('ffi_pip_letter/view_pip_letter/' . $row['id']) . '" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
											<a href="' . site_url('ffi_pip_letter/edit_pip_letter/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
											<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_ffi_pip_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
										</div>
									</div>
								</div>
							</td>
						</tr>';
			$i++;
		}
	}
	function get_emp_details()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->pip->get_emp_details();
			if ($data) {
				if ($data[0]['data_status'] == 1) {
					echo $data[0]['emp_name'] . "****" . $data[0]['designation'];
				} else {
					echo "0";
				}
			} else {
				echo "failed";
			}
		} else {
		}
	}
	function view_pip_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data['pip'] = $this->pip->view_pip_letter();
			$this->load->view('admin/back_end/ffi_pip_letter/print_pip', $data);
		} else {
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
