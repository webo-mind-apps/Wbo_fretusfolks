<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Backend_team extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/Backend_db', 'back_end');
		$this->load->library("pagination");
	}
	public function index($var = null)
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "backend";
			//  $data['backend_team']=$this->back_end->get_all_backend_team();
			$this->load->view('admin/back_end/backend_team/index', $data);
			//get_all_data();
		}
	} 
	public function get_all_data($var = null)//created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->back_end->make_datatables();
			$data = array();
			$status = '<span class="badge bg-blue">Completed</span>';
			$i = 1;
			foreach ($fetch_data as $row) { 
				$sub_array   = array();
				$sub_array[] = $row->id;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->ffi_emp_id;
				$sub_array[] = $row->emp_name;
				$sub_array[] = date('d M, Y', strtotime($row->joining_date));
				$sub_array[] = $row->phone1;
				$status = "";
				if ($row->data_status == 1) {
					$status = '<span class="badge bg-blue">Completed</span>';
				} else if ($row->data_status == 0) {
					$status = '<span class="badge bg-danger">Pending</span>';
				}
				$sub_array[] = $status;
				$sub_array[] = '
					 <div class="list-icons">
					 <div class="dropdown">
						 <a href="#" class="list-icons-item" data-toggle="dropdown">
							 <i class="icon-menu9"></i>
						 </a>
						 <div class="dropdown-menu dropdown-menu-right">
							 <a href="javascript:void(0)" id=' . $row->id . ' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
							 <a href="' . site_url('backend_team/edit_backend/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
							 <a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_backend_team(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						 </div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
				$i=++$i;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->back_end->get_all_data(),
				"recordsFiltered"     =>     $this->back_end->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	function new_backend_team()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "backend";
			$data['states'] = $this->back_end->get_all_states();
			$data['clients'] = $this->back_end->get_all_clients();
			$this->load->view('admin/back_end/backend_team/new_backend', $data);
		} else {
			redirect('home/index');
		}
	}
	function edit_backend()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "backend";
			$id = $this->uri->segment(3);
			$data['client'] = $this->back_end->get_backend_team_details($id);
			$data['edu_certificate'] = $this->back_end->get_edu_certificate($id);
			$data['other_certificate'] = $this->back_end->get_other_certificate($id);
			$data['states'] = $this->back_end->get_all_states();
			$data['all_clients'] = $this->back_end->get_all_clients();
			$this->load->view('admin/back_end/backend_team/edit_backend', $data);
		} else {
			redirect('home/index');
		}
	}
	function save_team()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->back_end->save_team();
			redirect('backend_team/');
		} else {
			redirect('home/index');
		}
	}
	function update_team()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->back_end->update_team();
			redirect('backend_team/');
		} else {
			redirect('home/index');
		}
	}
	function update_team_pending()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->back_end->update_team_pending();
			redirect('backend_team/');
		} else {
			redirect('home/index');
		}
	}
	function validate_ffi()
	{
		$data = $this->back_end->validate_ffi();
		echo $data;
	}
	function view_backend_team_details()
	{
		$id = $this->input->post('id');
		$data = $this->back_end->get_backend_team_details($id);
		$data1 = $this->back_end->get_edu_certificate($id);
		$data2 = $this->back_end->get_other_certificate($id);

		$joining_date = "";
		$contract_date = "";
		$interview_date = "";
		$dob = "";
		$gender = "";

		if ($data[0]['joining_date'] != "0000-00-00") {
			$joining_date = date("d-m-Y", strtotime($data[0]['joining_date']));
		}
		if ($data[0]['contract_date'] != "0000-00-00") {
			$contract_date = date("d-m-Y", strtotime($data[0]['contract_date']));
		}
		if ($data[0]['interview_date'] != "0000-00-00") {
			$interview_date = date("d-m-Y", strtotime($data[0]['interview_date']));
		}
		if ($data[0]['dob'] != "0000-00-00") {
			$dob = date("d-m-Y", strtotime($data[0]['dob']));
		}
		if ($data[0]['gender'] == 1) {
			$gender = "Male";
		} else if ($data[0]['gender'] == 2) {
			$gender = "Female";
		}
		echo '
					<div class="modal-header bg-primary">
						<h6 class="modal-title">' . ucwords($data[0]['emp_name']) . '</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Entity Name :</b> <span>' . ucwords($data[0]['entity_name']) . '</span></p>
								<p><b>Console ID :</b> <span>' . ucwords($data[0]['console_id']) . '</span></p>
								<p><b>Employee Name :</b> <span>' . ucwords($data[0]['emp_name']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>' . ucwords($data[0]['client_name']) . '</span></p>
								<p><b>Client Emp ID :</b> <span>' . ucwords($data[0]['client_emp_id']) . '</span></p>
								<p><b>Middle Name :</b> <span>' . ucwords($data[0]['middle_name']) . '</span></p>
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>FFI EMP ID :</b> <span>' . ucwords($data[0]['ffi_emp_id']) . '</span></p>
								<p><b>Grade :</b> <span>' . ucwords($data[0]['grade']) . '</span></p>
								<p><b>Last Name :</b> <span>' . ucwords($data[0]['last_name']) . '</span></p>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Interview Date :</b> <span>' . $interview_date . '</span></p>		
								<p><b>Designation :</b> <span>' . ucwords($data[0]['designation']) . '</span></p>
								<p><b>Location:</b> <span>' . ucwords($data[0]['location']) . '</span></p>
								<p><b>Gender :</b> <span>' . $gender . '</span></p>	
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Joining Date :</b> <span>' . $joining_date . '</span></p>
								<p><b>Department:</b> <span>' . ucwords($data[0]['department']) . '</span></p>
								<p><b>Branch Name :</b> <span>' . ucwords($data[0]['branch']) . '</span></p>		
								<p><b>Father Name :</b> <span>' . ucwords($data[0]['father_name']) . '</span></p>
									
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>DOL :</b> <span>' . $contract_date . '</span></p>		
								<p><b>State:</b> <span>' . ucwords($data[0]['state_name']) . '</span></p>		
								<p><b>Date of Birth :</b> <span>' . $dob . '</span></p>		
								<p><b>Mother Name :</b> <span>' . ucwords($data[0]['mother_name']) . '</span></p>								
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Religion :</b> <span>' . ucwords($data[0]['religion']) . '</span></p>			
								<p><b>Marital Status :</b> <span>' . ucwords($data[0]['maritial_status']) . '</span></p>			
								<p><b>No of Children :</b> <span>' . ucwords($data[0]['no_of_childrens']) . '</span></p>			
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Languages :</b> <span>' . ucwords($data[0]['languages']) . '</span></p>	
								<p><b>Emg Contact Person :</b> <span>' . ucwords($data[0]['emer_contact_no']) . '</span></p>	
								<p><b>Blood Group :</b> <span>' . ucwords($data[0]['blood_group']) . '</span></p>	
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Mother Tongue :</b> <span>' . ucwords($data[0]['mother_tongue']) . '</span></p>
								<p><b>Spouse Name :</b> <span>' . ucwords($data[0]['spouse_name']) . '</span></p>
								<p><b>Qualification :</b> <span>' . ucwords($data[0]['qualification']) . '</span></p>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 1:</b> <span>' . ucwords($data[0]['phone1']) . '</span></p>
								<p><b>Official Email :</b> <span>' . ucwords($data[0]['official_mail_id']) . '</span></p>						
								<p><b>Permanent Address:</b> <span>' . ucwords($data[0]['permanent_address']) . '</span></p>
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 2 :</b> <span>' . ucwords($data[0]['phone2']) . '</span></p>
								<p><b>Present Address :</b> <span>' . ucwords($data[0]['present_address']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>' . ucwords($data[0]['email']) . '</span></p>		
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Bank Name :</b> <span>' . ucwords($data[0]['bank_name']) . '</span></p>
								<p><b>UAN No :</b> <span>' . ucwords($data[0]['uan_no']) . '</span></p>
								<p><b>ESIC No :</b> <span>' . ucwords($data[0]['esic_no']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Bank Account No :</b> <span>' . $data[0]['bank_account_no'] . '</span></p>
								<p><b>Aadhar No :</b> <span>' . ucwords($data[0]['aadhar_no']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No :</b> <span>' . ucwords($data[0]['driving_license_no']) . '</span></p>								
								<p><b>Bank IFSC Code :</b> <span>' . $data[0]['bank_ifsc_code'] . '</span></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Aadhar No:</b> <span>' . $data[0]['aadhar_no'] . '</span></p>';
		if ($data[0]['aadhar_path'] != "") {
			echo '<p><b><a href="' . base_url() . $data[0]['aadhar_path'] . '" target="_blank"><i class="fa fa-book"></i> Aadhar Card</a></b></p>';
		}
		if ($data[0]['photo'] != "") {
			echo '<p><b><a href="' . base_url() . $data[0]['photo'] . '" target="_blank"><i class="fa fa-book"></i> Photo</a></b></p>';
		}
		echo '		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No:</b> <span>' . $data[0]['driving_license_no'] . '</span></p>';
		if ($data[0]['driving_license_path'] != "") {
			echo '<p><b><a href="' . base_url() . $data[0]['driving_license_path'] . '" target="_blank"><i class="fa fa-book"></i> Driving License</a></b></p>';
		}
		if ($data[0]['resume'] != "") {
			echo '<p><b><a href="' . base_url() . $data[0]['resume'] . '" target="_blank"><i class="fa fa-book"></i> Resume</a></b></p>';
		}
		echo '	</div>
							<div class="col-md-4 col-sm-6">
								<p><b>PAN No :</b> <span>' . ucwords($data[0]['pan_no']) . '</span></p>';
		if ($data[0]['pan_path'] != "") {
			echo '<p><b><a href="' . base_url() . $data[0]['pan_path'] . '" target="_blank"><i class="fa fa-book"></i> Pan Card</a></b></p>';
		}
		if ($data[0]['bank_document'] != "") {
			echo '<p><b><a href="' . base_url() . $data[0]['bank_document'] . '" target="_blank"><i class="fa fa-book"></i> Bank Document</a></b></p>';
		}
		echo '	</div>
						</div>
						
						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<p><b>Basic Salary :</b> Rs.<span>' . ucwords($data[0]['basic_salary']) . '</span></p>
								<p><b>Special Allowance :</b> Rs.<span>' . ucwords($data[0]['special_allowance']) . '</span></p>
								<p><b>Employee PF (12%) :</b> Rs.<span>' . ucwords($data[0]['emp_pf']) . '</span></p>
								<p><b>Employer PF :</b> Rs.<span>' . ucwords($data[0]['employer_pf']) . '</span></p>
								<p><b>Grand Total : Rs.<span>' . ucwords($data[0]['ctc']) . ' </b></span></p>
							</div>
							<div class="col-md-3 col-sm-6">
								<p><b>HRA :</b> Rs.<span>' . ucwords($data[0]['hra']) . '</span></p>
								<p><b>ST Bonus :</b> Rs.<span>' . ucwords($data[0]['st_bonus']) . '</span></p>
								<p><b>Employee ESIC  (1.75%) :</b> Rs.<span>' . ucwords($data[0]['emp_esic']) . '</span></p>
								<p><b>Employer ESIC  :</b> Rs.<span>' . ucwords($data[0]['employer_esic']) . '</span></p>
								
								
							</div>
							<div class="col-md-3 col-sm-6">
								<p><b>Conveyance :</b> Rs.<span>' . ucwords($data[0]['conveyance']) . '</span></p>
								<p><b>Other Allowance :</b> Rs.<span>' . ucwords($data[0]['other_allowance']) . '</span></p>
								<p><b>PT :</b> Rs.<span>' . ucwords($data[0]['pt']) . '</span></p>
								<p><b>Mediclaim Insurance :</b> Rs.<span>' . ucwords($data[0]['mediclaim']) . '</span></p>
								
								
							</div>
							<div class="col-md-3 col-sm-6">
								<p><b>Medical Reimbursement :</b> Rs.<span>' . ucwords($data[0]['medical_reimbursement']) . '</span></p>
								<p><b>Gross Salary : Rs.<span>' . ucwords($data[0]['gross_salary']) . ' </b></span></p>
								<p><b>Total Deduction : Rs.<span>' . ucwords($data[0]['total_deduction']) . ' </b></span></p>
								<p><b>Take Home Salary : Rs.<span>' . ucwords($data[0]['take_home']) . ' </b></span></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<p><b>Password :</b> <span>' . $data[0]['psd'] . '</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-6">
								<table class="table datatable-basic table-bordered table-striped table-hover">
								
								<tbody><tr>';

		if ($data[0]['voter_id'] != "") {
			echo '<td><a href="' . base_url() . $data[0]['voter_id'] . '" target="_blank"><i class="fa fa-file"></i> Voter ID</a></td>';
		}
		if ($data[0]['emp_form'] != "") {
			echo '<td><a href="' . base_url() . $data[0]['emp_form'] . '" target="_blank"><i class="fa fa-file"></i> Employee Form</a></td>';
		}
		if ($data[0]['pf_esic_form'] != "") {
			echo '<td><a href="' . base_url() . $data[0]['pf_esic_form'] . '" target="_blank"><i class="fa fa-file"></i> PF / ESIC Form</a></td>';
		}
		if ($data[0]['payslip'] != "") {
			echo '<td><a href="' . base_url() . $data[0]['payslip'] . '" target="_blank"><i class="fa fa-file"></i> Payslip</a></td>';
		}
		if ($data[0]['exp_letter'] != "") {
			echo '<td><a href="' . base_url() . $data[0]['exp_letter'] . '" target="_blank"><i class="fa fa-file"></i> Experience Letter</a></td>';
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
		$i = 1;
		foreach ($data1 as $res1) {
			echo '<div class="col-md-3 col-sm-6">
								<a href="' . base_url() . $res1['path'] . '" target="_blank"><i class="fa fa-file"></i> Document ' . $i . '</a>
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
		$i = 1;
		foreach ($data2 as $res1) {
			echo '<div class="col-md-3 col-sm-6">
								<a href="' . base_url() . $res1['path'] . '" target="_blank"><i class="fa fa-file"></i> Document ' . $i . '</a>
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
	function download_backend_details()
	{
		if ($this->session->userdata('admin_login')) {
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
			$this->excel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('BA')->setAutoSize(true);

			$this->excel->getActiveSheet()->getStyle("A1:BA1")->applyFromArray(array("font" => array("bold" => true)));
			$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Entity Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Client Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'FFI Employee ID');
			$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Console ID');
			$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Client Employee ID');
			$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Grade');
			$this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Employee Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Middle Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Last Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Interview Date');
			$this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Joining Date');
			$this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Contract End Date');
			$this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'Designation');
			$this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Department');
			$this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'State');
			$this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Location');
			$this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Branch Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Date of Birth');
			$this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Gender');
			$this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'Father Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('V1', 'Mother Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'Religion');
			$this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'Languages');
			$this->excel->setActiveSheetIndex(0)->setCellValue('Y1', 'Mother Tongue');
			$this->excel->setActiveSheetIndex(0)->setCellValue('Z1', 'Marital Status');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AA1', 'Emergency Contact Number');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AB1', 'Spouse name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AC1', 'No of childrens');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AD1', 'Blood Group');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AE1', 'Qualification');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AF1', 'Phone1');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AG1', 'Phone2');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AH1', 'Personal Email ID');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AI1', 'Official Email ID');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AJ1', 'Permanent Address');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AK1', 'Present Address');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AL1', 'PAN No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AM1', 'PAN Card');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AN1', 'Aadhar No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AO1', 'Aadhar Card');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AP1', 'Driving License No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AQ1', 'Driving License Card');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AR1', 'Photo');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AS1', 'Resume');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AT1', 'Bank Document');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AU1', 'Bank Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AV1', 'Bank Account No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AW1', 'Bank IFSC Code');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AX1', 'UAN No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AY1', 'ESIC No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AZ1', 'Status');

			/**************************************************************************************************************************/
			$n = 2;
			$i = 1;
			$data = $this->back_end->get_all_backend_team();
			foreach ($data as $row) {
				$interview_date = "";
				$joining_date = "";
				$contract_date = "";
				$dob = "";
				$gender = "";
				$status = "";

				if ($row['joining_date'] != "0000-00-00") {
					$joining_date = date("d-m-Y", strtotime($row['joining_date']));
				}
				if ($row['contract_date'] != "0000-00-00") {
					$contract_date = date("d-m-Y", strtotime($row['contract_date']));
				}
				if ($row['interview_date'] != "0000-00-00") {
					$interview_date = date("d-m-Y", strtotime($row['interview_date']));
				}
				if ($row['dob'] != "0000-00-00") {
					$dob = date("d-m-Y", strtotime($row['dob']));
				}
				if ($row['gender'] == 1) {
					$gender = "Male";
				} else if ($row['gender'] == 2) {
					$gender = "Female";
				}
				if ($row['data_status'] == 0) {
					$status = "Pending";
				} else if ($row['data_status'] == 1) {
					$status = "Completed";
				}
				$this->excel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
				$this->excel->setActiveSheetIndex(0)->setCellValue('B' . $n, $row['entity_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('C' . $n, $row['client_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('D' . $n, $row['ffi_emp_id']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('E' . $n, $row['console_id']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('F' . $n, $row['client_emp_id']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('G' . $n, $row['grade']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('H' . $n, $row['emp_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('I' . $n, $row['middle_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('J' . $n, $row['last_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('K' . $n, $interview_date);
				$this->excel->setActiveSheetIndex(0)->setCellValue('L' . $n, $joining_date);
				$this->excel->setActiveSheetIndex(0)->setCellValue('M' . $n, $contract_date);
				$this->excel->setActiveSheetIndex(0)->setCellValue('N' . $n, $row['designation']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('O' . $n, $row['department']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('P' . $n, $row['state_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('Q' . $n, $row['location']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('R' . $n, $row['branch']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('S' . $n, $dob);
				$this->excel->setActiveSheetIndex(0)->setCellValue('T' . $n, $gender);
				$this->excel->setActiveSheetIndex(0)->setCellValue('U' . $n, $row['father_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('V' . $n, $row['mother_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('W' . $n, $row['religion']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('X' . $n, $row['languages']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('Y' . $n, $row['mother_tongue']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('Z' . $n, $row['maritial_status']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AA' . $n, $row['emer_contact_no']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AB' . $n, $row['spouse_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AC' . $n, $row['no_of_childrens']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AD' . $n, $row['blood_group']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AE' . $n, $row['qualification']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AF' . $n, $row['phone1']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AG' . $n, $row['phone2']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AH' . $n, $row['email']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AI' . $n, $row['official_mail_id']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AJ' . $n, $row['permanent_address']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AK' . $n, $row['present_address']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AL' . $n, $row['pan_no']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AM' . $n, base_url() . $row['pan_path']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AN' . $n, $row['aadhar_no']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AO' . $n, base_url() . $row['aadhar_path']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AP' . $n, $row['driving_license_no']);

				if ($row['driving_license_path'] != "") {
					$this->excel->setActiveSheetIndex(0)->setCellValue('AQ' . $n, base_url() . $row['driving_license_path']);
				}
				if ($row['photo'] != "") {
					$this->excel->setActiveSheetIndex(0)->setCellValue('AR' . $n, base_url() . $row['photo']);
				}
				if ($row['resume'] != "") {
					$this->excel->setActiveSheetIndex(0)->setCellValue('AS' . $n, base_url() . $row['resume']);
				}
				if ($row['bank_document'] != "") {
					$this->excel->setActiveSheetIndex(0)->setCellValue('AT' . $n, base_url() . $row['bank_document']);
				}
				$this->excel->setActiveSheetIndex(0)->setCellValue('AU' . $n, $row['bank_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AV' . $n, $row['bank_account_no']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AW' . $n, $row['bank_ifsc_code']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AX' . $n, $row['uan_no']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AY' . $n, $row['esic_no']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('AZ' . $n, $status);
				$i++;
				$n++;
			}
			/**************************************************************************************************************************/
			$filename = date("d-m-Y") . ' BackEnd Details.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$objWriter->save('php://output');
		} else {
			redirect('home/index');
		}
	}
	function delete_backend_team()
	{
		if($this->back_end->delete_backend_team()){
			echo "deleted"; 
		}

		// $backend_team = $this->back_end->get_all_backend_team();
        // redirect('backend_team/');
		// $i = 1;
		// foreach ($backend_team as $row) {
		// 	$status = "";
		// 	if ($row['data_status'] == 1) {
		// 		$status = '<span class="badge bg-blue">Completed</span>';
		// 	} else if ($row['data_status'] == 0) {
		// 		$status = '<span class="badge bg-danger">Pending</span>';
		// 	}
		// 	echo '
		// 			<tr>
		// 				<td>' . $i . '</td>
		// 				<td>' . $row['client_name'] . '</td>
		// 				<td>' . $row['ffi_emp_id'] . '</td>
		// 				<td>' . $row['emp_name'] . '</td>
		// 				<td style="width:15%">' . date("d-m-Y", strtotime($row['joining_date'])) . '</td>
		// 				<td>' . $row['phone1'] . '</td>
		// 				<td>' . $status . '</td>
		// 				<td class="text-center">
		// 					<div class="list-icons">
		// 						<div class="dropdown">
		// 							<a href="#" class="list-icons-item" data-toggle="dropdown">
		// 								<i class="icon-menu9"></i>
		// 							</a>
		// 							<div class="dropdown-menu dropdown-menu-right">
		// 								<a href="javascript:void(0)" id=' . $row['id'] . ' onclick="view_backend_team_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
		// 								<a href="' . site_url('backend_team/edit_backend/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
		// 								<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_backend_team(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
		// 							</div>
		// 						</div>
		// 					</div>
		// 				</td>
		// 			</tr>';
		// 	$i++;
		// }
	}
	function delete_education_certificate()
	{
		$data = $this->back_end->delete_education_certificate();
	}
	function delete_other_certificate()
	{
		$data = $this->back_end->delete_other_certificate();
	}
	function remove_voter_id()
	{
		$data = $this->back_end->remove_voter_id();
	}
	function remove_emp_form()
	{
		$data = $this->back_end->remove_emp_form();
	}
	function remove_pf_esic()
	{
		$data = $this->back_end->remove_pf_esic();
	}
	function remove_payslip()
	{
		$data = $this->back_end->remove_payslip();
	}
	function remove_exp_letter()
	{
		$data = $this->back_end->remove_exp_letter();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
	// excel Import for ADMS DOC 
	public function adms_doc_import()
	{

		$data = array();
		// Load form validation library
		if (!empty($_FILES['import']['name'])) {
			// get file extension
			$valid_extentions = array('xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw');
			$extension = pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION);
			$valid = false;
			foreach ($valid_extentions as $key => $value) {
				if ($extension == $value) {
					$valid = true;
				}
			}

			if ($valid) {
				if ($extension == 'csv') :
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				elseif ($extension == 'xlsx') :
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				else :
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				endif;

				// file path
				$spreadsheet = $reader->load($_FILES['import']['tmp_name']);
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$data = array(
						"entity_name"			=> (empty($allDataInSheet[$i]['A']) ? 'null' : $allDataInSheet[$i]['A']),
						"client_id"				=> (empty($allDataInSheet[$i]['C']) ? 'null' : $allDataInSheet[$i]['B']),
						"ffi_emp_id"			=> (empty($allDataInSheet[$i]['B']) ? 'null' : $allDataInSheet[$i]['C']),
						"console_id"			=> (empty($allDataInSheet[$i]['D']) ? 'null' : $allDataInSheet[$i]['D']),
						"client_emp_id"			=> (empty($allDataInSheet[$i]['E']) ? 'null' : $allDataInSheet[$i]['E']),
						"grade"					=> (empty($allDataInSheet[$i]['F']) ? 'null' : $allDataInSheet[$i]['F']),
						"emp_name"				=> (empty($allDataInSheet[$i]['G']) ? 'null' : $allDataInSheet[$i]['G']),
						"middle_name"			=> (empty($allDataInSheet[$i]['H']) ? 'null' : $allDataInSheet[$i]['H']),
						"last_name"				=> (empty($allDataInSheet[$i]['I']) ? 'null' : $allDataInSheet[$i]['I']),
						"interview_date"		=> (empty($allDataInSheet[$i]['J']) ? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['J']))),
						"joining_date"			=> (empty($allDataInSheet[$i]['K']) ? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['K']))),
						"contract_date"			=> (empty($allDataInSheet[$i]['L']) ? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['L']))),
						"designation"			=> (empty($allDataInSheet[$i]['M']) ? 'null' : $allDataInSheet[$i]['M']),
						"department"			=> (empty($allDataInSheet[$i]['N']) ? 'null' : $allDataInSheet[$i]['N']),
						"state"					=> (empty($allDataInSheet[$i]['O']) ? 'null' : $allDataInSheet[$i]['O']),
						"location"				=> (empty($allDataInSheet[$i]['P']) ? 'null' : $allDataInSheet[$i]['P']),
						"branch"				=> (empty($allDataInSheet[$i]['Q']) ? 'null' : $allDataInSheet[$i]['Q']),
						"dob"					=> (empty($allDataInSheet[$i]['R']) ? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['R']))),
						"gender"				=> (empty($allDataInSheet[$i]['S']) ? 'null' : $allDataInSheet[$i]['S']),
						"father_name"			=> (empty($allDataInSheet[$i]['T']) ? 'null' : $allDataInSheet[$i]['T']),
						"mother_name"			=> (empty($allDataInSheet[$i]['U']) ? 'null' : $allDataInSheet[$i]['U']),
						"religion"				=> (empty($allDataInSheet[$i]['V']) ? 'null' : $allDataInSheet[$i]['V']),
						"languages"				=> (empty($allDataInSheet[$i]['W']) ? 'null' : $allDataInSheet[$i]['W']),
						"mother_tongue"			=> (empty($allDataInSheet[$i]['X']) ? 'null' : $allDataInSheet[$i]['X']),
						"maritial_status"		=> (empty($allDataInSheet[$i]['Y']) ? 'null' : $allDataInSheet[$i]['Y']),
						"emer_contact_no"		=> (empty($allDataInSheet[$i]['Z']) ? 'null' : $allDataInSheet[$i]['Z']),
						"spouse_name"			=> (empty($allDataInSheet[$i]['AA']) ? 'null' : $allDataInSheet[$i]['AA']),
						"no_of_childrens"		=> (empty($allDataInSheet[$i]['AB']) ? 'null' : $allDataInSheet[$i]['AB']),
						"blood_group"			=> (empty($allDataInSheet[$i]['AC']) ? 'null' : $allDataInSheet[$i]['AC']),
						"qualification"			=> (empty($allDataInSheet[$i]['AD']) ? 'null' : $allDataInSheet[$i]['AD']),
						"phone1"				=> (empty($allDataInSheet[$i]['AE']) ? 'null' : $allDataInSheet[$i]['AE']),
						"phone2"				=> (empty($allDataInSheet[$i]['AF']) ? 'null' : $allDataInSheet[$i]['AF']),
						"email"					=> (empty($allDataInSheet[$i]['AG']) ? 'null' : $allDataInSheet[$i]['AG']),
						"official_mail_id"		=> (empty($allDataInSheet[$i]['AH']) ? 'null' : $allDataInSheet[$i]['AH']),
						"permanent_address"		=> (empty($allDataInSheet[$i]['AI']) ? 'null' : $allDataInSheet[$i]['AI']),
						"present_address"		=> (empty($allDataInSheet[$i]['AJ']) ? 'null' : $allDataInSheet[$i]['AJ']),
						"pan_no"				=> (empty($allDataInSheet[$i]['AK']) ? 'null' : $allDataInSheet[$i]['AK']),
						"pan_path"				=> (empty($allDataInSheet[$i]['AL']) ? 'null' : $allDataInSheet[$i]['AL']),
						"aadhar_no"				=> (empty($allDataInSheet[$i]['AM']) ? 'null' : $allDataInSheet[$i]['AM']),
						"aadhar_path"			=> (empty($allDataInSheet[$i]['AN']) ? 'null' : $allDataInSheet[$i]['AN']),
						"driving_license_no"	=> (empty($allDataInSheet[$i]['AO']) ? 'null' : $allDataInSheet[$i]['AO']),
						"driving_license_path"	=> (empty($allDataInSheet[$i]['AP']) ? 'null' : $allDataInSheet[$i]['AP']),
						"photo"					=> (empty($allDataInSheet[$i]['AQ']) ? 'null' : $allDataInSheet[$i]['AQ']),
						"resume"				=> (empty($allDataInSheet[$i]['AR']) ? 'null' : $allDataInSheet[$i]['AR']),
						"bank_name"				=> (empty($allDataInSheet[$i]['AS']) ? 'null' : $allDataInSheet[$i]['AS']),
						"bank_document"			=> (empty($allDataInSheet[$i]['AT']) ? 'null' : $allDataInSheet[$i]['AT']),
						"bank_account_no"		=> (empty($allDataInSheet[$i]['AU']) ? 'null' : $allDataInSheet[$i]['AU']),
						"bank_ifsc_code"		=> (empty($allDataInSheet[$i]['AV']) ? 'null' : $allDataInSheet[$i]['AV']),
						"uan_no"				=> (empty($allDataInSheet[$i]['AW']) ? 'null' : $allDataInSheet[$i]['AW']),
						"esic_no"				=> (empty($allDataInSheet[$i]['AX']) ? 'null' : $allDataInSheet[$i]['AX']),
						"status"				=> (empty($allDataInSheet[$i]['AY']) ? 'null' : $allDataInSheet[$i]['AY']),
						"basic_salary"			=> (empty($allDataInSheet[$i]['AZ']) ? 'null' : $allDataInSheet[$i]['AZ']),
						"hra"					=> (empty($allDataInSheet[$i]['BA']) ? 'null' : $allDataInSheet[$i]['BA']),
						"conveyance"			=> (empty($allDataInSheet[$i]['BB']) ? 'null' : $allDataInSheet[$i]['BB']),
						"medical_reimbursement"	=> (empty($allDataInSheet[$i]['BC']) ? 'null' : $allDataInSheet[$i]['BC']),
						"special_allowance"		=> (empty($allDataInSheet[$i]['BD']) ? 'null' : $allDataInSheet[$i]['BD']),
						"st_bonus"				=> (empty($allDataInSheet[$i]['BE']) ? 'null' : $allDataInSheet[$i]['BE']),
						"gross_salary"			=> (empty($allDataInSheet[$i]['BF']) ? 'null' : $allDataInSheet[$i]['BF']),
						"emp_pf"				=> (empty($allDataInSheet[$i]['BG']) ? 'null' : $allDataInSheet[$i]['BG']),
						"emp_esic"				=> (empty($allDataInSheet[$i]['BH']) ? 'null' : $allDataInSheet[$i]['BH']),
						"pt"					=> (empty($allDataInSheet[$i]['BI']) ? 'null' : $allDataInSheet[$i]['BI']),
						"total_deduction"		=> (empty($allDataInSheet[$i]['BJ']) ? 'null' : $allDataInSheet[$i]['BJ']),
						"take_home"				=> (empty($allDataInSheet[$i]['BK']) ? 'null' : $allDataInSheet[$i]['BK']),
						"employer_pf"			=> (empty($allDataInSheet[$i]['BL']) ? 'null' : $allDataInSheet[$i]['BL']),
						"employer_esic"			=> (empty($allDataInSheet[$i]['BM']) ? 'null' : $allDataInSheet[$i]['BM']),
						"mediclaim"				=> (empty($allDataInSheet[$i]['BN']) ? 'null' : $allDataInSheet[$i]['BN']),
						"ctc"					=> (empty($allDataInSheet[$i]['BO']) ? 'null' : $allDataInSheet[$i]['BO']),
						"voter_id"				=> (empty($allDataInSheet[$i]['BP']) ? 'null' : $allDataInSheet[$i]['BP']),
						"emp_form"				=> (empty($allDataInSheet[$i]['BQ']) ? 'null' : $allDataInSheet[$i]['BQ']),
						"pf_esic_form"			=> (empty($allDataInSheet[$i]['BS']) ? 'null' : $allDataInSheet[$i]['BS']),
						"other_allowance"		=> (empty($allDataInSheet[$i]['BT']) ? 'null' : $allDataInSheet[$i]['BT']),
						"payslip"				=> (empty($allDataInSheet[$i]['BU']) ? 'null' : $allDataInSheet[$i]['BU']),
						"exp_letter"			=> (empty($allDataInSheet[$i]['BV']) ? 'null' : $allDataInSheet[$i]['BV']),
						"password"				=> (empty($allDataInSheet[$i]['BW']) ? 'null' : $allDataInSheet[$i]['BW']),
						"psd"					=>	md5($allDataInSheet[$i]['BW']),
						"active_status"			=> (empty($allDataInSheet[$i]['BX']) ? 'null' : $allDataInSheet[$i]['BX']),
						'modified_date'			=>	date('Y-m-d H:i:s')
					);

					$this->back_end->importEmployee($data);
				}

				$this->session->set_flashdata('success', 'Import successfully');
				redirect('backend_team', 'refresh');
			} else {

				$this->session->set_flashdata('error', 'Please Choose Valid file formate ');
			}
		}
	}

	// zip Generate testing
	public function test()
	{
		$this->load->library('zip');

		$path = 'payslip/payslip_' . date('Ymdhis');
		if (!is_dir($path)) mkdir($path, 0777, TRUE);

		for ($i = 0; $i < 10; $i++) {
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML('<p>Only test' . $i . '</p>');
			$pdfData = $mpdf->Output($path . '/' . $i . '.pdf', 'F');
		}
		$this->zip->read_dir($path);
		$download = $this->zip->download($path . '.zip');
	}

	// Document Sample formate generate
	public function doc_formate()
	{
		if($this->session->userdata('admin_login'))
		{
		$client=$this->back_end->get_all_clients();
		$states=$this->back_end->get_all_states();
		
        // $alpha = array('A', 'B', 'C','D', 'E', 'F','G', 'H', 'I','J', 'K', 'L','M', 'N', 'O');
       
		$spreadsheet = new Spreadsheet();
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(1);
		$spreadsheet->getActiveSheet()->setTitle('sheet1');
		$sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setCellValue('A1', 'SL No');
        $sheet1->setCellValue('B1', 'CLIENT ID');
		$sheet1->setCellValue('C1', 'CLIENT NAME');

		$sheet1->setCellValue('E1', 'STATES ID');
		$sheet1->setCellValue('F1', 'STATES');

		$sheet1->setCellValue('H1', 'GENDER VALUE');
		$sheet1->setCellValue('I1', 'GENDER');

		$sheet1->setCellValue('K1', 'MARITAL STATUS');

		$sheet1->setCellValue('M1', 'BLOOD GROUP');

		$sheet1->setCellValue('O1', 'STATUS VALUE');
		$sheet1->setCellValue('P1', 'STATUS');

		$sheet1->setCellValue('R1', 'VALUE');
		$sheet1->setCellValue('S1', 'ACTIVE STATUS');
		
		$sheet1->getStyle("A1:S1")->applyFromArray(array("font" => array("bold" => true)));
		foreach(range('A','S') as $columnID) {
			$sheet1->getColumnDimension($columnID)
				->setAutoSize(true);
		}
		$i = 2;
        foreach ($client as $key => $value) {

            $sheet1->setCellValue('A'.$i, $key + 1);
            $sheet1->setCellValue('B'.$i, $value['id']);
            $sheet1->setCellValue('C'.$i, $value['client_name']);
            $i += 1;
		}   
		$j = 2;
		foreach ($states as $key => $value) {
			$sheet1->setCellValue('E'.$j, $value['id']);
            $sheet1->setCellValue('F'.$j, $value['state_name']);
            $j += 1;
		}   

		$sheet1->setCellValue('H2','1');
		$sheet1->setCellValue('H3','2');
		$sheet1->setCellValue('I2','Male');
		$sheet1->setCellValue('I3','Female');
		
		$sheet1->setCellValue('K2','Single');
		$sheet1->setCellValue('K3','Married');
		
		$sheet1->setCellValue('M2','O+');
		$sheet1->setCellValue('M3','O-');
		$sheet1->setCellValue('M4','A+');
		$sheet1->setCellValue('M5','A-');
		$sheet1->setCellValue('M6','B+');
		$sheet1->setCellValue('M7','B-');
		$sheet1->setCellValue('M8','AB+');
		$sheet1->setCellValue('M9','AB-');
		
		$sheet1->setCellValue('O2','0');
		$sheet1->setCellValue('O3','1');
		$sheet1->setCellValue('P2','Active');
		$sheet1->setCellValue('P3','Inactive');

		$sheet1->setCellValue('R2','0');
		$sheet1->setCellValue('R3','1');
		$sheet1->setCellValue('S2','Active');
		$sheet1->setCellValue('S3','Deactive');


		
		$spreadsheet->setActiveSheetIndex(0);
		$spreadsheet->getActiveSheet()->setTitle('Back end details');
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->getStyle("A1:BZ1")->applyFromArray(array("font" => array("bold" => true)));
        $sheet->setCellValue('A1', 'Entity Name: *');
        $sheet->setCellValue('B1', 'Enter Client Name: *');
		$sheet->setCellValue('C1', 'Enter FFI Employee ID: *');
		$sheet->setCellValue('D1', 'Console ID:');
        $sheet->setCellValue('E1', 'Enter Client Employee ID:');
		$sheet->setCellValue('F1', 'Grade:');
		$sheet->setCellValue('G1', 'Enter Employee Name: *');
        $sheet->setCellValue('H1', 'Middle Name:');
		$sheet->setCellValue('I1', 'Last Name:');
		$sheet->setCellValue('J1', 'Interview Date: *');
        $sheet->setCellValue('K1', 'Joining Date: *');
		$sheet->setCellValue('L1', 'DOL');
		$sheet->setCellValue('M1', 'Enter Designation: *');
        $sheet->setCellValue('N1', 'Enter Department:');
		$sheet->setCellValue('O1', 'State: *');
		$sheet->setCellValue('P1', 'Location: *');
        $sheet->setCellValue('Q1', 'Branch:');
		$sheet->setCellValue('R1', 'DOB: *');
		$sheet->setCellValue('S1', 'Gender: *');
        $sheet->setCellValue('T1', 'Father Name: *');
		$sheet->setCellValue('U1', 'Mother Name: *');
		$sheet->setCellValue('V1', 'Religion: *');
        $sheet->setCellValue('W1', 'Languages: *');
		$sheet->setCellValue('X1', 'Mother Tongue: *');
		$sheet->setCellValue('Y1', 'Marital Status: *');
        $sheet->setCellValue('Z1', 'Emergency Contact Person: *');
		$sheet->setCellValue('AA1', 'Spouse Name:');
		$sheet->setCellValue('AB1', 'No of Children:');
        $sheet->setCellValue('AC1', 'Blood Group: *');
		$sheet->setCellValue('AD1', 'Qualification: *');
		$sheet->setCellValue('AE1', 'Phone 1: *');
        $sheet->setCellValue('AF1', 'Phone 2:');
		$sheet->setCellValue('AG1', 'Email ID:');
		$sheet->setCellValue('AH1', 'Official Email ID:');
        $sheet->setCellValue('AI1', 'Enter Permanent Address: *');
		$sheet->setCellValue('AJ1', 'Enter Present Address: *');
		$sheet->setCellValue('AK1', 'Enter PAN Card No:');
        $sheet->setCellValue('AL1', 'Attach PAN:');
		$sheet->setCellValue('AM1', 'Enter Adhar Card No: *');
		$sheet->setCellValue('AN1', 'Attach Adhaar Card:');
        $sheet->setCellValue('AO1', 'Enter Driving License No:');
		$sheet->setCellValue('AP1', 'Attach Driving License:');
		$sheet->setCellValue('AQ1', 'Photo: *');
        $sheet->setCellValue('AR1', 'Resume: *');
		$sheet->setCellValue('AS1', 'Enter Bank Name:');
		$sheet->setCellValue('AT1', 'Attach Bank Document:');
        $sheet->setCellValue('AU1', 'Enter Bank Account No:');
		$sheet->setCellValue('AV1', 'Repeat Bank Account No:');
		$sheet->setCellValue('AW1', 'Enter Bank IFSC CODE:');
        $sheet->setCellValue('AX1', 'UAN No:');
		$sheet->setCellValue('AY1', 'ESIC No:');
		$sheet->setCellValue('AZ1', 'Status:');
        $sheet->setCellValue('BA1', 'Basic Salary: *');
		$sheet->setCellValue('BB1', 'HRA: *');
		$sheet->setCellValue('BC1', 'Conveyance: *');
        $sheet->setCellValue('BD1', 'Medical Reimbursement: *');
		$sheet->setCellValue('BE1', 'Special Allowance: *');
		$sheet->setCellValue('BF1', 'ST: *');
        $sheet->setCellValue('BG1', 'Other Allowance: *');
		$sheet->setCellValue('BH1', 'Gross Salary: *');
		$sheet->setCellValue('BI1', 'Employee PF : *');
        $sheet->setCellValue('BJ1', 'Employee ESIC : *');
		$sheet->setCellValue('BK1', 'PT: *');
		$sheet->setCellValue('BL1', 'Total Deduction: *');
        $sheet->setCellValue('BM1', 'Take Home Salary: *');
		$sheet->setCellValue('BN1', 'Employer PF : *');
		$sheet->setCellValue('BO1', 'Employer ESIC : *');
        $sheet->setCellValue('BP1', 'Mediclaim Insurance: *');
		$sheet->setCellValue('BQ1', 'Grand Total: *');
		$sheet->setCellValue('BR1', 'Attach Voter ID:');
        $sheet->setCellValue('BS1', 'Attach Employee Form:');
		$sheet->setCellValue('BT1', 'Education Certificate:');
		$sheet->setCellValue('BU1', 'PF Form / ESIC:');
        $sheet->setCellValue('BV1', 'Others:');
		$sheet->setCellValue('BW1', 'Payslip:');
		$sheet->setCellValue('BX1', 'Exp Letter:');
        $sheet->setCellValue('BY1', 'Password: *');
		$sheet->setCellValue('BZ1', 'Active Status: *');

		foreach(range('A','BZ') as $columnID) {
			$sheet->getColumnDimension($columnID)
				->setAutoSize(true);
		}
		
        $writer = new Xlsx($spreadsheet);
        $filename = 'DOC_FORMAT';
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
}
