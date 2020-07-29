<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Letter_content extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('admin_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/letter_content_db','letter_content');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="ffi_masters";
			$data['pip_letter']=$this->letter_content->get_all_letter_content();
			$this->load->view('admin/back_end/letter_content/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_letter_content()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="ffi_masters";
			
			$this->load->view('admin/back_end/letter_content/new_letter_content',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_letter_content()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="ffi_masters";
			$id=$this->uri->segment(3);
			$data['letter_details']=$this->letter_content->get_letter_content($id);
			$this->load->view('admin/back_end/letter_content/edit_letter_content',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->letter_content->save_letter();
			redirect('letter_content/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->letter_content->update_letter();
			redirect('letter_content/');
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
