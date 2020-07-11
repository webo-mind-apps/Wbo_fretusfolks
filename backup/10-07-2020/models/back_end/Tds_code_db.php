<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Tds_code_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_tds()
	{
		$this->db->order_by('id','DESC');
		$query=$this->db->get('tds_code');
		$q=$query->result_array();
		return $q;
	}
	function save_tds()
	{
		$tds=$this->input->post('tds_code');
		$data=array("code"=>$tds);
		$this->db->insert('tds_code',$data);
		$this->session->set_flashdata('success','success');
	}
	function delete_tds_code()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('tds_code');
	}
	function change_code_details()
	{
		$id=$this->input->post('id');
		$code=$this->input->post('code');
		$status=$this->input->post('value');
		
		$data=array("code"=>$code,"status"=>$status);
		$this->db->where('id',$id);
		$this->db->update('tds_code',$data);
		
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