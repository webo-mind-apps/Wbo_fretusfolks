<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termination_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Termination_db','termination');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['pip']=$this->termination->view_termination_letter();
			$this->load->view('admin/back_end/termination_letter/print_termination',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
}
