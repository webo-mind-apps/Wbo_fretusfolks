<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/admin');
					$this->load->model('back_end/home_db','home');
					$this->load->library("pagination");
        }
	public function index()
	{
		$this->load->view('admin/index');
	}
	public function process_login()
	{
		$data=$this->admin->check_login();
		
			if($data=="success")
			{
				
				redirect('home/dashboard');
			}
			else
			{
				$this->session->set_flashdata('abc','error');
				redirect('home/index');
			}
	}
	public function dashboard()
	{
		if($this->session->userdata('employee_login'))
		{
			$emp_id=$this->session->userdata('emp_id');
			if($emp_id)
			{ 
				$data['active_menu']="dashboard";
				$data['employee']=$this->admin->get_employee_details($emp_id);
				$this->load->view('admin/back_end/index',$data);
			}
			
		}
		else
		{
			redirect('home/index');
		}
	}
	public function reset_password()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['active_menu']="settings";
			$data['emp_details']=$this->home->get_emp_details();
			$this->load->view('admin/back_end/change_password/reset_password',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function change_psd()
	{
		if($this->session->userdata('employee_login'))
		{
			$this->home->change_psd();
			redirect('home/dashboard');
		}
		else
		{
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('employee_login');
		redirect('home/index');
	}
}
