<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
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
		$this->load->view('admin/index');
	}
	public function otp_index()
	{
		if($this->session->userdata('admin_otp'))
		{
			$this->load->view('admin/otp_index');
		}
		
	}
	public function testing()
	{
		$this->load->library('email');
			 
		require 'PHPMailer/PHPMailerAutoload.php';
			
			  $to_mail='mythili.webomindapps@gmail.com';
			
			$smtp_usermail='no-reply@fretusfolks.com';
			$smtp_userpwd='wP6D_Gx8mVy3';
			 
			//coolaidotp@gmail.com
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 3;
			$mail->Debugoutput = 'html';
			$mail->Host = 'fretusfolks.co.in';
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username = $smtp_usermail;
			$mail->Password = $smtp_userpwd;
			$mail->SMTPSecure = 'tls';	
			$message ="CoolAid Application Login OTP is "; 
			
			 
			$subject="Fretus Folks";
			$s_name="Fretus Folks";
			
				$tomailLists = array($to_mail);
				$arrlength = count($tomailLists);
				$mail->setFrom($smtp_usermail,$s_name);
				$mail->addReplyTo("no-reply@fretusfolks.com", "Fretus Folks");

					for($x = 0; $x < $arrlength; $x++) 
					{     
						$mail->addAddress($tomailLists[$x]);
					}
				$mail->Subject = $subject;
				$mail->msgHTML($message);
				if($mail->send())
				{
				  
					echo "success";
				}
				else
				{
					echo $mail->ErrorInfo;
				}
	}
	public function process_login()
	{
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
				$subject="Fretus folks | OTP Verification for login";
				$message="Dear ".$data->name.",<br/><br/>Please find your one time password ".$change_otp."<br/><br/><br/>Thanks,<br/>Fretus folks";
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
		if($this->session->userdata('admin_otp'))
		{
			$this->form_validation->set_rules('sdfsfswetyess', 'Admin OTP', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() ==  TRUE):
				if($this->admin->otp()):
					$change_otp=rand(111111,999999);
					$data=array("ref_no" =>$change_otp);
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
		if($this->session->userdata('admin_login') && $this->session->userdata('admin_otp'))
		{
			$data['active_menu']="dashboard";
			$data['cdms_report']=$this->home->get_cdms_report();
			$data['contract_details']=$this->home->get_contract_end_data();
			$data['total_employee']=$this->home->get_total_employee();
			$data['employee_details']=$this->home->get_company_details();
			$data['fhrms_details']=$this->home->get_fhrms_details();
			$data['cfis_report']=$this->home->get_cfis_report();
			$data['dcs_report']=$this->home->get_dcs_report();
			$data['fhrms_report']=$this->home->get_fhrms_report();
			$data['labour_notice']=$this->home->get_labour_notice();
			$data['cims_details']=$this->home->get_cims_details();
			$data['asset_details']=$this->home->get_asset_details();
			$data['tds_details']=$this->home->get_tds_details();
			$data['backend_team']=$this->home->todays_dob();
			$this->load->view('admin/back_end/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		$this->session->unset_userdata('admin_id');	
		$this->session->unset_userdata('admin_name');	
		$this->session->unset_userdata('admin_type');	
		$this->session->unset_userdata('admin_otp');
		redirect('home/index');
	}
}
