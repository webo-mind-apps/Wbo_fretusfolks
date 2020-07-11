<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$this->db->join('states c', 'a.state=c.id', 'left');
		$this->db->where("a.status", "0");
		$this->db->where("a.dcs_approval", "0");
		$this->db->order_by('a.id', 'DESC');
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}

	public function make_query()
	{
		$order_column = array("a.id", "b.client_name", "a.emp_name", "a.phone1", "a.data_status");
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$this->db->join('states c', 'a.state=c.id', 'left');
		$this->db->where("a.status", "0");
		$this->db->where("a.dcs_approval", "0");
		if (isset($_POST["search"]["value"])) {
			$this->db->group_start();
			$this->db->like("a.id", $_POST["search"]["value"]);
			$this->db->or_like("b.client_name", $_POST["search"]["value"]);
			$this->db->or_like("a.emp_name", $_POST["search"]["value"]);
			$this->db->or_like("a.phone1", $_POST["search"]["value"]);
			$this->db->or_like("a.data_status", $_POST["search"]["value"]);
			$this->db->group_end();
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('a.id', 'DESC');
		}
	}

	function get_all_data()
	{
		$this->db->select("*");
		$this->db->from('backend_management');
		return $this->db->count_all_results();
	}

	function get_filtered_data()
	{
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function make_datatables()
	{
		$this->make_query();
		if ($_POST["length"] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function delete_candidates()
	{
		$id = $this->input->post('id', true);
		$this->db->where("id", $id);
		if ($this->db->delete("backend_management")) {
			return True;
		}
	}

	// function delete_candidates()
	// {
	// 	$id=$this->input->post('id');
	// 	$data=array("status"=>"2");
	// 	$this->db->where("id",$id);
	// 	$this->db->update("backend_management",$data);
	// }

	function get_candidate_details($id)
	{
		$this->db->select('a.*,b.client_name,c.state_name,d.name as username');
		$this->db->from('backend_management a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$this->db->join('states c', 'a.state=c.id', 'left');
		$this->db->join('muser_master d', 'a.created_by=d.id', 'left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}
	function update_approval()
	{
		$id = $this->input->post('id', true);
		$value = $this->input->post('value', true);

		$data = array("dcs_approval" => $value);
		$this->db->where('id', $id);
		$this->db->update('backend_management', $data);
	}

	function get_all_states()
	{
		$this->db->order_by('state_name', 'ASC');
		$query = $this->db->get("states");
		$q = $query->result_array();
		return $q;
	}
	function get_all_clients()
	{
		$this->db->where("status", "0");
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get("client_management");
		$q = $query->result_array();
		return $q;
	}
}
