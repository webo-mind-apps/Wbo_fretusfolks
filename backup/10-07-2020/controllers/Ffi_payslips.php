<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Ffi_payslips extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Ffi_payslips_db','payslips');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['payslips']=$this->payslips->get_all_payslips();
			$this->load->view('admin/back_end/ffi_payslips/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function print_payslip()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['payslip']=$this->payslips->get_payslip_details();
			$this->load->view('admin/back_end/ffi_payslips/print_payslip',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function upload_payslips()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->payslips->upload_payslips();
			redirect('ffi_payslips/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_payslip()
	{
		$data1=$this->payslips->delete_payslip();
		$data=$this->payslips->search_payslip();
		$i=1;
			foreach($data as $row)
			{
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['emp_id'].'</td>
						<td>'.$row['employee_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['mobile'].'</td>
						<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('ffi_payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_payslip(this.id);" class="dropdown-item" target=""><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
				$i++;
			}
	}
	public function search_payslip()
	{
		$data=$this->payslips->search_payslip();
		if($data)
		{
			$i=1;
			foreach($data as $row)
			{
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['emp_id'].'</td>
						<td>'.$row['employee_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['department'].'</td>
						<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('ffi_payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_payslip(this.id);" class="dropdown-item" target=""><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
				$i++;
			}
		}
		else
		{
			
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
