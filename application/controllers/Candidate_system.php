<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Candidate_system extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Candidate_db','candidate');
					$this->load->library("pagination");
        }
	public function index()
	{
 
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['candidate_info']=$this->candidate->get_all_candidate_info();
			$this->load->view('admin/back_end/candidate_info/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_candidate()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['states']=$this->candidate->get_all_states();
			$data['clients']=$this->candidate->get_all_clients();
			$this->load->view('admin/back_end/candidate_info/new_candidate',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_candidate()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$id=$this->uri->segment(3);
			$data['candidate']=$this->candidate->get_candidate_details($id);
			$data['states']=$this->candidate->get_all_states();
			$data['all_clients']=$this->candidate->get_all_clients();
			$this->load->view('admin/back_end/candidate_info/edit_candidate',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_candidate()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->candidate->save_candidate();
			redirect('candidate_system/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_candidate()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->candidate->update_candidate();
			redirect('candidate_system/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function view_candidate_details()
	{
		$id=$this->input->post('id');
		$data=$this->candidate->get_candidate_details($id);
		
		$joining_date="";
		$interview_date="";
		$dob="";
		$created_at="";
		$gender="";
		
		if($data[0]['joining_date']!="0000-00-00")
		{
			$joining_date=date("d-m-Y",strtotime($data[0]['joining_date']));	
		}
		if($data[0]['interview_date']!="0000-00-00")
		{
			$interview_date=date("d-m-Y",strtotime($data[0]['interview_date']));	
		}
		if($data[0]['dob']!="0000-00-00")
		{
			$dob=date("d-m-Y",strtotime($data[0]['dob']));	
		}
		if($data[0]['created_at']!="0000-00-00")
		{
			$created_at=date("d-m-Y",strtotime($data[0]['created_at']));
		}
		if($data[0]['gender']==1)
		{
			$gender="Male";
		}
		else if($data[0]['gender']==2)
		{
			$gender="Female";
		}
		echo '
					<div class="modal-header bg-primary">
						<h6 class="modal-title">'.ucwords($data[0]['emp_name']).'</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Employee Name :</b> <span>'.ucwords($data[0]['emp_name']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>'.ucwords($data[0]['client_name']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone:</b> <span>'.ucwords($data[0]['phone1']).'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>'.$data[0]['email'].'</span></p>
								<p><b>State:</b> <span>'.ucwords($data[0]['state_name']).'</span></p>								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Interview Date :</b> <span>'.$interview_date.'</span></p>
								<p><b>Location:</b> <span>'.ucwords($data[0]['location']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Joining Date :</b> <span>'.$joining_date.'</span></p>
								<p><b>Designation :</b> <span>'.ucwords($data[0]['designation']).'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Department :</b> <span>'.ucwords($data[0]['department']).'</span></p>
								<p><b>Aadhar No:</b> <span>'.$data[0]['aadhar_no'].'</span></p>
								<p><b><a href="'.base_url().$data[0]['aadhar_path'].'" target="_blank"><i class="fa fa-book"></i> Aadhar Card</a></b></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No:</b> <span>'.$data[0]['driving_license_no'].'</span></p>
								<p><b><a href="'.base_url().$data[0]['driving_license_path'].'" target="_blank"><i class="fa fa-book"></i> Driving License</a></b></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b><a href="'.base_url().$data[0]['photo'].'" target="_blank"><i class="fa fa-book"></i> Photo</a></b></p>
								<p><b><a href="'.base_url().$data[0]['resume'].'" target="_blank"><i class="fa fa-book"></i> Resume</a></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Uploaded By :</b> <span>'.ucwords($data[0]['username']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Date of Upload:</b> <span>'.$created_at.'</span></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>
					</div>';
	}
	function download_candidate_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			
			$this->excel->getActiveSheet()->setTitle('Candidate Details');
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
			
			$this->excel->getActiveSheet()->getStyle("A1:P1")->applyFromArray(array("font" => array("bold" => true)));
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
			  $this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Department');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Designation');
			   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					$data=$this->candidate->get_all_candidate_info();	
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
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n, $row['department']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('R'.$n, $row['designation']);
						$i++;
						$n++;
					}
				   /**************************************************************************************************************************/ 
						$filename=date("d-m-Y").' Candidate Details.xls';
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
	function delete_candidate()
	{
		$data1=$this->candidate->delete_candidate();
		$data=$this->candidate->get_all_candidate_info();
		$i=1;
		foreach($data as $row)
		{
			$status="";
			$approval="";
			if($row['data_status']==1)
			{
				$status='<span class="badge bg-blue">Completed</span>';
			}
			else if($row['data_status']==0)
			{
				$status='<span class="badge bg-danger">Pending</span>';
			}
			if($row['dcs_approval']==1)
			{
				$approval='<span class="badge bg-blue">Approved</span>';
			}
			else if($row['dcs_approval']==2)
			{
				$approval='<span class="badge bg-danger">Disapproved</span>';
			}
			echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['emp_name'].'</td>
						<td style="width:15%">'.date("d-m-Y",strtotime($row['joining_date'])).'</td>
						<td>'.$row['phone1'].'</td>
						<td>'.$approval.'</td>
						<td>'.$status.'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="javascript:void(0)" id='.$row['id'].' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
										<a href="'.site_url('candidate_system/edit_candidate/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_candidate(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
									</div>
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
