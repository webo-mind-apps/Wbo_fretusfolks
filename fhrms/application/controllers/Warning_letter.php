<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warning_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Warning_letter_db','warning_letter');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['active_menu']="warning";
			$data['letter']=$this->warning_letter->get_all_warning_letter();
			$this->load->view('admin/back_end/warning_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function view_warning_letter()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['pip']=$this->warning_letter->view_warning_letter();
			$this->load->view('admin/back_end/warning_letter/print_warning_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
}
