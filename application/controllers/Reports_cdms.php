<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reports_cdms extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Reports_cdms_db','cdms_report');
					$this->load->model('back_end/Client_db','client');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="client";
			$data['clients']=$this->cdms_report->get_all_clients();
			$data['states']=$this->cdms_report->get_all_states();
			$data['location']=$this->cdms_report->get_all_location();
			$this->load->view('admin/back_end/reports_cdms/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}

	public function search_cdms_details()
	{
		$require_data=$this->input->post('data');
		$data=$this->cdms_report->search_cdms_details();
		
		
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
								<th>Contact Person</th>
								<th>Contact Person Mobile</th>
								<th>Contact Person Email</th>
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
						<tr>';
							echo '<td>'.$i.'</td>';
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
													<a href="javascript:void(0)" id='.$row['id'].' onclick="view_client_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
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
								<td>'.$row['contact_person'].'</td>
								<td>'.$row['contact_person_phone'].'</td>
								<td>'.$row['contact_person_email'].'</td>
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="javascript:void(0)" id='.$row['id'].' onclick="view_client_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
											</div>
										</div>
									</div>
								</td>
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
			$require_data=$this->input->post('data');
			$data=$this->cdms_report->search_cdms_details();
			
			$start="B";
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Client Details');
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
				
				$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
				$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Client Name');
				$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Landline');
				$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Client Email');
				$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Contact Person');
				$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Contact Person Phone');
				$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Contact Person Email');
				$this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Registered Address');
				$this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Communication Address');
				$this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'PAN No');
				$this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'TAN No');
				$this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Website Url');
				$this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Mode Agreement');
				$this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Agreement Type');
				$this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Agreement Document');
				$this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Region');
				$this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Contract Start');
				$this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Contract End');
				$this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Rate');
				$this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Commercial Type');
				$this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'Remark');
				$this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'State Name');
				$this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'GSTN No');
				
				$n=2;
				$i=1;
				
				foreach($data as $row)
					{
						$gst_data=$this->client->get_client_gst_download($row['id']);
						$agree_mode="";
						$agree_type="";
						$commercial="";
						if($row['mode_agreement']==1)
						{
							$agree_mode="LOI";
						}
						else if($row['mode_agreement']==2)
						{
							$agree_mode="Agreement";
						}
						if($row['agreement_type']==1)
						{
							$agree_type="One Time Sourcing";
						}
						else if($row['agreement_type']==2)
						{
							$agree_type="Contractual";
						}
						else if($row['agreement_type']==3)
						{
							$agree_type="Other (".$row['other_agreement']." )";
						}
						if($row['commercial_type']==1)
						{
							$commercial="%";
						}
						else if($row['commercial_type']==2)
						{
							$commercial="Rs";
						}
						  $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $row['client_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['land_line']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['client_email']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $row['contact_person']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $row['contact_person_phone']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $row['contact_person_email']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $row['registered_address']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $row['communication_address']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $row['pan']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $row['tan']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, $row['website_url']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $agree_mode);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, $agree_type);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, $row['agreement_doc']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, $row['region']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n, date("d-m-Y",strtotime($row['contract_start'])));
						  $this->excel->setActiveSheetIndex(0)->setCellValue('R'.$n, date("d-m-Y",strtotime($row['contract_end'])));
						  $this->excel->setActiveSheetIndex(0)->setCellValue('S'.$n, $row['rate']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('T'.$n, $commercial);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('U'.$n, $row['remark']);	

							foreach($gst_data as $res)
							{
								 $this->excel->setActiveSheetIndex(0)->setCellValue('W'.$n, $res['state_name']);
								 $this->excel->setActiveSheetIndex(0)->setCellValue('X'.$n, $res['gstn_no']);
								 $n++;
							}
							
						$i++;
						$n++;
						
					}
				
			}
			
			
			$filename=date("d-m-Y").' Client Details.xls';
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
