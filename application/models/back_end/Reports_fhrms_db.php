<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Reports_fhrms_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function search_fhrms_details()
	{
		$from_date=$this->input->post('from_date');
		$to_date=$this->input->post('to_date');
		$state=$this->input->post('state');
		$location=$this->input->post('emp_location');
		$active_status=$this->input->post('active_status');
		$pending_doc=$this->input->post('pending_doc');
		
		$db_from_date=date("Y-m-d",strtotime($from_date));
		$db_to_date=date("Y-m-d",strtotime($to_date));
		
		$this->db->select('a.*,c.state_name');
		$this->db->from('fhrms a');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where("a.status","0");
		
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
		$con=1;
		if(!empty($pending_doc))
		{
			foreach($pending_doc as $res)
			{
				if($con==1)
				{
					$this->db->where('a.'.$res,'');
				}
				else
				{
					$this->db->or_where('a.'.$res,'');
				}
				$con++;
			}
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