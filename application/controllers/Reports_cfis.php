<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Reports_cfis extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('admin_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Reports_cfis_db','cfis_report');
					$this->load->model('back_end/Backend_db','back_end');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="reports";
			$data['clients']=$this->cfis_report->get_all_clients();
			$data['states']=$this->cfis_report->get_all_states();
			$data['location']=$this->cfis_report->get_all_location();
			$this->load->view('admin/back_end/reports_cfis/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function search_cfis_details()
	{
		$require_data=$this->input->post('data');
		$data=$this->cfis_report->search_cfis_details();
		
		
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
								<th>Recruiter</th>
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
						<td>'.$row['username'].'</td>
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
	function download_report()
	{
		if($this->session->userdata('admin_login'))
		{
			$require_data=$this->input->post('data');
			$data=$this->cfis_report->search_cfis_details();
			
			$start="B";
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('CFIS Details');
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
					$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Employee Name');
					$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Phone No');
					$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Email');
					$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Interview Date');
					$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Joining Date');
					$this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'State');
					$this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Location');
					$this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Status');
					$this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Aadhar No');
					$this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Aadhar Card');
					$this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Driving License No');
					$this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Driving License Card');
					$this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Photo');
					$this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Resume');
					$this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Recruiter');
				  
				   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					
					foreach($data as $row)
					{
						$joining_date="";
						$interview_date="";
						$dob="";
						$gender="";
						$status="";
						
						if($row['joining_date']!="0000-00-00")
						{
							$joining_date=date("d-m-Y",strtotime($row['joining_date']));	
						}
						if($row['interview_date']!="0000-00-00")
						{
							$interview_date=date("d-m-Y",strtotime($row['interview_date']));	
						}
						if($row['dob']!="0000-00-00")
						{
							$dob=date("d-m-Y",strtotime($row['dob']));	
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
						  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['emp_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['phone1']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $row['email']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $interview_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $interview_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $row['state_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $row['location']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $status);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $row['aadhar_no']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, base_url().$row['aadhar_path']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $row['driving_license_no']);
						  if($row['driving_license_path']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, base_url().$row['driving_license_path']);
						  }
						  if($row['photo']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, base_url().$row['photo']);
						  }
						  if($row['resume']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, base_url().$row['resume']);
						  }
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n,$row['username']);
						$i++;
						$n++;
					}
			}
			$filename=date("d-m-Y").' CFIS Report.xls';
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
