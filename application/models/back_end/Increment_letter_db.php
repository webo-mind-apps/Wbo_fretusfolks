<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Increment_letter_db extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library("session");
	}
	public function get_all_increment_letters()
	{
		$this->db->select('a.*,b.client_name,c.emp_name,c.email,c.phone1');
		$this->db->from('increment_letter a');
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
		$order_column = array("a.id", "employee_id", "client_name", "emp_name", "date", "phone1", "email");
		$this->db->select('a.*,b.client_name,c.emp_name,c.email,c.phone1');
		$this->db->from('increment_letter a');
		$this->db->join('client_management b', 'a.company_id=b.id', 'left');
		$this->db->join('backend_management c', 'a.employee_id=c.ffi_emp_id', 'left');
		$this->db->where("a.status", "0");

		if (isset($_POST["search"]["value"])) {
			$this->db->group_start();
			$this->db->like("a.id", $_POST["search"]["value"]);
			$this->db->or_like("employee_id", $_POST["search"]["value"]);
			$this->db->or_like("client_name", $_POST["search"]["value"]);
			$this->db->or_like("emp_name", $_POST["search"]["value"]);
			$this->db->or_like("date", $_POST["search"]["value"]);
			$this->db->or_like("phone1", $_POST["search"]["value"]);
			$this->db->or_like("email", $_POST["search"]["value"]);
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
		$this->db->from('increment_letter');
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

	function save_increment_letter()
	{
		$emp_id = $this->input->post('ffi_emp_id');
		$client = $this->input->post('client');
		$department = $this->input->post('departments');
		$designation = $this->input->post('designation');

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
		$content = $this->input->post('content');

		$data = array(
			"designation" => $designation, "department" => $department, "basic_salary" => $basic_salary, "hra" => $hra, "conveyance" => $conveyance, "medical_reimbursement" => $medical, "special_allowance" => $special_allowance, "other_allowance" => $other_allowance, "gross_salary" => $gross_salary, "emp_pf" => $emp_pf, "emp_esic" => $emp_esic, "pt" => $pt, "total_deduction" => $total_deduction, "take_home" => $take_home, "employer_pf" => $employer_pf, "employer_esic" => $employer_esic, "mediclaim" => $mediclaim, "ctc" => $ctc
		);

		$this->db->where("ffi_emp_id", $emp_id);
		$this->db->where("client_id", $client);
		$this->db->update("backend_management", $data);

		$date = date("Y-m-d");
		$data1 = array("company_id" => $client, "employee_id" => $emp_id, "date" => $date, "basic_salary" => $basic_salary, "hra" => $hra, "conveyance" => $conveyance, "medical_reimbursement" => $medical, "special_allowance" => $special_allowance, "other_allowance" => $other_allowance, "gross_salary" => $gross_salary, "emp_pf" => $emp_pf, "emp_esic" => $emp_esic, "pt" => $pt, "total_deduction" => $total_deduction, "take_home" => $take_home, "employer_pf" => $employer_pf, "employer_esic" => $employer_esic, "mediclaim" => $mediclaim, "ctc" => $ctc, "content" => $content);

		if ($this->db->insert("increment_letter", $data1)) {
			return true;
		}
	}
	function get_increment_letter_details()
	{
		$id = $this->uri->segment(3);
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name');
		$this->db->from('increment_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'a.company_id=c.id', 'left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}
	public function get_all_client()
	{
		$query = $this->db->get('client_management');
		$q = $query->result_array();
		return $q;
	}

	public function download_increment()
	{
		$input_date = "";
		$client = $this->input->post('increment_download_client');
		$input_date = $this->input->post('increment_download_date');
		$input_date2 = $this->input->post('increment_download_date2');

		$date = date("Y-m-d", strtotime($input_date));
		$date2 = date("Y-m-d", strtotime($input_date2));

		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name');
		$this->db->from('increment_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'a.company_id=c.id', 'left');
		$this->db->where('a.company_id', $client);
		if (!empty($input_date)) {
			$this->db->where('a.date >=', $date);
			$this->db->where('a.date <=', $date2);
		}
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
	function get_letter_content()
	{
		$this->db->where('type', '1');
		$query = $this->db->get('letter_content');
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
	function delete_increment_letter()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('increment_letter');
	}
	// excel import
	public function importEmployee_increment_letter($data = null)
	{
		$this->db->where('ffi_emp_id', $data['employee_id']);
		$query = $this->db->get("backend_management");
		if ($query->num_rows()) {

			$this->db->where('employee_id', $data['employee_id']);
			$query = $this->db->get("increment_letter");
			if (!$query->num_rows()) {
				$this->db->insert('increment_letter', $data);
				if ($this->db->affected_rows() > 0) {
					return true;
				}
			} else {
				$this->db->where('employee_id', $data['employee_id']);
				$this->db->update('increment_letter', $data);
				if ($this->db->affected_rows() > 0) {
					return true;
				}
			}
		}
	}
}
