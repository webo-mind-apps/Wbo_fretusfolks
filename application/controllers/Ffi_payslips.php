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
	public function download_ffi_payslips()
	{
		if ($this->session->userdata('admin_login')) {

			if ($row_count = $this->payslips->download_ffi_payslips()) {

				$this->load->library('zip');

				$path = 'ffi_payslip/ffi_payslip_'. date('Y-m-d-his');
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$row_count=$row_count/1000;
				$row_count=round($row_count);
				for($i=0;$i<=$row_count;$i++)
				{
					$a=$i*1000;
					if($data= $this->payslips->download_ffi_payslips_partial(1000,$a))
					{
						// echo "<pre>";
						// print_r($data);
						// exit;
						foreach ($data as $row)
						{
							
							$mpdf = new \Mpdf\Mpdf();
							$datas['payslip'][0] = $row;
							$html = $this->load->view('admin/back_end/ffi_payslips/print_payslip', $datas, true);
							// $mpdf->Image('', 0, 0, 210, 297, 'png', '', true, false);
							$mpdf->AddPage(
								'', // L - landscape, P - portrait 
								'',
								'',
								'',
								'',
								5, // margin_left
								5, // margin right
								30, // margin top
								30, // margin bottom
								0, // margin header
								0
							); // margin footer 
							$mpdf->WriteHTML($html);
							
							$mpdf->Output($path . '/' . $row['emp_id'] . "_" . $row['employee_name'] . ".pdf", 'F');
						}
					}
				}

				$this->zip->read_dir($path, false);
				$download = $this->zip->download($path . '.zip');
				
			} else {

				$this->session->set_flashdata('error', 'No datas found');
				redirect('ffi_payslips/');
			}
		} else {
			redirect('home/index');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
