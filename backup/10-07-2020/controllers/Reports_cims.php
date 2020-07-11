<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reports_cims extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Reports_cims_db','cims_reports');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="reports";
			$data['clients']=$this->cims_reports->get_all_clients();
			$data['states']=$this->cims_reports->get_all_states();
			$data['location']=$this->cims_reports->get_all_location();
			$this->load->view('admin/back_end/reports_cims/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function search_cims_details()
	{
		$require_data=$this->input->post('req_data');
		$data=$this->cims_reports->search_cims_details();
		
		
		echo '<thead><tr>';
			if(!empty($require_data))
			{
				echo '<th>Si No</th>';
				foreach($require_data as $res)
				{
					echo '<th>'.ucwords(str_replace("_"," ",$res)).'</th>';
				}
				echo '<th class="text-center">Actions</th>';
			}
			else
			{
				echo '<tr>
						<th>Si No</th>
						<th>Client Name</th>
						<th>Invoice No</th>
						<th>Service Location</th>
						<th>GST No</th>
						<th style="width:15%">Grand Total</th>
						<th style="width:15%">Invoice Date</th>
						<th class="text-center">Actions</th>	
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
							echo '
									<td class="text-center">
										<div class="list-icons">
											<div class="dropdown">
												<a href="#" class="list-icons-item" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="javascript:void(0)" id='.$row['id'].' onclick="view_invoice_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
												</div>
											</div>
										</div>
									</td>
							';	
								
					echo '</tr>';
					$i++;
				}
				else
				{
					echo '<tr>
							<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['invoice_no'].'</td>
						<td>'.$row['state_name'].'</td>
						<td>'.$row['gst_no'].'</td>
						<td>Rs. '.$row['grand_total'].'</td>
						<td>'.date("d-m-Y",strtotime($row['date'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="javascript:void(0)" id='.$row['id'].' onclick="view_invoice_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
					';
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
			$require_data=$this->input->post('data');
			$data=$this->cims_reports->search_cims_details();
			
			$start="B";
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('CIMS Details');
			
			$this->excel->getActiveSheet()->getStyle("A1:S1")->applyFromArray(array("font" => array("bold" => true)));
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
				  $this->excel->getActiveSheet()->setTitle('CIMS Details');
				  
				      $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Invoice No');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Client Name');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Service Location');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'GST No');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Gross Value');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Service Value');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Source Value');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Total');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'CGST (%)');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'CGST Amount');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'SGST (%)');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'SGST Amount');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'IGST (%)');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'IGST Amount');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Total Tax');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Total Invoice Amount');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Credit Note');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Debit Note');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Grand Total');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'Total Employee');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('V1', 'Invoice Generatted On');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'Invoice For The Month');
					  $this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'Invoice Path');
			  
				  
				   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					
					foreach($data as $row)
					{
						$gross_value=$row['gross_value'];
						$service_fees=$row['service_value'];
						$source_fees=$row['source_value'];
						
						$cgst=$row['cgst'];
						$sgst=$row['sgst'];
						$igst=$row['igst'];
						$date=$row['date'];
						
						$total=$gross_value+$service_fees+$source_fees;
						$cgst_amt=($total*$cgst)/100;
						$sgst_amt=($total*$sgst)/100;
						$igst_amt=($total*$igst)/100;
						
						$tax=$cgst_amt+$sgst_amt+$igst_amt;
						$grand_total=$total+$tax;
						
						$db_date=date("d-m-Y",strtotime($date));
						
					  $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $row['invoice_no']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['client_name']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['state_name']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $row['gst_no']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $row['gross_value']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $row['service_value']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $row['source_value']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $total);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $row['cgst']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $row['cgst_amount']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, $row['sgst']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $row['sgst_amount']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, $row['igst']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, $row['igst_amount']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, $row['tax_amount']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n, $row['total_value']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('R'.$n, $row['credit_note']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('S'.$n, $row['debit_note']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('T'.$n, $row['grand_total']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('U'.$n, $row['total_employee']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('V'.$n, $db_date);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('W'.$n, $row['inv_month']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('X'.$n, base_url().$row['file_path']);
					  
						$i++;
						$n++;
					}
			}
			$filename=date("d-m-Y").' CIMS Report.xls';
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
