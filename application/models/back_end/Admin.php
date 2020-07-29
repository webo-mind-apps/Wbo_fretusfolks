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
		$this->form_validation->set_rules('vsdfsdds', 'User Type', 'trim|required');
		$this->form_validation->set_rules('kldsjfoiwe', 'Email id', 'trim|required');
		$this->form_validation->set_rules('kjsflkjsfs', 'password', 'trim|required');		
		if ($this->form_validation->run() == TRUE):
			$user_type=$this->input->post('vsdfsdds', true);
			$email=$this->input->post('kldsjfoiwe', true);
			$password=$this->input->post('kjsflkjsfs', true);
			
			$this->db->where("email",$email);
			// $this->db->where("enc_pass",$password);
			$this->db->where("user_type",$user_type);
			$this->db->where("status","0");
			$query=$this->db->get('muser_master');
			$res=$query->row();
		
			if($query->num_rows()==1)
			{
				if($this->bcrypt->check_password($password, $res->enc_pass))
				{
					$this->session->set_userdata('admin_id',$res->id);	
					// $this->session->set_userdata('admin_login','true');
					// $this->session->set_userdata('admin_name',$res[0]['username']);	
					// $this->session->set_userdata('admin_type',$res[0]['user_type']);	

					$this->session->set_userdata('admin_otp',true);	
					
					return $res;
				}else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		else:
			return false;
		endif;
	}

	function ref_no_update($data=null)
	{
		$this->db->where("id",$this->session->userdata('admin_id'))->update('muser_master',$data);
		return $this->db->affected_rows() > 0 ? true : false;
	}
	function resend_otp($data=null)
	{
		$res=$this->db->where("id",$this->session->userdata('admin_id'))->get('muser_master')->row();
		$this->db->where("id",$this->session->userdata('admin_id'))->update('muser_master',$data);
		return $this->db->affected_rows() > 0 ? $res : false;
				
	}

	function otp()
	{
		$tutor_otp=$this->input->post('sdfsfswetyess');
		$query=$this->db->where("ref_no",$tutor_otp)
		->where("id",$this->session->userdata('admin_id'))->get('muser_master');
		$number_of_row=$query->num_rows();
		$res=$query->row();
		if($number_of_row==1)
		{
			
			$this->session->set_userdata('admin_id',$res->id);	
			$this->session->set_userdata('admin_login',true);
			$this->session->set_userdata('admin_name',$res->username);	
			$this->session->set_userdata('admin_type',$res->user_type);	
			$this->session->set_userdata('admin_otp',true);	
			return true;
		}
		else { 
			return false;
		}		
	}
}  
?>
