<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Ffcm_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_expenses()
	{
		$month=date("m");
		$year=date("Y");
		$this->db->where('status','0');
		$this->db->where('MONTH(date)',$month);
		$this->db->where('YEAR(date)',$year);
		$this->db->order_by('date','DESC');
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}
	function search_expenses()
	{
		$month=$this->input->post('month');;
		$year=$this->input->post('year');
		
		$this->db->where('status','0');
		$this->db->where('MONTH(date)',$month);
		$this->db->where('YEAR(date)',$year);
		$this->db->order_by('date','DESC');
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}
	function delete_expenses()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('expenses');
	}
	function get_expenses_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}
	function save_expenses()
	{
		$exp_date=$this->input->post('exp_date');
		$month=$this->input->post('month');
		$expenses=$this->input->post('expenses');
		$amount=$this->input->post('amount');
		
		$db_date=date("Y-m-d",strtotime($exp_date));
		
		$data=array("date"=>$db_date,"month"=>$month,"nature_expenses"=>$expenses,"amount"=>$amount);
		
		$this->db->insert('expenses',$data);	
	}
	function update_expenses()
	{
		$id=$this->uri->segment(3);
		
		$exp_date=$this->input->post('exp_date');
		$month=$this->input->post('month');
		$expenses=$this->input->post('expenses');
		$amount=$this->input->post('amount');
		
		$db_date=date("Y-m-d",strtotime($exp_date));
		
		$data=array("date"=>$db_date,"month"=>$month,"nature_expenses"=>$expenses,"amount"=>$amount);
		$this->db->where('id',$id);
		$this->db->update('expenses',$data);	
	}
}  
?>