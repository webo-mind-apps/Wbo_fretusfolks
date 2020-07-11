<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Ffi_payslips_db extends CI_Model 
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

	public function download_ffi_payslips()
	{
		$month=$this->input->post('payslip_download_month', true);
		$year=$this->input->post('payslip_download_year', true);
		$this->db->select('*');
		$this->db->from('ffi_payslips');
		$this->db->where("month", $month);
		$this->db->where("year", $year);
		$query=$this->db->get();
		$row_count=$query->num_rows();
		return $row_count;
	}

	public function download_ffi_payslips_partial($limit,$start)
	{
		$month=$this->input->post('payslip_download_month', true);
		$year=$this->input->post('payslip_download_year', true);
		$this->db->select('*');
		$this->db->from('ffi_payslips');
		$this->db->where("month", $month);
		$this->db->where("year", $year);
		$this->db->limit($limit,$start); 
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	public function upload_payslips()
	{
		$month=$this->input->post('payslip_month');
		$year=$this->input->post('payslip_year');
		
		$this->load->library("excel");
		
		$path = 'uploads/ffi_payslips/';
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
							$emp_id = $worksheet->getCellByColumnAndRow(0, $i)->getValue();
							$name = $worksheet->getCellByColumnAndRow(1, $i)->getValue();
							$designation = $worksheet->getCellByColumnAndRow(2, $i)->getValue();
							$doj = $worksheet->getCellByColumnAndRow(3, $i)->getValue();
							$department = $worksheet->getCellByColumnAndRow(4, $i)->getValue();							
							$uan_no = $worksheet->getCellByColumnAndRow(5, $i)->getValue();
							$pf_no = $worksheet->getCellByColumnAndRow(6, $i)->getValue();
							$esic_no = $worksheet->getCellByColumnAndRow(7, $i)->getValue();
							$bank_name = $worksheet->getCellByColumnAndRow(8, $i)->getValue();
							$bank_account = $worksheet->getCellByColumnAndRow(9, $i)->getValue();
							$ifsc_code = $worksheet->getCellByColumnAndRow(10, $i)->getValue();
							$month_days = $worksheet->getCellByColumnAndRow(11, $i)->getValue();
							$payable_days = $worksheet->getCellByColumnAndRow(12, $i)->getValue();
							$leave_days = $worksheet->getCellByColumnAndRow(13, $i)->getValue();
							$lop = $worksheet->getCellByColumnAndRow(14, $i)->getValue();
							$arrears_days = $worksheet->getCellByColumnAndRow(15, $i)->getValue();
							$ot_hours = $worksheet->getCellByColumnAndRow(16, $i)->getValue();
							//$notice_period_days = $worksheet->getCellByColumnAndRow(18, $i)->getValue();
							
							$fix_basic = $worksheet->getCellByColumnAndRow(17, $i)->getValue();
							$fix_hra = $worksheet->getCellByColumnAndRow(18, $i)->getValue();
							$fix_conveyance = $worksheet->getCellByColumnAndRow(19, $i)->getValue();
							$fix_edu_allowance = $worksheet->getCellByColumnAndRow(20, $i)->getValue();
							$fix_medical_reimbursement = $worksheet->getCellByColumnAndRow(21, $i)->getValue();
							$fix_special_allowance = $worksheet->getCellByColumnAndRow(22, $i)->getValue();
							$fix_other_allowance = $worksheet->getCellByColumnAndRow(23, $i)->getValue();
							$fix_st_bonus = $worksheet->getCellByColumnAndRow(24, $i)->getValue();
							$fix_leave_wages = $worksheet->getCellByColumnAndRow(25, $i)->getValue();
							$fix_holiday_wages = $worksheet->getCellByColumnAndRow(26, $i)->getValue();
							$fix_attendance_bonus = $worksheet->getCellByColumnAndRow(27, $i)->getValue();
							$fix_ot_wages = $worksheet->getCellByColumnAndRow(28, $i)->getValue();
							$fix_incentive = $worksheet->getCellByColumnAndRow(29, $i)->getValue();
							$fix_arrear_wages = $worksheet->getCellByColumnAndRow(30, $i)->getValue();
							$fix_other_wages = $worksheet->getCellByColumnAndRow(31, $i)->getValue();
							$fix_total_gross = $worksheet->getCellByColumnAndRow(32, $i)->getValue();
							if(strstr($fix_total_gross,'=')==true)
							{
								$fix_total_gross = $worksheet->getCellByColumnAndRow(32, $i)->getOldCalculatedValue();
							}
							
							$earn_basic = $worksheet->getCellByColumnAndRow(33, $i)->getValue();
							if(strstr($earn_basic,'=')==true)
							{
								$earn_basic = $worksheet->getCellByColumnAndRow(33, $i)->getOldCalculatedValue();
							}
							$earn_hra = $worksheet->getCellByColumnAndRow(34, $i)->getValue();
							if(strstr($earn_hra,'=')==true)
							{
								$earn_hra = $worksheet->getCellByColumnAndRow(34, $i)->getOldCalculatedValue();
							}
							$earn_conveyance = $worksheet->getCellByColumnAndRow(35, $i)->getValue();
							if(strstr($earn_conveyance,'=')==true)
							{
								$earn_conveyance = $worksheet->getCellByColumnAndRow(35, $i)->getOldCalculatedValue();
							}
							$earn_edu_allowance = $worksheet->getCellByColumnAndRow(36, $i)->getValue();
							if(strstr($earn_edu_allowance,'=')==true)
							{
								$earn_edu_allowance = $worksheet->getCellByColumnAndRow(36, $i)->getOldCalculatedValue();
							}
							$earn_medical_reimbursement = $worksheet->getCellByColumnAndRow(37, $i)->getValue();
							if(strstr($earn_medical_reimbursement,'=')==true)
							{
								$earn_medical_reimbursement = $worksheet->getCellByColumnAndRow(37, $i)->getOldCalculatedValue();
							}
							$earn_special_allowance = $worksheet->getCellByColumnAndRow(38, $i)->getValue();
							if(strstr($earn_special_allowance,'=')==true)
							{
								$earn_special_allowance = $worksheet->getCellByColumnAndRow(38, $i)->getOldCalculatedValue();
							}
							$earn_other_allowance = $worksheet->getCellByColumnAndRow(39, $i)->getValue();
							if(strstr($earn_other_allowance,'=')==true)
							{
								$earn_other_allowance = $worksheet->getCellByColumnAndRow(39, $i)->getOldCalculatedValue();
							}
							$earn_st_bonus = $worksheet->getCellByColumnAndRow(40, $i)->getValue();
							if(strstr($earn_st_bonus,'=')==true)
							{
								$earn_st_bonus = $worksheet->getCellByColumnAndRow(40, $i)->getOldCalculatedValue();
							}
							$earn_leave_wages = $worksheet->getCellByColumnAndRow(41, $i)->getValue();
							if(strstr($earn_leave_wages,'=')==true)
							{
								$earn_leave_wages = $worksheet->getCellByColumnAndRow(41, $i)->getOldCalculatedValue();
							}
							$earn_holiday_wages = $worksheet->getCellByColumnAndRow(42, $i)->getValue();
							if(strstr($earn_holiday_wages,'=')==true)
							{
								$earn_holiday_wages = $worksheet->getCellByColumnAndRow(42, $i)->getOldCalculatedValue();
							}
							$earn_attendance_bonus = $worksheet->getCellByColumnAndRow(43, $i)->getValue();
							if(strstr($earn_attendance_bonus,'=')==true)
							{
								$earn_attendance_bonus = $worksheet->getCellByColumnAndRow(43, $i)->getOldCalculatedValue();
							}
							$earn_ot_wages = $worksheet->getCellByColumnAndRow(44, $i)->getValue();
							if(strstr($earn_ot_wages,'=')==true)
							{
								$earn_ot_wages = $worksheet->getCellByColumnAndRow(44, $i)->getOldCalculatedValue();
							}
							$earn_incentive = $worksheet->getCellByColumnAndRow(45, $i)->getValue();
							if(strstr($earn_incentive,'=')==true)
							{
								$earn_incentive = $worksheet->getCellByColumnAndRow(45, $i)->getOldCalculatedValue();
							}
							$earn_arrear_wages = $worksheet->getCellByColumnAndRow(46, $i)->getValue();
							if(strstr($earn_arrear_wages,'=')==true)
							{
								$earn_arrear_wages = $worksheet->getCellByColumnAndRow(46, $i)->getOldCalculatedValue();
							}
							$earn_other_wages = $worksheet->getCellByColumnAndRow(47, $i)->getValue();
							if(strstr($earn_other_wages,'=')==true)
							{
								$earn_other_wages = $worksheet->getCellByColumnAndRow(47, $i)->getOldCalculatedValue();
							}
							$earn_total_gross = $worksheet->getCellByColumnAndRow(48, $i)->getValue();
							if(strstr($earn_total_gross,'=')==true)
							{
								$earn_total_gross = $worksheet->getCellByColumnAndRow(48, $i)->getOldCalculatedValue();
							}
							
							$epf = $worksheet->getCellByColumnAndRow(49, $i)->getValue();
							if(strstr($epf,'=')==true)
							{
								$epf = $worksheet->getCellByColumnAndRow(49, $i)->getOldCalculatedValue();
							}
							$esic = $worksheet->getCellByColumnAndRow(50, $i)->getValue();
							if(strstr($esic,'=')==true)
							{
								$esic = $worksheet->getCellByColumnAndRow(50, $i)->getOldCalculatedValue();
							}
							$pt = $worksheet->getCellByColumnAndRow(51, $i)->getValue();
							if(strstr($pt,'=')==true)
							{
								$pt = $worksheet->getCellByColumnAndRow(51, $i)->getOldCalculatedValue();
							}
							$it = $worksheet->getCellByColumnAndRow(52, $i)->getValue();
							if(strstr($it,'=')==true)
							{
								$it = $worksheet->getCellByColumnAndRow(52, $i)->getOldCalculatedValue();
							}
							$lwf = $worksheet->getCellByColumnAndRow(53, $i)->getValue();
							if(strstr($lwf,'=')==true)
							{
								$lwf = $worksheet->getCellByColumnAndRow(53, $i)->getOldCalculatedValue();
							}
							$salary_advance = $worksheet->getCellByColumnAndRow(54, $i)->getValue();
							if(strstr($salary_advance,'=')==true)
							{
								$salary_advance = $worksheet->getCellByColumnAndRow(54, $i)->getOldCalculatedValue();
							}
							$other_deduction = $worksheet->getCellByColumnAndRow(55, $i)->getValue();
							if(strstr($other_deduction,'=')==true)
								
							{
								$other_deduction = $worksheet->getCellByColumnAndRow(55, $i)->getOldCalculatedValue();
							}
							$total_deduction = $worksheet->getCellByColumnAndRow(56, $i)->getValue();
							if(strstr($total_deduction,'=')==true)
							{
								$total_deduction = $worksheet->getCellByColumnAndRow(56, $i)->getOldCalculatedValue();
							}
							
							$net_salary = $worksheet->getCellByColumnAndRow(57, $i)->getValue();
							if(strstr($net_salary,'=')==true)
							{
								$net_salary = $worksheet->getCellByColumnAndRow(57, $i)->getOldCalculatedValue();
							}
							$in_words = $worksheet->getCellByColumnAndRow(58, $i)->getValue();
							
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
							$this->db->delete('ffi_payslips');
						
						$data=array("emp_id"=>$emp_id,"employee_name"=>$name,"designation"=>$designation,"date_of_joining"=>$db_doj,"department"=>$department,"uan_no"=>$uan_no,"pf_no"=>$pf_no,"esi_no"=>$esic_no,"bank_name"=>$bank_name,"account_no"=>$bank_account,"ifsc_code"=>$ifsc_code,"month_days"=>$month_days,"pay_days"=>$payable_days,"leave_days"=>$leave_days,"lop_days"=>$lop,"arrear_days"=>$arrears_days,"ot_hours"=>$ot_hours,"fixed_basic"=>$fix_basic,"fixed_hra"=>$fix_hra,"fixed_con_allow"=>$fix_conveyance,"fixed_edu_allowance"=>$fix_edu_allowance,"fixed_med_reim"=>$fix_medical_reimbursement,"fixed_spec_allow"=>$fix_special_allowance,"fixed_oth_allow"=>$fix_other_allowance,"fixed_st_bonus"=>$fix_st_bonus,"fixed_leave_wages"=>$fix_leave_wages,"fixed_holidays_wages"=>$fix_holiday_wages,"fixed_attendance_bonus"=>$fix_attendance_bonus,"fixed_ot_wages"=>$fix_ot_wages,"fixed_incentive"=>$fix_incentive,"fixed_arrear_wages"=>$fix_arrear_wages,"fixed_other_wages"=>$fix_other_wages,"fixed_gross"=>$fix_total_gross,"earned_basic"=>$earn_basic,"earned_hra"=>$earn_hra,"earned_con_allow"=>$earn_conveyance,"earned_education_allowance"=>$earn_edu_allowance,"earned_med_reim"=>$earn_medical_reimbursement,"earned_spec_allow"=>$earn_special_allowance,"earned_oth_allow"=>$earn_other_allowance,"earned_st_bonus"=>$earn_st_bonus,"earned_leave_wages"=>$earn_leave_wages,"earned_holiday_wages"=>$earn_holiday_wages,"earned_attendance_bonus"=>$earn_attendance_bonus,"earned_ot_wages"=>$earn_ot_wages,"earned_incentive"=>$earn_incentive,"earned_arrear_wages"=>$earn_arrear_wages,"earned_other_wages"=>$earn_other_wages,"earned_gross"=>$earn_total_gross,"epf"=>$epf,"esic"=>$esic,"pt"=>$pt,"it"=>$it,"lwf"=>$lwf,"salary_advance"=>$salary_advance,"other_deduction"=>$other_deduction,"total_deductions"=>$total_deduction,"net_salary"=>$net_salary,"in_words"=>$in_words,"month"=>$month,"year"=>$year);
						
							$qry=$this->db->insert('ffi_payslips',$data);
							
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
		$query=$this->db->get('ffi_payslips');
		$q=$query->result_array();
		return $q;
	}
	function delete_payslip()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_payslips');
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
		$query=$this->db->get('ffi_payslips');
		$q=$query->result_array();
		return $q;
	}
}  
?>
