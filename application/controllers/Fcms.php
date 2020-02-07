<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Fcms extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Fcms_db','fcms');
					$this->load->library("pagination");
        }
	public function index()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1))
		{
			$data['active_menu']="fcms";
			$data['invoice']=$this->fcms->get_all_invoice();
			$this->load->view('admin/back_end/invoice/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function new_invoice()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1))
		{
			$data['active_menu']="fcms";
			$data['clients']=$this->fcms->get_all_clients();
			$this->load->view('admin/back_end/invoice/new_invoice',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function edit_invoice()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1))
		{
			$data['active_menu']="fcms";
			$data['clients']=$this->fcms->get_all_clients();
			$data['invoice']=$this->fcms->get_invoice_details();
			
			$client=$data['invoice'][0]['client_id'];
			
			$data['client_location']=$this->fcms->client_location($client);
			$this->load->view('admin/back_end/invoice/edit_invoice',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function save_invoice()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1))
		{
			$data=$this->fcms->save_invoice();
			redirect('fcms/');
		}
		else
		{
			redirect('home/index');
		}
	}
	public function update_invoice()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1))
		{
			$data=$this->fcms->update_invoice();
			redirect('fcms/');
		}
		else
		{
			redirect('home/index');
		}
	}
	public function download_invoice()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1))
		{
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			
			$this->excel->getActiveSheet()->setTitle('Invoice Details');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
			
			$this->excel->getActiveSheet()->getStyle("A1:T1")->applyFromArray(array("font" => array("bold" => true)));
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
			  
			  $data=$this->fcms->get_all_invoice();
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
			/**************************************************************************************************************************/
					$filename=date("d-m-Y").' Invoice Details.xls';
					header('Content-Type: application/vnd.ms-excel');
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					header('Cache-Control: max-age=0');
					$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
					$objWriter->save('php://output');
		}
		else
		{
			redirect('home/index');
		}
	}
	function view_invoice_details()
	{
		$id=$this->input->post('id');
		$data=$this->fcms->get_invoice_details_popup($id);
		
			echo '
					<div class="modal-header bg-primary">
						<h6 class="modal-title">'.ucwords($data[0]['client_name']).'</h6>
						
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Invoice No :</b> <span>'.ucwords($data[0]['invoice_no']).'</span></p>
								<p><b>GST No:</b> <span>'.ucwords($data[0]['gst_no']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>'.ucwords($data[0]['client_name']).'</span></p>
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Location :</b> <span>'.ucwords($data[0]['state_name']).'</span></p>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Gross Value :</b> Rs. <span>'.$data[0]['gross_value'].'</span></p>
								<p><b>CGST (%) :</b> <span>'.$data[0]['cgst'].'</span></p>
								<p><b>CGST Amount :</b> Rs. <span>'.ucwords($data[0]['cgst_amount']).'</span></p>								
								<p><b>Total Tax :</b> Rs. <span>'.ucwords($data[0]['tax_amount']).'</span></p>';
								if($data[0]['file_path']!="")
								{
									echo '<p><span><a href="'.base_url().$data[0]['file_path'].'" target="_blank"> <i class="fa fa-file"></i> Invoice Document</a></span></p>';
								}
						echo '
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Service Fees :</b> Rs. <span>'.$data[0]['service_value'].'</span></p>
								<p><b>SGST (%) :</b> <span>'.$data[0]['sgst'].'</span></p>
								<p><b>SGST Amount :</b> Rs. <span>'.ucwords($data[0]['sgst_amount']).'</span></p>
								<p><b>Total Amount :</b> Rs. <span>'.ucwords($data[0]['total_value']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Sourcing Fees :</b> Rs. <span>'.$data[0]['source_value'].'</span></p>
								<p><b>IGST (%) :</b> <span>'.$data[0]['igst'].'</span></p>
								<p><b>IGST Amount :</b> Rs. <span>'.ucwords($data[0]['igst_amount']).'</span></p>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Credit Note : Rs. <span>'.ucwords($data[0]['credit_note']).'</span></b></p>
								<p><b>Balance Amount : Rs. <span>'.ucwords($data[0]['balance_amount']).'</span></b></p>
								<p><b>Invoice Generated  On :</b><span>'.date("d-m-Y",strtotime($data[0]['date'])).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Debit Note : Rs. <span>'.ucwords($data[0]['debit_note']).'</span></b></p>
								<p><b>TDS Amount : Rs. <span>'.ucwords($data[0]['tds_amount']).'</span></b></p>
								<p><b>For the month :</b><span>'.$data[0]['inv_month'].'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Grand Total : Rs. <span>'.ucwords($data[0]['grand_total']).'</span></b></p>
								<p><b>Amount Received : Rs. <span>'.ucwords($data[0]['amount_received']).'</span></b></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>
					</div>';
	}
	function get_client_location()
	{
		$data=$this->fcms->get_client_location();
		echo '<option value="">Select Location</option>';
		foreach($data as $res)
		{
			echo '<option value="'.$res['state'].'">'.$res['state_name'].'</option>';
		}
	}
	function get_client_gst()
	{
		$data=$this->fcms->get_client_gst();
		echo $data;
	}
	function delete_invoice()
	{
		$data1=$this->fcms->delete_invoice();
		$data=$this->fcms->get_all_invoice();
		$i=1;
		foreach($data as $row)
		{
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.$row['client_name'].'</td>
												<td>'.$row['invoice_no'].'</td>
												<td>'.$row['state_name'].'</td>
												<td>'.$row['gst_no'].'</td>
												<td style="width:15%">Rs. '.$row['grand_total'].'</td>
												<td>'.date("d-m-Y",strtotime($row['date'])).'</td>
												<td class="text-center">
													<div class="list-icons">
														<div class="dropdown">
															<a href="#" class="list-icons-item" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="javascript:void(0);" class="dropdown-item" id="'.$row['id'].'" onclick="view_invoice_details(this.id)"><i class="fa fa-eye"></i> View Details</a>
																<a href="'.site_url('fcms/edit_invoice/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>';
															if($this->session->userdata('admin_type')==0)
															{
																echo '<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_invoice(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
															}
												echo '		</div>
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
