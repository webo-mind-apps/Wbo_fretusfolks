<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Termination_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	
	function view_termination_letter()
	{
		$id=$this->session->userdata('emp_id');
		
		$this->db->select('a.*,b.emp_name,b.location,b.joining_date,b.designation');
		$this->db->from('ffi_termination_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.emp_id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
}  
?>