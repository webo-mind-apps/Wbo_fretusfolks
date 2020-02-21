<?php
// ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Offer_letter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/Offer_letter_db', 'letter');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "backend";
			//$data['offer_letter'] = $this->letter->get_all_offer_letters();
			$this->load->view('admin/back_end/offer_letter/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->letter->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';
			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $row->id;
				$sub_array[] = $row->employee_id;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->emp_name;
				$sub_array[] = date('d M, Y', strtotime($row->date));
				$sub_array[] = $row->phone1;
				$sub_array[] = $row->email;
				$status = "";
				$sub_array[] = '
				<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="' . site_url('offer_letter/view_offer_letter/' . $row->id) . '" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i>Download Offer Letter</a>
							<a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_offer_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						</div>
					</div>
				</div>
			</td>
					 ';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->letter->get_all_data(),
				"recordsFiltered"     =>     $this->letter->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	function new_offer_letter()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "backend";
			$data['states'] = $this->letter->get_all_states();
			$data['clients'] = $this->letter->get_all_clients();
			$this->load->view('admin/back_end/offer_letter/new_offer_letter', $data);
		} else {
			redirect('home/index');
		}
	}

	// function pdf_offer_letter($id = NULL)
	// {
	// 	$this->load->library('zip'); 
	// 	$data['letter_details'] = $this->letter->get_offer_letter_pdf(); 

	// 	$path = 'offer_letters/offer_letter_'.date('Ymdhis');
	// 	if(!is_dir($path)) mkdir($path, 0777, TRUE); 
	// 	foreach ($data['letter_details'] as $key => $value) {
	// 		$mpdf=new \Mpdf\Mpdf(); 
	// 		$mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
	// 		   $mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
	// 		   $mpdf->AddPage('', // L - landscape, P - portrait 
	// 			'', '', '', '',
	// 			5, // margin_left
	// 			5, // margin right
	// 			60, // margin top
	// 			30, // margin bottom
	// 			0, // margin header
	// 			0); // margin footer
	// 		$data['letter_details'][0] = $value;
	// 		if($value['client_code']==1)
	// 		{
	// 		$html = $this->load->view('admin/back_end/offer_letter/pdf-format1', $data, true); 
	// 		}  
	// 		if($value['client_code']==2)
	// 		{
	// 		$html = $this->load->view('admin/back_end/offer_letter/pdf-format2', $data, true);
	// 		}  
	// 		if($value['client_code']==3)
	// 		{
	// 		$html = $this->load->view('admin/back_end/offer_letter/pdf-format3', $data, true); 
	// 		}  
	// 		if($value['client_code']==4)
	// 		{
	// 		$html = $this->load->view('admin/back_end/offer_letter/pdf-format4', $data, true); 
	// 		}  

	// 		$mpdf->WriteHTML($html); 
	// 		$file = $data['letter_details'][0]['employee_id'];
	// 		$file = $file.'-'.$data['letter_details'][0]['emp_name'];
	// 		$pdfData = $mpdf->Output($path.'/'.$file.'.pdf', 'F'); 
	// 	} 
	// 	$this->zip->read_dir($path,false);
	// 	$download = $this->zip->download($path.'.zip');
	// }

	function pdf_offer_letter($id = NULL) //1/limit records use null
	{
		$this->load->library('zip');
		$data['letter_details'] = $this->letter->get_offer_letter_pdf(); //2.select records in model 
		if (!empty($data['letter_details'])) {
			$path = 'offer_letters/offer_letter_' . date('Ymdhis');
			if (!is_dir($path)) mkdir($path, 0777, TRUE);
			foreach ($data['letter_details'] as $key => $value) {
				$mpdf = new \Mpdf\Mpdf(); //3.check documentation avail
				$mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
				$mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
				$mpdf->AddPage(
					'', // L - landscape, P - portrait 
					'',
					'',
					'',
					'',
					5, // margin_left
					5, // margin right
					35, // margin top
					35, // margin bottom
					0, // margin header
					0
				); // margin footer
				$data['letter_details'][0] = $value; //4.using record id fetch html pages 
				// echo "<pre>";
				// print_r($data['letter_details'][0]);
				// exit;
				if ($value['offer_letter_type'] == 1) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format1', $data, true);
				} else if ($value['offer_letter_type'] == 2) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format2', $data, true);
				} else if ($value['offer_letter_type'] == 3) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format3', $data, true);
				} else if ($value['offer_letter_type'] == 4) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format4', $data, true);
				}

				$mpdf->WriteHTML($html);
				$file = $data['letter_details'][0]['employee_id'];
				$date = date('Ymdhis') . $key;
				$file = $file . '-' . $data['letter_details'][0]['emp_name'];
				$pdfData = $mpdf->Output($path . '/' . $file . $date . '.pdf', 'F');
			}
			$this->zip->read_dir($path, false); //5.make it as zip 
			$download = $this->zip->download($path . '.zip');
		} else {
			$this->session->set_flashdata('noData', 'Datas not available');
			redirect('offer_letter', 'refresh');
		}
	}

	function get_employee_detail()
	{
		$data = $this->letter->get_employee_detail();
		$joining_date = "";
		$contract_date = "";
		if ($data) {
			if ($data[0]['joining_date'] != "0000-00-00") {
				$joining_date = date("d-m-Y", strtotime($data[0]['joining_date']));
			}
			if ($data[0]['contract_date'] != "0000-00-00") {
				$contract_date = date("d-m-Y", strtotime($data[0]['contract_date']));
			}
			echo "<pre>";
			print_r($data);
			exit();

			if ($data[0]['data_status'] == 1) {
				echo $data[0]['client_id'] . "****" . $data[0]['emp_name'] . "****" . $joining_date . "****" . $contract_date . "****" . $data[0]['designation'] . "****" . $data[0]['location'] . "****" . $data[0]['department'] . "****" . $data[0]['basic_salary'] . "****" . $data[0]['hra'] . "****" . $data[0]['conveyance'] . "****" . $data[0]['medical_reimbursement'] . "****" . $data[0]['special_allowance'] . "****" . $data[0]['other_allowance'] . "****" . $data[0]['st_bonus'] . "****" . $data[0]['gross_salary'] . "****" . $data[0]['emp_pf'] . "****" . $data[0]['emp_esic'] . "****" . $data[0]['pt'] . "****" . $data[0]['total_deduction'] . "****" . $data[0]['take_home'] . "****" . $data[0]['employer_pf'] . "****" . $data[0]['employer_esic'] . "****" . $data[0]['mediclaim'] . "****" . $data[0]['ctc'];
			} else {
				echo "0";
			}
		} else {
			echo "failed";
		}
	}
	function save_offer_letter()
	{
		$letter_type = $this->input->post('letter_format');

		$data['letter_details'] = $this->letter->save_offer_letter();
		// echo '<pre>';
		// print_r($data['letter_details']);
		// exit;

		if (!empty($data)) {
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
			$mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
			$mpdf->AddPage(
				'', // L - landscape, P - portrait 
				'',
				'',
				'',
				'',
				5, // margin_left
				5, // margin right
				35, // margin top
				30, // margin bottom
				0, // margin header
				0
			); // margin footer
			if ($letter_type == 1) {

				$html = $this->load->view('admin/back_end/offer_letter/pdf-format1', $data, true);
			} else if ($letter_type == 2) {

				$html = $this->load->view('admin/back_end/offer_letter/pdf-format2', $data, true);
			} else if ($letter_type == 3) {

				$html = $this->load->view('admin/back_end/offer_letter/pdf-format3', $data, true);
			} else if ($letter_type == 4) {

				$html = $this->load->view('admin/back_end/offer_letter/pdf-format4', $data, true);
			}
			$mpdf->WriteHTML($html);
			$content = $mpdf->Output('', 'S');
			$filename = date('d/m/Y') . "_offer-letter.pdf";
			$this->load->config('email');
			$this->load->library('email');
			$message = $this->load->view('admin/back_end/offer_letter/offer_letter_email', $data, true);
			$subject = "welcome";
			$from = $this->config->item('smtp_user');
			$to = $data['letter_details'][0]['email'];
			$this->email->set_newline("\r\n");
			$this->email->from($from, 'Fretus folks india');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->attach($content, 'attachment', $filename, 'application/pdf');
			if ($this->email->send()) { 
				redirect('Offer_letter/');
			} else {
				echo "<script>alert('Mail not sent')</script>";
			}
		}
	}

	function view_offer_letter()
	{ //single pdf file download FUNC USE
		if ($this->session->userdata('admin_login')) {
			if ($data = $this->letter->get_offer_letter()) {
				$mpdf = new \Mpdf\Mpdf();
				$letter_type = $data[0]['offer_letter_type'];
				$data['letter_details'][0] = $data[0];
				// echo "<pre>";
				// print_r($data['letter_details'][0]);
				// exit;
				if ($letter_type == 1) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format1', $data, true);
				} else if ($letter_type == 2) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format2', $data, true);
				} else if ($letter_type == 3) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format3', $data, true);
				} else if ($letter_type == 4) {
					$html = $this->load->view('admin/back_end/offer_letter/pdf-format4', $data, true);
				}
				$mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
				$mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
				$mpdf->AddPage(
					'', // L - landscape, P - portrait 
					'',
					'',
					'',
					'',
					5, // margin_left
					5, // margin right
					35, // margin top
					35, // margin bottom
					0, // margin header
					0
				); // margin footer  
				$mpdf->WriteHTML($html);
				$date = date('Ymdhis');
				$mpdf->Output($data[0]['ffi_emp_id'] . "_" . $data[0]['emp_name'] . $date . ".pdf", 'D');
				redirect('increment_letter');
			}
		}
	}

	function delete_offer_letter()
	{
		if ($this->letter->delete_offer_letter()) {
			echo "deleted";
		}
		// $data1 = $this->letter->delete_offer_letter();
		// $data = $this->letter->get_all_offer_letters();

		// $i = 1;
		// foreach ($data as $row) {
		// 	$status = "";
		// 	echo '
		// 	<tr>
		// 		<td>' . $i . '</td>
		// 		<td>' . $row['employee_id'] . '</td>
		// 		<td>' . $row['client_name'] . '</td>
		// 		<td>' . $row['emp_name'] . '</td>
		// 		<td style="width:15%">' . date("d-m-Y", strtotime($row['date'])) . '</td>
		// 		<td>' . $row['phone1'] . '</td>
		// 		<td>' . $row['email'] . '</td>
		// 		<td class="text-center">
		// 			<div class="list-icons">
		// 				<div class="dropdown">
		// 					<a href="#" class="list-icons-item" data-toggle="dropdown">
		// 						<i class="icon-menu9"></i>
		// 					</a>
		// 					<div class="dropdown-menu dropdown-menu-right">
		// 						<a href="' . site_url('offer_letter/view_offer_letter/' . $row['id']) . '" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
		// 						<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_offer_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
		// 					</div>
		// 				</div>
		// 			</div>
		// 		</td>
		// 	</tr>';
		// 	$i++;
		// }
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}

	// excel Import for ADMS OFFER LETTER 
	function adms_offer_letter_import()
	{
		$data = array();
		// Load form validation library
		if (!empty($_FILES['import']['name'])) {
			//1.get file content type using mime type
			$allowed_extentions = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			$content_type = mime_content_type($_FILES['import']['tmp_name']);

			$extension = "";
			$valid = false;
			if (in_array($content_type, $allowed_extentions)) {
				//2.get file extension 
				$valid_extentions = array('xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw');
				$extension = pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION);
				foreach ($valid_extentions as $key => $value) {
					if ($extension == $value) {
						$valid = true;
					}
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
				$not_exist = 0;
				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$client = empty($allDataInSheet[$i]['B']) ? 'null' : $allDataInSheet[$i]['B'];
					$this->db->where("client_name", $client); //selecting clint id for usage
					$query = $this->db->get("client_management");
					$q = $query->row_array();
					$client_id = $q['id'];

					$date = date("Y-m-d");
					$offer_letter = empty($allDataInSheet[$i]['C']) ? 'null' : $allDataInSheet[$i]['C'];
					// echo "<pre>";
					// print_r($offer_letter);
					// exit;
					$offer_letter_type = "";
					if ($offer_letter == "Format 1") {
						$offer_letter_type = 1;
					} elseif ($offer_letter == "Format 2") {
						$offer_letter_type = 2;
					} elseif ($offer_letter == "Format 3") {
						$offer_letter_type = 3;
					} elseif ($offer_letter == "Format 4") {
						$offer_letter_type = 4;
					}

					$emp_id = (empty($allDataInSheet[$i]['A']) ? 'null' : $allDataInSheet[$i]['A']);

					$data = array(
						"employee_id"			=> (empty($allDataInSheet[$i]['A']) ? '' : $allDataInSheet[$i]['A']),
						"company_id"			=>  $client_id,
						"date"					=>	$date,
						"offer_letter_type"		=>	$offer_letter_type,
						"basic_salary"			=> (empty($allDataInSheet[$i]['D']) ? 'null' : $allDataInSheet[$i]['D']),
						"hra"					=> (empty($allDataInSheet[$i]['E']) ? 'null' : $allDataInSheet[$i]['E']),
						"conveyance"			=> (empty($allDataInSheet[$i]['F']) ? 'null' : $allDataInSheet[$i]['F']),
						"medical_reimbursement"	=> (empty($allDataInSheet[$i]['G']) ? 'null' : $allDataInSheet[$i]['G']),
						"special_allowance"		=> (empty($allDataInSheet[$i]['H']) ? 'null' : $allDataInSheet[$i]['H']),
						"st_bonus"				=> (empty($allDataInSheet[$i]['I']) ? 'null' : $allDataInSheet[$i]['I']),
						"other_allowance"		=> (empty($allDataInSheet[$i]['J']) ? 'null' : $allDataInSheet[$i]['J']),
						"gross_salary"			=> (empty($allDataInSheet[$i]['K']) ? 'null' : $allDataInSheet[$i]['K']),
						"emp_pf"				=> (empty($allDataInSheet[$i]['L']) ? 'null' : $allDataInSheet[$i]['L']),
						"emp_esic"				=> (empty($allDataInSheet[$i]['M']) ? 'null' : $allDataInSheet[$i]['M']),
						"pt"					=> (empty($allDataInSheet[$i]['N']) ? 'null' : $allDataInSheet[$i]['N']),
						"total_deduction"		=> (empty($allDataInSheet[$i]['O']) ? 'null' : $allDataInSheet[$i]['O']),
						"take_home"				=> (empty($allDataInSheet[$i]['P']) ? 'null' : $allDataInSheet[$i]['P']),
						"employer_pf"			=> (empty($allDataInSheet[$i]['Q']) ? 'null' : $allDataInSheet[$i]['Q']),
						"employer_esic"			=> (empty($allDataInSheet[$i]['R']) ? 'null' : $allDataInSheet[$i]['R']),
						"mediclaim"				=> (empty($allDataInSheet[$i]['S']) ? 'null' : $allDataInSheet[$i]['S']),
						"ctc"					=> (empty($allDataInSheet[$i]['T']) ? 'null' : $allDataInSheet[$i]['T']),

					);
					if ($data['employee_id'] != '' || !empty($data['employee_id'])) :
						if ($import_status = $this->letter->importEmployee_offer_letter($data)) {
							if ($import_status == "insert") {
								$insert = $insert + 1;
								$this->db->select('a.*,b.branch,b.emp_name,b.last_name,b.middle_name,b.ffi_emp_id,b.email,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name');
								$this->db->from('offer_letter a');
								$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
								$this->db->join('client_management c', 'a.company_id=c.id', 'left');
								$this->db->where('a.employee_id', $data['employee_id']);
								$query = $this->db->get();
								$data['letter_details'] = $query->result_array();

								$mpdf = new \Mpdf\Mpdf();
								$mpdf->SetHTMLHeader('<img src="admin_assets/ffi_header.jpg"/>');
								$mpdf->SetHTMLFooter('<img src="admin_assets/ffi_footer.jpg"/>');
								$mpdf->AddPage(
									'', // L - landscape, P - portrait 
									'',
									'',
									'',
									'',
									5, // margin_left
									5, // margin right
									35, // margin top
									30, // margin bottom
									0, // margin header
									0
								); // margin footer
								if ($offer_letter_type == 1) {

									$html = $this->load->view('admin/back_end/offer_letter/pdf-format1', $data, true);
								} else if ($offer_letter_type == 2) {

									$html = $this->load->view('admin/back_end/offer_letter/pdf-format2', $data, true);
								} else if ($offer_letter_type == 3) {

									$html = $this->load->view('admin/back_end/offer_letter/pdf-format3', $data, true);
								} else if ($offer_letter_type == 4) {

									$html = $this->load->view('admin/back_end/offer_letter/pdf-format4', $data, true);
								}
								$mpdf->WriteHTML($html);
								$content = $mpdf->Output('', 'S');
								// exit;

								$filename = date('d/m/Y') . "_offer-letter.pdf";
								$this->load->config('email');
								$this->load->library('email');
								$message = $this->load->view('admin/back_end/offer_letter/offer_letter_email', $data, true);
								$subject = "welcome";
								$from = $this->config->item('smtp_user');
								$to = $data['letter_details'][0]['email'];

								$this->email->set_newline("\r\n");
								$this->email->from($from, 'Fretus folks india');
								$this->email->to($to);
								$this->email->subject($subject);
								$this->email->message($message);
								$this->email->attach($content, 'attachment', $filename, 'application/pdf');
								if (!$this->email->send()) {
									echo "<script>alert('not sent(import)')</script>";
								}
							} else if ($import_status == "not_exist") {
								$not_exist = $not_exist + 1;
							}
						}
					endif;
				}
				$msg = $insert . ' rows inserted <br>'  . $not_exist . ' employee not founded <br>';
				$this->session->set_flashdata('success', $msg);
				redirect('offer_letter', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Please Choose Valid file formate ');
				redirect('offer_letter', 'refresh');
			}
			redirect('offer_letter', 'refresh');
		}
	}

	public function doc_formate()
	{
		if ($this->session->userdata('admin_login')) {
			$client = $this->letter->get_all_clients();
			// $alpha = array('A', 'B', 'C','D', 'E', 'F','G', 'H', 'I','J', 'K', 'L','M', 'N', 'O');
			// echo "<pre>";
			// print_r($client);
			// exit;
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("admin_assets/exel-formate/ADMS_OFFER_LETTER.xlsx");

			$spreadsheet->setActiveSheetIndex(1);
			$spreadsheet->getActiveSheet()->setTitle('list1');
			$sheet1 = $spreadsheet->getActiveSheet();
			$sheet1->setCellValue('A1', 'SL No');
			$sheet1->setCellValue('B1', 'CLIENT NAME');
			$sheet1->setCellValue('C1', 'CLIENT ID');
			$sheet1->setCellValue('E1', 'FORMAT NAME');
			$sheet1->setCellValue('F1', 'FORMAT ID');

			$sheet1->getStyle("A1:F1")->applyFromArray(array("font" => array("bold" => true)));
			foreach (range('A', 'F') as $columnID) {
				$sheet1->getColumnDimension($columnID)->setAutoSize(true);
			}
			$i = 2;
			foreach ($client as $key => $value) {
				$sheet1->setCellValue('A' . $i, $key + 1);
				$sheet1->setCellValue('B' . $i, $value['client_name']);
				$sheet1->setCellValue('C' . $i, $value['id']);
				$i += 1;
			}
			$sheet1->setCellValue('E2', "Format 1");
			$sheet1->setCellValue('E3', "Format 2");
			$sheet1->setCellValue('E4', "Format 3");
			$sheet1->setCellValue('E5', "Format 4");

			$sheet1->setCellValue('F2', 1);
			$sheet1->setCellValue('F3', 2);
			$sheet1->setCellValue('F4', 3);
			$sheet1->setCellValue('F5', 4);

			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle('Offer_letter');
			$sheet = $spreadsheet->getActiveSheet();
			$cellB2 = $sheet->getCell('B2')->getDataValidation();
			$cellB2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellB2->setAllowBlank(false);
			$cellB2->setShowInputMessage(true);
			$cellB2->setShowErrorMessage(true);
			$cellB2->setShowDropDown(true);
			// $rowCount = $sheet1->getHighestRow();
			$cellB2->setFormula1('list1!$B:$B');
			$sheet->setCellValue('V2', '=vlookup(B2,list1!B:C,2,false)');

			$cellC2 = $sheet->getCell('C2')->getDataValidation();
			$cellC2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellC2->setAllowBlank(false);
			$cellC2->setShowInputMessage(true);
			$cellC2->setShowErrorMessage(true);
			$cellC2->setShowDropDown(true);
			// $rowCount = $sheet1->getHighestRow();
			$cellC2->setFormula1('list1!$E:$E');
			$sheet->setCellValue('W2', '=vlookup(C2,list1!E:F,2,false)');

			$writer = new Xlsx($spreadsheet);
			$filename = 'ADMS_OFFER_LETTER_DOWNLOAD_FORMAT';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output'); // download file  
		} else {
			redirect('home/index');
		}
	}
}
