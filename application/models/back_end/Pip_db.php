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
	function get_all_pip_letter()
	{
		$this->db->select('a.*,b.emp_name,phone1,designation');
		$this->db->from('pip_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
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
		$query=$this->db->get("backend_management");
		$q=$query->result_array();
		return $q;
	}
	function save_letter()
	{
		$from_name=$this->input->post('from_name');
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		$observation=$this->input->post('observation');
		$goals=$this->input->post('goals');
		$updates=$this->input->post('updates');
		$timeline=$this->input->post('timeline');
		
		$db_date=date("Y-m-d",strtotime($date));
		
		$today=date("Y-m-d");
		
		$data=array("from_name"=>$from_name,"emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"observation"=>$observation,"goals"=>$goals,"updates"=>$updates,"timeline"=>$timeline,"date_of_update"=>$today);
		$this->db->insert("pip_letter",$data);
		
	}
	function update_letter()
	{
		$id=$this->uri->segment(3);
		$from_name=$this->input->post('from_name');
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		$observation=$this->input->post('observation');
		$goals=$this->input->post('goals');
		$updates=$this->input->post('updates');
		$timeline=$this->input->post('timeline');
		
		$db_date=date("Y-m-d",strtotime($date));	
		
		$data=array("from_name"=>$from_name,"emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"observation"=>$observation,"goals"=>$goals,"updates"=>$updates,"timeline"=>$timeline,"date_of_update"=>$today);
		
		
		$this->db->where('id',$id);
		$this->db->update('pip_letter',$data);
	}
	function delete_pip_letter()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('pip_letter');
	}
	function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id');
		$this->db->where('ffi_emp_id',$emp_id);
		$this->db->where("status","0");
		$query=$this->db->get('backend_management');
		$q=$query->result_array();
		return $q;
	}
	function view_pip_letter()
	{
		$id=$this->uri->segment('3');
		$this->db->select('a.*,b.emp_name');
		$this->db->from('pip_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_pip_info($id)
	{
		$this->db->select('a.*,b.emp_name,designation');
		$this->db->from('pip_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
}  
?>