<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class User_master extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/User_master_db','user_master');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="user_master";
			$data['user_master']=$this->user_master->get_all_user_master();
			$this->load->view('admin/back_end/user_master/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
    
    function new_user_master()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="user_master";
			//$data['employee']=$this->termination->get_all_employee();
			//$data['letter_content']=$this->termination->get_letter_content();
			$this->load->view('admin/back_end/user_master/new_user_master',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
    
	function save_user_master()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->user_master->save_user_master();
			redirect('user_master/');
		}
		else
		{
			redirect('home/index');
		}
    }
    function change_status()
	{	
		if($this->session->userdata('admin_login'))
		{
			$data=$this->user_master->change_status();
		}
		else
		{
			redirect('home/index');
		}
	}

	function edit_user_master()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$id=$this->uri->segment(3);
			$data['user_master']=$this->user_master->get_user_master_details($id);
			$this->load->view('admin/back_end/user_master/edit_user_master',$data);
		}
		else
		{
			redirect('home/');
		}
	}
	function update_user_master()
	{	
		if($this->session->userdata('admin_login'))
		{
			$data=$this->user_master->update_user_master();			
			redirect('/user_master');
		}
		else
		{
			redirect('home/index');
		}
    }
    
    function delete_user_master()
	{
	
		if($this->session->userdata('admin_login'))
		{			
			$data=$this->user_master->delete_user_master();			
			redirect('/user_master');	
		}
		else
		{
			redirect('home/');
		}
    }
    
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
