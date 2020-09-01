<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
//error_reporting(0);
class Payslips extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Payslips_db', 'payslips');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			$data['payslips'] = $this->payslips->get_all_payslips();
			$data['client_management'] = $this->payslips->get_all_client();
			$this->load->view('admin/back_end/payslips/index', $data);
		} else {
			redirect('home/index');
		}
	}
	function print_payslip()
	{ //single pdf file download FUNC USE
		if ($this->session->userdata('admin_login')) {
			if ($data['data'] = $this->payslips->get_payslip_details()) {
				$mpdf = new \Mpdf\Mpdf();
				// echo "<pre>";
				// print_r($data['data']);
				// exit;
				$html = $this->load->view('admin/back_end/payslips/pdf_payslips', $data, true);
				
				// $mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
				// $mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
				$mpdf->AddPage(
					'', // L - landscape, P - portrait 
					'',
					'',
					'',
					'',
					5, // margin_left
					5, // margin right
					30, // margin top
					30, // margin bottom
					0, // margin header
					0
				); // margin footer  
				$mpdf->WriteHTML($html);
				$date = date('Y-m-d_his');
				$mpdf->Output($data['data']['emp_id'] . "_" . $data['data']['emp_name'] . "_" . $date . ".pdf", 'D');
				redirect('payslips');
			}
		}
	}


	public function upload_payslips()
	{

		$data = array();
		// Load form validation library
		if (!empty($_FILES['file']['name'])) {
			// get file extension
			$valid_extentions = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$content_type = mime_content_type($_FILES['file']['tmp_name']);
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
				$spreadsheet = $reader->load($_FILES['file']['tmp_name']); //1.location
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				//2.fetch stru and datas row wise
				// echo "<pre>"; 
				// print_r($allDataInSheet[2]); 

				$insert = 0;
				$update = 0;
				$month = $this->input->post('payslip_month', true);
				$year = $this->input->post('payslip_year', true);
				$date = date("Y-m-d");
				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$data = array(
						"emp_id"						=> (empty($allDataInSheet[$i]['A']) ? '' : $allDataInSheet[$i]['A']),
						"emp_name"						=> (empty($allDataInSheet[$i]['B']) ? '' : $allDataInSheet[$i]['B']),
						"designation"					=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"doj"							=> (empty($allDataInSheet[$i]['D']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['D']))),
						"department"					=> (empty($allDataInSheet[$i]['E']) ? '' : $allDataInSheet[$i]['E']),
						"location"						=> (empty($allDataInSheet[$i]['F']) ? '' : $allDataInSheet[$i]['F']),
						"client_name"					=> (empty($allDataInSheet[$i]['G']) ? '' : $allDataInSheet[$i]['G']),
						"uan_no"						=> (empty($allDataInSheet[$i]['H']) ? '' : $allDataInSheet[$i]['H']),
						"pf_no"							=> (empty($allDataInSheet[$i]['I']) ? '' : $allDataInSheet[$i]['I']),
						"esi_no"						=> (empty($allDataInSheet[$i]['J']) ? '' : $allDataInSheet[$i]['J']),
						"bank_name"						=> (empty($allDataInSheet[$i]['K']) ? '' : $allDataInSheet[$i]['K']),
						"account_no"					=> (empty($allDataInSheet[$i]['L']) ? '' : $allDataInSheet[$i]['L']),
						"ifsc_code"						=> (empty($allDataInSheet[$i]['M']) ? '' : $allDataInSheet[$i]['M']),
						"month_days"					=> (empty($allDataInSheet[$i]['N']) ? '' : $allDataInSheet[$i]['N']),
						"payable_days"					=> (empty($allDataInSheet[$i]['O']) ? '' : $allDataInSheet[$i]['O']),
						"leave_days"					=> (empty($allDataInSheet[$i]['P']) ? '' : $allDataInSheet[$i]['P']),
						"lop_days"						=> (empty($allDataInSheet[$i]['Q']) ? '' : $allDataInSheet[$i]['Q']),
						"arrears_days"					=> (empty($allDataInSheet[$i]['R']) ? '' : $allDataInSheet[$i]['R']),
						"ot_hours"						=> (empty($allDataInSheet[$i]['S']) ? '' : $allDataInSheet[$i]['S']),
						"leave_balance"					=> (empty($allDataInSheet[$i]['T']) ? '' : $allDataInSheet[$i]['T']),
						"fixed_basic_da"				=> (empty($allDataInSheet[$i]['U']) ? '' : $allDataInSheet[$i]['U']),
						"fixed_hra"						=> (empty($allDataInSheet[$i]['V']) ? '' : $allDataInSheet[$i]['V']),
						"fixed_conveyance"				=> (empty($allDataInSheet[$i]['W']) ? '' : $allDataInSheet[$i]['W']),
						"fix_education_allowance"		=> (empty($allDataInSheet[$i]['X']) ? '' : $allDataInSheet[$i]['X']),
						"fixed_medical_reimbursement"	=> (empty($allDataInSheet[$i]['Y']) ? '' : $allDataInSheet[$i]['Y']),
						"fixed_special_allowance" 		=> (empty($allDataInSheet[$i]['Z']) ? '' : $allDataInSheet[$i]['Z']),
						"fixed_other_allowance"			=> (empty($allDataInSheet[$i]['AA']) ? '' : $allDataInSheet[$i]['AA']),
						"fixed_st_bonus"				=> (empty($allDataInSheet[$i]['AB']) ? '' : $allDataInSheet[$i]['AB']),
						"fix_leave_wages"				=> (empty($allDataInSheet[$i]['AC']) ? '' : $allDataInSheet[$i]['AC']),
						"fixed_holiday_wages"			=> (empty($allDataInSheet[$i]['AD']) ? '' : $allDataInSheet[$i]['AD']),
						"fixed_attendance_bonus"		=> (empty($allDataInSheet[$i]['AE']) ? '' : $allDataInSheet[$i]['AE']),
						"fixed_ot_wages"				=> (empty($allDataInSheet[$i]['AF']) ? '' : $allDataInSheet[$i]['AF']),
						"fix_incentive_wages"			=> (empty($allDataInSheet[$i]['AG']) ? '' : $allDataInSheet[$i]['AG']),
						"fix_arrear_wages"				=> (empty($allDataInSheet[$i]['AH']) ? '' : $allDataInSheet[$i]['AH']),
						"fixed_other_wages"				=> (empty($allDataInSheet[$i]['AI']) ? '' : $allDataInSheet[$i]['AI']),
						"fixed_total_earnings"			=> (empty($allDataInSheet[$i]['AJ']) ? '' : $allDataInSheet[$i]['AJ']),

						"earn_basic"					=> (empty($allDataInSheet[$i]['AK']) ? '' : $allDataInSheet[$i]['AK']),
						"earn_hr"						=> (empty($allDataInSheet[$i]['AL']) ? '' : $allDataInSheet[$i]['AL']),
						"earn_conveyance"				=> (empty($allDataInSheet[$i]['AM']) ? '' : $allDataInSheet[$i]['AM']),
						"earn_education_allowance"		=> (empty($allDataInSheet[$i]['AN']) ? '' : $allDataInSheet[$i]['AN']),
						"earn_medical_allowance"		=> (empty($allDataInSheet[$i]['AO']) ? '' : $allDataInSheet[$i]['AO']),
						"earn_special_allowance"		=> (empty($allDataInSheet[$i]['AP']) ? '' : $allDataInSheet[$i]['AP']),
						"earn_other_allowance"			=> (empty($allDataInSheet[$i]['AQ']) ? '' : $allDataInSheet[$i]['AQ']),
						"earn_st_bonus"					=> (empty($allDataInSheet[$i]['AR']) ? '' : $allDataInSheet[$i]['AR']),
						"earn_leave_wages"				=> (empty($allDataInSheet[$i]['AS']) ? '' : $allDataInSheet[$i]['AS']),
						"earn_holiday_wages"			=> (empty($allDataInSheet[$i]['AT']) ? '' : $allDataInSheet[$i]['AT']),
						"earn_attendance_bonus"			=> (empty($allDataInSheet[$i]['AU']) ? '' : $allDataInSheet[$i]['AU']),
						"earn_ot_wages"					=> (empty($allDataInSheet[$i]['AV']) ? '' : $allDataInSheet[$i]['AV']),
						"earn_incentive_wages"			=> (empty($allDataInSheet[$i]['AW']) ? '' : $allDataInSheet[$i]['AW']),
						"earn_arrear_wages"				=> (empty($allDataInSheet[$i]['AX']) ? '' : $allDataInSheet[$i]['AX']),
						"earn_other_wages"				=> (empty($allDataInSheet[$i]['AY']) ? '' : $allDataInSheet[$i]['AY']),
						"earn_total_gross"				=> (empty($allDataInSheet[$i]['AZ']) ? '' : $allDataInSheet[$i]['AZ']),
						"epf"							=> (empty($allDataInSheet[$i]['BA']) ? '' : $allDataInSheet[$i]['BA']),
						"esic"							=> (empty($allDataInSheet[$i]['BB']) ? '' : $allDataInSheet[$i]['BB']),
						"pt"							=> (empty($allDataInSheet[$i]['BC']) ? '' : $allDataInSheet[$i]['BC']),
						"it"							=> (empty($allDataInSheet[$i]['BD']) ? '' : $allDataInSheet[$i]['BD']),
						"lwf"							=> (empty($allDataInSheet[$i]['BE']) ? '' : $allDataInSheet[$i]['BE']),
						"salary_advance"				=> (empty($allDataInSheet[$i]['BF']) ? '' : $allDataInSheet[$i]['BF']),
						"other_deduction"				=> (empty($allDataInSheet[$i]['BG']) ? '' : $allDataInSheet[$i]['BG']),
						"total_deduction"				=> (empty($allDataInSheet[$i]['BH']) ? '' : $allDataInSheet[$i]['BH']),
						"net_salary"					=> (empty($allDataInSheet[$i]['BI']) ? '' : $allDataInSheet[$i]['BI']),
						"in_words"						=> (empty($allDataInSheet[$i]['BJ']) ? '' : $allDataInSheet[$i]['BJ']),
						"month"							=> $month,
						"year"							=> $year,
						"date_upload"					=> $date,

					);

					if ($data['emp_id'] != '' || !empty($data['emp_id'])) {
						if ($import_status = $this->payslips->importEmployee_payslips_letter($data)) {

							if ($import_status == "insert") {
								$insert = $insert + 1;
								$result = array();
								
								$result['payslip'] = $this->payslips->get_employee_mail_details($data['emp_id']);
								if(!empty($result['payslip'])){
									if ($result['payslip']['email'] != '' || !empty($result['payslip']['email'])) {
										$message = $this->load->view('admin/back_end/payslips/payslips_email', $result, true);
										$mpdf = new \Mpdf\Mpdf();
										// $mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
										// $mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
										$mpdf->AddPage(
											'', // L - landscape, P - portrait 
											'',
											'',
											'',
											'',
											5, // margin_left
											5, // margin right
											30, // margin top
											30, // margin bottom
											0, // margin header
											0
										); // margin footer 
										$data['data'] = $data;
										$html = $this->load->view('admin/back_end/payslips/pdf_payslips', $data, true);
										$mpdf->WriteHTML($html);
										$content = $mpdf->Output('', 'S');
										$filename = date('d/m/Y') . $result['payslip']['emp_name']."_payslip.pdf";
										$subject = "Payslips details";
										$this->load->config('email');
										$this->load->library('email');
										$from = $this->config->item('smtp_user');

										$to = $result['payslip']['email'];
										$this->email->set_newline("\r\n");
										$this->email->from($from, 'Fretus folks india');
										$this->email->to($to);
										$this->email->subject($subject);
										$this->email->message($message);
										$this->email->attach($content, 'attachment', $filename, 'application/pdf');
										$this->email->send();
										$this->email->clear(TRUE);
									}
								}
								
							} else if ($import_status == "update") {
								$update = $update + 1;
							}
						}
					}
				}

				$msg = $insert . ' rows inserted <br>' . $update . ' rows updated <br>';
				
				$this->session->set_flashdata('success', $msg);
				redirect('payslips', 'refresh');
			} else {
				$this->session->set_flashdata('no_file', 'Please Choose Valid file formate ');
				redirect('payslips', 'refresh');
			}
			redirect('payslips', 'refresh');
		}
	}
	public function download_payslips()
	{
		if ($this->session->userdata('admin_login')) {

			if ($row_count = $this->payslips->download_payslips()) {

				$this->load->library('zip');
				$client_name=$this->input->post('payslip_download_client', true);
				$path = 'payslip/payslip_' . $client_name . "_" . date('Y-m-d-his');
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$row_count=$row_count/1000;
				$row_count=round($row_count);
				for($i=0;$i<=$row_count;$i++)
				{
					$a=$i*1000;
					if($data= $this->payslips->download_payslips_partial(1000,$a))
					{
						foreach ($data as $row)
						{
							$mpdf = new \Mpdf\Mpdf();
							$datas['data'] = $row;
							$html = $this->load->view('admin/back_end/payslips/pdf_payslips', $datas, true);
							// $mpdf->Image('', 0, 0, 210, 297, 'png', '', true, false);
							$mpdf->AddPage(
								'', // L - landscape, P - portrait 
								'',
								'',
								'',
								'',
								5, // margin_left
								5, // margin right
								30, // margin top
								30, // margin bottom
								0, // margin header
								0
							); // margin footer 
							$mpdf->WriteHTML($html);
							
							$mpdf->Output($path . '/' . $row['emp_id'] . "_" . $row['emp_name'] . ".pdf", 'F');
						}
					}
				}

				$this->zip->read_dir($path, false);
				$download = $this->zip->download($path . '.zip');
				
			} else {

				$this->session->set_flashdata('error', 'No datas found');
				redirect('payslips/');
			}
		} else {
			redirect('home/index');
		}
	}


	public function delete_payslip()
	{
		$data1 = $this->payslips->delete_payslip();
		$data = $this->payslips->search_payslip();
		$i = 1;
		foreach ($data as $row) {
			echo '
					<tr>
						<td>' . $i . '</td>
						<td>' . $row['emp_id'] . '</td>
						<td>' . $row['emp_name'] . '</td>
						<td>' . $row['designation'] . '</td>
						<td>' . $row['client_name'] . '</td>
						<td style="width:15%">' . date("F Y", strtotime("01-" . $row['month'] . "-" . $row['year'])) . '</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="' . site_url('payslips/print_payslip/' . $row['id']) . '" id="' . $row['id'] . '" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Download Payslip</a>
										<a href="javascript:void(0)" id="' . $row['id'] . '" class="dropdown-item" onclick="delete_payslip(this.id);"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
			$i++;
		}
	}
	public function search_payslip()
	{
		$data = $this->payslips->search_payslip();
		if ($data) {
			$i = 1;
			foreach ($data as $row) {
				echo '
					<tr>
						<td>' . $i . '</td>
						<td>' . $row['emp_id'] . '</td>
						<td>' . $row['emp_name'] . '</td>
						<td>' . $row['designation'] . '</td>
						<td>' . $row['client_name'] . '</td>
						<td style="width:15%">' . date("F Y", strtotime("01-" . $row['month'] . "-" . $row['year'])) . '</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="' . site_url('payslips/print_payslip/' . $row['id']) . '" id="' . $row['id'] . '" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Download Payslip</a>
										<a href="javascript:void(0)" id="' . $row['id'] . '" class="dropdown-item" onclick="delete_payslip(this.id);"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
				$i++;
			}
		} else {
		}
	}
	public function doc_format()
	{
		if ($this->session->userdata('admin_login')) {
			$client = $this->payslips->get_all_clients();
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("downloads/salary_slip.xlsx");

			$spreadsheet->setActiveSheetIndex(1);
			$spreadsheet->getActiveSheet()->setTitle('list1');
			$sheet1 = $spreadsheet->getActiveSheet();
			$sheet1->setCellValue('H1', 'CLIENT NAME');
			$sheet1->setCellValue('I1', 'CLIENT ID');



			$sheet1->getStyle("H1:I1")->applyFromArray(array("font" => array("bold" => true)));
			foreach (range('A', 'H') as $columnID) {
				$sheet1->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$i = 2;
			foreach ($client as $key => $value) {

				$sheet1->setCellValue('H' . $i, $value['client_name']);
				$sheet1->setCellValue('I' . $i, $value['id']);

				$i += 1;
			}


			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle('Salary sheet');
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('BL1', 'CLIENT ID');

			$cellB2 = $sheet->getCell('G2')->getDataValidation();
			$cellB2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellB2->setAllowBlank(false);
			$cellB2->setShowInputMessage(true);
			$cellB2->setShowErrorMessage(true);
			$cellB2->setShowDropDown(true);
			// $rowCount = $sheet1->getHighestRow();
			$cellB2->setFormula1('list1!$H:$H');
			$sheet->setCellValue('BL2', '=vlookup(G2,list1!H:I,2,false)');


			$writer = new Xlsx($spreadsheet);
			$filename = 'PAYSLIPS_DOWNLOAD_FORMAT';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output'); // download file 

		} else {
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
