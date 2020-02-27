<?php
defined('BASEPATH') or exit('No direct script access allowed');
//MODEL  
class Admin extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library("session");
	}

	function check_employee_data()
	{
		$name = $this->input->post('username');
		$this->db->select('emp_name,middle_name,last_name,email');
		$this->db->where("ffi_emp_id", $name);
		$query = $this->db->get('backend_management');
		$res = $query->result_array();

		if ($query->num_rows()) {
			$this->session->set_userdata('input_emp_id', $name);
			return $res;
		} else {
			return 0;
			$this->session->unset_userdata('input_emp_id');
		}
	}

	function add_refresh_id()
	{
		$code = md5(rand());
		$employee_id = $this->session->userdata('input_emp_id');
		$this->db->where('ffi_emp_id', $employee_id);
		$field = array('refresh_code' => $code);
		if ($this->db->update("backend_management", $field)) {
			return $code;
		} else {
			return false;
		}
	}

	function update_refresh_id()
	{
		$employee_id = $this->session->userdata('input_emp_id');
		$code = md5(rand());
		$this->db->where('ffi_emp_id', $employee_id);
		$field = array("refresh_code" => $code);
		if ($this->db->update("backend_management", $field)) {
			return $code;
		} else {
			return false;
		}
	}
	function check_refresh_id()
	{
		$employee_id = $this->session->userdata('input_emp_id');
		$code_id = $this->input->get('code_id');
		$this->db->where("ffi_emp_id", $employee_id);
		$this->db->where("refresh_code", $code_id);
		$query = $this->db->get('backend_management');
		$a = $query->result_array();
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	function update_emp_password()
	{
		$employee_id = $this->session->userdata('input_emp_id');
		$new_password = $this->input->post('abc_new_password');
		$confirm_password = $this->input->post('abc_confirm_password');
		if ($new_password == $confirm_password) {
			$field = array("password" => md5($new_password));
			$this->db->where('ffi_emp_id', $employee_id);
			if ($this->db->update("backend_management", $field)) {
				return true;
			}
			// else{
			// 	echo "<script>alert('not working')</script>";
			// }
		}
	}

	function check_login()
	{
		$name = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$this->db->where("ffi_emp_id", $name);
		$this->db->where("password", $password);
		$this->db->where("data_status", "1");
		$query = $this->db->get('backend_management');
		$res = $query->result_array();

		if ($query->num_rows() == 1) {
			$this->session->set_userdata('emp_id', $res[0]['ffi_emp_id']);
			$this->session->set_userdata('employee_login', 'true');
			$this->session->set_userdata('emp_name', $res[0]['emp_name']);
			return "success";
		} else {
			return "false";
		}
	}

	function get_employee_details($emp_id)
	{
		$this->db->select('a.*,b.client_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b', 'a.client_id=b.id', 'left');
		$this->db->where('a.ffi_emp_id', $emp_id);
		$query = $this->db->get();
		$q = $query->result_array();
		return $q;
	}
}
