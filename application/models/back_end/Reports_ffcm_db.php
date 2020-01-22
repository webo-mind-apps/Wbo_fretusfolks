<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Reports_ffcm_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function search_ffcm_details()
	{
		
		$from_date=$this->input->post('from_date');
		$to_date=$this->input->post('to_date');
		
		$db_from_date=date("Y-m-d",strtotime($from_date));
		$db_to_date=date("Y-m-d",strtotime($to_date));
		
		$this->db->where("status","0");
		if($from_date !="" and $to_date !="")
		{
			$this->db->where('DATE(date) >=',$db_from_date);
			$this->db->where('DATE(date) <=',$db_to_date);
		}
		if($from_date !="" and $to_date=="")
		{
			$this->db->where('DATE(date)',$db_from_date);
		}
		$this->db->order_by('id','ASC');
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}
	function get_all_tds_code()
	{
		$this->db->order_by('id','ASC');
		$this->db->where('status','0');
		$query=$this->db->get("tds_code");
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