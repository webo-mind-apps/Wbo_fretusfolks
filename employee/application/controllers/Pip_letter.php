<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pip_letter extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('employee_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Pip_db','pip');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['pip']=$this->pip->view_pip_letter();
			
			$this->load->view('admin/back_end/pip_letter/print_pip',$data);
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
