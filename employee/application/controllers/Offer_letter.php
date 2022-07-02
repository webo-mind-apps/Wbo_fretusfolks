<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer_letter extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('employee_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Offer_letter_db','letter');
					$this->load->library("pagination");
        }
	public function index()
	{
		// $letter_type=$this->input->post('letter_format');
		
		// $letter=$this->letter->get_letter_details();
		$data['letter_details']=$this->letter->get_employee_details();
		 
		// if($letter)
		if ($data = $this->letter->get_offer_letter()) 
		{
			// $data['tenure_date']=$letter[0]['tenure_date'];
			$letter_type = $data[0]['offer_letter_type'];
			$data['letter_details'][0] = $data[0];
			
			// if($letter[0]['offer_letter_type']==1)
			// {
			// 	$this->load->view('admin/back_end/offer_letter/format1',$data);
			// }
			// if($letter[0]['offer_letter_type']==2)
			// {
			// 	$this->load->view('admin/back_end/offer_letter/format2',$data);
			// }
			// if($letter[0]['offer_letter_type']==3)
			// {
			// 	$this->load->view('admin/back_end/offer_letter/format3',$data);
			// }
			// if($letter[0]['offer_letter_type']==4)
			// {
			// 	$this->load->view('admin/back_end/offer_letter/format4',$data);
			// }
			// if($letter[0]['offer_letter_type']==5)
			// {
			// 	$this->load->view('admin/back_end/offer_letter/format5',$data);
			// }
			if ($letter_type == 1) {

				 $this->load->view('admin/back_end/offer_letter/pdf-format1', $data);
			} else if ($letter_type == 2) {

				 $this->load->view('admin/back_end/offer_letter/pdf-format2', $data);
			} else if ($letter_type == 3) {

				 $this->load->view('admin/back_end/offer_letter/pdf-format3', $data);
			} else if ($letter_type == 4) {

				$this->load->view('admin/back_end/offer_letter/pdf-format4', $data);
			}else if ($letter_type == 5) {
				$this->load->view('admin/back_end/offer_letter/pdf-format5', $data);
			}
		}
		else
		{
			echo "Your Offer Letter is Not Generatted, Please Try Again Later";
		}
	}
	function logout()
	{
		$this->session->unset_userdata('employee_login');
		redirect('home/index');
	}
}
