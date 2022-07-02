<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Ffi_payslips extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('admin_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Ffi_payslips_db','payslips');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['payslips']=$this->payslips->get_all_payslips();
			$this->load->view('admin/back_end/ffi_payslips/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function print_payslip()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['payslip']=$this->payslips->get_payslip_details();
			$this->load->view('admin/back_end/ffi_payslips/print_payslip',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	// public function upload_payslips()
	// {
	// 	if($this->session->userdata('admin_login'))
	// 	{
	// 		$data=$this->payslips->upload_payslips();
	// 		redirect('ffi_payslips/');
	// 	}
	// 	else
	// 	{
	// 		redirect('home/index');
	// 	}
	// }
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
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				endif;

				$path = 'AKJHJG7665BHJG/ffi_payslips/';
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
					
					$new_name = $_FILES["file"]['name'];
					$config['upload_path'] = $path;					
					$config['allowed_types'] = 'xlsx|xls|csv';
					$config['remove_spaces'] = TRUE;
					$config['file_name'] = $new_name;	
					$this->load->library('upload', $config);
					$this->upload->initialize($config);  
					if (!$this->upload->do_upload('file')) 
					{
						$error = array('error' => $this->upload->display_errors());
					} else 
					{
						$data = array('upload_data' => $this->upload->data());
					} 
					$inputFileName = $path . $import_xls_file;

				// file path
				$spreadsheet = $reader->load($_FILES['file']['tmp_name']); //1.location
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				//2.fetch stru and datas row wise
				// echo "<pre>"; 
				// print_r($allDataInSheet[2]); 

				$insert = 0;
				$update = 0;
				$month=$this->input->post('payslip_month');
				$year=$this->input->post('payslip_year');
				$date = date("Y-m-d");
				for ($i = 2; $i <= count($allDataInSheet); $i++) {

					$data=array(
						"emp_id"						=> (empty($allDataInSheet[$i]['A']) ? '' : $allDataInSheet[$i]['A']),
						"employee_name"     			=> (empty($allDataInSheet[$i]['B']) ? '' : $allDataInSheet[$i]['B']),
						"designation"					=> (empty($allDataInSheet[$i]['C']) ? '' : $allDataInSheet[$i]['C']),
						"date_of_joining"				=> (empty($allDataInSheet[$i]['D']) ? '' : date('Y-m-d', strtotime($allDataInSheet[$i]['D']))), 
						"department"					=> (empty($allDataInSheet[$i]['E']) ? '' : $allDataInSheet[$i]['E']),
						"uan_no"						=> (empty($allDataInSheet[$i]['F']) ? '' : $allDataInSheet[$i]['F']),
						"pf_no"							=> (empty($allDataInSheet[$i]['G']) ? '' : $allDataInSheet[$i]['G']),
						"esi_no"						=> (empty($allDataInSheet[$i]['H']) ? '' : $allDataInSheet[$i]['H']),
						"bank_name"						=> (empty($allDataInSheet[$i]['I']) ? '' : $allDataInSheet[$i]['I']),
						"account_no"					=> (empty($allDataInSheet[$i]['J']) ? '' : $allDataInSheet[$i]['J']),
						"ifsc_code"						=> (empty($allDataInSheet[$i]['K']) ? '' : $allDataInSheet[$i]['K']),
						"month_days"					=> (empty($allDataInSheet[$i]['L']) ? '' : $allDataInSheet[$i]['L']),
						"pay_days"						=> (empty($allDataInSheet[$i]['M']) ? '' : $allDataInSheet[$i]['M']),
						"leave_days"					=> (empty($allDataInSheet[$i]['N']) ? '' : $allDataInSheet[$i]['N']),
						"lop_days"						=> (empty($allDataInSheet[$i]['O']) ? '' : $allDataInSheet[$i]['O']),
						"arrear_days"					=> (empty($allDataInSheet[$i]['P']) ? '' : $allDataInSheet[$i]['P']),
						"ot_hours"						=> (empty($allDataInSheet[$i]['Q']) ? '' : $allDataInSheet[$i]['Q']),
						"fixed_basic"					=> (empty($allDataInSheet[$i]['R']) ? '' : $allDataInSheet[$i]['R']),
						"fixed_hra"						=> (empty($allDataInSheet[$i]['S']) ? '' : $allDataInSheet[$i]['S']),
						"fixed_con_allow"				=> (empty($allDataInSheet[$i]['T']) ? '' : $allDataInSheet[$i]['T']),
						"fixed_edu_allowance"			=> (empty($allDataInSheet[$i]['U']) ? '' : $allDataInSheet[$i]['U']),
						"fixed_med_reim"				=> (empty($allDataInSheet[$i]['V']) ? '' : $allDataInSheet[$i]['V']),
						"fixed_spec_allow"				=> (empty($allDataInSheet[$i]['W']) ? '' : $allDataInSheet[$i]['W']), 
						"fixed_oth_allow"				=> (empty($allDataInSheet[$i]['X']) ? '' : $allDataInSheet[$i]['X']),
						"fixed_st_bonus"				=> (empty($allDataInSheet[$i]['Y']) ? '' : $allDataInSheet[$i]['Y']),
						"fixed_leave_wages"				=> (empty($allDataInSheet[$i]['Z']) ? '' : $allDataInSheet[$i]['Z']),
						"fixed_holidays_wages"			=> (empty($allDataInSheet[$i]['AA']) ? '' : $allDataInSheet[$i]['AA']),
						"fixed_attendance_bonus"    	=> (empty($allDataInSheet[$i]['AB']) ? '' : $allDataInSheet[$i]['AB']),
						"fixed_ot_wages"				=> (empty($allDataInSheet[$i]['AC']) ? '' : $allDataInSheet[$i]['AC']),
						"fixed_incentive"				=> (empty($allDataInSheet[$i]['AD']) ? '' : $allDataInSheet[$i]['AD']),
						"fixed_arrear_wages"			=> (empty($allDataInSheet[$i]['AE']) ? '' : $allDataInSheet[$i]['AE']),
						"fixed_other_wages"				=> (empty($allDataInSheet[$i]['AF']) ? '' : $allDataInSheet[$i]['AF']),
						"fixed_gross"					=> (empty($allDataInSheet[$i]['AG']) ? '' : $allDataInSheet[$i]['AG']),
						"earned_basic"					=> (empty($allDataInSheet[$i]['AH']) ? '' : $allDataInSheet[$i]['AH']),
						"earned_hra"					=> (empty($allDataInSheet[$i]['AI']) ? '' : $allDataInSheet[$i]['AI']),
						"earned_con_allow"				=> (empty($allDataInSheet[$i]['AJ']) ? '' : $allDataInSheet[$i]['AJ']),
						"earned_education_allowance"	=> (empty($allDataInSheet[$i]['AK']) ? '' : $allDataInSheet[$i]['AK']),
						"earned_med_reim"				=> (empty($allDataInSheet[$i]['AL']) ? '' : $allDataInSheet[$i]['AL']),
						"earned_spec_allow"				=> (empty($allDataInSheet[$i]['AM']) ? '' : $allDataInSheet[$i]['AM']),
						"earned_oth_allow"				=> (empty($allDataInSheet[$i]['AN']) ? '' : $allDataInSheet[$i]['AN']),
						"earned_st_bonus"				=> (empty($allDataInSheet[$i]['AO']) ? '' : $allDataInSheet[$i]['AO']),
						"earned_leave_wages"			=> (empty($allDataInSheet[$i]['AP']) ? '' : $allDataInSheet[$i]['AP']),
						"earned_holiday_wages"			=> (empty($allDataInSheet[$i]['AQ']) ? '' : $allDataInSheet[$i]['AQ']),
						"earned_attendance_bonus"		=> (empty($allDataInSheet[$i]['AR']) ? '' : $allDataInSheet[$i]['AR']),
						"earned_ot_wages"				=> (empty($allDataInSheet[$i]['AS']) ? '' : $allDataInSheet[$i]['AS']),
						"earned_incentive"				=> (empty($allDataInSheet[$i]['AT']) ? '' : $allDataInSheet[$i]['AT']),
						"earned_arrear_wages"			=> (empty($allDataInSheet[$i]['AU']) ? '' : $allDataInSheet[$i]['AU']),
						"earned_other_wages"			=> (empty($allDataInSheet[$i]['AV']) ? '' : $allDataInSheet[$i]['AV']),
						"earned_gross"					=> (empty($allDataInSheet[$i]['AW']) ? '' : $allDataInSheet[$i]['AW']),
						"epf"							=> (empty($allDataInSheet[$i]['AX']) ? '' : $allDataInSheet[$i]['AX']),
						"esic"							=> (empty($allDataInSheet[$i]['AY']) ? '' : $allDataInSheet[$i]['AY']),
						"pt"							=> (empty($allDataInSheet[$i]['AZ']) ? '' : $allDataInSheet[$i]['AZ']),
						"it"							=> (empty($allDataInSheet[$i]['BA']) ? '' : $allDataInSheet[$i]['BA']),	
						"lwf"							=> (empty($allDataInSheet[$i]['BB']) ? '' : $allDataInSheet[$i]['BB']),
						"salary_advance"				=> (empty($allDataInSheet[$i]['BC']) ? '' : $allDataInSheet[$i]['BC']),
						"other_deduction"				=> (empty($allDataInSheet[$i]['BD']) ? '' : $allDataInSheet[$i]['BD']),
						"total_deductions"				=> (empty($allDataInSheet[$i]['BE']) ? '' : $allDataInSheet[$i]['BE']),
						"net_salary"					=> (empty($allDataInSheet[$i]['BF']) ? '' : $allDataInSheet[$i]['BF']),
						"in_words"						=> (empty($allDataInSheet[$i]['BG']) ? '' : $allDataInSheet[$i]['BG']),
						"month"							=> $month,
						"year"							=> $year,
					);

					if ($data['emp_id'] != '' || !empty($data['emp_id'])) {
						if ($import_status = $this->payslips->upload_payslips($data)) {
							if ($import_status == "insert") {
								$insert = $insert + 1;
							} 
						}
					}
				}
				$msg = $insert . ' rows inserted successfully!';
				$this->session->set_flashdata('success', $msg);
			} else {
				$this->session->set_flashdata('no_file', 'Please Choose Valid file formate ');
			}
		}
		redirect('ffi_payslips', 'refresh');
	}
	function delete_payslip()
	{
		$data1=$this->payslips->delete_payslip();
		$data=$this->payslips->search_payslip();
		$i=1;
			foreach($data as $row)
			{
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['emp_id'].'</td>
						<td>'.$row['employee_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['mobile'].'</td>
						<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('ffi_payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_payslip(this.id);" class="dropdown-item" target=""><i class="fa fa-trash"></i> Delete</a>
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
		$data=$this->payslips->search_payslip();
		if($data)
		{
			$i=1;
			foreach($data as $row)
			{
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['emp_id'].'</td>
						<td>'.$row['employee_name'].'</td>
						<td>'.$row['designation'].'</td>
						<td>'.$row['department'].'</td>
						<td style="width:15%">'.date("F Y",strtotime("01-".$row['month']."-".$row['year'])).'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('ffi_payslips/print_payslip/'.$row['id']).'" id="'.$row['id'].'" class="dropdown-item" target="_blank"><i class="fa fa-print"></i> Print</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_payslip(this.id);" class="dropdown-item" target=""><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
				$i++;
			}
		}
		else
		{
			
		}
	}
	public function download_ffi_payslips()
	{
		if ($this->session->userdata('admin_login')) {

			if ($row_count = $this->payslips->download_ffi_payslips()) {

				$this->load->library('zip');

				$path = 'public/ffi_payslip/ffi_payslip_'. date('Y-m-d-his');
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$row_count=$row_count/1000;
				$row_count=round($row_count);
				for($i=0;$i<=$row_count;$i++)
				{
					$a=$i*1000;
					if($data= $this->payslips->download_ffi_payslips_partial(1000,$a))
					{
						// echo "<pre>";
						// print_r($data);
						// exit;
						foreach ($data as $row)
						{
							
							$mpdf = new \Mpdf\Mpdf();
							$datas['payslip'][0] = $row;
							$html = $this->load->view('admin/back_end/ffi_payslips/print_payslip', $datas, true);
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
							
							$mpdf->Output($path . '/' . $row['emp_id'] . "_" . $row['employee_name'] . ".pdf", 'F');
						}
					}
				}

				$this->zip->read_dir($path, false);
				$download = $this->zip->download($path . '.zip');
				
			} else {

				$this->session->set_flashdata('error', 'No datas found');
				redirect('ffi_payslips/');
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
}
