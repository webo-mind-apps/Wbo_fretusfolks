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
		$this->form_validation->set_rules('bkjdhweiosk', 'Email id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nfgrfdsdfsddd', 'password', 'trim|required|xss_clean');		
		if ($this->form_validation->run() == TRUE):
			$email=$this->input->post('bkjdhweiosk', true);
			$password=$this->input->post('nfgrfdsdfsddd', true);
			
			$this->db->select('email,password,id,ffi_emp_id,emp_name');
			$this->db->where("email",$email);
			$this->db->where("data_status","1");
			$query=$this->db->get('fhrms');
			$res=$query->row();
			if($query->num_rows()==1)
			{
				if($this->bcrypt->check_password($password, $res->password))
				{
					$this->session->set_userdata('admin_otp',true);	
					$this->session->set_userdata('id',$res->id);
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
		$this->db->where("id",$this->session->userdata('id'))->update('fhrms',$data);
		return $this->db->affected_rows() > 0 ? true : false;
	}
	function resend_otp($data=null)
	{
		$res=$this->db->where("id",$this->session->userdata('id'))->get('fhrms')->row();
		$this->db->where("id",$this->session->userdata('id'))->update('fhrms',$data);
		return $this->db->affected_rows() > 0 ? $res : false;
				
	}

	function otp()
	{
		$tutor_otp=$this->input->post('cxfdfdsfdfs');
		$query=$this->db->where("ref_no",$tutor_otp)
		->where("id",$this->session->userdata('id'))->get('fhrms');
		$number_of_row=$query->num_rows();
		$res=$query->row();
		if($number_of_row==1)
		{
			
			$this->session->set_userdata('emp_id',$res->ffi_emp_id);	
			$this->session->set_userdata('employee_otp_login',true);
			$this->session->set_userdata('emp_name',$res->emp_name);
			$this->session->set_userdata('employee_login',true);
			
			return true;
		}
		else { 
			return false;
		}		
	}
	
	function get_employee_details($emp_id)
	{
		$this->db->select('a.*');
		$this->db->from('fhrms a');
		//$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->where('a.ffi_emp_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}

}  
?>
