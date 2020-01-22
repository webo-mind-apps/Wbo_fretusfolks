<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Dcs_report extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Dcs_report_db','dcs_report');
					$this->load->model('back_end/Backend_db','back_end');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="reports";
			$data['clients']=$this->dcs_report->get_all_clients();
			$data['states']=$this->dcs_report->get_all_states();
			$data['location']=$this->dcs_report->get_all_location();
			$this->load->view('admin/back_end/dcs_reports/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}


public function custom_filter_search_details()
	{
		$data=$this->dcs_report->custom_filter_search_details();
		
		
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
								<th>EMP ID</th>
								<th>EMP Name</th>
								<th>Designation</th>
								<th>Phone</th>
								<th style="width:15%">Joining Date</th>
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
													<a href="javascript:void(0)" id='.$row['id'].' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
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
						<td>'.$row['ffi_emp_id'].'</td>
						<td>'.$row['emp_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['phone1'].'</td>
						<td>'.date("d-m-Y",strtotime($row['joining_date'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="javascript:void(0)" id='.$row['id'].' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
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
	
	public function search_dcs_details()
	{
		$require_data=$this->input->post('data');
		$data=$this->dcs_report->search_dcs_details();
		
		
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
								<th>EMP ID</th>
								<th>EMP Name</th>
								<th>Designation</th>
								<th>Phone</th>
								<th style="width:15%">Joining Date</th>
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
													<a href="'.site_url('backend_team/edit_backend/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
													<a href="javascript:void(0)" id='.$row['id'].' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
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
						<td>'.$row['ffi_emp_id'].'</td>
						<td>'.$row['emp_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['phone1'].'</td>
						<td>'.date("d-m-Y",strtotime($row['joining_date'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('backend_team/edit_backend/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
										<a href="javascript:void(0)" id='.$row['id'].' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
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
			$data=$this->dcs_report->search_dcs_details();
			
			$start="B";
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('DCS Details');
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
				  $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'FFI Employee ID');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Client Employee ID');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Employee Name');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Interview Date');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Joining Date');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Contract Date');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Designation');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Department');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'State');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Location');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Date of Birth');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Gender');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Father Name');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Blood Group');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Qualification');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Phone1');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Phone2');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Email');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'Permanent Address');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('V1', 'Present Address');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'PAN No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'PAN Card');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('Y1', 'Aadhar No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('Z1', 'Aadhar Card');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AA1', 'Driving License No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AB1', 'Driving License Card');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AC1', 'Photo');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AD1', 'Resume');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AE1', 'Bank Document');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AF1', 'Bank Name');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AG1', 'Bank Account No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AH1', 'Bank IFSC Code');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AI1', 'UAN No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AJ1', 'Status');
				  
				   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					
					foreach($data as $row)
					{
						$interview_date="";
						$joining_date="";
						$contract_date="";
						$dob="";
						$gender="";
						$status="";
						
						if($row['joining_date']!="0000-00-00")
						{
							$joining_date=date("d-m-Y",strtotime($row['joining_date']));	
						}
						if($row['contract_date']!="0000-00-00")
						{
							$contract_date=date("d-m-Y",strtotime($row['contract_date']));	
						}
						if($row['interview_date']!="0000-00-00")
						{
							$interview_date=date("d-m-Y",strtotime($row['interview_date']));	
						}
						if($row['dob']!="0000-00-00")
						{
							$dob=date("d-m-Y",strtotime($row['dob']));	
						}
						if($row['gender']==1)
						{
							$gender="Male";
						}
						else if($row['gender']==2)
						{
							$gender="Female";
						}
						if($row['data_status']==0)
						{
							$status="Pending";
						}
						else if($row['data_status']==1)
						{
							$status="Completed";
						}
						  $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $row['client_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['ffi_emp_id']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['client_emp_id']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $row['emp_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $interview_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $joining_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $contract_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $row['designation']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $row['department']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $row['state_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, $row['location']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $dob);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, $gender);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, $row['father_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, $row['blood_group']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n, $row['qualification']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('R'.$n, $row['phone1']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('S'.$n, $row['phone2']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('T'.$n, $row['email']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('U'.$n, $row['permanent_address']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('V'.$n, $row['present_address']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('W'.$n, $row['pan_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('X'.$n, base_url().$row['pan_path']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Y'.$n, $row['aadhar_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Z'.$n, base_url().$row['aadhar_path']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AA'.$n, $row['driving_license_no']);	  
						   
						   if($row['driving_license_path']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AB'.$n, base_url().$row['driving_license_path']);	 
						  }
						  if($row['photo']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AC'.$n, base_url().$row['photo']);	 
						  }
						  if($row['resume']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AD'.$n, base_url().$row['resume']);	 
						  }
						  if($row['bank_document']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AE'.$n, base_url().$row['bank_document']);	 
						  }
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AF'.$n, $row['bank_name']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AG'.$n, $row['bank_account_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AH'.$n, $row['bank_ifsc_code']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AI'.$n, $row['uan_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AJ'.$n, $status);	 	  
						$i++;
						$n++;
					}
			}
			$filename=date("d-m-Y").' DCS Report.xls';
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
