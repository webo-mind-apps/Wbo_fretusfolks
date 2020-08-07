<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Payslips_db extends CI_Model 
{  
    function __construct()  
    {
		parent::__construct();
	
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_payslips()
	{
		$this->db->order_by('id','DESC');
		$query=$this->db->get('payslips');
		$q=$query->result_array();
		return $q;
	}
	public function get_all_payslips_for_email($emp_id)
	{
		$this->db->where('emp_id',$emp_id);
		$query=$this->db->get('payslips');
		$q=$query->row_array();
		return $q;
	}
	public function get_all_client()
	{
		$query=$this->db->get('client_management');
		$q=$query->result_array();
		return $q;
	}

	public function download_payslips()
	{
		$month=$this->input->post('payslip_download_month');
		$year=$this->input->post('payslip_download_year');
		$client_name=$this->input->post('payslip_download_client');
	
		$this->db->where('month',$month);
		$this->db->where('year',$year);
		$this->db->where('client_name',$client_name);
		$query=$this->db->get('payslips');
		$q=$query->result_array();
		return $q;
	}
	public function upload_payslips()
		{
			$month=$this->input->post('payslip_month');
			$year=$this->input->post('payslip_year');
			$db_date=date("Y-m-d");
			$this->load->library("excel");
			
			$path = 'AKJHJG7665BHJG/payslips/';
				
			$new_name = $_FILES["file"]['name'];
			$type = $_FILES["file"]['type'];
			$config['upload_path'] = $path;					
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
			$config['file_name'] = $new_name;	
			$this->load->library('upload', $config);
            $this->upload->initialize($config);      
			$gftype=pathinfo($_FILES["edu_certificate"]['name'], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["edu_certificate"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{	
					if (!$this->upload->do_upload('file')) 
					{
						$error = array('error' => $this->upload->display_errors());
					} else 
					{
						$data = array('upload_data' => $this->upload->data());
					}
				}
					if (!empty($data['upload_data']['file_name'])) 
			{
                $import_xls_file = $data['upload_data']['file_name'];
            } else 
			{
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
			
			try 
			{
					$data = array();
					// Load form validation library
					if (!empty($_FILES['file']['name'])) {
						// get file extension
						$valid_extentions = array('xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw');
						$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
						$valid = false;
						foreach ($valid_extentions as $key => $value) {
							if ($extension == $value) {
								$valid = true;
							}
						}

						if ($valid)
						 {
							if ($extension == 'csv') :
								$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
							elseif ($extension == 'xlsx') :
								$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
							else :
								$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
							endif;

							// file path
							$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
							$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

							for ($i = 2; $i <= count($allDataInSheet); $i++)
							 {
							
								$emp_id = (empty($allDataInSheet[$i]['B']) ? 'null' : $allDataInSheet[$i]['B']);
								
								$fix_total_gross = (empty($allDataInSheet[$i]['AK']) ? 'null' : $allDataInSheet[$i]['AK']);
								$earn_basic = (empty($allDataInSheet[$i]['AL']) ? 'null' : $allDataInSheet[$i]['AL']);
								$earn_hra = (empty($allDataInSheet[$i]['AM']) ? 'null' : $allDataInSheet[$i]['AM']);
								$earn_conveyance = (empty($allDataInSheet[$i]['AN']) ? 'null' : $allDataInSheet[$i]['AN']);
								$earn_education_allowance = (empty($allDataInSheet[$i]['AO']) ? 'null' : $allDataInSheet[$i]['AO']);
								$earn_medical_reimbursement =(empty($allDataInSheet[$i]['AP']) ? 'null' : $allDataInSheet[$i]['AP']);
								$earn_special_allowance = (empty($allDataInSheet[$i]['AQ']) ? 'null' : $allDataInSheet[$i]['AQ']);
								$earn_other_allowance = (empty($allDataInSheet[$i]['AR']) ? 'null' : $allDataInSheet[$i]['AR']);
								$earn_st_bonus = (empty($allDataInSheet[$i]['AS']) ? 'null' : $allDataInSheet[$i]['AS']);
								$earn_leave_wages = (empty($allDataInSheet[$i]['AT']) ? 'null' : $allDataInSheet[$i]['AT']);
								$earn_holiday_wages = (empty($allDataInSheet[$i]['AU']) ? 'null' : $allDataInSheet[$i]['AU']);
								$earn_attendance_bonus = (empty($allDataInSheet[$i]['AV']) ? 'null' : $allDataInSheet[$i]['AV']);
								$earn_ot_wages = (empty($allDataInSheet[$i]['AW']) ? 'null' : $allDataInSheet[$i]['AW']);
								$earn_incentive_wages = (empty($allDataInSheet[$i]['AX']) ? 'null' : $allDataInSheet[$i]['AX']);
								$earn_arrear_wages = (empty($allDataInSheet[$i]['AY']) ? 'null' : $allDataInSheet[$i]['AY']);
								$earn_other_wages = (empty($allDataInSheet[$i]['AZ']) ? 'null' : $allDataInSheet[$i]['AZ']);
								$earn_total_gross = (empty($allDataInSheet[$i]['BA']) ? 'null' : $allDataInSheet[$i]['BA']);
								$epf =(empty($allDataInSheet[$i]['BB']) ? 'null' : $allDataInSheet[$i]['BB']);

								$esic = (empty($allDataInSheet[$i]['BC']) ? 'null' : $allDataInSheet[$i]['BC']);
								$pt = (empty($allDataInSheet[$i]['BD']) ? 'null' : $allDataInSheet[$i]['BD']);
								$it =(empty($allDataInSheet[$i]['BE']) ? 'null' : $allDataInSheet[$i]['BE']);
								$total_deduction = (empty($allDataInSheet[$i]['BI']) ? 'null' : $allDataInSheet[$i]['BI']);
								$net_salary = (empty($allDataInSheet[$i]['BJ']) ? 'null' : $allDataInSheet[$i]['BJ']);
								$in_words = (empty($allDataInSheet[$i]['BK']) ? 'null' : $allDataInSheet[$i]['BK']);

								if(strstr($fix_total_gross,'=')==true)
								{
									$fix_total_gross = $spreadsheet->getActiveSheet()->getCell('AK'.$i)->getOldCalculatedValue();
								}

								if(strstr($earn_basic,'=')==true)
								{
									$earn_basic = $spreadsheet->getActiveSheet()->getCell('AL'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_hra,'=')==true)
								{
									$earn_hra = $spreadsheet->getActiveSheet()->getCell('AM'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_conveyance,'=')==true)
								{
									$earn_conveyance = $spreadsheet->getActiveSheet()->getCell('AN'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_education_allowance,'=')==true)
								{
									$earn_education_allowance = $spreadsheet->getActiveSheet()->getCell('AO'.$i)->getOldCalculatedValue();
								}
								
								if(strstr($earn_medical_reimbursement,'=')==true)
								{
									$earn_medical_reimbursement =$spreadsheet->getActiveSheet()->getCell('AP'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_special_allowance,'=')==true)
								{
									$earn_special_allowance = $spreadsheet->getActiveSheet()->getCell('AQ'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_other_allowance,'=')==true)
								{
									$earn_other_allowance = $spreadsheet->getActiveSheet()->getCell('AR'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_st_bonus,'=')==true)
								{
									$earn_st_bonus = $spreadsheet->getActiveSheet()->getCell('AS'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_leave_wages,'=')==true)
								{
									$earn_leave_wages = $spreadsheet->getActiveSheet()->getCell('AT'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_holiday_wages,'=')==true)
								{
									$earn_holiday_wages =$spreadsheet->getActiveSheet()->getCell('AU'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_attendance_bonus,'=')==true)
								{
									$earn_attendance_bonus =$spreadsheet->getActiveSheet()->getCell('AV'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_ot_wages,'=')==true)
								{
									$earn_ot_wages = $spreadsheet->getActiveSheet()->getCell('AW'.$i)->getOldCalculatedValue();
								}
								
								if(strstr($earn_incentive_wages,'=')==true)
								{
									$earn_incentive_wages =$spreadsheet->getActiveSheet()->getCell('AX'.$i)->getOldCalculatedValue();
								}
								
								if(strstr($earn_arrear_wages,'=')==true)
								{
									$earn_arrear_wages = $spreadsheet->getActiveSheet()->getCell('AY'.$i)->getOldCalculatedValue();
								}
								
								if(strstr($earn_other_wages,'=')==true)
								{
									$earn_other_wages = $spreadsheet->getActiveSheet()->getCell('AZ'.$i)->getOldCalculatedValue();
								}
								if(strstr($earn_total_gross,'=')==true)
								{
									$earn_total_gross = $spreadsheet->getActiveSheet()->getCell('BA'.$i)->getOldCalculatedValue();
								}
							
								if(strstr($epf,'=')==true)
								{
									$epf = $spreadsheet->getActiveSheet()->getCell('BB'.$i)->getOldCalculatedValue();
								}
								
								
								if(strstr($esic,'=')==true)
								{
									$esic = $spreadsheet->getActiveSheet()->getCell('BC'.$i)->getOldCalculatedValue();
								}
								
								
								
								if(strstr($pt,'=')==true)
								{
									$pt = $spreadsheet->getActiveSheet()->getCell('BD'.$i)->getOldCalculatedValue();
								}
								
								
								if(strstr($it,'=')==true)
								{
									$it = $spreadsheet->getActiveSheet()->getCell('BE'.$i)->getOldCalculatedValue();
								}
								
							
								if(strstr($total_deduction,'=')==true)
								{
									$total_deduction = $spreadsheet->getActiveSheet()->getCell('BI'.$i)->getOldCalculatedValue();
								}
								
								
								if(strstr($net_salary,'=')==true)
								{
									$net_salary = $spreadsheet->getActiveSheet()->getCell('BJ'.$i)->getOldCalculatedValue();
								}
								
								if(strstr($in_words,'=')==true)
								{
									$in_words =$spreadsheet->getActiveSheet()->getCell('BK'.$i)->getOldCalculatedValue();
								}
								
								

								$data=array(
									"emp_id"						=>$emp_id,
									"emp_name"						=>(empty($allDataInSheet[$i]['C']) ? 'null' : $allDataInSheet[$i]['C']),
									"designation"					=>(empty($allDataInSheet[$i]['D']) ? 'null' : $allDataInSheet[$i]['D']),
									"doj"							=>(empty($allDataInSheet[$i]['E']) ? 'null' : $allDataInSheet[$i]['E']),
									"department"					=>(empty($allDataInSheet[$i]['F']) ? 'null' : $allDataInSheet[$i]['F']),
									"location"						=>(empty($allDataInSheet[$i]['G']) ? 'null' : $allDataInSheet[$i]['G']),
									"client_name"					=>(empty($allDataInSheet[$i]['BM']) ? 'null' : $allDataInSheet[$i]['BM']),
									"uan_no"						=>(empty($allDataInSheet[$i]['I']) ? 'null' : $allDataInSheet[$i]['I']),
									"pf_no"							=>(empty($allDataInSheet[$i]['J']) ? 'null' : $allDataInSheet[$i]['J']),
									"esi_no"						=>(empty($allDataInSheet[$i]['K']) ? 'null' : $allDataInSheet[$i]['K']),
									"bank_name"						=>(empty($allDataInSheet[$i]['L']) ? 'null' : $allDataInSheet[$i]['L']),
									"account_no"					=>(empty($allDataInSheet[$i]['M']) ? 'null' : $allDataInSheet[$i]['M']),
									"ifsc_code"						=>(empty($allDataInSheet[$i]['N']) ? 'null' : $allDataInSheet[$i]['N']),
									"month_days"					=>(empty($allDataInSheet[$i]['O']) ? 'null' : $allDataInSheet[$i]['O']),
									"payable_days"					=>(empty($allDataInSheet[$i]['P']) ? 'null' : $allDataInSheet[$i]['P']),
									"leave_days"					=>(empty($allDataInSheet[$i]['Q']) ? 'null' : $allDataInSheet[$i]['Q']),
									"lop_days"						=>(empty($allDataInSheet[$i]['R']) ? 'null' : $allDataInSheet[$i]['R']),
									"arrears_days"					=>(empty($allDataInSheet[$i]['S']) ? 'null' : $allDataInSheet[$i]['S']),
									"ot_hours"						=>(empty($allDataInSheet[$i]['T']) ? 'null' : $allDataInSheet[$i]['T']),
									"leave_balance"					=>(empty($allDataInSheet[$i]['U']) ? 'null' : $allDataInSheet[$i]['U']),
									"fixed_basic_da"				=>(empty($allDataInSheet[$i]['V']) ? 'null' : $allDataInSheet[$i]['V']),
									"fixed_hra"						=>(empty($allDataInSheet[$i]['W']) ? 'null' : $allDataInSheet[$i]['W']),
									"fixed_conveyance"				=>(empty($allDataInSheet[$i]['X']) ? 'null' : $allDataInSheet[$i]['X']),
									"fixed_medical_reimbursement"	=>(empty($allDataInSheet[$i]['Z']) ? 'null' : $allDataInSheet[$i]['Z']),
									"fixed_special_allowance" 		=>(empty($allDataInSheet[$i]['AA']) ? 'null' : $allDataInSheet[$i]['AA']),
									"fixed_other_allowance"			=>(empty($allDataInSheet[$i]['AB']) ? 'null' : $allDataInSheet[$i]['AB']),
									"fixed_ot_wages"				=>(empty($allDataInSheet[$i]['AG']) ? 'null' : $allDataInSheet[$i]['AG']),
									"fixed_attendance_bonus"		=>(empty($allDataInSheet[$i]['AF']) ? 'null' : $allDataInSheet[$i]['AF']),
									"fixed_st_bonus"				=>(empty($allDataInSheet[$i]['AC']) ? 'null' : $allDataInSheet[$i]['AC']),
									"fixed_holiday_wages"			=>(empty($allDataInSheet[$i]['AE']) ? 'null' : $allDataInSheet[$i]['AE']),
									"fixed_other_wages"				=>(empty($allDataInSheet[$i]['AJ']) ? 'null' : $allDataInSheet[$i]['AJ']),
									"fixed_total_earnings"			=>$fix_total_gross,
									"fix_education_allowance"		=>(empty($allDataInSheet[$i]['Y']) ? 'null' : $allDataInSheet[$i]['Y']),
									"fix_leave_wages"				=>(empty($allDataInSheet[$i]['AD']) ? 'null' : $allDataInSheet[$i]['AD']),
									"fix_incentive_wages"			=>(empty($allDataInSheet[$i]['AH']) ? 'null' : $allDataInSheet[$i]['AH']),
									"fix_arrear_wages"				=>(empty($allDataInSheet[$i]['AI']) ? 'null' : $allDataInSheet[$i]['AI']),
									"earn_basic"					=>$earn_basic,
									"earn_hr"						=>$earn_hra,
									"earn_conveyance"				=>$earn_conveyance,
									"earn_medical_allowance"		=>$earn_medical_reimbursement,
									"earn_special_allowance"		=>$earn_special_allowance,
									"earn_other_allowance"			=>$earn_other_allowance,
									"earn_ot_wages"					=>$earn_ot_wages,
									"earn_attendance_bonus"			=>$earn_attendance_bonus,
									"earn_st_bonus"					=>$earn_st_bonus,
									"earn_holiday_wages"			=>$earn_holiday_wages,
									"earn_other_wages"				=>$earn_other_wages,
									"earn_total_gross"				=>$earn_total_gross,
									"earn_education_allowance"		=>$earn_education_allowance,
									"earn_leave_wages"				=>$earn_leave_wages,
									"earn_incentive_wages"			=>$earn_incentive_wages,
									"earn_arrear_wages"				=>$earn_arrear_wages,
									"epf"							=>(empty($allDataInSheet[$i]['BB']) ? 'null' : $allDataInSheet[$i]['BB']),
									"esic"							=>$esic,
									"pt"							=>$pt,
									"it"							=>$it,
									"lwf"							=>(empty($allDataInSheet[$i]['BF']) ? 'null' : $allDataInSheet[$i]['BF']),
									"salary_advance"				=>(empty($allDataInSheet[$i]['BG']) ? 'null' : $allDataInSheet[$i]['BG']),
									"other_deduction"				=>(empty($allDataInSheet[$i]['BH']) ? 'null' : $allDataInSheet[$i]['BH']),
									"total_deduction"				=>$total_deduction,
									"net_salary"					=>$net_salary,
									"in_words"						=>$in_words,
									"month"							=>$month,
									"year"							=>$year,
									"date_upload"					=>$db_date,
								);
								
								$qry=$this->db->insert('payslips',$data);
								if($qry)
								{
									$this->db->select('ffi_emp_id,email,emp_name,middle_name,last_name');
									$this->db->from('backend_management');
									$this->db->where('ffi_emp_id',$emp_id);
									$query=$this->db->get();
									$q[] =$query->row_array();
								}
								
							}

							if($qry)
							{
								$this->session->set_flashdata('success','success');
							}
							else
							{
								$this->session->set_flashdata('abc','error');
							}

							return $q;
						} 
						else
						 {

							$this->session->set_flashdata('error', 'Please Choose Valid file formate ');
						}
					}
				}
			
			catch(Exception $e) 
			{	
					$this->session->set_flashdata('abc','error');
			}
	}
	function get_payslip_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('payslips');
		$q=$query->result_array();
		return $q;
	}
	function delete_payslip()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('payslips');
	}
	function search_payslip()
	{
		$emp_id=$this->input->post('emp_id');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		
		if($emp_id !="")
		{
			$this->db->where('emp_id',$emp_id);
		}
		if($month !="")
		{
			$this->db->where('month',$month);
		}
		if($year !="")
		{
			$this->db->where('year',$year);
		}
		$this->db->order_by('id','ASC');
		$query=$this->db->get('payslips');
		$q=$query->result_array();
		return $q;
	}
	function get_all_clients()
	{
		$this->db->where("status","0");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
		$q=$query->result_array();
		return $q;
	}
}  
?>
