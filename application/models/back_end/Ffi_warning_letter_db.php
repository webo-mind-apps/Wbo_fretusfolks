<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Ffi_warning_letter_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_termination_letter()
	{
		$this->db->select('a.*,b.emp_name,phone1,designation');
		$this->db->from('ffi_warning_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->order_by('a.id','DESC');
		$this->db->where('a.status','0');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_all_employee()
	{
		$this->db->where("data_status","1");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("fhrms");
		$q=$query->result_array();
		return $q;
	}
	function save_letter()
	{
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		
		$db_date=date("Y-m-d",strtotime($date));
		$today=date("Y-m-d");
		$data=array("emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"date_of_update"=>$today);
		$this->db->insert("ffi_warning_letter",$data);
	}
	function update_letter()
	{
		$id=$this->uri->segment(3);
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		
		$db_date=date("Y-m-d",strtotime($date));
		$today=date("Y-m-d");
		$data=array("emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"date_of_update"=>$today);
		
		$this->db->where('id',$id);
		$this->db->update('ffi_warning_letter',$data);
	}
	function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id');
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function view_warning_letter()
	{
		$id=$this->uri->segment('3');
		$this->db->select('a.*,b.emp_name,b.location,b.joining_date,b.designation');
		$this->db->from('ffi_warning_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_warning_letter_info($id)
	{
		$this->db->select('a.*,b.emp_name,designation');
		$this->db->from('ffi_warning_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function delete_warning_letter()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_warning_letter');
	}
	function get_letter_content()
	{
		$this->db->where('type','4');
		$query=$this->db->get('letter_content');
		$q=$query->result_array();
		return $q;
	}
}  
?>