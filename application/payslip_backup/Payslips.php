<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
//error_reporting(0);
class Payslips extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Payslips_db','payslips');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['payslips']=$this->payslips->get_all_payslips();
			$data['client_management']=$this->payslips->get_all_client();
			$this->load->view('admin/back_end/payslips/index',$data);
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
			$this->load->view('admin/back_end/payslips/print_payslip',$data);
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
			$result['payslip']=$this->payslips->upload_payslips();
			if(!empty($data))
			{
				foreach($data as $r)
				{
					$result['result']=$r;
					$result['payslip']=$this->payslips->get_all_payslips_for_email($r['ffi_emp_id']);
					
					$message=$this->load->view('admin/back_end/payslips/payslips_email',$result,true);

					$mpdf = new \Mpdf\Mpdf();
					$html = $this->load->view('admin/back_end/payslips/pdf_payslips',$result,true);
					$mpdf->WriteHTML($html);
					$content = $mpdf->Output('', 'S');
					$filename = date('d/m/Y')."_pay-slips.pdf";

					$subject="welcome";
					$this->load->config('email');
					$this->load->library('email');
					$from = $this->config->item('smtp_user');
					$to=$r['email'];
					$this->email->set_newline("\r\n");
					$this->email->from($from, 'Fretus folks india');
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->attach($content, 'attachment', $filename, 'application/pdf');
					$this->email->send();
					
				}
			}
			
			redirect('payslips/');
		}
		else
		{
			redirect('home/index');
		}
	}
	public function download_payslips()
	{
	
		
		if($this->session->userdata('admin_login'))
		{
			
			if($data=$this->payslips->download_payslips())
			{
				
					$this->load->library('zip');
			
					$path = 'payslip/payslip_'.date('Ymdhis');
					if(!is_dir($path)) mkdir($path, 0777, TRUE);
					
					foreach($data as $row)	
					{
						$mpdf=new \Mpdf\Mpdf();
						$datas['payslip']=$row;
						$html = $this->load->view('admin/back_end/payslips/pdf_payslips',$datas,true);
						// $mpdf->Image('', 0, 0, 210, 297, 'png', '', true, false);
						$mpdf->WriteHTML($html);
						$mpdf->Output($path.'/'.$row['emp_id']."_".$row['emp_name'].".pdf", 'F');
					}
					$this->zip->read_dir($path,false);
					$download = $this->zip->download($path.'.zip');
			}
			else
			{
				$this->session->set_flashdata('error', 'No datas found');
				redirect('payslips/');
			}
					
		}		
		
		else
		{
			redirect('home/index');
		}
			
	}
		
	
	public function delete_payslip()
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
						<td>'.$row['emp_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['client_name'].'</td>
						<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a href="javascript:void(0)" id="'.$row['id'].'" class="dropdown-item" onclick="delete_payslip(this.id);"><i class="fa fa-trash"></i> Delete</a>
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
						<td>'.$row['emp_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['client_name'].'</td>
						<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a href="javascript:void(0)" id="'.$row['id'].'" class="dropdown-item" onclick="delete_payslip(this.id);"><i class="fa fa-trash"></i> Delete</a>
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
	public function doc_format()
	{
		if($this->session->userdata('admin_login'))
		{
		$client=$this->payslips->get_all_clients();
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("downloads/salary_slip.xlsx");
	
		$spreadsheet->setActiveSheetIndex(1);
		$spreadsheet->getActiveSheet()->setTitle('list1');
		$sheet1 = $spreadsheet->getActiveSheet();
		$sheet1->setCellValue('H1', 'CLIENT NAME');
        $sheet1->setCellValue('I1', 'CLIENT ID');
		
		
		
		$sheet1->getStyle("H1:I1")->applyFromArray(array("font" => array("bold" => true)));
		foreach(range('A','H') as $columnID) {
			$sheet1->getColumnDimension($columnID)
				->setAutoSize(true);
		}
		$i = 2;
        foreach ($client as $key => $value) {

			$sheet1->setCellValue('H'.$i, $value['client_name']);
            $sheet1->setCellValue('I'.$i, $value['id']);
            
            $i += 1;
		}  
		

		$spreadsheet->setActiveSheetIndex(0);
		$spreadsheet->getActiveSheet()->setTitle('Salary sheet');
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('BM1', 'CLIENT ID');

		$cellB2 = $sheet->getCell('H2')->getDataValidation();
		$cellB2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
		$cellB2->setAllowBlank(false);
		$cellB2->setShowInputMessage(true);
		$cellB2->setShowErrorMessage(true);
		$cellB2->setShowDropDown(true);
		// $rowCount = $sheet1->getHighestRow();
		$cellB2->setFormula1('list1!$H:$H');
		$sheet->setCellValue('BM2', '=vlookup(H2,list1!H:I,2,false)');

		
        $writer = new Xlsx($spreadsheet);
        $filename = 'PAYSLIPS_DOWNLOAD_FORMAT';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file 
			
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
