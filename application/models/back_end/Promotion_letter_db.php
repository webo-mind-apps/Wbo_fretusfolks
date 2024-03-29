<?php
defined('BASEPATH') or exit('No direct script access allowed');

class promotion_letter_db extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library("session");
	}
	public function get_all_promotion_letters()
	{
		$this->db->select('a.*, b.client_name,c.email,c.phone1');
		$this->db->from('promotion_letter a');
		$this->db->join('backend_management c', 'a.employee_id=c.ffi_emp_id', 'left');
		$this->db->join('client_management b', 'c.client_id=b.id', 'left');
		$this->db->where("a.status", "0");
		$this->db->order_by('a.id', 'DESC');
		$query = $this->db->get();
		$q = $query->result_array();

		return $q;
	}

	public function make_query()
	{
		$order_column = array("a.id", "employee_id", "client_name", "emp_name", "date", "phone1", "email");
		$this->db->select('a.*,b.client_name,c.email,c.phone1,c.client_id');
		$this->db->from('promotion_letter a');
		$this->db->join('backend_management c', 'a.employee_id=c.ffi_emp_id', 'left');
		$this->db->join('client_management b', 'c.client_id=b.id', 'left');
		$this->db->where("c.status", "0");

		if (isset($_POST["search"]["value"])) {
			$this->db->group_start();
			$this->db->like("a.id", $_POST["search"]["value"]);
			$this->db->or_like("a.employee_id", $_POST["search"]["value"]);
			$this->db->or_like("b.client_name", $_POST["search"]["value"]);
			$this->db->or_like("a.emp_name", $_POST["search"]["value"]);
			$this->db->or_like("a.date", $_POST["search"]["value"]);
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
		$this->db->from('promotion_letter');
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

	function save_promotion_letter()
	{
		$emp_id = $this->input->post('ffi_emp_id', true);
		$emp_name = $this->input->post('emp_name', true);
		$old_designation = $this->input->post('old_designation', true);
		$new_designation = $this->input->post('new_designation', true);

		$basic_salary = $this->input->post('basic_salary', true);
		$hra = $this->input->post('hra', true);
		$special_allowance = $this->input->post('special_allowance', true);
		$st_bonus = $this->input->post('st_bonus', true);
		$gross_salary = $this->input->post('gross_salary', true);
		$emp_pf = $this->input->post('emp_pf', true);
		$emp_esic = $this->input->post('emp_esic', true);
		$take_home = $this->input->post('take_home', true);
		$employer_pf = $this->input->post('employer_pf', true);
		$employer_esic = $this->input->post('employer_esic', true);
		$ctc = $this->input->post('ctc', true);
		$joining_date = $this->input->post('joining_date', true);
		$effective_date = $this->input->post('effective_date', true);
		$date = date("Y-m-d");
		$data = array(
			"employee_id"			=> $emp_id,
			"emp_name"				=> $emp_name,
			"date"					=>	$date,
			"basic_salary"			=> $basic_salary,
			"hra"					=> $hra,
			"special_allowance"		=> $special_allowance,
			"st_bonus"				=> $st_bonus,
			"gross_salary"			=> $gross_salary,
			"emp_pf"				=> $emp_pf,
			"emp_esic"				=> $emp_esic,
			"net_take_home"			=> $take_home,
			"employer_pf"			=> $employer_pf,
			"employer_esic"			=> $employer_esic,
			"ctc"					=> $ctc,
			"effective_date"		=> date('Y-m-d', strtotime($effective_date)),
			"designation"			=> $new_designation,
			"old_designation"		=> $old_designation,
			"joining_date"			=> date('Y-m-d', strtotime($joining_date)),


		);

		// $data = array(
		// 	"designation" => $designation, "department" => $department, "basic_salary" => $basic_salary, "hra" => $hra, "conveyance" => $conveyance, "medical_reimbursement" => $medical, "special_allowance" => $special_allowance, "other_allowance" => $other_allowance, "gross_salary" => $gross_salary, "emp_pf" => $emp_pf, "emp_esic" => $emp_esic, "pt" => $pt, "total_deduction" => $total_deduction, "take_home" => $take_home, "employer_pf" => $employer_pf, "employer_esic" => $employer_esic, "mediclaim" => $mediclaim, "ctc" => $ctc
		// );

		// $this->db->where("ffi_emp_id", $emp_id);
		// $this->db->where("client_id", $client);
		// $this->db->update("backend_management", $data);

		// $date = date("Y-m-d");
		// $data1 = array("company_id" => $client, "employee_id" => $emp_id, "date" => $date, "basic_salary" => $basic_salary, "hra" => $hra, "conveyance" => $conveyance, "medical_reimbursement" => $medical, "special_allowance" => $special_allowance, "other_allowance" => $other_allowance, "gross_salary" => $gross_salary, "emp_pf" => $emp_pf, "emp_esic" => $emp_esic, "pt" => $pt, "total_deduction" => $total_deduction, "take_home" => $take_home, "employer_pf" => $employer_pf, "employer_esic" => $employer_esic, "mediclaim" => $mediclaim, "ctc" => $ctc);

		if ($this->db->insert("promotion_letter", $data)) {
			return true;
		}
	}
	function get_promotion_letter_details()
	{
		$id = $this->uri->segment(3);
		$this->db->select('a.*,d.content,c.client_name,b.client_id');
		$this->db->from('promotion_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'b.client_id=c.id', 'left');
		$this->db->join('letter_content d', 'd.type=5', 'left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$q = $query->row_array();
		return $q;
	}
	public function get_all_client()
	{
		$query = $this->db->get('client_management');
		$q = $query->result_array();
		return $q;
	}

	public function download_promotion()
	{
		$input_date = "";
		$client = $this->input->post('promotion_download_client', true);
		$input_date = $this->input->post('promotion_download_date', true);
		$input_date2 = $this->input->post('promotion_download_date2', true);



		$this->db->select('a.*,c.client_name,d.content,c.client_name,b.client_id');
		$this->db->from('promotion_letter a');
		$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
		$this->db->join('client_management c', 'b.client_id=c.id', 'left');
		$this->db->join('letter_content d', '5=d.id', 'left');
		$this->db->where('b.client_id', $client);
		if (!empty($input_date)) {
			$date = date("Y-m-d", strtotime($input_date));
			$date2 = date("Y-m-d", strtotime($input_date2));
			$this->db->where('a.date >=', $date);
			$this->db->where('a.date <=', $date2);
		}
		$query = $this->db->get();
		$q = $query->result_array();
		
		if($q){
			return $q;
		}else{
			return "nothing_found";
		}
		// 	echo "<pre>";
		// 	print_r($q);

		// 	echo "</pre>";
		// exit;
	}

	function get_employee_detail()
	{
		$emp_id = $this->input->post('emp_id', true);
		$this->db->where('ffi_emp_id', $emp_id);
		$this->db->where("status", 0);
		$query = $this->db->get('backend_management');
		$q = $query->result_array();
		
		return $q;
	}
	function get_letter_content()
	{
		$this->db->where('type', '5');
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
	function delete_promotion_letter()
	{
		$id = $this->input->post('id', true);
		$this->db->where('id', $id);
		$this->db->delete('promotion_letter');
	}
	// excel import
	public function importEmployee_promotion_letter($data = null)
	{
		if ($data['employee_id'] != 'null' || $data['employee_id'] != '' || !empty($data['employee_id'])) {

			$this->db->where('ffi_emp_id', $data['employee_id']);
			$query = $this->db->get("backend_management");
			if ($query->num_rows() > 0) {
				$this->db->insert('promotion_letter', $data);
				return "insert";
			} else {
				return "not_exist";
			}
		} else {
			return false;
		}
	}
}
