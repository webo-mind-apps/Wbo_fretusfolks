<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show_cause extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Show_cause_db','show_cause');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['pip']=$this->show_cause->view_showcause_letter();
			$this->load->view('admin/back_end/show_cause/print_showcause',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
}
