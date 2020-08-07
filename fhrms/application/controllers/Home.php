<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/admin');
					$this->load->model('back_end/home_db','home');
					$this->load->library("pagination");
        }
	public function index()
	{
		$this->load->library('recaptcha');
		$recaptcha = $this->recaptcha->create_box();
		$this->load->view('admin/index',['recaptcha' => $recaptcha]);
	}

	public function otp_index()
	{
		if($this->session->userdata('admin_otp'))
		{
			$this->load->view('admin/otp_index');
		}
		
	}
	public function process_login()
	{
			// if($this->input->post('action') === 'submit')
		// {
		// 	$is_valid = $this->recaptcha->is_valid();

		// 	if($is_valid['success'])
		// 	{
				$data=$this->admin->check_login();
				
					if($data!=false)
					{
						$change_otp=rand(111111,999999);
						$data1=array("ref_no" =>$change_otp);
						$this->admin->ref_no_update($data1);
						$this->load->config('email');
						$this->load->library('email');
						$from = $this->config->item('smtp_user');
						$to =$data->email;
						$subject="Fretus folks | OTP Verification for employee";
						$message="Dear ".$data->emp_name.",<br/><br/>Please find your one time password ".$change_otp."<br/><br/><br/>Thanks,<br/>Fretus folks";
						$this->email->from($from, 'Fretus folks');
						$this->email->to($to);
						$this->email->subject($subject);
						$this->email->message($message);
						$this->email->send();
						$this->email->clear(TRUE);

						$this->session->set_tempdata('success','OTP is sent in your mail id', 5);
						redirect('home/otp_index');
					}
					else
					{
						$this->session->set_flashdata('abc','User name or password is wrong!');
						redirect('home/index');
					}
	// 		}
	// 		else
	// 		{
	// 			$this->session->set_flashdata('abc','Recaptcha problem,solve recaptcha!');
	// 			redirect('home/index');
	// 		}
				
	// }
	}
	public function otp()
	{
		if($this->session->userdata('admin_otp'))
		{
			$this->form_validation->set_rules('cxfdfdsfdfs', 'OTP', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() ==  TRUE):
				if($this->admin->otp()):
					$change_otp=rand(111111,999999);
					$data=array("ref_no" =>$change_otp);
					if($this->admin->ref_no_update($data)):
						redirect('home/dashboard');
					endif;
				else:
					$this->session->set_flashdata('abc','Your OTP is wrong!');
					redirect('home/otp_index');
				endif;
			else:
				$this->session->set_flashdata('abc','Form validation error!');
				redirect('home/otp_index');
			endif;
		}else{
			
			redirect('home/index');
		}
	}

	public function resend_otp()
	{
		if($this->session->userdata('admin_otp'))
		{
			$change_otp=rand(111111,999999);
			$data=array("ref_no" =>$change_otp);
			$update=$this->admin->resend_otp($data);
				if($update != false):
					$this->load->config('email');
					$this->load->library('email');

					$from = $this->config->item('smtp_user');
					$to =$update->email;
					$subject="Fretus folks | OTP Verification for login";
					$message="Dear ".$update->name.",<br/><br/>Please find your one time password ".$change_otp."<br/><br/><br/>Thanks,<br/>Fretus folks";

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
		if($this->session->userdata('employee_login'))
		{
			$emp_id=$this->session->userdata('emp_id');
			if($emp_id)
			{ 
				$data['active_menu']="dashboard";
				$data['employee']=$this->admin->get_employee_details($emp_id);
				$this->load->view('admin/back_end/index',$data);
			}
			
		}
		else
		{
			redirect('home/index');
		}
	}
	public function reset_password()
	{
		if($this->session->userdata('employee_login'))
		{
			$data['active_menu']="settings";
			$data['emp_details']=$this->home->get_emp_details();
			$this->load->view('admin/back_end/change_password/reset_password',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function change_psd()
	{
		if($this->session->userdata('employee_login'))
		{
			if($this->home->change_psd())
			{
					redirect('home/dashboard');
			}else{
				$this->session->set_flashdata('abc','Form validation error!');
				redirect('home/reset_password');
			}
		
		}
		else
		{
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('employee_login');
		$this->session->unset_userdata('emp_id');	
		$this->session->unset_userdata('employee_otp_login');
		$this->session->unset_userdata('emp_name');
			
		redirect('home/index');
	}
}
