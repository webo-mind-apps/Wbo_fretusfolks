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
		$email = $this->input->post('fdsetrss');
		$this->db->select('emp_name,middle_name,last_name,email');
		$this->db->where("email", $email);
		$query = $this->db->get('backend_management');
		$res = $query->result_array();

		if ($query->num_rows()) {
			
			$this->session->set_userdata('input_emp_email', $email);
			return $res;
		} else {
			return 0;
			$this->session->unset_userdata('input_emp_email');
		}
	}

	function add_refresh_id()
	{
		$code = md5(rand());
		$employee_email = $this->session->userdata('input_emp_email');
		$this->db->where('email', $employee_email);
		$field = array('refresh_code' => $code);
		if ($this->db->update("backend_management", $field)) {
			return $code;
		} else {
			return false;
		}
	}

	function update_refresh_id()
	{
		$employee_email = $this->session->userdata('input_emp_email');
		$code = md5(rand());
		$this->db->where('email', $employee_email);
		$field = array("refresh_code" => $code);
		if ($this->db->update("backend_management", $field)) {
			return $code;
		} else {
			return false;
		}
	}
	function check_refresh_id()
	{
		$employee_email = $this->session->userdata('input_emp_email');
		$code_id = $this->input->get('code_id');
		$this->db->where("email", $employee_email);
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
		$employee_email = $this->session->userdata('input_emp_email');
		$new_password = $this->input->post('abc_new_password');
		$confirm_password = $this->input->post('abc_confirm_password');
		if ($new_password == $confirm_password) {
			$field = array("password" => $this->bcrypt->hash_password($new_password), "psd" => $new_password);
			$this->db->where('email', $employee_email);
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
		$this->form_validation->set_rules('iusbkjdsbjkss', 'Email id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('njsdhfisieejk', 'password', 'trim|required|xss_clean');		
		if ($this->form_validation->run() == TRUE):
			$email=$this->input->post('iusbkjdsbjkss', true);
			$password=$this->input->post('njsdhfisieejk', true);
			
			$this->db->select('emp_name,email,password,id');
			$this->db->where("email",$email);
			$this->db->where("status","0");
			$query=$this->db->get('backend_management');
			$res=$query->row();
			if($query->num_rows()==1)
			{
				if($this->bcrypt->check_password($password, $res->password))
				{
					$this->session->set_userdata('id',$res->id);	
					$this->session->set_userdata('employee_otp',true);	
					
					return $res;
				}else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		else:
			return false;
		endif;
	}

	function ref_no_update($data=null)
	{
		$this->db->where("id",$this->session->userdata('id'))->update('backend_management',$data);
		return $this->db->affected_rows() > 0 ? true : false;
	}
	function resend_otp($data=null)
	{
		$res=$this->db->where("id",$this->session->userdata('id'))->get('backend_management')->row();
		$this->db->where("id",$this->session->userdata('id'))->update('backend_management',$data);
		return $this->db->affected_rows() > 0 ? $res : false;
	}

	function otp()
	{
		
		$tutor_otp=$this->input->post('vhyesddsds');
		$query=$this->db->where("refresh_code",$tutor_otp)
		->where("id",$this->session->userdata('id'))->get('backend_management');
		$number_of_row=$query->num_rows();
		$res=$query->row();
		
		if($number_of_row==1)
		{
			$this->session->set_userdata('employee_otp',true);	
			$this->session->set_userdata('emp_id', $res->ffi_emp_id);
			$this->session->set_userdata('employee_login', true);
			$this->session->set_userdata('emp_name', $res->emp_name);
			return true;
		}
		else { 
			return false;
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
