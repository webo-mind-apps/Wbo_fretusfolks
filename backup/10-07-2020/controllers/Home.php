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
		
		
		
		/* $this->load->library('email');
			
		$from_email = "noreply@webomindapps.com"; 
         $to_email = 'mythili.webomindapps@gmail.com'; 
   
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) 
		 {
			 echo "Success";
		 }			 
		 else
		 {
			 echo "Failed";
		 } */
			
			
			/* require 'phpmail/PHPMailerAutoload.php';
			
			$smtp_usermail='noreply.webomindapps@gmail.com';
			$smtp_userpwd='Webo@123';
			 
			//coolaidotp@gmail.com
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username =$smtp_usermail;
			$mail->Password = $smtp_userpwd;	
			 
			$message ="Testing \n"; 
			
			
			 
			$subject="Fretus Folks";
			$s_name="Fretus Folks";
			
				$tomailLists = array('mythili.webomindapps@gmail.com');
				$arrlength = count($tomailLists);
				$mail->setFrom($smtp_usermail,$s_name);
				$mail->addReplyTo("noreply.webomindapps@gmail.com", "Fretus Folks");

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
				} */
			  
	}
	public function process_login()
	{
		$data=$this->admin->check_login();
		
			if($data=="success")
			{
				redirect('home/dashboard');
			}
			else
			{
				$this->session->set_flashdata('abc','error');
				redirect('home/index');
			}
	}
	public function dashboard()
	{
		if($this->session->userdata('admin_login'))
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
		redirect('home/index');
	}
}
