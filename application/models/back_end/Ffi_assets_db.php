<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Ffi_assets_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_employee()
	{
		$this->db->where("status","0");
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function get_all_ffi_assets()
	{
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id');
		$this->db->from('assets_management a');
		$this->db->join('fhrms b','a.employee_id=b.id');
		$this->db->where('a.status !=','2');
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_asset_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('assets_management');
		$q=$query->result_array();
		return $q;
	}
	function save_assets()
	{
		$asset_name=$this->input->post('asset_name');
		$asset_code=$this->input->post('asset_code');
		$employee=$this->input->post('employee');
		$issue_date=$this->input->post('issue_date');
		$return_date=$this->input->post('return_date');
		$damage=$this->input->post('damage');
		$status=$this->input->post('status');
		
		$db_date1="";
		$db_date2="";
		if($issue_date !="")
		{
			$db_date1=date("Y-m-d",strtotime($issue_date));
		}
		if($return_date !="")
		{
			$db_date2=date("Y-m-d",strtotime($return_date));
		}
		$data=array("employee_id"=>$employee,"asset_name"=>$asset_name,"asset_code"=>$asset_code,"issued_date"=>$db_date1,"returned_date"=>$db_date2,"damage_recover"=>$damage,"status"=>$status);
		$this->db->insert("assets_management",$data);
	}
	function update_assets()
	{
		$id=$this->uri->segment(3);
		$asset_name=$this->input->post('asset_name');
		$asset_code=$this->input->post('asset_code');
		$employee=$this->input->post('employee');
		$issue_date=$this->input->post('issue_date');
		$return_date=$this->input->post('return_date');
		$damage=$this->input->post('damage');
		$status=$this->input->post('status');
		
		$db_date1="";
		$db_date2="";
		if($issue_date !="")
		{
			$db_date1=date("Y-m-d",strtotime($issue_date));
		}
		if($return_date !="")
		{
			$db_date2=date("Y-m-d",strtotime($return_date));
		}
		$data=array("employee_id"=>$employee,"asset_name"=>$asset_name,"asset_code"=>$asset_code,"issued_date"=>$db_date1,"returned_date"=>$db_date2,"damage_recover"=>$damage,"status"=>$status);
		$this->db->where('id',$id);
		$this->db->update("assets_management",$data);
	}
	function search_assets()
	{
		$from_date=$this->input->post('from_date');
		$to_date=$this->input->post('to_date');
		
		$fdate=date("Y-m-d",strtotime($from_date));
		$tdate=date("Y-m-d",strtotime($to_date));
		
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id');
		$this->db->from('assets_management a');
		$this->db->join('fhrms b','a.employee_id=b.id');
		$this->db->where('a.status !=','2');
		
		if($from_date !="" && $to_date !="")
		{
			$this->db->where('a.issued_date >=',$fdate);
			$this->db->where('a.issued_date <=',$tdate);
			
		}
		else if($from_date !="" && $to_date=="")
		{
			$this->db->where('a.issued_date',$fdate);
		}
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function delete_assets()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('assets_management');
	}
}  
?>