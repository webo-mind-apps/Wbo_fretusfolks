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
	public function upload_payslips()
	{
		$month=$this->input->post('payslip_month');
		$year=$this->input->post('payslip_year');
		$this->load->library("excel");
		
		$path = 'AKJHJG7665BHJG/payslips/';
		if (!is_dir($path)) mkdir($path, 0777, TRUE);
			$new_name = $_FILES["file"]['name'];
			$type = $_FILES["file"]['type'];
			$config['upload_path'] = $path;					
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
			$config['file_name'] = $new_name;	
			$this->load->library('upload', $config);
            $this->upload->initialize($config);      
			
			$gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name'][$i]))[1];
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
							$vertical = $worksheet->getCellByColumnAndRow(6, $i)->getValue();
							$location = $worksheet->getCellByColumnAndRow(7, $i)->getValue();
							$client_name = $worksheet->getCellByColumnAndRow(8, $i)->getValue();
							$uan_no = $worksheet->getCellByColumnAndRow(9, $i)->getValue();
							$pf_no = $worksheet->getCellByColumnAndRow(10, $i)->getValue();
							$esic_no = $worksheet->getCellByColumnAndRow(11, $i)->getValue();
							$bank_name = $worksheet->getCellByColumnAndRow(12, $i)->getValue();
							$bank_account = $worksheet->getCellByColumnAndRow(13, $i)->getValue();
							$month_days = $worksheet->getCellByColumnAndRow(14, $i)->getValue();
							$payable_days = $worksheet->getCellByColumnAndRow(15, $i)->getValue();
							$lop = $worksheet->getCellByColumnAndRow(16, $i)->getValue();
							$arrears_days = $worksheet->getCellByColumnAndRow(17, $i)->getValue();
							$ot_hours = $worksheet->getCellByColumnAndRow(18, $i)->getValue();
							$notice_period_days = $worksheet->getCellByColumnAndRow(19, $i)->getValue();
							
							$fix_basic = $worksheet->getCellByColumnAndRow(20, $i)->getValue();
							$fix_hra = $worksheet->getCellByColumnAndRow(21, $i)->getValue();
							$fix_conveyance = $worksheet->getCellByColumnAndRow(22, $i)->getValue();
							$fix_medical_reimbursement = $worksheet->getCellByColumnAndRow(23, $i)->getValue();
							$fix_special_allowance = $worksheet->getCellByColumnAndRow(24, $i)->getValue();
							$fix_other_allowance = $worksheet->getCellByColumnAndRow(25, $i)->getValue();
							$fix_ot_wages = $worksheet->getCellByColumnAndRow(26, $i)->getValue();
							$fix_attendance_bonus = $worksheet->getCellByColumnAndRow(27, $i)->getValue();
							$fix_st_bonus = $worksheet->getCellByColumnAndRow(28, $i)->getValue();
							$fix_holiday_wages = $worksheet->getCellByColumnAndRow(29, $i)->getValue();
							$fix_other_wages = $worksheet->getCellByColumnAndRow(30, $i)->getValue();
							$fix_total_gross = $worksheet->getCellByColumnAndRow(31, $i)->getValue();
							if(strstr($fix_total_gross,'=')==true)
							{
								$fix_total_gross = $worksheet->getCellByColumnAndRow(31, $i)->getOldCalculatedValue();
							}
							
							$earn_basic = $worksheet->getCellByColumnAndRow(32, $i)->getValue();
							$earn_hra = $worksheet->getCellByColumnAndRow(33, $i)->getValue();
							$earn_conveyance = $worksheet->getCellByColumnAndRow(34, $i)->getValue();
							$earn_medical_reimbursement = $worksheet->getCellByColumnAndRow(35, $i)->getValue();
							$earn_special_allowance = $worksheet->getCellByColumnAndRow(36, $i)->getValue();
							$earn_other_allowance = $worksheet->getCellByColumnAndRow(37, $i)->getValue();
							$earn_ot_wages = $worksheet->getCellByColumnAndRow(38, $i)->getValue();
							$earn_attendance_bonus = $worksheet->getCellByColumnAndRow(39, $i)->getValue();
							$earn_st_bonus = $worksheet->getCellByColumnAndRow(40, $i)->getValue();
							$earn_holiday_wages = $worksheet->getCellByColumnAndRow(41, $i)->getValue();
							$earn_other_wages = $worksheet->getCellByColumnAndRow(42, $i)->getValue();
							$earn_total_gross = $worksheet->getCellByColumnAndRow(43, $i)->getValue();
							if(strstr($earn_total_gross,'=')==true)
							{
								$earn_total_gross = $worksheet->getCellByColumnAndRow(43, $i)->getOldCalculatedValue();
							}
							
							$arr_basic = $worksheet->getCellByColumnAndRow(44, $i)->getValue();
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
							}
							
							$epf = $worksheet->getCellByColumnAndRow(68, $i)->getValue();
							$esic = $worksheet->getCellByColumnAndRow(69, $i)->getValue();
							$pt = $worksheet->getCellByColumnAndRow(70, $i)->getValue();
							$it = $worksheet->getCellByColumnAndRow(71, $i)->getValue();
							$lwf = $worksheet->getCellByColumnAndRow(72, $i)->getValue();
							$salary_advance = $worksheet->getCellByColumnAndRow(73, $i)->getValue();
							$other_deduction = $worksheet->getCellByColumnAndRow(74, $i)->getValue();
							
							$total_deduction = $worksheet->getCellByColumnAndRow(75, $i)->getValue();
							if(strstr($total_deduction,'=')==true)
							{
								$total_deduction = $worksheet->getCellByColumnAndRow(75, $i)->getOldCalculatedValue();
							}
							
							$net_salary = $worksheet->getCellByColumnAndRow(76, $i)->getValue();
							if(strstr($net_salary,'=')==true)
							{
								$net_salary = $worksheet->getCellByColumnAndRow(76, $i)->getOldCalculatedValue();
							}
							$in_words = $worksheet->getCellByColumnAndRow(77, $i)->getValue();
							
							
							
							if($notice_period_days=="")
							{
								$notice_period_days=0;
							}
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
							
							$data=array("emp_id"=>$emp_id,"emp_name"=>$name,"designation"=>$designation,"doj"=>$db_doj,"department"=>$department,"vertical"=>$vertical,"location"=>$location,"client_name"=>$client_name,"uan_no"=>$uan_no,"pf_no"=>$pf_no,"esi_no"=>$esic_no,"bank_name"=>$bank_name,"account_no"=>$bank_account,"month_days"=>$month_days,"payable_days"=>$payable_days,"lop_days"=>$lop,"arrears_days"=>$arrears_days,"ot_hours"=>$ot_hours,"notice_period_days"=>$notice_period_days,"fixed_basic_da"=>$fix_basic,"fixed_hra"=>$fix_hra,"fixed_conveyance"=>$fix_conveyance,"fixed_medical_reimbursement"=>$fix_medical_reimbursement,"fixed_special_allowance"=>$fix_special_allowance,"fixed_other_allowance"=>$fix_other_allowance,"fixed_ot_wages"=>$fix_ot_wages,"fixed_attendance_bonus"=>$fix_attendance_bonus,"fixed_st_bonus"=>$fix_st_bonus,"fixed_holiday_wages"=>$fix_holiday_wages,"fixed_other_wages"=>$fix_other_wages,"fixed_total_earnings"=>$fix_total_gross,"earn_basic"=>$earn_basic,"earn_hr"=>$earn_hra,"earn_conveyance"=>$earn_conveyance,"earn_medical_allowance"=>$earn_medical_reimbursement,"earn_special_allowance"=>$earn_special_allowance,"earn_other_allowance"=>$earn_other_allowance,"earn_ot_wages"=>$earn_ot_wages,"earn_attendance_bonus"=>$earn_attendance_bonus,"earn_st_bonus"=>$earn_st_bonus,"earn_holiday_wages"=>$earn_holiday_wages,"earn_other_wages"=>$earn_other_wages,"earn_total_gross"=>$earn_total_gross,"arr_basic"=>$arr_basic,"arr_hra"=>$arr_hra,"arr_conveyance"=>$arr_conveyance,"arr_medical_reimbursement"=>$arr_medical_reimbursement,"arr_special_allowance"=>$arr_special_allowance,"arr_other_allowance"=>$arr_other_allowance,"arr_ot_wages"=>$arr_ot_wages,"arr_attendance_bonus"=>$arr_attendance_bonus,"arr_st_bonus"=>$arr_st_bonus,"arr_holiday_wages"=>$arr_holiday_wages,"arr_other_wages"=>$arr_other_wages,"arr_total_gross"=>$arr_total_gross,"total_basic"=>$total_basic,"total_hra"=>$total_hra,"total_conveyance"=>$total_conveyance,"total_medical_reimbursement"=>$total_medical_reimbursement,"total_special_allowance"=>$total_special_allowance,"total_other_allowance"=>$total_other_allowance,"total_ot_wages"=>$total_ot_wages,"total_attendance_bonus"=>$total_attendance_bonus,"total_st_bonus"=>$total_st_bonus,"total_holiday_wages"=>$total_holiday_wages,"total_other_wages"=>$total_other_wages,"total_total_gross"=>$total_total_gross,"epf"=>$epf,"esic"=>$esic,"pt"=>$pt,"it"=>$it,"lwf"=>$lwf,"salary_advance"=>$salary_advance,"other_deduction"=>$other_deduction,"total_deduction"=>$total_deduction,"net_salary"=>$net_salary,"in_words"=>$in_words,"month"=>$month,"year"=>$year);
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
