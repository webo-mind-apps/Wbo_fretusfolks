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
		$name=$this->input->post('username');
		$password=md5($this->input->post('password'));
		
		$this->db->where("ffi_emp_id",$name);
		$this->db->where("password",$password);
		$this->db->where("data_status","1");
		$query=$this->db->get('fhrms');
		$res=$query->result_array();
	
		if($query->num_rows()==1)
		{
			$this->session->set_userdata('emp_id',$res[0]['ffi_emp_id']);	
			$this->session->set_userdata('employee_login','true');
			$this->session->set_userdata('emp_name',$res[0]['emp_name']);
			return "success";
		}
		else
		{
			return "false";
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