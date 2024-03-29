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
			$data['client_management'] = $this->back_end->get_all_clients();
			//  $data['backend_team']=$this->back_end->get_all_backend_team();
			$this->load->view('admin/back_end/backend_team/index', $data);
			//get_all_data();
		}
	}
	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->back_end->make_datatables();

			$data = array();
			$status = '<span class="badge bg-blue">Completed</span>';
			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
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
				$active_status="";
				if ($row->status == 1) {
					$status = '<span class="badge bg-danger">Inactive</span>';
				} else if ($row->status == 0) {
					$status = '<span class="badge bg-green">Active</span>';
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
							 <a href="javascript:void(0);" id="' . $row->ffi_emp_id . '" onclick="delete_backend_team(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						 </div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
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
		$id = $this->input->post('id', true);
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
								<p><b>FFI EMP ID :</b> <span>' . $data[0]['ffi_emp_id'].'</span></p>
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
								
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 2 :</b> <span>' . ucwords($data[0]['phone2']) . '</span></p>
								<p><b>Present Address :</b> <span>' . ucwords($data[0]['present_address']) . '</span></p>
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>' .$data[0]['email'] . '</span></p>	
								<p><b>Permanent Address:</b> <span>' . ucwords($data[0]['permanent_address']) . '</span></p>	
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
						<div class="col-md-4 col-sm-6">
							<p><b>Basic Salary :</b> Rs.<span>' . ucwords($data[0]['basic_salary']) . '</span></p>
							<p><b>Medical Reimbursement :</b> Rs.<span>' . ucwords($data[0]['medical_reimbursement']) . '</span></p> 
							<p><b>Special Allowance :</b> Rs.<span>' . ucwords($data[0]['special_allowance']) . '</span></p>
							<p><b>Employee PF (12%) :</b> Rs.<span>' . ucwords($data[0]['emp_pf']) . '</span></p>
							<p><b>Employer PF :</b> Rs.<span>' . ucwords($data[0]['employer_pf']) . '</span></p>
							<p><b>Grand Total :</b> Rs.<span>' . ucwords($data[0]['ctc']) . ' </span></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<p><b>HRA :</b> Rs.<span>' . ucwords($data[0]['hra']) . '</span></p>
							<p><b>Gross Salary :</b> Rs.<span>' . ucwords($data[0]['gross_salary']) . ' </span></p>
							<p><b>ST Bonus :</b> Rs.<span>' . ucwords($data[0]['st_bonus']) . '</span></p>
							<p><b>Employee ESIC  (1.75%) :</b> Rs.<span>' . ucwords($data[0]['emp_esic']) . '</span></p>
							<p><b>Employer ESIC  :</b> Rs.<span>' . ucwords($data[0]['employer_esic']) . '</span></p>
							<p><b>Take Home Salary :</b> Rs.<span>' . ucwords($data[0]['take_home']) . ' </span></p>
							
						</div>
						<div class="col-md-4 col-sm-6">
							<p><b>Conveyance :</b> Rs.<span>' . ucwords($data[0]['conveyance']) . '</span></p>
							<p><b>Total Deduction :</b> Rs.<span>' . ucwords($data[0]['total_deduction']) . ' </span></p>
							<p><b>Other Allowance :</b> Rs.<span>' . ucwords($data[0]['other_allowance']) . '</span></p>
							<p><b>PT :</b> Rs.<span>' . ucwords($data[0]['pt']) . '</span></p>
							<p><b>Mediclaim Insurance :</b> Rs.<span>' . ucwords($data[0]['mediclaim']) . '</span></p>
							
							
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
			try{
			
			$date = date('y-m-d-his');
			$spreadsheet = new Spreadsheet();
			$spreadsheet->createSheet();
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->setTitle('BackEnd Team Details');
			$sheet->getColumnDimension('A')->setAutoSize(true);
			$sheet->getColumnDimension('B')->setAutoSize(true);
			$sheet->getColumnDimension('C')->setAutoSize(true);
			$sheet->getColumnDimension('D')->setAutoSize(true);
			$sheet->getColumnDimension('E')->setAutoSize(true);
			$sheet->getColumnDimension('F')->setAutoSize(true);
			$sheet->getColumnDimension('G')->setAutoSize(true);
			$sheet->getColumnDimension('H')->setAutoSize(true);
			$sheet->getColumnDimension('I')->setAutoSize(true);
			$sheet->getColumnDimension('J')->setAutoSize(true);
			$sheet->getColumnDimension('K')->setAutoSize(true);
			$sheet->getColumnDimension('L')->setAutoSize(true);
			$sheet->getColumnDimension('M')->setAutoSize(true);
			$sheet->getColumnDimension('N')->setAutoSize(true);
			$sheet->getColumnDimension('O')->setAutoSize(true);
			$sheet->getColumnDimension('P')->setAutoSize(true);
			$sheet->getColumnDimension('Q')->setAutoSize(true);
			$sheet->getColumnDimension('R')->setAutoSize(true);
			$sheet->getColumnDimension('S')->setAutoSize(true);
			$sheet->getColumnDimension('T')->setAutoSize(true);
			$sheet->getColumnDimension('U')->setAutoSize(true);
			$sheet->getColumnDimension('V')->setAutoSize(true);
			$sheet->getColumnDimension('W')->setAutoSize(true);
			$sheet->getColumnDimension('X')->setAutoSize(true);
			$sheet->getColumnDimension('Y')->setAutoSize(true);
			$sheet->getColumnDimension('Z')->setAutoSize(true);
			$sheet->getColumnDimension('AA')->setAutoSize(true);
			$sheet->getColumnDimension('AB')->setAutoSize(true);
			$sheet->getColumnDimension('AC')->setAutoSize(true);
			$sheet->getColumnDimension('AD')->setAutoSize(true);
			$sheet->getColumnDimension('AE')->setAutoSize(true);
			$sheet->getColumnDimension('AF')->setAutoSize(true);
			$sheet->getColumnDimension('AG')->setAutoSize(true);
			$sheet->getColumnDimension('AH')->setAutoSize(true);
			$sheet->getColumnDimension('AI')->setAutoSize(true);
			$sheet->getColumnDimension('AJ')->setAutoSize(true);
			$sheet->getColumnDimension('AK')->setAutoSize(true);
			$sheet->getColumnDimension('AL')->setAutoSize(true);
			$sheet->getColumnDimension('AM')->setAutoSize(true);
			$sheet->getColumnDimension('AN')->setAutoSize(true);
			$sheet->getColumnDimension('AO')->setAutoSize(true);
			$sheet->getColumnDimension('AP')->setAutoSize(true);
			$sheet->getColumnDimension('AQ')->setAutoSize(true);
			$sheet->getColumnDimension('AR')->setAutoSize(true);
			$sheet->getColumnDimension('AS')->setAutoSize(true);
			$sheet->getColumnDimension('AT')->setAutoSize(true);
			$sheet->getColumnDimension('AU')->setAutoSize(true);
			$sheet->getColumnDimension('AV')->setAutoSize(true);
			$sheet->getColumnDimension('AW')->setAutoSize(true);
			$sheet->getColumnDimension('AX')->setAutoSize(true);
			$sheet->getColumnDimension('AY')->setAutoSize(true);
			$sheet->getColumnDimension('AZ')->setAutoSize(true);
			$sheet->getColumnDimension('BA')->setAutoSize(true);
			$sheet->getColumnDimension('BB')->setAutoSize(true);
			$sheet->getColumnDimension('BC')->setAutoSize(true);
			$sheet->getColumnDimension('BD')->setAutoSize(true);
			$sheet->getColumnDimension('BE')->setAutoSize(true);
			$sheet->getColumnDimension('BF')->setAutoSize(true);
			$sheet->getColumnDimension('BG')->setAutoSize(true);
			$sheet->getColumnDimension('BH')->setAutoSize(true);
			$sheet->getColumnDimension('BI')->setAutoSize(true);
			$sheet->getColumnDimension('BJ')->setAutoSize(true);
			$sheet->getColumnDimension('BK')->setAutoSize(true);
			$sheet->getColumnDimension('BL')->setAutoSize(true);
			$sheet->getColumnDimension('BM')->setAutoSize(true);
			$sheet->getColumnDimension('BN')->setAutoSize(true);
			$sheet->getColumnDimension('BO')->setAutoSize(true);
			$sheet->getColumnDimension('BP')->setAutoSize(true);
			// $sheet->getColumnDimension('BQ')->setAutoSize(true);
			// $sheet->getColumnDimension('BR')->setAutoSize(true);
			// $sheet->getColumnDimension('BS')->setAutoSize(true);


			$sheet->getStyle("A1:BP1")->applyFromArray(array("font" => array("bold" => true)));
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
			//$sheet->setCellValue('AL1', 'Attach PAN:');
			$sheet->setCellValue('AL1', 'Enter Adhar Card No: *');
			//$sheet->setCellValue('AN1', 'Attach Adhaar Card:');
			$sheet->setCellValue('AM1', 'Enter Driving License No:');
			//$sheet->setCellValue('AP1', 'Attach Driving License:');
			//$sheet->setCellValue('AQ1', 'Photo: *');
			//$sheet->setCellValue('AR1', 'Resume: *');
			$sheet->setCellValue('AN1', 'Enter Bank Name:');
			//$sheet->setCellValue('AT1', 'Attach Bank Document:');
			$sheet->setCellValue('AO1', 'Enter Bank Account No:');
			//$sheet->setCellValue('AV1', 'Repeat Bank Account No:');
			$sheet->setCellValue('AP1', 'Enter Bank IFSC CODE:');
			$sheet->setCellValue('AQ1', 'UAN No:');
			$sheet->setCellValue('AR1', 'ESIC No:');
			$sheet->setCellValue('AS1', 'Status:');
			$sheet->setCellValue('AT1', 'Basic Salary: *');
			$sheet->setCellValue('AU1', 'HRA: *');
			$sheet->setCellValue('AV1', 'Conveyance: *');
			$sheet->setCellValue('AW1', 'Medical Reimbursement: *');
			$sheet->setCellValue('AX1', 'Special Allowance: *');
			$sheet->setCellValue('AY1', 'ST: *');
			$sheet->setCellValue('AZ1', 'Other Allowance: *');
			$sheet->setCellValue('BA1', 'Gross Salary: *');
			$sheet->setCellValue('BB1', 'Employee PF : *');
			$sheet->setCellValue('BC1', 'Employee ESIC : *');
			$sheet->setCellValue('BD1', 'PT: *');
			$sheet->setCellValue('BE1', 'Total Deduction: *');
			$sheet->setCellValue('BF1', 'Take Home Salary: *');
			$sheet->setCellValue('BG1', 'Employer PF : *');
			$sheet->setCellValue('BH1', 'Employer ESIC : *');
			$sheet->setCellValue('BI1', 'Mediclaim Insurance: *');

			$sheet->setCellValue('BJ1', 'Ctc: *');
			$sheet->setCellValue('BK1', 'Voter ID:');
			//$sheet->setCellValue('BK1', 'Attach Employee Form:');
			//$sheet->setCellValue('BM1', 'Education Certificate:');
			$sheet->setCellValue('BL1', 'PF Form / ESIC:');
			//$sheet->setCellValue('BO1', 'Others:');
			$sheet->setCellValue('BM1', 'Payslip:');
			$sheet->setCellValue('BN1', 'Exp Letter:');
			$sheet->setCellValue('BO1', 'Password: *');
			$sheet->setCellValue('BP1', 'Active Status: *');

			/**************************************************************************************************************************/
			$n = 2;
			$i = 1;
			$data = $this->back_end->get_all_backend_team_for_download();
			if (!empty($data)) {
				$client = $this->input->post('backend_download_client', true);

				foreach ($data as $key => $row) {
					if (!empty($client)) {

						$path = 'dcs/dcs_' . $data[0]['client_name'] . '_' . $date;
					} else {

						$path = 'dcs/dcs_' . $date;
					}
					if (!is_dir($path)) mkdir($path, 0777, TRUE);
					$interview_date = "";
					$joining_date = "";
					$contract_date = "";
					$dob = "";
					$gender = "";
					$status = "";
					// $row=$row[$key];
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
					if ($row['active_status'] == 0) {
						$status1 = "Active";
					} else if ($row['active_status'] == 1) {
						$status1 = "Deactive";
					}
					if ($row['status'] == 0) {
						$status = "Active";
					} else if ($row['status'] == 1) {
						$status = "Inactive";
					}
					$sheet->setCellValue('A' . $n, $row['entity_name']);
					$sheet->setCellValue('B' . $n, $row['client_name']);
					$sheet->setCellValue('C' . $n, $row['ffi_emp_id']);
					$sheet->setCellValue('D' . $n, $row['console_id']);
					$sheet->setCellValue('E' . $n, $row['client_emp_id']);
					$sheet->setCellValue('F' . $n, $row['grade']);
					$sheet->setCellValue('G' . $n, $row['emp_name']);
					$sheet->setCellValue('H' . $n, $row['middle_name']);
					$sheet->setCellValue('I' . $n, $row['last_name']);
					$sheet->setCellValue('J' . $n, $joining_date);
					$sheet->setCellValue('K' . $n, $interview_date);
					$sheet->setCellValue('L' . $n, $contract_date);
					$sheet->setCellValue('M' . $n, $row['designation']);
					$sheet->setCellValue('N' . $n, $row['department']);
					$sheet->setCellValue('O' . $n, $row['state_name']);
					$sheet->setCellValue('P' . $n, $row['location']);
					$sheet->setCellValue('Q' . $n, $row['branch']);
					$sheet->setCellValue('R' . $n, $dob);
					$sheet->setCellValue('S' . $n, $gender);
					$sheet->setCellValue('T' . $n, $row['father_name']);
					$sheet->setCellValue('U' . $n, $row['mother_name']);
					$sheet->setCellValue('V' . $n, $row['religion']);
					$sheet->setCellValue('W' . $n, $row['languages']);
					$sheet->setCellValue('X' . $n, $row['mother_tongue']);
					$sheet->setCellValue('Y' . $n, $row['maritial_status']);

					$sheet->setCellValue('Z' . $n, $row['emer_contact_no']);
					$sheet->setCellValue('AA' . $n, $row['spouse_name']);
					$sheet->setCellValue('AB' . $n, $row['no_of_childrens']);
					$sheet->setCellValue('AC' . $n, $row['blood_group']);
					$sheet->setCellValue('AD' . $n, $row['qualification']);
					$sheet->setCellValue('AE' . $n, $row['phone1']);
					$sheet->setCellValue('AF' . $n, $row['phone2']);
					$sheet->setCellValue('AG' . $n, $row['email']);
					$sheet->setCellValue('AH' . $n, $row['official_mail_id']);
					$sheet->setCellValue('AI' . $n, $row['permanent_address']);
					$sheet->setCellValue('AJ' . $n, $row['present_address']);
					$sheet->setCellValue('AK' . $n, $row['pan_no']);
					$sheet->setCellValue('AL' . $n, $row['aadhar_no']);
					$sheet->setCellValue('AM' . $n, $row['driving_license_no']);
					$sheet->setCellValue('AN' . $n, $row['bank_name']);
					$sheet->setCellValue('AO' . $n, $row['bank_account_no']);
					$sheet->setCellValue('AP' . $n, $row['bank_ifsc_code']);
					$sheet->setCellValue('AQ' . $n, $row['uan_no']);
					$sheet->setCellValue('AR' . $n, $row['esic_no']);
					$sheet->setCellValue('AS' . $n, $row['status']);
					$sheet->setCellValue('AT' . $n, $row['basic_salary']);
					$sheet->setCellValue('AU' . $n, $row['hra']);
					$sheet->setCellValue('AV' . $n, $row['conveyance']);
					$sheet->setCellValue('AW' . $n, $row['medical_reimbursement']);
					$sheet->setCellValue('AX' . $n, $row['special_allowance']);
					$sheet->setCellValue('AY' . $n, $row['st_bonus']);
					$sheet->setCellValue('AZ' . $n, $row['other_allowance']);
					$sheet->setCellValue('BA' . $n, $row['gross_salary']);
					$sheet->setCellValue('BB' . $n, $row['emp_pf']);
					$sheet->setCellValue('BC' . $n, $row['emp_esic']);
					$sheet->setCellValue('BD' . $n, $row['pt']);
					$sheet->setCellValue('BE' . $n, $row['total_deduction']);
					$sheet->setCellValue('BF' . $n, $row['take_home']);
					$sheet->setCellValue('BG' . $n, $row['employer_pf']);
					$sheet->setCellValue('BH' . $n, $row['employer_esic']);
					$sheet->setCellValue('BI' . $n, $row['mediclaim']);
					$sheet->setCellValue('BJ' . $n, $row['ctc']);
					$sheet->setCellValue('BK' . $n, $row['voter_id']);
					$sheet->setCellValue('BL' . $n, $row['pf_esic_form']);
					$sheet->setCellValue('BM' . $n, $row['payslip']);
					$sheet->setCellValue('BN' . $n, $row['exp_letter']);
					$sheet->setCellValue('BO' . $n, $row['password']);
					$sheet->setCellValue('BP' . $n, $status);
					// $sheet->setCellValue('BQ' . $n, $row['location']);
					// $sheet->setCellValue('BR' . $n, $row['branch']);
					// $sheet->setCellValue('BS' . $n, $dob);

					$i++;
					$n++;
				}
				/**************************************************************************************************************************/
				$objWriter =  new Xlsx($spreadsheet);
				$filename = 'BackEnd_Details_' . $date . '.xlsx';

				$objWriter->save($path . "/" . $filename);

				$this->load->library('zip');
				$log_file='';
				
				$wrong_path=0;
				foreach ($data as $key => $row) {
					$zip_data = array(
						$row['bank_document'],
						$row['emp_form'],
						$row['exp_letter'],
						$row['driving_license_path'],
						$row['pan_path'],
						$row['payslip'],
						$row['pf_esic_form'],
						$row['photo'],
						$row['resume'],
						$row['voter_id'],
						$row['aadhar_path'],

					);

					$education_certificate = $this->back_end->get_education_details($row['ffi_emp_id']);
					foreach ($education_certificate as $key => $r)
					 {
						array_push($zip_data,$r['path']);
					}

					$other_certificate = $this->back_end->get_other_certificate_details($row['ffi_emp_id']);
					
					foreach ($other_certificate as $key => $r1) {

						array_push($zip_data,$r1['path']);
				}
				// if($row['ffi_emp_id']=="FFI006")
				// {
				// 	echo"<pre>";
				// 	print_r($zip_data);
				// 	exit;
				// }
				
					$correct_path=0;
					foreach ($zip_data as $key => $row1) {
						
						if (file_exists($row1)) {
							
							$size    = filesize($row1)/1024;
							if($size<=500)
							{
								$this->zip->read_file($row1);
								$correct_path++;
							}
							else{
								$arr=explode('/',$row1);
								$file_name=end($arr);
								$txt = "[Emp_id=>".$row['ffi_emp_id']."]-[File name=>".$file_name."]-[File path=>".$row1."]\r\n\n";
								$log_file .= $txt;
								$wrong_path++;
							}
						}
					}
					if($correct_path>0){
					$this->zip->archive($path . '/' . $row['ffi_emp_id'] . '_' . $row['emp_name'] . '.zip');
					$this->zip->clear_data();
					}
					
				}
				if($wrong_path>0){
				$myfile = fopen($path."/dcs_log_file.txt", "w");
				fwrite($myfile, $log_file);
				fclose($myfile);
				}
				// $this->zip->clear_data();
				$this->zip->read_dir($path, false);
				$download = $this->zip->download($path . '.zip');
			
				redirect('backend_team/');
			} else {
				$this->session->set_flashdata('no_data', 'No datas founded');
				redirect('backend_team/', 'refresh');
			}
		}
		catch(Exception $e) {
			$this->session->set_flashdata('take_time', 'Large size');
				redirect('backend_team/', 'refresh');

		}
		} else {
			redirect('home/index');
		}
	}

	
	function delete_backend_team()
	{
		if ($this->back_end->delete_backend_team()) {
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
			$valid_extentions = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			$extension = pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION);
			$content_type = mime_content_type($_FILES['import']['tmp_name']);
			$valid = false;
			foreach ($valid_extentions as $key => $value) {
				if ($content_type == $value) {
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
				$insert = 0;
				$update = 0;
				$nochanges = 0;
				$not_imported =array();
				$not_imported_count=0;
				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$data['backend'] = array(
						"entity_name"			=> (empty($allDataInSheet[$i]['A']) ? '' : $allDataInSheet[$i]['A']),
						"client_id"				=> (empty($allDataInSheet[$i]['CA']) ? '' : $allDataInSheet[$i]['CA']),
						"ffi_emp_id"			=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"console_id"			=> (empty($allDataInSheet[$i]['D']) ? '' : $allDataInSheet[$i]['D']),
						"client_emp_id"			=> (empty($allDataInSheet[$i]['E']) ? '' : $allDataInSheet[$i]['E']),
						"grade"					=> (empty($allDataInSheet[$i]['F']) ? '' : $allDataInSheet[$i]['F']),
						"emp_name"				=> (empty($allDataInSheet[$i]['G']) ? '' : $allDataInSheet[$i]['G']),
						"middle_name"			=> (empty($allDataInSheet[$i]['H']) ? '' : $allDataInSheet[$i]['H']),
						"last_name"				=> (empty($allDataInSheet[$i]['I']) ? '' : $allDataInSheet[$i]['I']),
						"interview_date"		=> (empty($allDataInSheet[$i]['J']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['J']))),
						"joining_date"			=> (empty($allDataInSheet[$i]['K']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['K']))),
						"contract_date"			=> (empty($allDataInSheet[$i]['L']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['L']))),
						"designation"			=> (empty($allDataInSheet[$i]['M']) ? '' : $allDataInSheet[$i]['M']),
						"department"			=> (empty($allDataInSheet[$i]['N']) ? '' : $allDataInSheet[$i]['N']),
						"state"					=> (empty($allDataInSheet[$i]['CB']) ? '' : $allDataInSheet[$i]['CB']),
						"location"				=> (empty($allDataInSheet[$i]['P']) ? '' : $allDataInSheet[$i]['P']),
						"branch"				=> (empty($allDataInSheet[$i]['Q']) ? '' : $allDataInSheet[$i]['Q']),
						"dob"					=> (empty($allDataInSheet[$i]['R']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['R']))),
						"gender"				=> (empty($allDataInSheet[$i]['CC']) ? '' : $allDataInSheet[$i]['CC']),
						"father_name"			=> (empty($allDataInSheet[$i]['T']) ? '' : $allDataInSheet[$i]['T']),
						"mother_name"			=> (empty($allDataInSheet[$i]['U']) ? '' : $allDataInSheet[$i]['U']),
						"religion"				=> (empty($allDataInSheet[$i]['V']) ? '' : $allDataInSheet[$i]['V']),
						"languages"				=> (empty($allDataInSheet[$i]['W']) ? '' : $allDataInSheet[$i]['W']),
						"mother_tongue"			=> (empty($allDataInSheet[$i]['X']) ? '' : $allDataInSheet[$i]['X']),
						"maritial_status"		=> (empty($allDataInSheet[$i]['Y']) ? '' : $allDataInSheet[$i]['Y']),
						"emer_contact_no"		=> (empty($allDataInSheet[$i]['Z']) ? '' : $allDataInSheet[$i]['Z']),
						"spouse_name"			=> (empty($allDataInSheet[$i]['AA']) ? '' : $allDataInSheet[$i]['AA']),
						"no_of_childrens"		=> (empty($allDataInSheet[$i]['AB']) ? '' : $allDataInSheet[$i]['AB']),
						"blood_group"			=> (empty($allDataInSheet[$i]['AC']) ? '' : $allDataInSheet[$i]['AC']),
						"qualification"			=> (empty($allDataInSheet[$i]['AD']) ? '' : $allDataInSheet[$i]['AD']),
						"phone1"				=> (empty($allDataInSheet[$i]['AE']) ? '' : $allDataInSheet[$i]['AE']),
						"phone2"				=> (empty($allDataInSheet[$i]['AF']) ? '' : $allDataInSheet[$i]['AF']),
						"email"					=> (empty($allDataInSheet[$i]['AG']) ? '' : $allDataInSheet[$i]['AG']),
						"official_mail_id"		=> (empty($allDataInSheet[$i]['AH']) ? '' : $allDataInSheet[$i]['AH']),
						"permanent_address"		=> (empty($allDataInSheet[$i]['AI']) ? '' : $allDataInSheet[$i]['AI']),
						"present_address"		=> (empty($allDataInSheet[$i]['AJ']) ? '' : $allDataInSheet[$i]['AJ']),
						"pan_no"				=> (empty($allDataInSheet[$i]['AK']) ? '' : $allDataInSheet[$i]['AK']),
						"pan_path"				=> (empty($allDataInSheet[$i]['AL']) ? '' : $allDataInSheet[$i]['AL']),
						"aadhar_no"				=> (empty($allDataInSheet[$i]['AM']) ? '' : $allDataInSheet[$i]['AM']),
						"aadhar_path"			=> (empty($allDataInSheet[$i]['AN']) ? '' : $allDataInSheet[$i]['AN']),
						"driving_license_no"	=> (empty($allDataInSheet[$i]['AO']) ? '' : $allDataInSheet[$i]['AO']),
						"driving_license_path"	=> (empty($allDataInSheet[$i]['AP']) ? '' : $allDataInSheet[$i]['AP']),
						"photo"					=> (empty($allDataInSheet[$i]['AQ']) ? '' : $allDataInSheet[$i]['AQ']),
						"resume"				=> (empty($allDataInSheet[$i]['AR']) ? '' : $allDataInSheet[$i]['AR']),
						"bank_name"				=> (empty($allDataInSheet[$i]['AS']) ? '' : $allDataInSheet[$i]['AS']),
						"bank_document"			=> (empty($allDataInSheet[$i]['AT']) ? '' : $allDataInSheet[$i]['AT']),
						"bank_account_no"		=> (empty($allDataInSheet[$i]['AU']) ? '' : $allDataInSheet[$i]['AU']),
						"bank_ifsc_code"		=> (empty($allDataInSheet[$i]['AV']) ? '' : $allDataInSheet[$i]['AV']),
						"uan_no"				=> (empty($allDataInSheet[$i]['AW']) ? '' : $allDataInSheet[$i]['AW']),
						"esic_no"				=> (empty($allDataInSheet[$i]['AX']) ? '' : $allDataInSheet[$i]['AX']),
						"status"				=> (empty($allDataInSheet[$i]['CD']) ? '' : $allDataInSheet[$i]['CD']),
						"basic_salary"			=> (empty($allDataInSheet[$i]['AZ']) ? '' : $allDataInSheet[$i]['AZ']),
						"hra"					=> (empty($allDataInSheet[$i]['BA']) ? '' : $allDataInSheet[$i]['BA']),
						"conveyance"			=> (empty($allDataInSheet[$i]['BB']) ? '' : $allDataInSheet[$i]['BB']),
						"medical_reimbursement"	=> (empty($allDataInSheet[$i]['BC']) ? '' : $allDataInSheet[$i]['BC']),
						"special_allowance"		=> (empty($allDataInSheet[$i]['BD']) ? '' : $allDataInSheet[$i]['BD']),
						"st_bonus"				=> (empty($allDataInSheet[$i]['BE']) ? '' : $allDataInSheet[$i]['BE']),
						"other_allowance"		=> (empty($allDataInSheet[$i]['BF']) ? '' : $allDataInSheet[$i]['BF']),
						"gross_salary"			=> (empty($allDataInSheet[$i]['BG']) ? '' : $allDataInSheet[$i]['BG']),
						"emp_pf"				=> (empty($allDataInSheet[$i]['BH']) ? '' : $allDataInSheet[$i]['BH']),
						"emp_esic"				=> (empty($allDataInSheet[$i]['BI']) ? '' : $allDataInSheet[$i]['BI']),
						"pt"					=> (empty($allDataInSheet[$i]['BJ']) ? '' : $allDataInSheet[$i]['BJ']),
						"total_deduction"		=> (empty($allDataInSheet[$i]['BK']) ? '' : $allDataInSheet[$i]['BK']),
						"take_home"				=> (empty($allDataInSheet[$i]['BL']) ? '' : $allDataInSheet[$i]['BL']),
						"employer_pf"			=> (empty($allDataInSheet[$i]['BM']) ? '' : $allDataInSheet[$i]['BM']),
						"employer_esic"			=> (empty($allDataInSheet[$i]['BN']) ? '' : $allDataInSheet[$i]['BN']),
						"mediclaim"				=> (empty($allDataInSheet[$i]['BO']) ? '' : $allDataInSheet[$i]['BO']),
						"ctc"					=> (empty($allDataInSheet[$i]['BP']) ? '' : $allDataInSheet[$i]['BP']),
						"voter_id"				=> (empty($allDataInSheet[$i]['BQ']) ? '' : $allDataInSheet[$i]['BQ']),
						"emp_form"				=> (empty($allDataInSheet[$i]['BR']) ? '' : $allDataInSheet[$i]['BR']),
						"pf_esic_form"			=> (empty($allDataInSheet[$i]['BT']) ? '' : $allDataInSheet[$i]['BT']),
						"payslip"				=> (empty($allDataInSheet[$i]['BV']) ? '' : $allDataInSheet[$i]['BV']),
						"exp_letter"			=> (empty($allDataInSheet[$i]['BW']) ? '' : $allDataInSheet[$i]['BW']),
						"password"				=> md5(empty($allDataInSheet[$i]['BX']) ? '' : $allDataInSheet[$i]['BX']),
						"psd"					=> (empty($allDataInSheet[$i]['BX']) ? '' : $allDataInSheet[$i]['BX']),
						"active_status"			=> (empty($allDataInSheet[$i]['CE']) ? '' : $allDataInSheet[$i]['CE']),
						"data_status"			=> (empty($allDataInSheet[$i]['CF']) ? '' : $allDataInSheet[$i]['CF']),
						"dcs_approval"			=> (empty($allDataInSheet[$i]['CJ']) ? '' : $allDataInSheet[$i]['CJ']),

						// 'modified_date'			=>	date('Y-m-d H:i:s')
					);

					$data['reference_id'] = array(
						"client_name"		=> (empty($allDataInSheet[$i]['B']) ? '' : $allDataInSheet[$i]['B']),
						"state_name"		=> (empty($allDataInSheet[$i]['O']) ? '' : $allDataInSheet[$i]['O']),
						"gender_name"		=> (empty($allDataInSheet[$i]['S']) ? '' : $allDataInSheet[$i]['S']),
						"status_name"		=> (empty($allDataInSheet[$i]['AY']) ? '' : $allDataInSheet[$i]['AY']),
						"active_status_name"=> (empty($allDataInSheet[$i]['BY']) ? '' : $allDataInSheet[$i]['BY']),
						"data_status_name"	=> (empty($allDataInSheet[$i]['BZ']) ? '' : $allDataInSheet[$i]['BZ']),
						"dcs_approval_name"	=> (empty($allDataInSheet[$i]['CI']) ? '' : $allDataInSheet[$i]['CI']),
					);


					$data['education_certificate'] = array(
						"emp_id"	=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"path"		=> (empty($allDataInSheet[$i]['BS']) ? '' : $allDataInSheet[$i]['BS'])
					);
					$data['education_certificate_excel'] = array(
						"emp_id1"	=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"path1"		=> (empty($allDataInSheet[$i]['BS']) ? '' : $allDataInSheet[$i]['BS'])
					);

					$data['other_certificate'] = array(
						"emp_id"	=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"path"		=> (empty($allDataInSheet[$i]['BU']) ? '' : $allDataInSheet[$i]['BU']),
					);
					$data['other_certificate_excel'] = array(
						"emp_id2"	=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"path2"		=> (empty($allDataInSheet[$i]['BU']) ? '' : $allDataInSheet[$i]['BU']),
					);

					if ($data['backend']['emp_name'] != '' || !empty($data['backend']['emp_name'])) {
						if ($import_status = $this->back_end->importEmployee($data)) {

							if ($import_status == "insert") {
								$insert = $insert + 1;
							} else if ($import_status == "update") {
								$update = $update + 1;
							} else if ($import_status == "nochanges") {
								$nochanges = $nochanges + 1;
							}
						}
						
					}
					else{
					
						$not_imported[]=array_merge($data['backend'],$data['education_certificate_excel'],$data['other_certificate_excel'],$data['reference_id']);
						$not_imported_count=$not_imported_count+1;
						
					}
				}
				// echo "<pre>";
				// print_r($not_imported_count);
				// print_r($not_imported);
				// exit;
				if($not_imported_count>0)
				{
					try{
					
						// $spreadsheet1 = new Spreadsheet();
						$spreadsheet1 = new Spreadsheet();
						$spreadsheet1->createSheet();
						$spreadsheet1->setActiveSheetIndex(0);
						$sheet = $spreadsheet1->getActiveSheet();
						
						$sheet->setTitle('BackEnd Team Details');
						$sheet->getColumnDimension('A')->setAutoSize(true);
						$sheet->getColumnDimension('B')->setAutoSize(true);
						$sheet->getColumnDimension('C')->setAutoSize(true);
						$sheet->getColumnDimension('D')->setAutoSize(true);
						$sheet->getColumnDimension('E')->setAutoSize(true);
						$sheet->getColumnDimension('F')->setAutoSize(true);
						$sheet->getColumnDimension('G')->setAutoSize(true);
						$sheet->getColumnDimension('H')->setAutoSize(true);
						$sheet->getColumnDimension('I')->setAutoSize(true);
						$sheet->getColumnDimension('J')->setAutoSize(true);
						$sheet->getColumnDimension('K')->setAutoSize(true);
						$sheet->getColumnDimension('L')->setAutoSize(true);
						$sheet->getColumnDimension('M')->setAutoSize(true);
						$sheet->getColumnDimension('N')->setAutoSize(true);
						$sheet->getColumnDimension('O')->setAutoSize(true);
						$sheet->getColumnDimension('P')->setAutoSize(true);
						$sheet->getColumnDimension('Q')->setAutoSize(true);
						$sheet->getColumnDimension('R')->setAutoSize(true);
						$sheet->getColumnDimension('S')->setAutoSize(true);
						$sheet->getColumnDimension('T')->setAutoSize(true);
						$sheet->getColumnDimension('U')->setAutoSize(true);
						$sheet->getColumnDimension('V')->setAutoSize(true);
						$sheet->getColumnDimension('W')->setAutoSize(true);
						$sheet->getColumnDimension('X')->setAutoSize(true);
						$sheet->getColumnDimension('Y')->setAutoSize(true);
						$sheet->getColumnDimension('Z')->setAutoSize(true);
						$sheet->getColumnDimension('AA')->setAutoSize(true);
						$sheet->getColumnDimension('AB')->setAutoSize(true);
						$sheet->getColumnDimension('AC')->setAutoSize(true);
						$sheet->getColumnDimension('AD')->setAutoSize(true);
						$sheet->getColumnDimension('AE')->setAutoSize(true);
						$sheet->getColumnDimension('AF')->setAutoSize(true);
						$sheet->getColumnDimension('AG')->setAutoSize(true);
						$sheet->getColumnDimension('AH')->setAutoSize(true);
						$sheet->getColumnDimension('AI')->setAutoSize(true);
						$sheet->getColumnDimension('AJ')->setAutoSize(true);
						$sheet->getColumnDimension('AK')->setAutoSize(true);
						$sheet->getColumnDimension('AL')->setAutoSize(true);
						$sheet->getColumnDimension('AM')->setAutoSize(true);
						$sheet->getColumnDimension('AN')->setAutoSize(true);
						$sheet->getColumnDimension('AO')->setAutoSize(true);
						$sheet->getColumnDimension('AP')->setAutoSize(true);
						$sheet->getColumnDimension('AQ')->setAutoSize(true);
						$sheet->getColumnDimension('AR')->setAutoSize(true);
						$sheet->getColumnDimension('AS')->setAutoSize(true);
						$sheet->getColumnDimension('AT')->setAutoSize(true);
						$sheet->getColumnDimension('AU')->setAutoSize(true);
						$sheet->getColumnDimension('AV')->setAutoSize(true);
						$sheet->getColumnDimension('AW')->setAutoSize(true);
						$sheet->getColumnDimension('AX')->setAutoSize(true);
						$sheet->getColumnDimension('AY')->setAutoSize(true);
						$sheet->getColumnDimension('AZ')->setAutoSize(true);
						$sheet->getColumnDimension('BA')->setAutoSize(true);
						$sheet->getColumnDimension('BB')->setAutoSize(true);
						$sheet->getColumnDimension('BC')->setAutoSize(true);
						$sheet->getColumnDimension('BD')->setAutoSize(true);
						$sheet->getColumnDimension('BE')->setAutoSize(true);
						$sheet->getColumnDimension('BF')->setAutoSize(true);
						$sheet->getColumnDimension('BG')->setAutoSize(true);
						$sheet->getColumnDimension('BH')->setAutoSize(true);
						$sheet->getColumnDimension('BI')->setAutoSize(true);
						$sheet->getColumnDimension('BJ')->setAutoSize(true);
						$sheet->getColumnDimension('BK')->setAutoSize(true);
						$sheet->getColumnDimension('BL')->setAutoSize(true);
						$sheet->getColumnDimension('BM')->setAutoSize(true);
						$sheet->getColumnDimension('BN')->setAutoSize(true);
						$sheet->getColumnDimension('BO')->setAutoSize(true);
						$sheet->getColumnDimension('BP')->setAutoSize(true);
						$sheet->getColumnDimension('BQ')->setAutoSize(true);
						$sheet->getColumnDimension('BR')->setAutoSize(true);
						$sheet->getColumnDimension('BS')->setAutoSize(true);
						$sheet->getColumnDimension('BT')->setAutoSize(true);
						$sheet->getColumnDimension('BU')->setAutoSize(true);
						$sheet->getColumnDimension('BV')->setAutoSize(true);
						$sheet->getColumnDimension('BW')->setAutoSize(true);
						$sheet->getColumnDimension('BX')->setAutoSize(true);
						$sheet->getColumnDimension('BY')->setAutoSize(true);
						$sheet->getColumnDimension('BZ')->setAutoSize(true);
						$sheet->getColumnDimension('CA')->setAutoSize(true);
						$sheet->getColumnDimension('CB')->setAutoSize(true);
						$sheet->getColumnDimension('CC')->setAutoSize(true);
						$sheet->getColumnDimension('CD')->setAutoSize(true);
						$sheet->getColumnDimension('CE')->setAutoSize(true);
						$sheet->getColumnDimension('CF')->setAutoSize(true);
						$sheet->getColumnDimension('CG')->setAutoSize(true);
						$sheet->getColumnDimension('CH')->setAutoSize(true);
						$sheet->getColumnDimension('CI')->setAutoSize(true);
						$sheet->getColumnDimension('CJ')->setAutoSize(true);
						$sheet->getColumnDimension('CK')->setAutoSize(true);
						
						
						$sheet->getStyle("A1:CK1")->applyFromArray(array("font" => array("bold" => true)));
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
						//$sheet->setCellValue('AV1', 'Repeat Bank Account No:');
						$sheet->setCellValue('AV1', 'Enter Bank IFSC CODE:');
						$sheet->setCellValue('AW1', 'UAN No:');
						$sheet->setCellValue('AX1', 'ESIC No:');
						$sheet->setCellValue('AY1', 'Status:');
						$sheet->setCellValue('AZ1', 'Basic Salary: *');
						$sheet->setCellValue('BA1', 'HRA: *');
						$sheet->setCellValue('BB1', 'Conveyance: *');
						$sheet->setCellValue('BC1', 'Medical Reimbursement: *');
						$sheet->setCellValue('BD1', 'Special Allowance: *');
						$sheet->setCellValue('BE1', 'ST: *');
						$sheet->setCellValue('BF1', 'Other Allowance: *');
						$sheet->setCellValue('BG1', 'Gross Salary: *');
						$sheet->setCellValue('BH1', 'Employee PF : *');
						$sheet->setCellValue('BI1', 'Employee ESIC : *');
						$sheet->setCellValue('BJ1', 'PT: *');
						$sheet->setCellValue('BK1', 'Total Deduction: *');
						$sheet->setCellValue('BL1', 'Take Home Salary: *');
						$sheet->setCellValue('BM1', 'Employer PF : *');
						$sheet->setCellValue('BN1', 'Employer ESIC : *');
						$sheet->setCellValue('BO1', 'Mediclaim Insurance: *');
						$sheet->setCellValue('BP1', 'Ctc: *');
						$sheet->setCellValue('BQ1', 'Voter ID:');
						$sheet->setCellValue('BR1', 'Attach Employee Form:');
						$sheet->setCellValue('BS1', 'Education Certificate:');
						$sheet->setCellValue('BT1', 'PF Form / ESIC:');
						$sheet->setCellValue('BU1', 'Others:');
						$sheet->setCellValue('BV1', 'Payslip:');
						$sheet->setCellValue('BW1', 'Exp Letter:');
						$sheet->setCellValue('BX1', 'Password: *');
						$sheet->setCellValue('BY1', 'Active Status: *');
						$sheet->setCellValue('BZ1', 'Data Status: *');
						$sheet->setCellValue('CA1', 'Client Id: *');
						$sheet->setCellValue('CB1', 'State Id: *');
						$sheet->setCellValue('CC1', 'Gender Id: *');
						$sheet->setCellValue('CD1', 'Status Id: *');
						$sheet->setCellValue('CE1', 'Active Status Id: *');
						$sheet->setCellValue('CF1', 'Data Status Id:*');
						$sheet->setCellValue('CI1', 'Data Approval: *');
						$sheet->setCellValue('CJ1', 'Data Approval Id: *');
						$sheet->setCellValue('CK1', 'Declaration');
			
						/**************************************************************************************************************************/
						
						
						if (!empty($not_imported)) {
							// echo "<pre>";
							// print_r($not_imported);
							// exit;

							$n = 2;
							$i = 1;
							foreach ($not_imported as $key => $row) {
							
								$sheet->setCellValue('A' . $n, $row['entity_name']);
								$sheet->setCellValue('B' . $n, $row['client_name']);
								$sheet->setCellValue('C' . $n, $row['ffi_emp_id']);
								$sheet->setCellValue('D' . $n, $row['console_id']);
								$sheet->setCellValue('E' . $n, $row['client_emp_id']);
								$sheet->setCellValue('F' . $n, $row['grade']);
								$sheet->setCellValue('G' . $n, $row['emp_name']);
								$sheet->setCellValue('H' . $n, $row['middle_name']);
								$sheet->setCellValue('I' . $n, $row['last_name']);
								$sheet->setCellValue('J' . $n, $row['interview_date']);
								$sheet->setCellValue('K' . $n, $row['joining_date']);
								$sheet->setCellValue('L' . $n, $row['contract_date']);
								$sheet->setCellValue('M' . $n, $row['designation']);
								$sheet->setCellValue('N' . $n, $row['department']);
								$sheet->setCellValue('O' . $n, $row['state_name']);
								$sheet->setCellValue('P' . $n, $row['location']);
								$sheet->setCellValue('Q' . $n, $row['branch']);
								$sheet->setCellValue('R' . $n, $row['dob']);
								$sheet->setCellValue('S' . $n, $row['gender_name']);
								$sheet->setCellValue('T' . $n, $row['father_name']);
								$sheet->setCellValue('U' . $n, $row['mother_name']);
								$sheet->setCellValue('V' . $n, $row['religion']);
								$sheet->setCellValue('W' . $n, $row['languages']);
								$sheet->setCellValue('X' . $n, $row['mother_tongue']);
								$sheet->setCellValue('Y' . $n, $row['maritial_status']);
								$sheet->setCellValue('Z' . $n, $row['emer_contact_no']);
								$sheet->setCellValue('AA' . $n, $row['spouse_name']);
								$sheet->setCellValue('AB' . $n, $row['no_of_childrens']);
								$sheet->setCellValue('AC' . $n, $row['blood_group']);
								$sheet->setCellValue('AD' . $n, $row['qualification']);
								$sheet->setCellValue('AE' . $n, $row['phone1']);
								$sheet->setCellValue('AF' . $n, $row['phone2']);
								$sheet->setCellValue('AG' . $n, $row['email']);
								$sheet->setCellValue('AH' . $n, $row['official_mail_id']);
								$sheet->setCellValue('AI' . $n, $row['permanent_address']);
								$sheet->setCellValue('AJ' . $n, $row['present_address']);
								$sheet->setCellValue('AK' . $n, $row['pan_no']);
								$sheet->setCellValue('AL' . $n, $row['pan_path']);
								$sheet->setCellValue('AM' . $n, $row['aadhar_no']);
								$sheet->setCellValue('AN' . $n, $row['aadhar_path']);
								$sheet->setCellValue('AO' . $n, $row['driving_license_no']);
								$sheet->setCellValue('AP' . $n, $row['driving_license_path']);
								$sheet->setCellValue('AQ' . $n, $row['photo']);
								$sheet->setCellValue('AR' . $n, $row['resume']);
								$sheet->setCellValue('AS' . $n, $row['bank_name']);
								$sheet->setCellValue('AT' . $n, $row['bank_document']);
								$sheet->setCellValue('AU' . $n, $row['bank_account_no']);
								$sheet->setCellValue('AV' . $n, $row['bank_ifsc_code']);
								$sheet->setCellValue('AW' . $n, $row['uan_no']);
								$sheet->setCellValue('AX' . $n, $row['esic_no']);
								$sheet->setCellValue('AY' . $n, $row['status_name']);
								$sheet->setCellValue('AZ' . $n, $row['basic_salary']);
								$sheet->setCellValue('BA' . $n, $row['hra']);
								$sheet->setCellValue('BB' . $n, $row['conveyance']);
								$sheet->setCellValue('BC' . $n, $row['medical_reimbursement']);
								$sheet->setCellValue('BD' . $n, $row['special_allowance']);
								$sheet->setCellValue('BE' . $n, $row['st_bonus']);
								$sheet->setCellValue('BF' . $n, $row['other_allowance']);
								$sheet->setCellValue('BG' . $n, $row['gross_salary']);
								$sheet->setCellValue('BH' . $n, $row['emp_pf']);
								$sheet->setCellValue('BI' . $n, $row['emp_esic']);
								$sheet->setCellValue('BJ' . $n, $row['pt']);
								$sheet->setCellValue('BK' . $n, $row['total_deduction']);
								$sheet->setCellValue('BL' . $n, $row['take_home']);
								$sheet->setCellValue('BM' . $n, $row['employer_pf']);
								$sheet->setCellValue('BN' . $n, $row['employer_esic']);
								$sheet->setCellValue('BO' . $n, $row['mediclaim']);
								$sheet->setCellValue('BP' . $n, $row['ctc']);
								$sheet->setCellValue('BQ' . $n, $row['voter_id']);
								$sheet->setCellValue('BR' . $n, $row['emp_form']);
								$sheet->setCellValue('BS' . $n, $row['path1']);
								$sheet->setCellValue('BT' . $n, $row['pf_esic_form']);
								$sheet->setCellValue('BU' . $n, $row['path2']);
								$sheet->setCellValue('BV' . $n, $row['payslip']);
								$sheet->setCellValue('BW' . $n, $row['exp_letter']);
								$sheet->setCellValue('BX' . $n, $row['psd']);
								$sheet->setCellValue('BY' . $n, $row['active_status_name']);
								$sheet->setCellValue('BZ' . $n, $row['data_status_name']);
								$sheet->setCellValue('CA' . $n, $row['client_id']);
								$sheet->setCellValue('CB' . $n, $row['state']);
								$sheet->setCellValue('CC' . $n, $row['gender']);
								$sheet->setCellValue('CD' . $n, $row['status']);
								$sheet->setCellValue('CE' . $n, $row['active_status']);
								$sheet->setCellValue('CF' . $n, $row['data_status']);
								$sheet->setCellValue('CI' . $n, $row['dcs_approval_name']);
								$sheet->setCellValue('CJ' . $n, $row['dcs_approval']);
								$sheet->setCellValue('CK' . $n, 'Enter employee name');
								
								// $sheet->setCellValue('BQ' . $n, $row['location']);
								// $sheet->setCellValue('BR' . $n, $row['branch']);
								// $sheet->setCellValue('BS' . $n, $dob);
			
								$i++;
								$n++;
								
							}
						// 	/**************************************************************************************************************************/
						// 	// echo "sdfds";
						// 	// 	exit;
							$date = date('y-m-d-his');
							$objWriter =  new Xlsx($spreadsheet1);
							// $filename = 'Backend_not_imported';
							$filename = 'Backend_not_imported_' . $date;
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
							header('Cache-Control: max-age=0');
							$objWriter->save('php://output'); // download file 
							
						} else {
							$this->session->set_flashdata('no_data', 'No datas founded');
							
						}

					}
					catch(Exception $e) {
						$this->session->set_flashdata('take_time', 'Large size');
					}
				}
				
				if ($insert > 0 || $update > 0) {
					$msg = "Imported successfully";

					$this->session->set_flashdata('success', $msg);
				}
				redirect('backend_team', 'refresh');
			} else {

				$this->session->set_flashdata('no_file', 'Please Choose Valid file formate ');
				redirect('backend_team', 'refresh');
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
		if ($this->session->userdata('admin_login')) {
			$client = $this->back_end->get_all_clients();
			$states = $this->back_end->get_all_states();

			// $alpha = array('A', 'B', 'C','D', 'E', 'F','G', 'H', 'I','J', 'K', 'L','M', 'N', 'O');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("admin_assets/exel-formate/DOC_FORMAT.xlsx");

			$spreadsheet->setActiveSheetIndex(1);
			$spreadsheet->getActiveSheet()->setTitle('list1');
			$sheet1 = $spreadsheet->getActiveSheet();
			$sheet1->setCellValue('A1', 'SL No');
			$sheet1->setCellValue('B1', 'CLIENT NAME');
			$sheet1->setCellValue('C1', 'CLIENT ID');

			$sheet1->setCellValue('O1', 'STATES');
			$sheet1->setCellValue('P1', 'STATES ID');



			$sheet1->setCellValue('S1', 'GENDER');
			$sheet1->setCellValue('T1', 'GENDER VALUE');

			$sheet1->setCellValue('Y1', 'MARITAL STATUS');

			$sheet1->setCellValue('AC1', 'BLOOD GROUP');

			$sheet1->setCellValue('AZ1', 'STATUS');
			$sheet1->setCellValue('BA1', 'STATUS VALUE');

			$sheet1->setCellValue('BZ1', 'ACTIVE STATUS');
			$sheet1->setCellValue('CA1', 'VALUE');

			$sheet1->setCellValue('CC1', 'DATA STATUS');
			$sheet1->setCellValue('CD1', 'DATA STATUS VALUE');

			$sheet1->setCellValue('CG1', 'APPROVAL SELECT');
			$sheet1->setCellValue('CH1', 'DDCS APPROVAL ID');



			$sheet1->getStyle("A1:CA1")->applyFromArray(array("font" => array("bold" => true)));
			foreach (range('A', 'CA') as $columnID) {
				$sheet1->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$i = 2;
			foreach ($client as $key => $value) {

				$sheet1->setCellValue('A' . $i, $key + 1);
				$sheet1->setCellValue('B' . $i, $value['client_name']);
				$sheet1->setCellValue('C' . $i, $value['id']);

				$i += 1;
			}
			$j = 2;
			foreach ($states as $key => $value) {
				$sheet1->setCellValue('O' . $j, $value['state_name']);
				$sheet1->setCellValue('P' . $j, $value['id']);

				$j += 1;
			}


			$sheet1->setCellValue('S2', 'Male');
			$sheet1->setCellValue('S3', 'Female');
			$sheet1->setCellValue('T2', '1');
			$sheet1->setCellValue('T3', '2');

			$sheet1->setCellValue('Y2', 'Single');
			$sheet1->setCellValue('Y3', 'Married');

			$sheet1->setCellValue('AC2', 'O+');
			$sheet1->setCellValue('AC3', 'O-');
			$sheet1->setCellValue('AC4', 'A+');
			$sheet1->setCellValue('AC5', 'A-');
			$sheet1->setCellValue('AC6', 'B+');
			$sheet1->setCellValue('AC7', 'B-');
			$sheet1->setCellValue('AC8', 'AB+');
			$sheet1->setCellValue('AC9', 'AB-');


			$sheet1->setCellValue('AZ2', 'Active');
			$sheet1->setCellValue('AZ3', 'Inactive');
			$sheet1->setCellValue('BA2', '0');
			$sheet1->setCellValue('BA3', '1');

			$sheet1->setCellValue('BZ2', 'Active');
			$sheet1->setCellValue('BZ3', 'Deactive');
			$sheet1->setCellValue('CA2', '0');
			$sheet1->setCellValue('CA3', '1');

			$sheet1->setCellValue('CC2', 'Complete');
			$sheet1->setCellValue('CC3', 'Pending');
			$sheet1->setCellValue('CD2', '1');
			$sheet1->setCellValue('CD3', '0');

			$sheet1->setCellValue('CG2', 'Approve');
			$sheet1->setCellValue('CG3', 'Reject');
			$sheet1->setCellValue('CH2', '1');
			$sheet1->setCellValue('CH3', '2');


			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle('Back_end');
			$sheet = $spreadsheet->getActiveSheet();

			$cellB2 = $sheet->getCell('B2')->getDataValidation();
			$cellB2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellB2->setAllowBlank(false);
			$cellB2->setShowInputMessage(true);
			$cellB2->setShowErrorMessage(true);
			$cellB2->setShowDropDown(true);
			// $rowCount = $sheet1->getHighestRow();
			$cellB2->setFormula1('list1!$B:$B');
			$sheet->setCellValue('CA2', '=vlookup(B2,list1!B:C,2,false)');

			$cellO2 = $sheet->getCell('O2')->getDataValidation();
			$cellO2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellO2->setAllowBlank(false);
			$cellO2->setShowInputMessage(true);
			$cellO2->setShowErrorMessage(true);
			$cellO2->setShowDropDown(true);
			// $rowCount = $sheet1->getHighestRow();
			$cellO2->setFormula1('list1!$O:$O');
			$sheet->setCellValue('CB2', '=vlookup(O2,list1!O:P,2,false)');

			$cellS2 = $sheet->getCell('S2')->getDataValidation();
			$cellS2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellS2->setAllowBlank(false);
			$cellS2->setShowInputMessage(true);
			$cellS2->setShowErrorMessage(true);
			$cellS2->setShowDropDown(true);
			$cellS2->setFormula1('list1!$S:$S');
			$sheet->setCellValue('CC2', '=vlookup(S2,list1!S:T,2,false)');

			$cellAY2 = $sheet->getCell('AY2')->getDataValidation();
			$cellAY2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellAY2->setAllowBlank(false);
			$cellAY2->setShowInputMessage(true);
			$cellAY2->setShowErrorMessage(true);
			$cellAY2->setShowDropDown(true);
			$cellAY2->setFormula1('list1!$AZ:$AZ');
			$sheet->setCellValue('CD2', '=vlookup(AY2,list1!AZ:BA,2,false)');

			$cellBY2 = $sheet->getCell('BY2')->getDataValidation();
			$cellBY2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellBY2->setAllowBlank(false);
			$cellBY2->setShowInputMessage(true);
			$cellBY2->setShowErrorMessage(true);
			$cellBY2->setShowDropDown(true);
			$cellBY2->setFormula1('list1!$BZ:$BZ');
			$sheet->setCellValue('CE2', '=vlookup(BY2,list1!BZ:CA,2,false)');

			$cellBZ2 = $sheet->getCell('BZ2')->getDataValidation();
			$cellBZ2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellBZ2->setAllowBlank(false);
			$cellBZ2->setShowInputMessage(true);
			$cellBZ2->setShowErrorMessage(true);
			$cellBZ2->setShowDropDown(true);
			$cellBZ2->setFormula1('list1!$CC:$CC');
			$sheet->setCellValue('CF2', '=vlookup(BZ2,list1!CC:CD,2,false)');

			$cellAC2 = $sheet->getCell('AC2')->getDataValidation();
			$cellAC2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellAC2->setAllowBlank(false);
			$cellAC2->setShowInputMessage(true);
			$cellAC2->setShowErrorMessage(true);
			$cellAC2->setShowDropDown(true);
			$cellAC2->setFormula1('list1!$AC:$AC');

			$cellCI2 = $sheet->getCell('CI2')->getDataValidation();
			$cellCI2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellCI2->setAllowBlank(false);
			$cellCI2->setShowInputMessage(true);
			$cellCI2->setShowErrorMessage(true);
			$cellCI2->setShowDropDown(true);
			$cellCI2->setFormula1('list1!$CG:$CG');
			$sheet->setCellValue('CJ2', '=vlookup(CI2,list1!CG:CH,2,false)');


			$cellY2 = $sheet->getCell('Y2')->getDataValidation();
			$cellY2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellY2->setAllowBlank(false);
			$cellY2->setShowInputMessage(true);
			$cellY2->setShowErrorMessage(true);
			$cellY2->setShowDropDown(true);
			$cellY2->setFormula1('list1!$Y:$Y');

			$writer = new Xlsx($spreadsheet);
			$filename = 'DOC_DOWNLOAD_FORMAT';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output'); // download file 

		} else {
			redirect('home/index');
		}
	}
}
