<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Dcs_approval_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_candidate_info()
	{
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where("a.status","0");
		$this->db->where("a.dcs_approval","0");
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_candidate_details($id)
	{
		$this->db->select('a.*,b.client_name,c.state_name,d.name as username');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->join('muser_master d','a.created_by=d.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function update_approval()
	{
		$id=$this->input->post('id');
		$value=$this->input->post('value');
		
		$data=array("dcs_approval"=>$value);
		$this->db->where('id',$id);
		$this->db->update('backend_management',$data);
	}
	function delete_candidates()
	{
		$id=$this->input->post('id');
		$data=array("status"=>"2");
		$this->db->where("id",$id);
		$this->db->update("backend_management",$data);
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
}  
?>