<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Reports_cdms_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function search_cdms_details()
	{
		$from_date=$this->input->post('from_date');
		$to_date=$this->input->post('to_date');
		$state=$this->input->post('state');
		$location=$this->input->post('emp_location');
		$active_status=$this->input->post('active_status');
		
		$db_from_date=date("Y-m-d",strtotime($from_date));
		$db_to_date=date("Y-m-d",strtotime($to_date));
		
		$this->db->select('a.*,b.state_name');
		$this->db->from('client_management a');
		$this->db->join('states b','a.service_state=b.id','left');
		$this->db->where("a.status","0");
		
		
		if($state !="")
		{
			$this->db->where_in('a.service_state',$state);
		}
		if($from_date !="" and $to_date !="")
		{
			$this->db->where('DATE(modify_date) >=',$db_from_date);
			$this->db->where('DATE(modify_date) <=',$db_to_date);
		}
		if($from_date !="" and $to_date=="")
		{
			$this->db->where('DATE(modify_date)',$db_from_date);
		}
		if($location !="")
		{
			$this->db->where('a.region',$location);
		}
		if($active_status !="")
		{
			$this->db->where('a.active_status',$active_status);
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