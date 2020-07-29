<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reports_payments extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('admin_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Reports_payments_db','payments_reports');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="reports";
			$data['clients']=$this->payments_reports->get_all_clients();
			$data['states']=$this->payments_reports->get_all_states();
			$data['location']=$this->payments_reports->get_all_location();
			$this->load->view('admin/back_end/reports_payments/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function search_payments_details()
	{
		$require_data=$this->input->post('req_data');
		$data=$this->payments_reports->search_payments_details();
		
		
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
						<th>Invoice Amount</th>
						<th style="width:15%">TDS Amount</th>
						<th style="width:10%">Total Amount</th>
						<th style="width:15%">Payment Date</th>
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
					$payment_date="";
					if($row['payment_received_date']!="0000-00-00")
					{
						$payment_date=date("d-m-Y",strtotime($row['payment_received_date']));
					}
					echo '<tr>
						<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['invoice_no'].'</td>
						<td>Rs.'.$row['total_amt_gst'].'</td>
						<td>Rs.'.$row['tds_amount'].'</td>
						<td style="width:10%">Rs.'.$row['amount_received'].'</td>
						<td>'.$payment_date.'</td>
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
			$data=$this->payments_reports->search_payments_details();
			
			$start="B";
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Payment Report');
			
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
					$this->excel->getActiveSheet()->setTitle('Payments Details');
				    $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
					$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Invoice No');
					$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Client Name');
					$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Service Location');
					$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Total without Tax');
					$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Total with Tax');
					
					$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Credit Note');
					$this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Debit Note');
					$this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Invoice Amount');
					
					$this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'TDS Code');
					$this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'TDS Percentage');
					$this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'TDS Amount');
					$this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Amount Received');
					$this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Balance Amount');
					$this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Month');
					$this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Payment Received Date');
			
				  
				   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					
					foreach($data as $row)
					{
						$payment_date="";
						if($row['payment_received_date']!="0000-00-00")
						{
							$payment_date=date("d-m-Y",strtotime($row['payment_received_date']));
						}
						  $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $row['invoice_no']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['client_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['state_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $row['total_amt']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $row['total_amt_gst']);
						  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $row['credit_note']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $row['debit_note']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $row['grand_total']);
						  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $row['code']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $row['tds_percentage']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, $row['tds_amount']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $row['amount_received']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, $row['balance_amount']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, $row['month']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, $payment_date);

						$i++;
						$n++;
					}
			}
			$filename=date("d-m-Y").' Payment Report.xls';
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
