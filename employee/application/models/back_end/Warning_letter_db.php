<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Warning_letter_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_warning_letter()
	{
		$id=$this->session->userdata('emp_id');
		$this->db->select('a.*,b.emp_name,b.location,b.joining_date,b.designation,b.phone1');
		$this->db->from('warning_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.emp_id',$id);
		$this->db->order_by("a.id","DESC");
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function view_warning_letter()
	{
		$emp_id=$this->session->userdata('emp_id');
		$id=$this->uri->segment(3);
		$this->db->select('a.*,b.emp_name,b.location,b.joining_date,b.designation');
		$this->db->from('warning_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.emp_id',$emp_id);
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
}  
?>