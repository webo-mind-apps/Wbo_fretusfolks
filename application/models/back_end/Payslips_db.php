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
		$client_id=$this->input->post('payslip_download_client');
		$this->db->select('a.*,b.client_name');
		$this->db->from('payslips a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$this->db->where("a.month", $month);
		$this->db->where("a.year", $year);
		$this->db->where("a.client_id", $client_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
	function get_payslip_details()
	{
		$id=$this->uri->segment(3);
		$this->db->select('a.*,b.client_name');
		$this->db->from('payslips a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$query=$this->db->get();
		$this->db->where('a.id',$id);
		$q=$query->result_array();
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
		$this->db->select('a.*,b.client_name');
		$this->db->from('payslips a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
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

			$this->db->where('ffi_emp_id', $data['emp_id']);
			$query = $this->db->get("backend_management");
			if ($query->num_rows() > 0) {
				$this->db->insert('payslips', $data);
				return "insert";
			} else {
				return "not_exist";
			}
		} else {
			return false;
		}
	}
}  
?>