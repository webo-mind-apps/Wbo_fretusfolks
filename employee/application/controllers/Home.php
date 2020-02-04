<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/admin');
		$this->load->model('back_end/home_db', 'home');
		$this->load->library("pagination");
	}
	public function index()
	{
		$this->load->view('admin/index');
	}

	public function forgot_password()
	{
		//Load forgot password form
		$this->load->view('admin/forgot_password_form');
	}


	public function process_reset_password() //
	{ //check emp id and send reset password link to emp mail
		if (isset($_POST['forgot_password_form_submit'])) {
			$data = $this->admin->check_employee_data();
			if ($data) {
				$this->load->config('email');
				$this->load->library('email');
				$from = $this->config->item('smtp_user');

				//Email content
				$data['first_name'] = $data[0]['emp_name'];
				$data['last_name'] = $data[0]['last_name'];
				//$this->load->view('mail_format', $data);
				// exit();
				$mail_message = $this->load->view('mail_format', $data, TRUE);
				$this->email->set_newline("\r\n");
				$this->email->from($from);
				$this->email->to('madhusudhandummy@gmail.com');
				$this->email->subject('Password reset Request');
				$this->email->message($mail_message);

				//Send email

				if ($this->email->send()) {
					$this->load->view('admin/forgot_password_form');
					$this->session->set_flashdata('mail_sent', 'sent');
					redirect('home/forgot_password');
				} else {
					$this->load->view('admin/forgot_password_form');
					$this->session->set_flashdata('mail_not_sent', 'not_sent');
					redirect('home/forgot_password');
				}
			} else {
				//invalid emp id send error to reset password form
				$this->session->set_flashdata('emp_id_err', 'error');
				redirect('home/forgot_password');
			}
		}
	}
	function create_new_password_form()
	{   //form for reset password
		$this->load->view('create_new_password_form');
		if (isset($_POST['create_new_password_submit'])) {
			$new_password = $this->input->post('abc_new_password');
			$confirm_password = $this->input->post('abc_confirm_password');
			if ($new_password != $confirm_password) {
				$this->session->set_flashdata('password_not_modifed', 'not_updated');
				redirect('home/create_new_password_form');
			}else{
				$this->admin->update_emp_password();
				$this->session->set_flashdata('password_modifed', 'updated');
				redirect('home/create_new_password_form');
			}
		}
	}
	function create_new_password()
	{  //id creating and sending from mail_format

		if (isset($_POST['flash_id_create_new_pass'])) {
			$enc_id = $_POST['flash_id_create_new_pass']; //from mail_format_submit
			if ($this->session->userdata($enc_id, 'encrypted_flash_id')) {
				//this is userdata getting md5 id
				redirect('home/create_new_password_form');
			}
		} //from create_new_user_form
		else if (isset($_POST['create_new_password_submit'])) {
			if ($this->admin->update_emp_password()) {
				$this->session->set_flashdata('password_modifed', 'updated');
				redirect('home/create_new_password_form');
			}  
		} else {
			redirect('home/forgot_password');
		}
	}

	public function process_login()
	{
		$data = $this->admin->check_login();

		if ($data == "success") {

			redirect('home/dashboard');
		} else {
			$this->session->set_flashdata('abc', 'error');
			redirect('home/index');
		}
	}
	public function dashboard()
	{
		if ($this->session->userdata('employee_login')) {
			$emp_id = $this->session->userdata('emp_id');
			if ($emp_id) {
				$data['active_menu'] = "dashboard";
				$data['employee'] = $this->admin->get_employee_details($emp_id);
				$this->load->view('admin/back_end/index', $data);
			}
		} else {
			redirect('home/index');
		}
	}
	public function reset_password()
	{
		if ($this->session->userdata('employee_login')) {
			$data['active_menu'] = "settings";
			$data['emp_details'] = $this->home->get_emp_details();
			$this->load->view('admin/back_end/change_password/reset_password', $data);
		} else {
			redirect('home/index');
		}
	}
	public function change_psd()
	{
		if ($this->session->userdata('employee_login')) {
			$this->home->change_psd();
			redirect('home/dashboard');
		} else {
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('employee_login');
		redirect('home/index');
	}
}
