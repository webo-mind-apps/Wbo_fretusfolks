<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

error_reporting(0);
class Increment_letter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/Increment_letter_db', 'increment');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			// $data['offer_letter'] = $this->increment->get_all_increment_letters();
			$data['client_management'] = $this->increment->get_all_client();
			$this->load->view('admin/back_end/increment_letter/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->increment->make_datatables();
			$data = array();
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $row->id;
				$sub_array[] = $row->employee_id;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->emp_name;
				$sub_array[] = date('d M, Y', strtotime($row->date));
				$sub_array[] = $row->phone1;
				$sub_array[] = $row->email;
				$sub_array[] = '
				<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="' . site_url('increment_letter/view_increment_letter/' . $row->id) . '" target="_blank" class="dropdown-item"><i class="fa fa-download"></i>Download Increment Letter</a>
							<a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_increment_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						</div>
					</div>
				</div>
			</td>
					 ';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->increment->get_all_data(),
				"recordsFiltered"     =>     $this->increment->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	function new_increment()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "adms";
			$data['letter_content'] = $this->increment->get_letter_content();
			$data['states'] = $this->increment->get_all_states();
			$data['clients'] = $this->increment->get_all_clients();
			$this->load->view('admin/back_end/increment_letter/new_increment_letter', $data);
		} else {
			redirect('home/index');
		}
	}

	// function letter_content()
	// {
	// 	if ($this->session->userdata('admin_login')) {

	// 		$this->load->view('admin/back_end/increment_letter/increment_content', $data);
	// 	} else {
	// 		redirect('home/index');
	// 	}
	// }

	// function save_increment_letter_content()
	// {
	// 	if ($this->session->userdata('admin_login')) {
	// 		$data['letter_content'] = $this->increment->save_increment_letter_content();
	// 	} else {
	// 		redirect('home/index');
	// 	}
	// }
	function get_employee_detail()
	{
		$data = $this->increment->get_employee_detail();
		$joining_date = "";
		$contract_date = "";
		
		if (!empty($data)||$data!='') {
			if ($data[0]['joining_date'] != "0000-00-00") {
				$joining_date = date("d-m-Y", strtotime($data[0]['joining_date']));
			}
			if ($data[0]['contract_date'] != "0000-00-00") {
				$contract_date = date("d-m-Y", strtotime($data[0]['contract_date']));
			}
			if ($data[0]['data_status'] == 1) {
				echo $data[0]['client_id'] . "****" . $data[0]['emp_name'] . "****" . $joining_date . "****" . $contract_date . "****" . $data[0]['designation'] . "****" . $data[0]['location'] . "****" . $data[0]['department'] . "****" . $data[0]['basic_salary'] . "****" . $data[0]['hra'] . "****" . $data[0]['conveyance'] . "****" . $data[0]['medical_reimbursement'] . "****" . $data[0]['special_allowance'] . "****" . $data[0]['other_allowance'] . "****" . $data[0]['st_bonus'] . "****" . $data[0]['gross_salary'] . "****" . $data[0]['emp_pf'] . "****" . $data[0]['emp_esic'] . "****" . $data[0]['pt'] . "****" . $data[0]['total_deduction'] . "****" . $data[0]['take_home'] . "****" . $data[0]['employer_pf'] . "****" . $data[0]['employer_esic'] . "****" . $data[0]['mediclaim'] . "****" . $data[0]['ctc'];
			} else {
				echo "0";
			}
		} else {
			echo "failed";
		}
	}

	function save_increment_letter()
	{
		$emp_id = $this->input->post('ffi_emp_id');
		// echo "<script>alert('inside')</script>";
		if ($data = $this->increment->save_increment_letter()) {
			$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name,b.last_name,b.middle_name,b.email');
			$this->db->from('increment_letter a');
			$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
			$this->db->join('client_management c', 'a.company_id=c.id', 'left');
			$this->db->where('b.ffi_emp_id', $emp_id);
			$query = $this->db->get();
			$result['letter_details'] = $query->row_array();

			$message = $this->load->view('admin/back_end/increment_letter/increment_email', $result, true);
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
				60, // margin top
				30, // margin bottom
				0, // margin header
				0
			); // margin footer
			$html = $this->load->view('admin/back_end/increment_letter/pdf_increment', $result, true);
			$mpdf->WriteHTML($html);
			$content = $mpdf->Output('', 'S');
			$filename = date('d/m/Y') . "_increments.pdf";
			$subject = "welcome";
			$this->load->config('email');
			$this->load->library('email');
			$from = $this->config->item('smtp_user');
			$to = $result['letter_details']['email'];
			$this->email->set_newline("\r\n");
			$this->email->from($from, 'Fretus folks india');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->attach($content, 'attachment', $filename, 'application/pdf');
			if ($this->email->send()) {
				redirect('increment_letter/');
			} else {
				echo "<script>alert('not sent')</script>";
				exit();
			}
		}
	}

	function delete_increment_letter()
	{
		if ($this->increment->delete_increment_letter()) {
			echo "deleted";
		}
		// $data = $this->increment->get_all_increment_letters();

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
		// 						<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_increment_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
		// 					</div>
		// 				</div>
		// 			</div>
		// 		</td>
		// 	</tr>';
		// 	$i++;
		// }
	}

	public function download_increment()
	{
		if ($this->session->userdata('admin_login')) {

			if ($data['letter_details'] = $this->increment->download_increment()) {
				if ($data['letter_details'] != "nothing_found") {
					$this->load->library('zip');
					$date = date('ymdhis');
					$path = 'increment_letter/incrementLetter_' . $data['letter_details'][0]['client_name'] . $date;
					if (!is_dir($path)) mkdir($path, 0777, TRUE);

					// echo "<script> alert('sdfsdf')</script>";

					// echo '<script>alert("'.count($data['letter_details']).'")</script>';

					foreach ($data['letter_details'] as $key => $row) {
						$mpdf = new \Mpdf\Mpdf();
						$datas['letter_details'][0] = $row;
						$html = $this->load->view('admin/back_end/increment_letter/pdf_increment', $datas, true);
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
						$date = date('Ymdhis') . $key;
						$mpdf->Output($path . '/' . $row['ffi_emp_id'] . "_" . $row['emp_name'] . $date . ".pdf", 'F');
					}
					$this->zip->read_dir($path, false);
					$download = $this->zip->download($path . '.zip');
				} else {
					$this->session->set_flashdata('no_data', 'No datas found');
					redirect('increment_letter');
					// redirect('home/index');
				}
			}
		} else {
			redirect('home/index');
		}
	}

	function view_increment_letter()
	{
		// $data['letter_details'] = $this->increment->get_increment_letter_details();

		// $this->load->view('admin/back_end/increment_letter/print_letter', $data);

		if ($this->session->userdata('admin_login')) {

			if ($data = $this->increment->get_increment_letter_details()) {

				$mpdf = new \Mpdf\Mpdf();
				$datas['letter_details'][0] = $data;
				// echo "<pre>";
				// print_r($datas['letter_details'][0]);
				// exit;
				$html = $this->load->view('admin/back_end/increment_letter/pdf_increment', $datas, true);
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
				$mpdf->Output($data['ffi_emp_id'] . "_" . $data['emp_name'] . $date . ".pdf", 'D');
				redirect('increment_letter');
			}
		} else {
			redirect('home/index');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}

	// excel Import for ADMS increment LETTER 
	public function adms_increment_letter_import()
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
				$spreadsheet = $reader->load($_FILES['import']['tmp_name']);//1.location
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				//2.fetch stru and datas row wise
				echo "<pre>"; 
				print_r($allDataInSheet[2]); 
				exit;
				$insert = 0; 
				$not_exist = 0; 
			 
				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$date = date("Y-m-d");
					$emp_id = (empty($allDataInSheet[$i]['A']) ? 'null' : $allDataInSheet[$i]['A']);
					$data = array(
						"employee_id"			=> (empty($allDataInSheet[$i]['A']) ? '' : $allDataInSheet[$i]['A']),
						"company_id"			=> (empty($allDataInSheet[$i]['V']) ? 'null' : $allDataInSheet[$i]['V']),
						"date"					=>	$date,

						"basic_salary"			=> (empty($allDataInSheet[$i]['C']) ? 'null' : $allDataInSheet[$i]['C']),
						"hra"					=> (empty($allDataInSheet[$i]['D']) ? 'null' : $allDataInSheet[$i]['D']),
						"conveyance"			=> (empty($allDataInSheet[$i]['E']) ? 'null' : $allDataInSheet[$i]['E']),
						"medical_reimbursement"	=> (empty($allDataInSheet[$i]['F']) ? 'null' : $allDataInSheet[$i]['F']),
						"special_allowance"		=> (empty($allDataInSheet[$i]['G']) ? 'null' : $allDataInSheet[$i]['G']),
						"st_bonus"				=> (empty($allDataInSheet[$i]['H']) ? 'null' : $allDataInSheet[$i]['H']),
						"other_allowance"		=> (empty($allDataInSheet[$i]['I']) ? 'null' : $allDataInSheet[$i]['I']),
						"gross_salary"			=> (empty($allDataInSheet[$i]['J']) ? 'null' : $allDataInSheet[$i]['J']),
						"emp_pf"				=> (empty($allDataInSheet[$i]['K']) ? 'null' : $allDataInSheet[$i]['K']),
						"emp_esic"				=> (empty($allDataInSheet[$i]['L']) ? 'null' : $allDataInSheet[$i]['L']),
						"pt"					=> (empty($allDataInSheet[$i]['M']) ? 'null' : $allDataInSheet[$i]['M']),
						"total_deduction"		=> (empty($allDataInSheet[$i]['N']) ? 'null' : $allDataInSheet[$i]['N']),
						"take_home"				=> (empty($allDataInSheet[$i]['O']) ? 'null' : $allDataInSheet[$i]['O']),
						"employer_pf"			=> (empty($allDataInSheet[$i]['P']) ? 'null' : $allDataInSheet[$i]['P']),
						"employer_esic"			=> (empty($allDataInSheet[$i]['Q']) ? 'null' : $allDataInSheet[$i]['Q']),
						"mediclaim"				=> (empty($allDataInSheet[$i]['R']) ? 'null' : $allDataInSheet[$i]['R']),
						"ctc"					=> (empty($allDataInSheet[$i]['S']) ? 'null' : $allDataInSheet[$i]['S']),
						"effective_date"		=> (empty($allDataInSheet[$i]['T']) ? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['T']))),
					);
					if ($data['employee_id'] != '' || !empty($data['employee_id'])) :
						if ($import_status = $this->increment->importEmployee_increment_letter($data)) {

							if ($import_status == "insert") {
								$insert = $insert + 1;

								$this->db->select('a.*,d.content,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date,c.client_name,b.last_name,b.middle_name,b.email,a.effective_date');
								$this->db->from('increment_letter a');
								$this->db->join('backend_management b', 'a.employee_id=b.ffi_emp_id', 'left');
								$this->db->join('client_management c', 'a.company_id=c.id', 'left');
								$this->db->join('letter_content d', 'd.type=1', 'left');
								// $this->db->where('b.ffi_emp_id', $emp_id);
								$query = $this->db->get();
								$result['letter_details'] = $query->result_array();
								// echo "<pre>";
								// print_r($result);
								// exit;
								$message = $this->load->view('admin/back_end/increment_letter/increment_email', $result, true);
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
									60, // margin top
									30, // margin bottom
									0, // margin header
									0
								); // margin footer
								$html = $this->load->view('admin/back_end/increment_letter/pdf_increment', $result, true);
								$mpdf->WriteHTML($html);
								$content = $mpdf->Output('', 'S');
								$filename = date('d/m/Y') . "_increment.pdf";
								$subject = "welcome";
								$this->load->config('email');
								$this->load->library('email');
								$from = $this->config->item('smtp_user');

								$to = $result['letter_details'][0]['email'];
								$this->email->set_newline("\r\n");
								$this->email->from($from, 'Fretus folks india');
								$this->email->to($to);
								$this->email->subject($subject);
								$this->email->message($message);
								$this->email->attach($content, 'attachment', $filename, 'application/pdf');
								if (!$this->email->send()) {
									echo "<script>alert('not sended');</script>";
								}
							} else if ($import_status == "not_exist") {
								$not_exist = $not_exist + 1;
							}
							// else if ($import_status == "nochanges") {
							// 	$nochanges = $nochanges + 1;
							// }
						}
					endif;
				}
				// echo "insert".$insert."<br>update".$update."<br>not exsist".$not_exist."<br>nochanges".$nochanges;

				$msg = $insert . ' rows inserted <br>'  . $not_exist . ' employee not founded <br>';
				$this->session->set_flashdata('success', $msg);
				redirect('increment_letter', 'refresh');
			} else {
				$this->session->set_flashdata('no_file', 'Please Choose Valid file formate ');
				redirect('increment_letter', 'refresh');
			}
			redirect('increment_letter', 'refresh');
		}
	}
	public function doc_formate()
	{
		if ($this->session->userdata('admin_login')) {
			$client = $this->increment->get_all_clients();
			// $alpha = array('A', 'B', 'C','D', 'E', 'F','G', 'H', 'I','J', 'K', 'L','M', 'N', 'O');

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("admin_assets/exel-formate/ADMS_INCREMENT_LETTER.xlsx");

			$spreadsheet->setActiveSheetIndex(1);
			$spreadsheet->getActiveSheet()->setTitle('list1');
			$sheet1 = $spreadsheet->getActiveSheet();
			$sheet1->setCellValue('A1', 'SL No');
			$sheet1->setCellValue('C1', 'CLIENT ID');
			$sheet1->setCellValue('B1', 'CLIENT NAME');

			// $sheet1->setCellValue('E1', 'Letter format');
			// $sheet1->setCellValue('F1', 'Format Id');


			$sheet1->getStyle("A1:G1")->applyFromArray(array("font" => array("bold" => true)));
			foreach (range('A', 'G') as $columnID) {
				$sheet1->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$i = 2;
			foreach ($client as $key => $value) {

				$sheet1->setCellValue('A' . $i, $key + 1);
				$sheet1->setCellValue('C' . $i, $value['id']);
				$sheet1->setCellValue('B' . $i, $value['client_name']);
				$i += 1;
			}

			// $sheet1->setCellValue('E2', 'Format 1');
			// $sheet1->setCellValue('E3', 'Format 2');
			// $sheet1->setCellValue('E4', 'Format 3');
			// $sheet1->setCellValue('E5', 'Udaan');

			// $sheet1->setCellValue('F2', '1');
			// $sheet1->setCellValue('F3', '2');
			// $sheet1->setCellValue('F4', '3');
			// $sheet1->setCellValue('F5', '4');

			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();
			$cellB2 = $sheet->getCell('B2')->getDataValidation();
			$cellB2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			$cellB2->setAllowBlank(false);
			$cellB2->setShowInputMessage(true);
			$cellB2->setShowErrorMessage(true);
			$cellB2->setShowDropDown(true);
			$rowCount = $sheet1->getHighestRow();
			$cellB2->setFormula1('list1!$B:$B');
			$sheet->setCellValue('V2', '=vlookup(B2,list1!B:C,2,false)');

			// $cellO2 = $sheet->getCell('C2')->getDataValidation();
			// $cellO2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
			// $cellO2->setAllowBlank(false);
			// $cellO2->setShowInputMessage(true);
			// $cellO2->setShowErrorMessage(true);
			// $cellO2->setShowDropDown(true);
			// $cellO2->setFormula1('list1!$E:$E');
			// $sheet->setCellValue('W2', '=vlookup(C2,list1!E:F,2,false)');

			$writer = new Xlsx($spreadsheet);
			$filename = 'ADMS_INCREMENT_LETTER_DOWNLOAD_FORMAT';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output'); // download file 

		} else {
			redirect('home/index');
		}
	}
}
