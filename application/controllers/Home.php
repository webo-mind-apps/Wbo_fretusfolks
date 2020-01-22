<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
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
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="dashboard";
			$data['cdms_report']=$this->home->get_cdms_report();
			$data['contract_details']=$this->home->get_contract_end_data();
			$data['total_employee']=$this->home->get_total_employee();
			$data['employee_details']=$this->home->get_company_details();
			$data['fhrms_details']=$this->home->get_fhrms_details();
			$data['cfis_report']=$this->home->get_cfis_report();
			$data['dcs_report']=$this->home->get_dcs_report();
			$data['fhrms_report']=$this->home->get_fhrms_report();
			$data['labour_notice']=$this->home->get_labour_notice();
			$data['cims_details']=$this->home->get_cims_details();
			$data['asset_details']=$this->home->get_asset_details();
			$data['tds_details']=$this->home->get_tds_details();
			$data['backend_team']=$this->home->todays_dob();
			$this->load->view('admin/back_end/index',$data);
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
