<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Payslips_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_payslips()
	{
		$emp_id=$this->session->userdata('emp_id');
		
		$this->db->where('emp_id',$emp_id);
		$this->db->order_by('id','DESC');
		$query=$this->db->get('ffi_payslips');
		$q=$query->result_array();
		return $q;
	}
	function get_payslip_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('ffi_payslips');
		$q=$query->result_array();
		return $q;
	}
}  
?>