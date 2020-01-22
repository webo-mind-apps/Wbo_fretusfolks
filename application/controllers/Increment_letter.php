<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Increment_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Increment_letter_db','increment');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['offer_letter']=$this->increment->get_all_increment_letters();
			$this->load->view('admin/back_end/increment_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_increment()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['letter_content']=$this->increment->get_letter_content();
			$data['states']=$this->increment->get_all_states();
			$data['clients']=$this->increment->get_all_clients();
			$this->load->view('admin/back_end/increment_letter/new_offer_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function get_employee_detail()
	{
		$data=$this->increment->get_employee_detail();
		$joining_date="";
		$contract_date="";
		if($data)
		{
			if($data[0]['joining_date']!="0000-00-00")
			{
				$joining_date=date("d-m-Y",strtotime($data[0]['joining_date']));
			}
			if($data[0]['contract_date']!="0000-00-00")
			{
				$contract_date=date("d-m-Y",strtotime($data[0]['contract_date']));
			}
			if($data[0]['data_status']==1)
			{
				echo $data[0]['client_id']."****".$data[0]['emp_name']."****".$joining_date."****".$contract_date."****".$data[0]['designation']."****".$data[0]['location']."****".$data[0]['department']."****".$data[0]['basic_salary']."****".$data[0]['hra']."****".$data[0]['conveyance']."****".$data[0]['medical_reimbursement']."****".$data[0]['special_allowance']."****".$data[0]['other_allowance']."****".$data[0]['st_bonus']."****".$data[0]['gross_salary']."****".$data[0]['emp_pf']."****".$data[0]['emp_esic']."****".$data[0]['pt']."****".$data[0]['total_deduction']."****".$data[0]['take_home']."****".$data[0]['employer_pf']."****".$data[0]['employer_esic']."****".$data[0]['mediclaim']."****".$data[0]['ctc'];
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "failed";
		}
		
	}
	
	function save_increment_letter()
	{
		$data=$this->increment->save_increment_letter();
		redirect('increment_letter/');
	}
	function view_increment_letter()
	{
		$data['letter_details']=$this->increment->get_increment_letter_details();
		
		$this->load->view('admin/back_end/increment_letter/print_letter',$data);	
	}
	function delete_increment_letter()
	{
		$data1=$this->increment->delete_increment_letter();
		$data=$this->increment->get_all_increment_letters();
		
		$i=1;
		foreach($data as $row)
		{
			$status="";
			echo '
			<tr>
				<td>'.$i.'</td>
				<td>'.$row['employee_id'].'</td>
				<td>'.$row['client_name'].'</td>
				<td>'.$row['emp_name'].'</td>
				<td style="width:15%">'.date("d-m-Y",strtotime($row['date'])).'</td>
				<td>'.$row['phone1'].'</td>
				<td>'.$row['email'].'</td>
				<td class="text-center">
					<div class="list-icons">
						<div class="dropdown">
							<a href="#" class="list-icons-item" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="'.site_url('offer_letter/view_offer_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
								<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_increment_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
							</div>
						</div>
					</div>
				</td>
			</tr>';
			$i++;
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
