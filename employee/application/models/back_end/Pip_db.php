<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Pip_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	
	function view_pip_letter()
	{
		$id=$this->session->userdata('emp_id');
		
		$this->db->select('a.*,b.emp_name');
		$this->db->from('pip_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.emp_id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
}  
?>