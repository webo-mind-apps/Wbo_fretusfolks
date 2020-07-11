<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Dcs_report_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	
	 
	function custom_filter_search_details()
	{
		$search=$this->input->post('search_val', true);
		$client=$this->input->post('client', true);
		$from_date=$this->input->post('from_date', true);
		$to_date=$this->input->post('to_date', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('emp_location', true);
		$active_status=$this->input->post('active_status', true);

		$db_from_date=date("Y-m-d",strtotime($from_date));
		$db_to_date=date("Y-m-d",strtotime($to_date));
		
		$joining_date=date("Y-m-d",strtotime($search));
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where("a.emp_name !=","");
		$this->db->where("a.dcs_approval","1");
		
		if($search !="")
		{
			$this->db->where('a.ffi_emp_id',$search);
		}
		$this->db->group_start();
		if($active_status !="1")
		{
			$this->db->where("a.status","0");
		}
		if($client !="")
		{
			$this->db->where_in('a.client_id',$client);
		}
		if($state !="")
		{
			$this->db->where_in('a.state',$state);
		}
		if($from_date !="" and $to_date !="")
		{
			$this->db->where('DATE(modified_date) >=',$db_from_date);
			$this->db->where('DATE(modified_date) <=',$db_to_date);
		}
		if($from_date !="" and $to_date=="")
		{
			$this->db->where('DATE(modified_date)',$db_from_date);
		}
		if($location !="")
		{
			$this->db->where('a.location',$location);
		}
		if($active_status !="")
		{
			$this->db->where('a.active_status',$active_status);
		}
		if($active_status=="1")
		{
			//$this->db->or_where('a.status','1');
		}
		$this->db->group_end();
		
		$this->db->order_by('id','ASC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
		
	}
	
	function search_dcs_details()
	{
		$client=$this->input->post('client', true);
		$from_date=$this->input->post('from_date', true);
		$to_date=$this->input->post('to_date', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('emp_location', true);
		$active_status=$this->input->post('active_status', true);
		
		$db_from_date=date("Y-m-d",strtotime($from_date));
		$db_to_date=date("Y-m-d",strtotime($to_date));
		
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		
		$this->db->where("a.emp_name !=","");
		$this->db->where("a.dcs_approval","1");
		
		if($active_status !="1")
		{
			$this->db->where("a.status","0");
		}
		if($client !="")
		{
			$this->db->where_in('a.client_id',$client);
		}
		if($state !="")
		{
			$this->db->where_in('a.state',$state);
		}
		if($from_date !="" and $to_date !="")
		{
			$this->db->where('DATE(modified_date) >=',$db_from_date);
			$this->db->where('DATE(modified_date) <=',$db_to_date);
		}
		if($from_date !="" and $to_date=="")
		{
			$this->db->where('DATE(modified_date)',$db_from_date);
		}
		if($location !="")
		{
			$this->db->where('a.location',$location);
		}
		if($active_status !="")
		{
			$this->db->where('a.active_status',$active_status);
		}
		if($active_status=="1")
		{
			//$this->db->or_where('a.status','1');
		}
		$this->db->order_by('id','ASC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_all_states()
	{
		$this->db->order_by('state_name','ASC');
		$query=$this->db->get("states");
		$q=$query->result_array();
		return $q;
	}
	function get_all_clients()
	{
		$this->db->where("status","0");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
		$q=$query->result_array();
		return $q;
	}
	function get_all_location()
	{
		$this->db->select('location');
		$this->db->group_by('location');
		$query=$this->db->get('backend_management');
		$q=$query->result_array();
		return $q;
	}
}  
?>