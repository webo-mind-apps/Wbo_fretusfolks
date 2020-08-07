<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
error_reporting(0);
class Bulk_update extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Bulk_update_db', 'bulk_update');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			$data['client_management'] = $this->bulk_update->get_all_clients();
			$this->load->view('admin/back_end/bulk_update/index', $data);
		} else {
			redirect('home/index');
		}
	}

	function active_update()
	{ //For making active
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$id = $this->input->post('id', true);
			$status = $this->input->post('status', true);
			foreach ($id as $key => $value) {
				$this->bulk_update->active_update($value, $status);
			}
		}
	}
	function inactive_update()
	{ //For making inactive
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$id = $this->input->post('id', true);
			$status = $this->input->post('status', true);
			foreach ($id as $key => $value) {
				$this->bulk_update->inactive_update($value, $status);
			}
		}
	}
	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->bulk_update->make_datatables();
			$data = array();
			$i = 1;
			foreach ($fetch_data as $row) {
				
				$sub_array = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->ffi_emp_id;
				$sub_array[] = $row->emp_name;
				$sub_array[] = date('d M, Y', strtotime($row->contract_date));
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->bulk_update->get_all_data(),
				"recordsFiltered"     =>     $this->bulk_update->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

		// Document Sample formate generate
		public function doc_formate()
		{
			if ($this->session->userdata('admin_login')) {
				// $alpha = array('A', 'B', 'C','D', 'E', 'F','G', 'H', 'I','J', 'K', 'L','M', 'N', 'O');
	
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("admin_assets/exel-formate/ADMS_BULK_INSCTIVE.xlsx");
				
				$spreadsheet->setActiveSheetIndex(0);
				$spreadsheet->getActiveSheet()->setTitle('BULK_INACTIVE');
				$sheet = $spreadsheet->getActiveSheet();
				$writer = new Xlsx($spreadsheet);
				$filename = 'DOC_BULK_INACTIVE_DOWNLOAD';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
				header('Cache-Control: max-age=0');
				$writer->save('php://output'); // download file 
	
			} else {
				redirect('home/index');
			}
		}

	function download_inactive_details()
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
			$data = $this->bulk_update->get_all_bulk_update_for_download();
			if (!empty($data)) {
				$client = $this->input->post('bulk_inactive_client', true);

				foreach ($data as $key => $row) {
					if (!empty($client)) {

						$path = 'public/bulk_inactive/dcs_' . $data[0]['client_name'] . '_' . $date;
					} else {

						$path = 'public/bulk_inactive/dcs_' . $date;
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
				$filename = 'Bulk_inactive_details' . $date . '.xlsx';

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

					$education_certificate = $this->bulk_update->get_education_details($row['ffi_emp_id']);
					foreach ($education_certificate as $key => $r)
					 {
						array_push($zip_data,$r['path']);
					}

					$other_certificate = $this->bulk_update->get_other_certificate_details($row['ffi_emp_id']);
					
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
					if(empty($row['ffi_emp_id']) || $row['ffi_emp_id']=='null')
					{
						$row['ffi_emp_id']="0";
					}
					if(empty($row['emp_name']) || $row['emp_name']=='null')
					{
						$row['emp_name']="0";
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
			
				redirect('bulk_update/');
			} else {
				$this->session->set_flashdata('no_data', 'No datas founded');
				redirect('bulk_update/', 'refresh');
			}
		}
		catch(Exception $e) {
			$this->session->set_flashdata('take_time', 'Large size');
				redirect('bulk_update/', 'refresh');

		}
		} else {
			redirect('home/index');
		}
	}
	public function adms_inactive_import()
	{
		if ($this->session->userdata('admin_login')) {
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
				$update = 0;
				
				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$data['bulk_inactive'] = array(
						"ffi_emp_id"			=> (empty($allDataInSheet[$i]['A']) ? '' : $allDataInSheet[$i]['A']),
						"emp_name"				=> (empty($allDataInSheet[$i]['B']) ? '' : $allDataInSheet[$i]['B']),
						"contract_date"			=> (empty($allDataInSheet[$i]['C']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['C']))),
						"status"				=> 1,
						// 'modified_date'			=>	date('Y-m-d H:i:s')
					);
					if ($data['bulk_inactive']['emp_name'] != '' || !empty($data['bulk_inactive']['emp_name'])) {
					if($this->bulk_update->importEmployee($data))
					{
						$update++;
					}

					}
				}
				if ($update > 0) {
					$msg = "Updated successfully";

					$this->session->set_flashdata('success', $msg);
				}
				redirect('bulk_update', 'refresh');
			} else {

				$this->session->set_flashdata('no_file', 'Please Choose Valid file formate ');
				redirect('bulk_update', 'refresh');
			}
		}
	} else {
		redirect('home/index');
	}
	}
}
