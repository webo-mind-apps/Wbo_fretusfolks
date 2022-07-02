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

	function get_offer_letter()
	{
		$emp_id=$this->session->userdata('emp_id');
		$id = $this->uri->segment(3);
		$this->db->select('a.*,c.client_name');
		$this->db->from('offer_letter a');
		$this->db->join('client_management c', 'a.company_id=c.id', 'left');
		$this->db->where('a.employee_id',$emp_id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;

		/*$this->db->where('id',$id);
		$query1=$this->db->get('offer_letter');
		$q1=$query1->result_array();
		
		$emp_id=$q1[0]['employee_id'];
		
		/*$this->db->select('a.*,b.client_name,c.offer_letter_type');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('offer_letter c','a.ffi_emp_id=c.employee_id','left');
		$this->db->where('a.ffi_emp_id',$emp_id);*/
	}
	
}  
?>
