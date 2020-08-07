<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Home_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_emp_details()
	{
		$emp_id=$this->session->userdata('emp_id');
		
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('backend_management');
		$q=$query->result_array();
		return $q;	
	}
	function change_psd()
	{
		$emp_id=$this->session->userdata('emp_id');
		$password=$this->input->post('password');
		$hash_pass = $this->bcrypt->hash_password($password);
		
		$data=array("password"=>$hash_pass,"psd"=>$password);
		$this->db->where('ffi_emp_id',$emp_id);
		$this->db->update('fhrms',$data);
		return $this->db->affected_rows() > 0 ? true : false;
	}
}  
?>
