<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Bulk_update extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Bulk_update_db','bulk_update');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$this->load->view('admin/back_end/bulk_update/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function get_all_data($var = null)//created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->bulk_update->make_datatables();
			$data = array();
			$i = 1;
			foreach ($fetch_data as $row) { 
				$checkbox ='<center><input type="checkbox" style="height: 25px; width: 20px; " class="checkbox"></center>';
				$sub_array = array();
				$sub_array[]= $checkbox;
				$sub_array[] = $row->id;
				$sub_array[] = $row->ffi_emp_id;
				$sub_array[] = $row->emp_name;
				$status = "";
				if ($row->status == 1) {
					$status = '<center><span class="badge bg-blue">Active</span></center>';
				} else if ($row->status == 0) {
					$status = '<center><span class="badge bg-danger">Inactive</span></center>';
				}
				$sub_array[] = $status;
				$data[] = $sub_array;
				$i=++$i;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->bulk_update->get_all_data(),
				"recordsFiltered"     =>     $this->bulk_update->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

}
