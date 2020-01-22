<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Increment_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Increment_letter_db','increment');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['letter_details']=$this->increment->get_increment_letter_details();
			$this->load->view('admin/back_end/increment_letter/print_letter',$data);	
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
