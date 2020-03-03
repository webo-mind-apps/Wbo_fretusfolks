<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Payslips_db extends CI_Model 
{  
    function __construct()  
    {
		parent::__construct();
	
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_payslips()
	{
		$this->db->order_by('id','DESC');
		$query=$this->db->get('payslips');
		$q=$query->result_array();
		return $q;
	}
	public function get_all_payslips_for_email($emp_id)
	{
		$this->db->where('emp_id',$emp_id);
		$query=$this->db->get('payslips');
		$q=$query->row_array();
		return $q;
	}
	public function get_all_client()
	{
		$query=$this->db->get('client_management');
		$q=$query->result_array();
		return $q;
	}

	public function download_payslips()
	{
		$month=$this->input->post('payslip_download_month');
		$year=$this->input->post('payslip_download_year');
		$client_name=$this->input->post('payslip_download_client');
		$this->db->select('*');
		$this->db->from('payslips');
		$this->db->where("month", $month);
		$this->db->where("year", $year);
		$this->db->where("client_name", $client_name);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
	function get_payslip_details()
	{
		$id=$this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('payslips');
		$query=$this->db->get();
		$this->db->where('id',$id);
		$q=$query->row_array();
		return $q;
	}
	function delete_payslip()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('payslips');
	}
	function search_payslip()
	{
		$emp_id=$this->input->post('emp_id');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$this->db->select('*');
		$this->db->from('payslips');
		if($emp_id !="" || !empty($emp_id))
		{
			$this->db->where('emp_id',$emp_id);
		}
		if($month !="" || !empty($month))
		{
			$this->db->where('month',$month);
		}
		if($year !="" || !empty($year))
		{
			$this->db->where('year',$year);
		}
		$this->db->order_by('id','ASC');
		$query=$this->db->get();
		
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
	public function importEmployee_payslips_letter($data = null)
	{
	
	
		if ($data['emp_id'] != 'null' || $data['emp_id'] != '' || !empty($data['emp_id'])) {
			$this->db->where('month',$data['month']);
			$this->db->where('year', $data['year']);
			$this->db->where('emp_id', $data['emp_id']);
			$q = $this->db->get('payslips')->num_rows();
			
			if($q > 0):
				$this->db->where('month',$data['month']);
				$this->db->where('year', $data['year']);
				$this->db->where('emp_id', $data['emp_id']);
				$this->db->update('payslips', $data);
				if ($this->db->affected_rows() > 0):
					return "update";
				endif;
			else:
				$this->db->insert('payslips', $data);
				if ($this->db->affected_rows() > 0):
					return "insert";
				endif;
			endif;
		}
	}
}  
?>