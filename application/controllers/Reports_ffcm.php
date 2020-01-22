<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reports_ffcm extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Reports_ffcm_db','ffcm_reports');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="reports";
			$this->load->view('admin/back_end/reports_ffcm/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function search_ffcm_details()
	{
		$require_data=$this->input->post('req_data');
		$data=$this->ffcm_reports->search_ffcm_details();
		
		
		echo '<thead><tr>';
			if(!empty($require_data))
			{
				echo '<th>Si No</th>';
				foreach($require_data as $res)
				{
					echo '<th>'.ucwords(str_replace("_"," ",$res)).'</th>';
				}
				
			}
			else
			{
				echo '<tr>
						<th>Si No</th>
						<th>Date</th>
						<th>Month</th>
						<th>Nature of Expenses</th>
						<th style="width:15%">Amount</th>
					</tr>';
			}
		echo '</tr></thead><tbody>';
		if($data)
		{
			$i=1;
			foreach($data as $row)
			{
				if(!empty($require_data))
				{
					echo '
						<tr><td>'.$i.'</td>';
							foreach($require_data as $res)
								{
									echo '<td>'.$row[$res].'</td>';
								}
					echo '</tr>';
					$i++;
				}
				else
				{
					$expenses_date="";
					if($row['date']!="0000-00-00")
					{
						$expenses_date=date("d-m-Y",strtotime($row['date']));
					}
					echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$expenses_date.'</td>
						<td>'.$row['month'].'</td>
						<td>'.$row['nature_expenses'].'</td>
						<td>Rs.'.$row['amount'].'</td>
					</tr>';
					$i++;
				}
			}
		}
		echo '</tbody>';	
	}
	function download_report()
	{
		if($this->session->userdata('admin_login'))
		{
			$require_data=$this->input->post('req_data');
			$data=$this->ffcm_reports->search_ffcm_details();
			
			$start="B";
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('FFCM Report');
			
			$this->excel->getActiveSheet()->getStyle("A1:AA1")->applyFromArray(array("font" => array("bold" => true)));
			if(!empty($require_data))
			{
				$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
				foreach($require_data as $res)
				{
					
					$this->excel->getActiveSheet()->getColumnDimension($start)->setAutoSize(true);
					$this->excel->setActiveSheetIndex(0)->setCellValue($start."1", ucwords(str_replace("_"," ",$res)));
					$start++;
				}
				$n=2;
				$i=1;
				foreach($data as $row)
				{
					$start="B";
					$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
					foreach($require_data as $res)
					{
						 $this->excel->setActiveSheetIndex(0)->setCellValue($start.$n, $row[$res]);
						$start++;
					}
					$n++;
					$i++;
				}
			}
			else
			{
					$this->excel->getActiveSheet()->setTitle('Expenses Details');
					$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
					$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
					$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
					$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
					$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
					
					$this->excel->getActiveSheet()->getStyle("A1:E1")->applyFromArray(array("font" => array("bold" => true)));
					$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
					$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Date');
					$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Month');
					$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Nature Of Expenses');
					$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Amount');
			
				  
				   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					
					foreach($data as $row)
					{
						$exp_date="";
						if($row['date']!="0000-00-00")
						{
							$exp_date=date("d-m-Y",strtotime($row['date']));
						}
						$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
						$this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $exp_date);
						$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['month']);
						$this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['nature_expenses']);
						$this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $row['amount']);
						$i++;
						$n++;
					}
			}
			$filename=date("d-m-Y").' Expenses Report.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$objWriter->save('php://output');
		}
		else
		{
			redirect('home/');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
