<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Offer_letter_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	
	function get_letter_details()
	{
		$emp_id=$this->session->userdata('emp_id');
		
		$this->db->where('employee_id',$emp_id);
		$this->db->where('status','0');
		$this->db->order_by('id','DESC');
		$query=$this->db->get('offer_letter');
		$q=$query->result_array();
		return $q;
	}
	function get_employee_details()
	{
		$emp_id=$this->session->userdata('emp_id');
		
		$this->db->select('a.*,b.client_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->where('a.ffi_emp_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
}  
?>