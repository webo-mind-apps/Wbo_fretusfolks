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
		$this->load->view('admin/forgot_password/forgot_password_form');
	}


	public function process_reset_password() //
	{ //check emp id and send reset password link to emp mail
		if (isset($_POST['forgot_password_form_submit'])) {
			$data = $this->admin->check_employee_data();
			
			if ($data) {
				
				if ($code = $this->admin->add_refresh_id()) {
				
					$this->load->config('email');
					$this->load->library('email');
					$from = $this->config->item('smtp_user');

					//Email content
					$data['code']       = $code;
					$data['first_name'] = $data[0]['emp_name'];
					$data['middle_name'] = $data[0]['middle_name'];
					$data['last_name']  = $data[0]['last_name'];
					$my_mail = $data[0]['email'];

					//echo $my_mail;
					// exit();
					$mail_message = $this->load->view('admin/forgot_password/mail_format', $data, TRUE);
					$this->email->set_newline("\r\n");
					$this->email->from($from);
					$this->email->to($my_mail);
					$this->email->subject('Password reset Request');
					$this->email->message($mail_message);

					//Send email

					if ($this->email->send()) {
						
						$this->load->view('admin/forgot_password/forgot_password_form');
						$this->session->set_flashdata('mail_sent', 'sent');
						redirect('home/forgot_password');
					} else {
						$this->load->view('admin/forgot_password/forgot_password_form');
						$this->session->set_flashdata('mail_not_sent', 'not_sent');
						redirect('home/forgot_password');
					}
				} else {
					echo "something our side error";
				}
			} else {
				//invalid emp id send error to reset password form
				$this->session->set_flashdata('emp_id_err', 'error');
				redirect('home/forgot_password');
			}
		} else {
			redirect('home/forgot_password');
		}
	}

	function create_new_password_form_fun() //calling from create_new_password func below
	{   //form for reset password 
		if (isset($_POST['create_new_password_submit'])) { //new password update entire func
			$new_password = $this->input->post('abc_new_password');
			$confirm_password = $this->input->post('abc_confirm_password');
			if ($new_password != $confirm_password) {
				$this->session->set_flashdata('password_not_modifed', 'not_updated');
				$this->load->view('admin/forgot_password/create_new_password_form');
				// redirect('home/create_new_password_form');
			} else {
				if ($this->admin->update_emp_password()) {
					$this->session->set_flashdata('password_modifed', 'updated');
					$this->admin->update_refresh_id();
					redirect('home/');
				}
			}
		} else {
			redirect('home/forgot_password');
		}
	}

	function create_new_password()
	{
		if (isset($_POST['mail_link_submit'])) { //from mail format form submit

			if ($this->admin->check_refresh_id()) {
				$this->load->view('admin/forgot_password/create_new_password_form');
			} else {
				$this->session->set_flashdata('link_expired', 'expired');
				redirect('home/forgot_password');
			}
		} else {
			redirect('home/forgot_password');
		}
	}

	public function otp_index()
	{
		if($this->session->userdata('employee_otp'))
		{
			$this->load->view('admin/otp_index');
		}
		
	}

	public function process_login()
	{
		$data=$this->admin->check_login();
		
			if($data!=false)
			{
				$change_otp=rand(111111,999999);
				$data1=array("refresh_code" =>$change_otp);
				$this->admin->ref_no_update($data1);
				
			
				$this->load->config('email');
				$this->load->library('email');

				$from = $this->config->item('smtp_user');
				$to =$data->email;
				$subject="Fretus folks | OTP Verification for login";
				$message="Dear ".$data->emp_name.",<br/><br/>Please find your one time password ".$change_otp."<br/><br/><br/>Thanks,<br/>Fretus folks";

				$this->email->from($from, 'Fretus folks');
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
				
				if ($this->email->send()) {
					$this->session->set_tempdata('success','OTP is sent in your mail id', 5);
					redirect('home/otp_index');
				}
				// return true;
				$this->email->clear(TRUE);
			
				
			}
			else
			{
				$this->session->set_flashdata('abc','error');
				redirect('home/index');
			}
	}
	public function otp()
	{
		if($this->session->userdata('employee_otp'))
		{
			$this->form_validation->set_rules('vhyesddsds', 'Employee OTP', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() ==  TRUE):
				if($this->admin->otp()):
					$change_otp=rand(111111,999999);
					$data=array("refresh_code" =>$change_otp);
					if($this->admin->ref_no_update($data)):
						redirect('home/dashboard');
					endif;
				else:
					$msg="Your OTP is wrong!";
					// $this->session->set_flashdata('failed',$msg);
					$this->session->set_tempdata('failed', $msg, 5);
					redirect('home/otp_index');
				endif;
			else:
				$msg="Form validation error!";
				$this->session->set_tempdata('failed',$msg, 5);
				redirect('home/otp_index');
			endif;
		}else{
			
			redirect('home/index');
		}
	}

	public function resend_otp()
	{
		if($this->session->userdata('employee_otp'))
		{
			$change_otp=rand(111111,999999);
			$data=array("refresh_code" =>$change_otp);
			$update=$this->admin->resend_otp($data);
				if($update != false):
					$this->load->config('email');
					$this->load->library('email');

					$from = $this->config->item('smtp_user');
					$to =$update->email;
					$subject="Fretus folks | OTP Verification for login";
					$message="Dear ".$update->emp_name.",<br/><br/>Please find your one time password ".$change_otp."<br/><br/><br/>Thanks,<br/>Fretus folks";

					$this->email->from($from, 'Fretus folks');
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($message);
					
					if ($this->email->send()) {
						$this->session->set_tempdata('success','OTP is sent in your email id!', 5);
						redirect('home/otp_index');
					}
					// return true;
					$this->email->clear(TRUE);

				else:
					$msg="Somthing went wrong try again!";
					// $this->session->set_flashdata('failed',$msg);
					$this->session->set_tempdata('failed', $msg, 5);
					redirect('home/otp_index');
				endif;
			
		}else{
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
		$this->session->unset_userdata('employee_otp');	
		$this->session->unset_userdata('emp_id');
		$this->session->unset_userdata('employee_login');
		$this->session->unset_userdata('emp_name');
		redirect('home/index');
	}
}
