<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Fhrms extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Fhrms_db','fhrms');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			//$data['backend_team']=$this->fhrms->get_all_ffi_employee();
			$this->load->view('admin/back_end/fhrms/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	
	public function todays_dob()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['backend_team']=$this->fhrms->todays_dob();
			$this->load->view('admin/back_end/fhrms/todays_birthday',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	
	
	
	function new_employee()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['states']=$this->fhrms->get_all_states();
			$data['clients']=$this->fhrms->get_all_clients();
			$this->load->view('admin/back_end/fhrms/new_employee',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_fhrms()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$id=$this->uri->segment(3);
			$data['client']=$this->fhrms->get_employee_details($id);
			$data['states']=$this->fhrms->get_all_states();
			$data['edu_certificate']=$this->fhrms->get_edu_certificate($id);
			$data['other_certificate']=$this->fhrms->get_other_certificate($id);
			$this->load->view('admin/back_end/fhrms/edit_employee',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_employee()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->fhrms->save_employee();
			redirect('fhrms/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_emp_pending()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->fhrms->save_emp_pending();
			redirect('fhrms/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_employee()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->fhrms->update_employee();
			redirect('fhrms/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_employee_pending()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->fhrms->update_employee_pending();
			redirect('fhrms/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function ffi_offer_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['offer_letter']=$this->fhrms->get_all_offer_letter();
			$this->load->view('admin/back_end/ffi_offer_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_offer_letter()
	{
		$data['active_menu']="fhrms";
		$data['states']=$this->fhrms->get_all_states();
		$data['clients']=$this->fhrms->get_all_clients();
		$this->load->view('admin/back_end/ffi_offer_letter/new_offer_letter',$data);
	}
	function get_emp_details()
	{
		$data=$this->fhrms->get_emp_details();
		$joining_date="";
		$contract_date="";
		if($data)
		{
			if($data[0]['joining_date']!="0000-00-00")
			{
				$joining_date=date("d-m-Y",strtotime($data[0]['joining_date']));
			}
			if($data[0]['contract_date']!="0000-00-00")
			{
				$contract_date=date("d-m-Y",strtotime($data[0]['contract_date']));
			}
			if($data[0]['data_status']==1)
			{
				echo $data[0]['emp_name']."****".$joining_date."****".$contract_date."****".$data[0]['designation']."****".$data[0]['location']."****".$data[0]['department']."****".$data[0]['basic_salary']."****".$data[0]['hra']."****".$data[0]['conveyance']."****".$data[0]['medical_reimbursement']."****".$data[0]['special_allowance']."****".$data[0]['other_allowance']."****".$data[0]['st_bonus']."****".$data[0]['gross_salary']."****".$data[0]['pf_percentage']."****".$data[0]['emp_pf']."****".$data[0]['esic_percentage']."****".$data[0]['emp_esic']."****".$data[0]['pt']."****".$data[0]['total_deduction']."****".$data[0]['employer_pf_percentage']."****".$data[0]['employer_pf']."****".$data[0]['employer_esic_percentage']."****".$data[0]['employer_esic']."****".$data[0]['mediclaim']."****".$data[0]['ctc'];
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "failed";
		}
	}
	function view_offer_letter()
	{
		$data['letter_details']=$this->fhrms->get_offer_letter();
		$this->load->view('admin/back_end/ffi_offer_letter/format1',$data);
		
		//$letter_type=$data['letter_details'][0]['offer_letter_type'];
		/*if($letter_type==1)
		{
			$this->load->view('admin/back_end/ffi_offer_letter/format1',$data);
		}
		if($letter_type==2)
		{
			$this->load->view('admin/back_end/offer_letter/format2',$data);
		}
		if($letter_type==3)
		{
			$this->load->view('admin/back_end/offer_letter/format3',$data);
		}*/
	}
	function delete_ffi_offer_letter()
	{
		$data1=$this->fhrms->delete_offer_letter();
		$data=$this->fhrms->get_all_offer_letter();
		
			$i=1;
			foreach($data as $row)
			{
				$status="";
				
				echo '
						<tr>
							<td>'.$i.'</td>
							<td>'.$row['emp_name'].'</td>
							<td style="width:15%">'.date("d-m-Y",strtotime($row['date'])).'</td>
							<td>'.$row['phone1'].'</td>
							<td>'.$row['email'].'</td>
							<td class="text-center">
								<div class="list-icons">
									<div class="dropdown">
										<a href="#" class="list-icons-item" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="'.site_url('fhrms/view_offer_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
											<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_offer_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
										</div>
									</div>
								</div>
							</td>
						</tr>';
				$i++;
			}
	}
	function save_offer_letter()
	{
		$letter_type=$this->input->post('letter_format');
		
		$data['letter_details']=$this->fhrms->save_offer_letter();
		if($letter_type==1)
		{
			$this->load->view('admin/back_end/ffi_offer_letter/format1',$data);
		}
		if($letter_type==2)
		{
			$this->load->view('admin/back_end/ffi_offer_letter/format2',$data);
		}
		if($letter_type==3)
		{
			$this->load->view('admin/back_end/ffi_offer_letter/format3',$data);
		}
	}
	function view_employee_details()
	{
		$id=$this->input->post('id');
		$data=$this->fhrms->get_employee_details($id);
		$data1=$this->fhrms->get_edu_certificate($id);
		$data2=$this->fhrms->get_other_certificate($id);
		
		$joining_date="";
		$contract_date="";
		$dob="";
		$gender="";
		
		if($data[0]['joining_date']!="0000-00-00")
		{
			$joining_date=date("d-m-Y",strtotime($data[0]['joining_date']));	
		}
		if($data[0]['contract_date']!="0000-00-00")
		{
			$contract_date=date("d-m-Y",strtotime($data[0]['contract_date']));	
		}
		if($data[0]['dob']!="0000-00-00")
		{
			$dob=date("d-m-Y",strtotime($data[0]['dob']));	
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
								<p><b>FFI EMP ID :</b> <span>'.ucwords($data[0]['ffi_emp_id']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Designation :</b> <span>'.ucwords($data[0]['designation']).'</span></p>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Department:</b> <span>'.ucwords($data[0]['department']).'</span></p>
								<p><b>Date of Birth :</b> <span>'.$dob.'</span></p>		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Joining Date :</b> <span>'.$joining_date.'</span></p>
								
								<p><b>Qualification :</b> <span>'.ucwords($data[0]['qualification']).'</span></p>		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Contract Date :</b> <span>'.$contract_date.'</span></p>		
								<p><b>Gender :</b> <span>'.$gender.'</span></p>		
									
																	
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>'.ucwords($data[0]['email']).'</span></p>								
								<p><b>Father Name :</b> <span>'.ucwords($data[0]['father_name']).'</span></p>							
								<p><b>Permanent Address:</b> <span>'.ucwords($data[0]['permanent_address']).'</span></p>
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 1:</b> <span>'.ucwords($data[0]['phone1']).'</span></p>
								<p><b>State:</b> <span>'.ucwords($data[0]['state_name']).'</span></p>
								<p><b>Present Address :</b> <span>'.ucwords($data[0]['present_address']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 2 :</b> <span>'.ucwords($data[0]['phone2']).'</span></p>
								<p><b>Location:</b> <span>'.ucwords($data[0]['location']).'</span></p>
								
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Bank Name :</b> <span>'.ucwords($data[0]['bank_name']).'</span></p>
								<p><b>UAN Generatted :</b> <span>'.ucwords($data[0]['uan_generatted']).'</span></p>
								<p><b>UAN No :</b> <span>'.ucwords($data[0]['uan_no']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Aadhar No :</b> <span>'.ucwords($data[0]['aadhar_no']).'</span></p>
								<p><b>Bank Account No :</b> <span>'.$data[0]['bank_account_no'].'</span></p>
								<p><b>UAN Type :</b> <span>'.ucwords($data[0]['uan_type']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No :</b> <span>'.ucwords($data[0]['driving_license_no']).'</span></p>								
								<p><b>Bank IFSC Code :</b> <span>'.$data[0]['bank_ifsc_code'].'</span></p>
							</div>
						</div>
						<hr>
						
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Aadhar No:</b> <span>'.$data[0]['aadhar_no'].'</span></p>';
								if($data[0]['aadhar_path']!="")
								{
									echo '<p><b><a href="'.base_url().$data[0]['aadhar_path'].'" target="_blank"><i class="fa fa-book"></i> Aadhar Card</a></b></p>';
								}
								if($data[0]['photo']!="")
								{
									echo '<p><b><a href="'.base_url().$data[0]['photo'].'" target="_blank"><i class="fa fa-book"></i> Photo</a></b></p>';
								}
						echo '		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No:</b> <span>'.$data[0]['driving_license_no'].'</span></p>';
								if($data[0]['driving_license_path']!="")
								{
									echo '<p><b><a href="'.base_url().$data[0]['driving_license_path'].'" target="_blank"><i class="fa fa-book"></i> Driving License</a></b></p>';
								}
								if($data[0]['resume']!="")
								{
									echo '<p><b><a href="'.base_url().$data[0]['resume'].'" target="_blank"><i class="fa fa-book"></i> Resume</a></b></p>';
								}
					echo '	</div>
							<div class="col-md-4 col-sm-6">
								<p><b>PAN No :</b> <span>'.ucwords($data[0]['pan_no']).'</span></p>';
								if($data[0]['pan_path']!="")
								{
									echo '<p><b><a href="'.base_url().$data[0]['pan_path'].'" target="_blank"><i class="fa fa-book"></i> Pan Card</a></b></p>';
								}
								if($data[0]['bank_document']!="")
								{
									echo '<p><b><a href="'.base_url().$data[0]['bank_document'].'" target="_blank"><i class="fa fa-book"></i> Bank Document</a></b></p>';
								}
					echo '	</div>
						</div>
						
						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<p><b>Basic Salary :</b> Rs.<span>'.ucwords($data[0]['basic_salary']).'</span></p>
								<p><b>Special Allowance :</b> Rs.<span>'.ucwords($data[0]['special_allowance']).'</span></p>
								<p><b>Employee PF ('.$data[0]['pf_percentage'].'%) :</b> Rs.<span>'.ucwords($data[0]['emp_pf']).'</span></p>
								<p><b>Employer PF ('.$data[0]['employer_pf_percentage'].'%) :</b> Rs.<span>'.ucwords($data[0]['employer_pf']).'</span></p>
								
								<p><b>CTC : Rs.<span>'.ucwords($data[0]['ctc']).' </b></span></p>
								
							</div>
							<div class="col-md-3 col-sm-6">
								<p><b>HRA :</b> Rs.<span>'.ucwords($data[0]['hra']).'</span></p>
								<p><b>ST Bonus :</b> Rs.<span>'.ucwords($data[0]['st_bonus']).'</span></p>
								<p><b>Employee ESIC  ('.$data[0]['esic_percentage'].'%) :</b> Rs.<span>'.ucwords($data[0]['emp_esic']).'</span></p>
								<p><b>Employer ESIC  ('.$data[0]['employer_esic_percentage'].'%) :</b> Rs.<span>'.ucwords($data[0]['employer_esic']).'</span></p>
							</div>
							<div class="col-md-3 col-sm-6">
								<p><b>Conveyance :</b> Rs.<span>'.ucwords($data[0]['conveyance']).'</span></p>
								<p><b>Other Allowance :</b> Rs.<span>'.ucwords($data[0]['other_allowance']).'</span></p>
								<p><b>PT :</b> Rs.<span>'.ucwords($data[0]['pt']).'</span></p>
								<p><b>Mediclaim Insurance :</b> Rs.<span>'.ucwords($data[0]['mediclaim']).'</span></p>
							</div>
							<div class="col-md-3 col-sm-6">
								<p><b>Medical Reimbursement :</b> Rs.<span>'.ucwords($data[0]['medical_reimbursement']).'</span></p>
								<p><b>Gross Salary : Rs.<span>'.ucwords($data[0]['gross_salary']).' </b></span></p>
								<p><b>Total Deduction : Rs.<span>'.ucwords($data[0]['total_deduction']).' </b></span></p>
								<p><b>Take Home Salary: Rs.<span>'.ucwords($data[0]['take_home']).' </b></span></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<p><b>Password :</b> <span>'.$data[0]['psd'].'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-6">
								<table class="table datatable-basic table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Certificate</th>
									</tr>
								</thead>
								<tbody>';
									
										if($data[0]['voter_id']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$data[0]['voter_id'].'" target="_blank"><i class="fa fa-file"></i> Voter ID</a></td>
													
												</tr>';
										}
										if($data[0]['emp_form']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$data[0]['emp_form'].'" target="_blank"><i class="fa fa-file"></i> Employee Form</a></td>
												</tr>';
										}
										if($data[0]['pf_esic_form']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$data[0]['pf_esic_form'].'" target="_blank"><i class="fa fa-file"></i> PF / ESIC Form</a></td>
													
												</tr>';
										}
										if($data[0]['payslip']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$data[0]['payslip'].'" target="_blank"><i class="fa fa-file"></i> Payslip</a></td>
													
												</tr>';
										}
										if($data[0]['exp_letter']!="")
										{
											echo '
												<tr>
													<td><a href="'.base_url().$data[0]['exp_letter'].'" target="_blank"><i class="fa fa-file"></i> Experience Letter</a></td>
													
												</tr>';
										}
										
									echo '
								</tbody>
							</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<p><b>Education Certificate :</b> </p>
						';
						$i=1;
							foreach($data1 as $res1)
							{
								echo '<div class="col-md-3 col-sm-6">
								<a href="'.base_url().$res1['path'].'" target="_blank"><i class="fa fa-file"></i> Document '.$i.'</a>
								</div>
								';
								$i++;
							}
						echo '
						</div>
						<hr>
						<div class="row">
							<p><b>Other Certificate :</b> </p>
						';
						$i=1;
							foreach($data2 as $res1)
							{
								echo '<div class="col-md-3 col-sm-6">
								<a href="'.base_url().$res1['path'].'" target="_blank"><i class="fa fa-file"></i> Document '.$i.'</a>
								</div>
								';
								$i++;
							}
							
						echo '
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>
					</div>';
	}
	function download_fhrms()
	{
		if($this->session->userdata('admin_login'))
		{
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);
			
			$this->excel->getActiveSheet()->setTitle('BackEnd Team Details');
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
			$this->excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
			
			
			
			$this->excel->getActiveSheet()->getStyle("A1:AO1")->applyFromArray(array("font" => array("bold" => true)));
			  $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'FFI Employee ID');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Employee Name');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Interview Date');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Joining Date');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Contract Date');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Designation');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Department');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'State');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Location');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Date of Birth');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Gender');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Father Name');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Blood Group');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Qualification');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Phone1');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Phone2');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Email');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Permanent Address');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Present Address');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'PAN No');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('V1', 'PAN Card');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'Aadhar No');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'Aadhar Card');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('Y1', 'Driving License No');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('Z1', 'Driving License Card');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AA1', 'Photo');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AB1', 'Resume');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AC1', 'Bank Document');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AD1', 'Bank Name');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AE1', 'Bank Account No');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AF1', 'Bank IFSC Code');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AG1', 'UAN Generatted');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AH1', 'UAN Type');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AI1', 'UAN No');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AJ1', 'Voter ID');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AK1', 'Employee Form');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AL1', 'PF ESIC Form');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AM1', 'Payslip');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AN1', 'Experience Letter');
			  $this->excel->setActiveSheetIndex(0)->setCellValue('AO1', 'Status');
			  
			   /**************************************************************************************************************************/
					$n=2;
					$i=1;
					$data=$this->fhrms->get_all_ffi_employee();	
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
						  $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $row['ffi_emp_id']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['emp_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $interview_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, $joining_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $contract_date);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $row['designation']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $row['department']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $row['state_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $row['location']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $dob);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, $gender);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $row['father_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, $row['blood_group']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, $row['qualification']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, $row['phone1']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n, $row['phone2']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('R'.$n, $row['email']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('S'.$n, $row['permanent_address']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('T'.$n, $row['present_address']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('U'.$n, $row['pan_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('V'.$n, base_url().$row['pan_path']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('W'.$n, $row['aadhar_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('X'.$n, base_url().$row['aadhar_path']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('Y'.$n, $row['driving_license_no']);	  
						   
						   if($row['driving_license_path']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('Z'.$n, base_url().$row['driving_license_path']);	 
						  }
						  if($row['photo']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AA'.$n, base_url().$row['photo']);	 
						  }
						  if($row['resume']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AB'.$n, base_url().$row['resume']);	 
						  }
						  if($row['bank_document']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AC'.$n, base_url().$row['bank_document']);	 
						  }
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AD'.$n, $row['bank_name']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AE'.$n, $row['bank_account_no']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AF'.$n, $row['bank_ifsc_code']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AG'.$n, $row['uan_generatted']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AH'.$n, $row['uan_type']);	  
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AI'.$n, $row['uan_no']);	  
						  
						  if($row['voter_id']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AJ'.$n, base_url().$row['voter_id']);	 
						  }
						  if($row['emp_form']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AK'.$n, base_url().$row['emp_form']);	 
						  }
						  if($row['pf_esic_form']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AL'.$n, base_url().$row['pf_esic_form']);	 
						  }
						  if($row['payslip']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AM'.$n, base_url().$row['payslip']);	 
						  }
						  if($row['exp_letter']!="")
						  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('AN'.$n, base_url().$row['exp_letter']);	 
						  }
						  $this->excel->setActiveSheetIndex(0)->setCellValue('AO'.$n, $status);	 	  
						$i++;
						$n++;
					}
				   /**************************************************************************************************************************/ 
				     $filename=date("d-m-Y").' Ffi Employee Details.xls';
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
	function validate_ffi()
	{
		$data=$this->fhrms->validate_ffi();
		echo $data;
	}
	function delete_education_certificate()
	{
		$data=$this->fhrms->delete_education_certificate();
	}
	function delete_other_certificate()
	{
		$data=$this->fhrms->delete_other_certificate();
	}
	function remove_voter_id()
	{
		$data=$this->fhrms->remove_voter_id();
	}
	function remove_emp_form()
	{
		$data=$this->fhrms->remove_emp_form();
	}
	function remove_pf_esic()
	{
		$data=$this->fhrms->remove_pf_esic();
	}
	function remove_payslip()
	{
		$data=$this->fhrms->remove_payslip();
	}
	function remove_exp_letter()
	{
		$data=$this->fhrms->remove_exp_letter();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}

	function delete_fhrms()
	{
		$data1=$this->fhrms->delete_fhrms();
		$data=$this->fhrms->get_all_ffi_employee();
		$i=1;
		foreach($data as $row)
		{
									echo '
											<tr>
												<td>'.$i.'</td>
												<td>'.$row['emp_name'].'</td>
												<td>'.$row['joining_date'].'</td>
												<td>'.$row['phone1'].'</td>
												<td>'.$row['email'].'</td>
												<td>'.$status.'</td>
												<td class="text-center">
												<div class="list-icons">
												<div class="dropdown">
													<a href="#" class="list-icons-item" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="javascript:void(0)" id='.$row['id'].' onclick="view_employee_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
														<a href="'.site_url('fhrms/edit_fhrms/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>';
													if($this->session->userdata('admin_type')==0)
															{
																echo '<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_fhrms(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
															}
														
															echo '	</div>
												</div>
											</div>
												</td>
											</tr>';
									$i++;
								}
	}

// data table fetch data from table
public function get_all_data()
{
	if ($this->session->userdata('admin_login')) {
		$fetch_data = $this->fhrms->make_datatables();

		$data = array();
		// $status = '<span class="badge bg-blue">Completed</span>';
		foreach ($fetch_data as $row) { 
			$sub_array   = array();
			$btn = '';
			if($this->session->userdata('admin_type')==0)
			{
				$btn = '<a href="javascript:void(0);" id="'.$row->id.'" onclick="delete_fhrms(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
';
			}
			$action = '<div class="list-icons">
			<div class="dropdown">
				<a href="#" class="list-icons-item" data-toggle="dropdown">
					<i class="icon-menu9"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a href="javascript:void(0)" id='.$row->id.' onclick="view_employee_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
					<a href="'.site_url('fhrms/edit_fhrms/'.$row->id).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
					'.$btn.'
				</div>
			</div>
		</div>';

			$sub_array[] = $row->id;
			$sub_array[] = $row->emp_name;
			$sub_array[] = $row->joining_date;
			$sub_array[] = $row->phone1;
			$sub_array[] = $row->email;
			$sub_array[] = $row->status;
			$sub_array[] = $action;
			
			 
			$data[] = $sub_array;
		// 	
		}
		$output = array(
			"draw"                =>     intval($_POST["draw"]),
			"recordsTotal"        =>     $this->fhrms->get_all_data(),
			"recordsFiltered"     =>     $this->fhrms->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	} else {
		redirect('home/index');
	}
}

public function get_all_datas()
{
	if ($this->session->userdata('admin_login')) {
		$fetch_data = $this->fhrms->make_datatable();

		$data = array();
		// $status = '<span class="badge bg-blue">Completed</span>';
		foreach ($fetch_data as $row) { 
			$sub_array   = array();
			$btn = '';
			if($this->session->userdata('admin_type')==0)
			{
				$btn = '<a href="javascript:void(0);" id="'.$row->id.'" onclick="delete_offer_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
';
			}
			$action = '<div class="list-icons">
			<div class="dropdown">
				<a href="#" class="list-icons-item" data-toggle="dropdown">
					<i class="icon-menu9"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a href="'.site_url('fhrms/view_offer_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
					'.$btn.'
				</div>
			</div>
		</div>';

			$sub_array[] = $row->id;
			$sub_array[] = $row->emp_name;
			$sub_array[] = $row->date;
			$sub_array[] = $row->phone1;
			$sub_array[] = $row->email;
			$sub_array[] = $action;
			
			 
			$data[] = $sub_array;
		// 	
		}
		$output = array(
			"draw"                =>     intval($_POST["draw"]),
			"recordsTotal"        =>     $this->fhrms->get_all_datas(),
			"recordsFiltered"     =>     $this->fhrms->get_filtered_datas(),
			"data" => $data
		);
		echo json_encode($output);
	} else {
		redirect('home/index');
	}
}


public function get_all_data_elements()
{
	if ($this->session->userdata('admin_login')) {
		$fetch_data = $this->fhrms->make_datatab();

		$data = array();
		// $status = '<span class="badge bg-blue">Completed</span>';
		foreach ($fetch_data as $row) { 
			$sub_array   = array();
			//$btn = '';
			/* if($this->session->userdata('admin_type')==0)
			{
			$btn = '<a href="javascript:void(0);" id="'.$row->id.'" onclick="delete_offer_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
';
			}
			/* $action = '<div class="list-icons">
			<div class="dropdown">
				<a href="#" class="list-icons-item" data-toggle="dropdown">
					<i class="icon-menu9"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a href="'.site_url('fhrms/view_offer_letter/'.$row->id).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
					'.$btn.'
				</div>
			</div>
		</div>'; */ 

			$sub_array[] = $row->id;
			$sub_array[] = $row->ffi_emp_id;
			$sub_array[] = $row->emp_name;
			$sub_array[] = $row->joining_date;
			$sub_array[] = $row->dob;
			$sub_array[] = $row->phone1;
			$sub_array[] = $row->email;
			
			
			 
			$data[] = $sub_array;
		// 	
		}
		$output = array(
			"draw"                =>     intval($_POST["draw"]),
			"recordsTotal"        =>     $this->fhrms->get_all_data_elements(),
			"recordsFiltered"     =>     $this->fhrms->get_filter_datas(),
			"data" => $data
		);
		echo json_encode($output);
	} else {
		redirect('home/index');
	}
}


}