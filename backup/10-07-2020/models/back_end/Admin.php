<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Admin extends CI_Model {  
  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function check_login()
	{
		$this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');		
		if ($this->form_validation->run() == TRUE):
			$user_type=$this->input->post('user_type', true);
			$name=$this->input->post('username', true);
			$password=md5($this->input->post('password', true));
			
			$this->db->where("username",$name);
			$this->db->where("enc_pass",$password);
			$this->db->where("user_type",$user_type);
			$this->db->where("status","0");
			$query=$this->db->get('muser_master');
			$res=$query->result_array();
		
			if($query->num_rows()==1)
			{
				$this->session->set_userdata('admin_id',$res[0]['id']);	
				$this->session->set_userdata('admin_login','true');
				$this->session->set_userdata('admin_name',$res[0]['username']);	
				$this->session->set_userdata('admin_type',$res[0]['user_type']);	
				return "success";
			}
			else
			{
				return "false";
			}
		else:
			return "false";
		endif;
	}

}  
?>