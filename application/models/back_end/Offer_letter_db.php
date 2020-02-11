<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Offer_letter_db extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library("session");
	}
	public function get_all_offer_letters()
	{
		$this->db->select('a.*,b.client_name,c.emp_name,c.email,c.phone1');
		$this->db->from('offer_letter a');
		$this->db->join('client_management b', 'a.company_id=b.id', 'left');
		$this->db->join('backend_management c', 'a.employee_id=c.ffi_emp_id', 'left');
		$this->db->where("a.status", "0");
		$this->db->order_by('a.id', 'DESC');
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}

	public function make_query()
	{
		$order_column = array("a.id", "employee_id", "b.client_name", "c.emp_name", "date", "c.phone1", "c.email");
		$this->db->select('a.*,b.client_name,c.emp_name,c.email,c.phone1');
		$this->db->from('offer_letter a');
		$this->db->join('client_management b', 'a.company_id=b.id', 'left');
		$this->db->join('backend_management c', 'a.employee_id=c.ffi_emp_id', 'left');
		$this->db->where("a.status", "0");
		if (isset($_POST["search"]["value"])) {
			$this->db->group_start();
			$this->db->like("a.id", $_POST["search"]["value"]);
			$this->db->or_like("employee_id", $_POST["search"]["value"]);
			$this->db->or_like("b.client_name", $_POST["search"]["value"]);
			$this->db->or_like("c.emp_name", $_POST["search"]["value"]);
			$this->db->or_like("date", $_POST["search"]["value"]);
			$this->db->or_like("c.phone1", $_POST["search"]["value"]);
			$this->db->or_like("c.email", $_POST["search"]["value"]);
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
		$this->db->from('offer_letter');
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


	function get_backend_team_details($id)
	{
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$this->db->join('states c', 'a.state=c.id', 'left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}
	function get_employee_detail()
	{
		$emp_id = $this->input->post('emp_id');
		$this->db->where('ffi_emp_id', $emp_id);
		$this->db->where("status", "0");
		$query = $this->db->get('backend_management');
		$q = $query->result_array();
		return $q;
	}
	function save_offer_letter()
	{
		$emp_id = $this->input->post('ffi_emp_id');
		$client = $this->input->post('client');
		$letter_format = $this->input->post('letter_format');
		$tenure_date = $this->input->post('tenure_date');

		$tenure_date_db = "";
		if ($tenure_date != "") {
			$tenure_date_db = date("Y-m-d", strtotime($tenure_date));
		}

		$basic_salary = $this->input->post('basic_salary');
		$hra = $this->input->post('hra');
		$conveyance = $this->input->post('conveyance');
		$medical = $this->input->post('medical');
		$special_allowance = $this->input->post('special_allowance');
		$other_allowance = $this->input->post('other_allowance');
		$gross_salary = $this->input->post('gross_salary');

		$emp_pf = $this->input->post('emp_pf');
		$emp_esic = $this->input->post('emp_esic');
		$pt = $this->input->post('pt');
		$total_deduction = $this->input->post('total_deduction');
		$take_home = $this->input->post('take_home');
		$employer_pf = $this->input->post('employer_pf');
		$employer_esic = $this->input->post('employer_esic');
		$mediclaim = $this->input->post('mediclaim');
		$ctc = $this->input->post('ctc');

		$date = date("Y-m-d");
		$data = array("company_id" => $client, "employee_id" => $emp_id, "date" => $date, "offer_letter_type" => $letter_format, "basic_salary" => $basic_salary, "hra" => $hra, "conveyance" => $conveyance, "medical_reimbursement" => $medical, "special_allowance" => $special_allowance, "other_allowance" => $other_allowance, "gross_salary" => $gross_salary, "emp_pf" => $emp_pf, "emp_esic" => $emp_esic, "pt" => $pt, "total_deduction" => $total_deduction, "take_home" => $take_home, "employer_pf" => $employer_pf, "employer_esic" => $employer_esic, "mediclaim" => $mediclaim, "ctc" => $ctc);
		$this->db->where('employee_id', $emp_id);
		$this->db->where('company_id', $client);
		$query = $this->db->get("offer_letter");
		if (!$query->num_rows()) {

			$this->db->insert('offer_letter', $data);
		}
		/*$this->db->select('a.*,b.client_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->where('a.ffi_emp_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
		*/
		$this->db->select('a.*,b.emp_name,b.last_name,b.middle_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name, b.email');
		$this->db->from('offer_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'a.company_id=c.id', 'left');
		$this->db->where('a.employee_id', $emp_id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}
	function get_offer_letter()
	{
		$id = $this->uri->segment(3);
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.branch,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name');
		$this->db->from('offer_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'a.company_id=c.id', 'left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;

		/*$this->db->where('id',$id);
		$query1=$this->db->get('offer_letter');
		$q1=$query1->result_array();
		
		$emp_id=$q1[0]['employee_id'];
		
		/*$this->db->select('a.*,b.client_name,c.offer_letter_type');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('offer_letter c','a.ffi_emp_id=c.employee_id','left');
		$this->db->where('a.ffi_emp_id',$emp_id);*/
	}
	function get_offer_letter_pdf()
	{
		// $id=$this->uri->segment(3);
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.branch,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name,c.client_code');
		$this->db->from('offer_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'a.company_id=c.id', 'left');
		// $this->db->where('a.id',$id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
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
	function delete_offer_letter()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('offer_letter');
	}

	// excel import
	public function importEmployee_offer_letter($data = null)	{

		$this->db->where('employee_id', $data['employee_id']);

		$query = $this->db->get("offer_letter");
		if (!$query->num_rows()) {
			$this->db->insert('offer_letter', $data);
			return true;
		} else {
			$this->db->where('employee_id', $data['employee_id']);
			$this->db->update('offer_letter', $data);
			return true;
		}
	}
}
