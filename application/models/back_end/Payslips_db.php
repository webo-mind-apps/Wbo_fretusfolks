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
		$this->load->library("excel");
		
		$path = 'uploads/payslips/';
			
			$new_name = $_FILES["file"]['name'];
			$type = $_FILES["file"]['type'];
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
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$flag = true;
					$i=0;
					$success_count=0;
					$fail_count=0;
					$error_data=array();
				
					foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
					{
						$highestRow = $worksheet->getHighestRow();
						$highestColumn = $worksheet->getHighestColumn();
						for($i=2; $i<=$highestRow; $i++)
						{
							$emp_id = $worksheet->getCellByColumnAndRow(1, $i)->getValue();
							$name = $worksheet->getCellByColumnAndRow(2, $i)->getValue();
							$designation = $worksheet->getCellByColumnAndRow(3, $i)->getValue();
							$doj = $worksheet->getCellByColumnAndRow(4, $i)->getValue();
							$department = $worksheet->getCellByColumnAndRow(5, $i)->getValue();
							//$vertical = $worksheet->getCellByColumnAndRow(6, $i)->getValue();
							$location = $worksheet->getCellByColumnAndRow(6, $i)->getValue();
							$client_name = $worksheet->getCellByColumnAndRow(7, $i)->getValue();
							$uan_no = $worksheet->getCellByColumnAndRow(8, $i)->getValue();
							$pf_no = $worksheet->getCellByColumnAndRow(9, $i)->getValue();
							$esic_no = $worksheet->getCellByColumnAndRow(10, $i)->getValue();
							$bank_name = $worksheet->getCellByColumnAndRow(11, $i)->getValue();
							$bank_account = $worksheet->getCellByColumnAndRow(12, $i)->getValue();
							
							$ifsc_code=$worksheet->getCellByColumnAndRow(13, $i)->getValue();
							
							$month_days = $worksheet->getCellByColumnAndRow(14, $i)->getValue();
							$payable_days = $worksheet->getCellByColumnAndRow(15, $i)->getValue();
							$leave_days = $worksheet->getCellByColumnAndRow(16, $i)->getValue();
							$lop = $worksheet->getCellByColumnAndRow(17, $i)->getValue();
							$arrears_days = $worksheet->getCellByColumnAndRow(18, $i)->getValue();
							$ot_hours = $worksheet->getCellByColumnAndRow(19, $i)->getValue();
							$leave_balance = $worksheet->getCellByColumnAndRow(20, $i)->getValue();
						
								// 	$notice_period_days = $worksheet->getCellByColumnAndRow(19, $i)->getValue();
							
							$fix_basic = $worksheet->getCellByColumnAndRow(21, $i)->getValue();
							$fix_hra = $worksheet->getCellByColumnAndRow(22, $i)->getValue();
							$fix_conveyance = $worksheet->getCellByColumnAndRow(23, $i)->getValue();
								$fix_education_allowance = $worksheet->getCellByColumnAndRow(24, $i)->getValue();
							
							$fix_medical_reimbursement = $worksheet->getCellByColumnAndRow(25, $i)->getValue();
							$fix_special_allowance = $worksheet->getCellByColumnAndRow(26, $i)->getValue();
							$fix_other_allowance = $worksheet->getCellByColumnAndRow(27, $i)->getValue();
							
							$fix_st_bonus = $worksheet->getCellByColumnAndRow(28, $i)->getValue();
								$fix_leave_wages=$worksheet->getCellByColumnAndRow(29, $i)->getValue();
							$fix_holiday_wages = $worksheet->getCellByColumnAndRow(30, $i)->getValue();
							$fix_attendance_bonus = $worksheet->getCellByColumnAndRow(31, $i)->getValue();
							
							$fix_ot_wages = $worksheet->getCellByColumnAndRow(32, $i)->getValue();
								$fix_incentive_wages = $worksheet->getCellByColumnAndRow(33, $i)->getValue();
								$fix_arrear_wages = $worksheet->getCellByColumnAndRow(34, $i)->getValue();
							
							
							$fix_other_wages = $worksheet->getCellByColumnAndRow(35, $i)->getValue();
							$fix_total_gross = $worksheet->getCellByColumnAndRow(36, $i)->getValue();
								if(strstr($fix_total_gross,'=')==true)
								{
									$fix_total_gross = $worksheet->getCellByColumnAndRow(36, $i)->getOldCalculatedValue();
								}
							
							
							$earn_basic = $worksheet->getCellByColumnAndRow(37, $i)->getValue(); 
							$earn_hra = $worksheet->getCellByColumnAndRow(38, $i)->getValue(); 
							$earn_conveyance = $worksheet->getCellByColumnAndRow(39, $i)->getValue(); 
							$earn_education_allowance = $worksheet->getCellByColumnAndRow(40, $i)->getValue(); 
							$earn_medical_reimbursement = $worksheet->getCellByColumnAndRow(41, $i)->getValue();
							$earn_special_allowance = $worksheet->getCellByColumnAndRow(42, $i)->getValue();
							$earn_other_allowance = $worksheet->getCellByColumnAndRow(43, $i)->getValue();
							$earn_st_bonus = $worksheet->getCellByColumnAndRow(44, $i)->getValue();
								$earn_leave_wages=$worksheet->getCellByColumnAndRow(45, $i)->getValue();
							$earn_holiday_wages = $worksheet->getCellByColumnAndRow(46, $i)->getValue();
							$earn_attendance_bonus = $worksheet->getCellByColumnAndRow(47, $i)->getValue();
							$earn_ot_wages = $worksheet->getCellByColumnAndRow(48, $i)->getValue();
								$earn_incentive_wages = $worksheet->getCellByColumnAndRow(49, $i)->getValue();
								$earn_arrear_wages = $worksheet->getCellByColumnAndRow(50, $i)->getValue();
							 
							$earn_other_wages = $worksheet->getCellByColumnAndRow(51, $i)->getValue();
							$earn_total_gross = $worksheet->getCellByColumnAndRow(52, $i)->getValue();
							 
							
							
							if(strstr($earn_basic,'=')==true)
							{
								$earn_basic = $worksheet->getCellByColumnAndRow(37, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_hra,'=')==true)
							{
								$earn_hra = $worksheet->getCellByColumnAndRow(38, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_conveyance,'=')==true)
							{
								$earn_conveyance = $worksheet->getCellByColumnAndRow(39, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_education_allowance,'=')==true)
							{
								$earn_education_allowance = $worksheet->getCellByColumnAndRow(40, $i)->getOldCalculatedValue();
							}
							
							if(strstr($earn_medical_reimbursement,'=')==true)
							{
								$earn_medical_reimbursement = $worksheet->getCellByColumnAndRow(41, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_special_allowance,'=')==true)
							{
								$earn_special_allowance = $worksheet->getCellByColumnAndRow(42, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_other_allowance,'=')==true)
							{
								$earn_other_allowance = $worksheet->getCellByColumnAndRow(43, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_st_bonus,'=')==true)
							{
								$earn_st_bonus = $worksheet->getCellByColumnAndRow(44, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_leave_wages,'=')==true)
							{
								$earn_leave_wages = $worksheet->getCellByColumnAndRow(45, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_holiday_wages,'=')==true)
							{
								$earn_holiday_wages = $worksheet->getCellByColumnAndRow(46, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_attendance_bonus,'=')==true)
							{
								$earn_attendance_bonus = $worksheet->getCellByColumnAndRow(47, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_ot_wages,'=')==true)
							{
								$earn_ot_wages = $worksheet->getCellByColumnAndRow(48, $i)->getOldCalculatedValue();
							}
							
							if(strstr($earn_incentive_wages,'=')==true)
							{
								$earn_incentive_wages = $worksheet->getCellByColumnAndRow(49, $i)->getOldCalculatedValue();
							}
							
							if(strstr($earn_arrear_wages,'=')==true)
							{
								$earn_arrear_wages = $worksheet->getCellByColumnAndRow(50, $i)->getOldCalculatedValue();
							}
							
							if(strstr($earn_other_wages,'=')==true)
							{
								$earn_other_wages = $worksheet->getCellByColumnAndRow(51, $i)->getOldCalculatedValue();
							}
							if(strstr($earn_total_gross,'=')==true)
							{
								$earn_total_gross = $worksheet->getCellByColumnAndRow(52, $i)->getOldCalculatedValue();
							}
							
							
							/*$arr_basic = $worksheet->getCellByColumnAndRow(44, $i)->getValue();
							$arr_hra = $worksheet->getCellByColumnAndRow(45, $i)->getValue();
							$arr_conveyance = $worksheet->getCellByColumnAndRow(46, $i)->getValue();
							$arr_medical_reimbursement = $worksheet->getCellByColumnAndRow(47, $i)->getValue();
							$arr_special_allowance = $worksheet->getCellByColumnAndRow(48, $i)->getValue();
							$arr_other_allowance = $worksheet->getCellByColumnAndRow(49, $i)->getValue();
							$arr_ot_wages = $worksheet->getCellByColumnAndRow(50, $i)->getValue();
							$arr_attendance_bonus = $worksheet->getCellByColumnAndRow(51, $i)->getValue();
							$arr_st_bonus = $worksheet->getCellByColumnAndRow(52, $i)->getValue();
							$arr_holiday_wages = $worksheet->getCellByColumnAndRow(53, $i)->getValue();
							$arr_other_wages = $worksheet->getCellByColumnAndRow(54, $i)->getValue();
							$arr_total_gross = $worksheet->getCellByColumnAndRow(55, $i)->getValue();
							if(strstr($arr_total_gross,'=')==true)
							{
								$arr_total_gross = $worksheet->getCellByColumnAndRow(55, $i)->getOldCalculatedValue();
							}
							
							$total_basic = $worksheet->getCellByColumnAndRow(56, $i)->getValue();
							if(strstr($total_basic,'=')==true)
							{
								$total_basic = $worksheet->getCellByColumnAndRow(56, $i)->getOldCalculatedValue();
							}
							
							$total_hra = $worksheet->getCellByColumnAndRow(57, $i)->getValue();
							if(strstr($total_hra,'=')==true)
							{
								$total_hra = $worksheet->getCellByColumnAndRow(57, $i)->getOldCalculatedValue();
							}
							
							$total_conveyance = $worksheet->getCellByColumnAndRow(58, $i)->getValue();
							if(strstr($total_conveyance,'=')==true)
							{
								$total_conveyance = $worksheet->getCellByColumnAndRow(58, $i)->getOldCalculatedValue();
							}
							
							$total_medical_reimbursement = $worksheet->getCellByColumnAndRow(59, $i)->getValue();
							if(strstr($total_medical_reimbursement,'=')==true)
							{
								$total_medical_reimbursement = $worksheet->getCellByColumnAndRow(59, $i)->getOldCalculatedValue();
							}
							
							$total_special_allowance = $worksheet->getCellByColumnAndRow(60, $i)->getValue();
							if(strstr($total_special_allowance,'=')==true)
							{
								$total_special_allowance = $worksheet->getCellByColumnAndRow(60, $i)->getOldCalculatedValue();
							}
							
							$total_other_allowance = $worksheet->getCellByColumnAndRow(61, $i)->getValue();
							if(strstr($total_other_allowance,'=')==true)
							{
								$total_other_allowance = $worksheet->getCellByColumnAndRow(61, $i)->getOldCalculatedValue();
							}
							
							$total_ot_wages = $worksheet->getCellByColumnAndRow(62, $i)->getValue();
							if(strstr($total_ot_wages,'=')==true)
							{
								$total_ot_wages = $worksheet->getCellByColumnAndRow(62, $i)->getOldCalculatedValue();
							}
							
							$total_attendance_bonus = $worksheet->getCellByColumnAndRow(63, $i)->getValue();
							if(strstr($total_attendance_bonus,'=')==true)
							{
								$total_attendance_bonus = $worksheet->getCellByColumnAndRow(63, $i)->getOldCalculatedValue();
							}
							
							$total_st_bonus = $worksheet->getCellByColumnAndRow(64, $i)->getValue();
							if(strstr($total_st_bonus,'=')==true)
							{
								$total_st_bonus = $worksheet->getCellByColumnAndRow(64, $i)->getOldCalculatedValue();
							}
							
							$total_holiday_wages = $worksheet->getCellByColumnAndRow(65, $i)->getValue();
							if(strstr($total_holiday_wages,'=')==true)
							{
								$total_holiday_wages = $worksheet->getCellByColumnAndRow(65, $i)->getOldCalculatedValue();
							}
							
							$total_other_wages = $worksheet->getCellByColumnAndRow(66, $i)->getValue();
							if(strstr($total_other_wages,'=')==true)
							{
								$total_other_wages = $worksheet->getCellByColumnAndRow(66, $i)->getOldCalculatedValue();
							}
							
							$total_total_gross = $worksheet->getCellByColumnAndRow(67, $i)->getValue();
							if(strstr($total_total_gross,'=')==true)
							{
								$total_total_gross = $worksheet->getCellByColumnAndRow(67, $i)->getOldCalculatedValue();
							}*/
							
							$epf = $worksheet->getCellByColumnAndRow(53, $i)->getValue();
							
							if(strstr($epf,'=')==true)
							{
								$epf = $worksheet->getCellByColumnAndRow(53, $i)->getOldCalculatedValue();
							}
							
							$esic = $worksheet->getCellByColumnAndRow(54, $i)->getValue();
							if(strstr($esic,'=')==true)
							{
								$esic = $worksheet->getCellByColumnAndRow(54, $i)->getOldCalculatedValue();
							}
							
							$pt = $worksheet->getCellByColumnAndRow(55, $i)->getValue();
							
							if(strstr($pt,'=')==true)
							{
								$pt = $worksheet->getCellByColumnAndRow(55, $i)->getOldCalculatedValue();
							}
							
							$it = $worksheet->getCellByColumnAndRow(56, $i)->getValue();
							if(strstr($it,'=')==true)
							{
								$it = $worksheet->getCellByColumnAndRow(56, $i)->getOldCalculatedValue();
							}
							
							$lwf = $worksheet->getCellByColumnAndRow(57, $i)->getValue();
							$salary_advance = $worksheet->getCellByColumnAndRow(58, $i)->getValue();
							$other_deduction = $worksheet->getCellByColumnAndRow(59, $i)->getValue();
							
							$total_deduction = $worksheet->getCellByColumnAndRow(60, $i)->getValue();
							if(strstr($total_deduction,'=')==true)
							{
								$total_deduction = $worksheet->getCellByColumnAndRow(60, $i)->getOldCalculatedValue();
							}
							
							$net_salary = $worksheet->getCellByColumnAndRow(61, $i)->getValue();
							if(strstr($net_salary,'=')==true)
							{
								$net_salary = $worksheet->getCellByColumnAndRow(61, $i)->getOldCalculatedValue();
							}
							$in_words = $worksheet->getCellByColumnAndRow(62, $i)->getValue();
							if(strstr($in_words,'=')==true)
							{
								$in_words = $worksheet->getCellByColumnAndRow(62, $i)->getOldCalculatedValue();
							}
							
							
							/*if($notice_period_days=="")
							{
								$notice_period_days=0;
							}*/
							if($arrears_days=="")
							{
								$arrears_days=0;
							}
							if($esic_no=="")
							{
								$esic_no=0;
							}
							
							$db_date=date("Y-m-d");
							$db_doj="";
							$db_dol="";
							
							if($doj!="")
							{
								$date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($doj));
								$db_doj=date("Y-m-d",strtotime($date));
								
							}
							
							$this->db->where('emp_id',$emp_id);
							$this->db->where('month',$month);
							$this->db->where('year',$year);
							$this->db->delete('payslips');
							
						 
						$db_date=date("Y-m-d");
						$data=array("emp_id"=>$emp_id,"emp_name"=>$name,"designation"=>$designation,"doj"=>$db_doj,"department"=>$department,"location"=>$location,"client_name"=>$client_name,"uan_no"=>$uan_no,"pf_no"=>$pf_no,"esi_no"=>$esic_no,"bank_name"=>$bank_name,"account_no"=>$bank_account,"ifsc_code"=>$ifsc_code,"month_days"=>$month_days,"payable_days"=>$payable_days,"leave_days"=>$leave_days,"lop_days"=>$lop,"arrears_days"=>$arrears_days,"ot_hours"=>$ot_hours,"leave_balance"=>$leave_balance,"fixed_basic_da"=>$fix_basic,"fixed_hra"=>$fix_hra,"fixed_conveyance"=>$fix_conveyance,"fixed_medical_reimbursement"=>$fix_medical_reimbursement,"fixed_special_allowance"=>$fix_special_allowance,"fixed_other_allowance"=>$fix_other_allowance,"fixed_ot_wages"=>$fix_ot_wages,"fixed_attendance_bonus"=>$fix_attendance_bonus,"fixed_st_bonus"=>$fix_st_bonus,"fixed_holiday_wages"=>$fix_holiday_wages,"fixed_other_wages"=>$fix_other_wages,"fixed_total_earnings"=>$fix_total_gross,"fix_education_allowance"=>$fix_education_allowance,"fix_leave_wages"=>$fix_leave_wages,"fix_incentive_wages"=>$fix_incentive_wages,"fix_arrear_wages"=>$fix_arrear_wages,"earn_basic"=>$earn_basic,"earn_hr"=>$earn_hra,"earn_conveyance"=>$earn_conveyance,"earn_medical_allowance"=>$earn_medical_reimbursement,"earn_special_allowance"=>$earn_special_allowance,"earn_other_allowance"=>$earn_other_allowance,"earn_ot_wages"=>$earn_ot_wages,"earn_attendance_bonus"=>$earn_attendance_bonus,"earn_st_bonus"=>$earn_st_bonus,"earn_holiday_wages"=>$earn_holiday_wages,"earn_other_wages"=>$earn_other_wages,"earn_total_gross"=>$earn_total_gross,"earn_education_allowance"=>$earn_education_allowance,"earn_leave_wages"=>$earn_leave_wages,"earn_incentive_wages"=>$earn_incentive_wages,"earn_arrear_wages"=>$earn_arrear_wages,"epf"=>$epf,"esic"=>$esic,"pt"=>$pt,"it"=>$it,"lwf"=>$lwf,"salary_advance"=>$salary_advance,"other_deduction"=>$other_deduction,"total_deduction"=>$total_deduction,"net_salary"=>$net_salary,"in_words"=>$in_words,"month"=>$month,"year"=>$year,"date_upload"=>$db_date);
						
							$qry=$this->db->insert('payslips',$data);
							 
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
			} 
			catch (Exception $e) 
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
}  
?>