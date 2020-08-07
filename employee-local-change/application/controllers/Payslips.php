<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payslips extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('employee_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Payslips_db','payslips');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['active_menu']="payslips";
			
			$data['payslips']=$this->payslips->get_all_payslips();
			$this->load->view('admin/back_end/payslips/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function print_payslip()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['payslip']=$this->payslips->get_payslip_details();
			$this->load->view('admin/back_end/payslips/print_payslip',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
