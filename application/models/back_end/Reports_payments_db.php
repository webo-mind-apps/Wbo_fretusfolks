<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Reports_payments_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function search_payments_details()
	{
		$client=$this->input->post('client');
		$from_date=$this->input->post('from_date');
		$to_date=$this->input->post('to_date');
		$state=$this->input->post('state');
		$active_status=$this->input->post('active_status');
				
		$db_from_date=date("Y-m-d",strtotime($from_date));
		$db_to_date=date("Y-m-d",strtotime($to_date));
		
		$this->db->select("a.*,d.invoice_no,d.service_location,d.credit_note,d.debit_note,d.grand_total,b.client_name,c.state_name,e.code");
		$this->db->from("payments a");
		$this->db->join("invoice d","d.id=a.invoice_id","left");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","d.service_location=c.id","left");
		$this->db->join("tds_code e","a.tds_code=e.id","left");
		$this->db->where("a.payment_received","1");
		
		if($client !="")
		{
			$this->db->where_in('a.client_id',$client);
		}
		if($state !="")
		{
			$this->db->where_in('d.service_location',$state);
		}
		if($from_date !="" and $to_date !="")
		{
			$this->db->where('DATE(a.payment_received_date) >=',$db_from_date);
			$this->db->where('DATE(a.payment_received_date) <=',$db_to_date);
		}
		if($from_date !="" and $to_date=="")
		{
			$this->db->where('DATE(a.payment_received_date)',$db_from_date);
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