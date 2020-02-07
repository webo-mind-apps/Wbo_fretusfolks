<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Ffi_warning_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Ffi_warning_letter_db','warning_letter');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['pip_letter']=$this->warning_letter->get_all_termination_letter();
			$this->load->view('admin/back_end/ffi_warning_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_warning_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['employee']=$this->warning_letter->get_all_employee();
			$data['letter_content']=$this->warning_letter->get_letter_content();
			$this->load->view('admin/back_end/ffi_warning_letter/new_warning_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_warning_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$id=$this->uri->segment(3);
			$data['pip_info']=$this->warning_letter->get_warning_letter_info($id);
			$this->load->view('admin/back_end/ffi_warning_letter/edit_warning_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->warning_letter->save_letter();
			redirect('ffi_warning_letter/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->warning_letter->update_letter();
			redirect('ffi_warning_letter/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function get_emp_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->warning_letter->get_emp_details();
			if($data)
			{
				if($data[0]['data_status']==1)
				{
					echo $data[0]['emp_name']."****".$data[0]['designation'];
				}
				else
				{
					echo "0";
				}
			}
			else
			{
				echo "failed";
			}
		}
	}
	function view_warning_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['pip']=$this->warning_letter->view_warning_letter();
			$this->load->view('admin/back_end/ffi_warning_letter/print_warning_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_warning_letter()
	{
		$this->warning_letter->delete_warning_letter();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
