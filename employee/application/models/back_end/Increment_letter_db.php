<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Increment_letter_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_increment_letter_details()
	{
		$emp_id=$this->session->userdata('emp_id');
		
		
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name');
		$this->db->from('increment_letter a');
		$this->db->join('backend_management b','a.employee_id=b.ffi_emp_id','left');
		$this->db->join('client_management c','a.company_id=c.id','left');
		$this->db->where('a.employee_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		
		
		return $q;
	}
	
}  
?>