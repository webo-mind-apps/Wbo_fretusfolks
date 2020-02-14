<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class bulk_update extends CI_Controller 
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
}
