<?php
defined('BASEPATH') OR exit('No direct script access allowed');  

class Fhrms_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_ffi_employee()
	{
		$this->db->select('a.*,b.state_name');
		$this->db->from('fhrms a');
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where("a.status","0");
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
	public function todays_dob()
	{  
		$this->db->select('a.*,b.state_name');
		$this->db->from('fhrms a');
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where("a.status","0"); 
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
	
	function get_employee_details($id)
	{
		$this->db->select('a.*,c.state_name');
		$this->db->from('fhrms a');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id');
		
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function save_employee()
	{
		$pan_path="";
		$aadhar_path="";
		$license_path="";
		$photo="";
		$resume="";
		$bank_document="";
		$voter_id="";
		$emp_form="";
		$pf_doc="";
		$payslip_doc="";
		$exp_doc="";
		
		$ffi_emp_id=$this->input->post('ffi_emp_id');
		$emp_name=$this->input->post('emp_name');
		$designation=$this->input->post('designation');
		$department=$this->input->post('department');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$gender=$this->input->post('gender');
		$fname=$this->input->post('fname');
		$blood_grp=$this->input->post('blood_grp');
		$qualification=$this->input->post('qualification');
		$phone1=$this->input->post('phone1');
		$phone2=$this->input->post('phone2');
		$email=$this->input->post('email');
		$permanent_address=$this->input->post('permanent_address');
		$present_address=$this->input->post('present_address');
		$pan_no=$this->input->post('pan_no');
		$aadhar_no=$this->input->post('aadhar_no');
		$driving_license=$this->input->post('driving_license');
		$bank_name=$this->input->post('bank_name');
		$bank_account_no=$this->input->post('bank_account_no');
		$ifsc_code=$this->input->post('ifsc_code');
		$uan=$this->input->post('uan');
		$uan_type=$this->input->post('uan_type');
		$uan_no=$this->input->post('uan_no');
		$status=$this->input->post('status');
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$st_bonus=$this->input->post('st_bonus');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		$pf_percentage=$this->input->post('pf_percentage');
		$emp_pf=$this->input->post('emp_pf');
		$esic_percentage=$this->input->post('esic_percentage');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		$employer_pf_percentage=$this->input->post('employer_pf_percentage');
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic_percentage=$this->input->post('employer_esic_percentage');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$take_home=$this->input->post('take_home');
		
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		
		$psd=$this->input->post('password');
		$password=md5($psd);
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		
		$db_interview_date="";		
		$db_joining_date="";
		$db_contact_end_date="";
		$db_dob="";
		
		if($interview_date !="")
		{
			$db_interview_date=date("Y-m-d",strtotime($interview_date));	
		}
		if($joining_date !="")
		{
			$db_joining_date=date("Y-m-d",strtotime($joining_date));	
		}
		if($contact_end_date !="")
		{
			$db_contact_end_date=date("Y-m-d",strtotime($contact_end_date));	
		}
		if($dob !="")
		{
			$db_dob=date("Y-m-d",strtotime($dob));	
		}
		if($_FILES['file_pan']['size']>1)
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = 'uploads/pan_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file_pan'))
            {
				$pan_path="uploads/pan_doc/".$new_name;
			}
		}
		if ($_FILES['file_aadhar']['size']>1)
        {
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = 'uploads/aadhar_doc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path="uploads/aadhar_doc/".$new_name1;
			}
		}
		if ($_FILES['file_license']['size']>1)
        {
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = 'uploads/license_doc/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if($this->upload->do_upload('file_license'))
            {
				$license_path="uploads/license_doc/".$new_name2;
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = 'uploads/resume/';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
            if($this->upload->do_upload('resume'))
            {
				$resume="uploads/resume/".$new_name3;
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = 'uploads/photo/';
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
            if($this->upload->do_upload('photo'))
            {
				$photo="uploads/photo/".$new_name4;
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = 'uploads/bank_doc/';
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
            if($this->upload->do_upload('file_document'))
            {
				$bank_document="uploads/bank_doc/".$new_name5;
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = 'uploads/voter_id/';
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id="uploads/voter_id/".$new_name6;
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = 'uploads/emp_form/';
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form="uploads/emp_form/".$new_name7;
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = 'uploads/pf_doc/';
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc="uploads/pf_doc/".$new_name8;
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = 'uploads/payslip_doc/';
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc="uploads/payslip_doc/".$new_name9;
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = 'uploads/exp_doc/';
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc="uploads/exp_doc/".$new_name10;
			}
		}
		
		$data=array("ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"data_status"=>"1","basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc);
			
		$this->db->insert("fhrms",$data);	
		$id=$this->db->insert_id();
		
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "uploads/edu_certificate/".$filen;
				$fpath="uploads/edu_certificate/".$filen;										
				if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('education_certificate',$data1);
				}
			}
		}
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "uploads/others_doc/".$filen;
				$fpath="uploads/others_doc/".$filen;										
				if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('other_certificate',$data1);
				}
			}
		}
		
	}
	function save_emp_pending()
	{
		$pan_path="";
		$aadhar_path="";
		$license_path="";
		$photo="";
		$resume="";
		$bank_document="";
		$voter_id="";
		$emp_form="";
		$pf_doc="";
		$payslip_doc="";
		$exp_doc="";
		
		$ffi_emp_id=$this->input->post('ffi_emp_id');
		$emp_name=$this->input->post('emp_name');
		$designation=$this->input->post('designation');
		$department=$this->input->post('department');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$gender=$this->input->post('gender');
		$fname=$this->input->post('fname');
		$blood_grp=$this->input->post('blood_grp');
		$qualification=$this->input->post('qualification');
		$phone1=$this->input->post('phone1');
		$phone2=$this->input->post('phone2');
		$email=$this->input->post('email');
		$permanent_address=$this->input->post('permanent_address');
		$present_address=$this->input->post('present_address');
		$pan_no=$this->input->post('pan_no');
		$aadhar_no=$this->input->post('aadhar_no');
		$driving_license=$this->input->post('driving_license');
		$bank_name=$this->input->post('bank_name');
		$bank_account_no=$this->input->post('bank_account_no');
		$ifsc_code=$this->input->post('ifsc_code');
		$uan=$this->input->post('uan');
		$uan_type=$this->input->post('uan_type');
		$uan_no=$this->input->post('uan_no');
		$status=$this->input->post('status');
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$st_bonus=$this->input->post('st_bonus');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		$pf_percentage=$this->input->post('pf_percentage');
		$emp_pf=$this->input->post('emp_pf');
		$esic_percentage=$this->input->post('esic_percentage');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		$employer_pf_percentage=$this->input->post('employer_pf_percentage');
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic_percentage=$this->input->post('employer_esic_percentage');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$take_home=$this->input->post('take_home');
			
		
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		$psd=$this->input->post('password');
		$password=md5($psd);
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		
		$db_interview_date="";		
		$db_joining_date="";
		$db_contact_end_date="";
		$db_dob="";
		
		if($interview_date !="")
		{
			$db_interview_date=date("Y-m-d",strtotime($interview_date));	
		}
		if($joining_date !="")
		{
			$db_joining_date=date("Y-m-d",strtotime($joining_date));	
		}
		if($contact_end_date !="")
		{
			$db_contact_end_date=date("Y-m-d",strtotime($contact_end_date));	
		}
		if($dob !="")
		{
			$db_dob=date("Y-m-d",strtotime($dob));	
		}
		if($_FILES['file_pan']['size']>1)
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = 'uploads/pan_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file_pan'))
            {
				$pan_path="uploads/pan_doc/".$new_name;
			}
		}
		if ($_FILES['file_aadhar']['size']>1)
        {
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = 'uploads/aadhar_doc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path="uploads/aadhar_doc/".$new_name1;
			}
		}
		if ($_FILES['file_license']['size']>1)
        {
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = 'uploads/license_doc/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if($this->upload->do_upload('file_license'))
            {
				$license_path="uploads/license_doc/".$new_name2;
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = 'uploads/resume/';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
            if($this->upload->do_upload('resume'))
            {
				$resume="uploads/resume/".$new_name3;
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = 'uploads/photo/';
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
            if($this->upload->do_upload('photo'))
            {
				$photo="uploads/photo/".$new_name4;
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = 'uploads/bank_doc/';
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
            if($this->upload->do_upload('file_document'))
            {
				$bank_document="uploads/bank_doc/".$new_name5;
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = 'uploads/voter_id/';
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id="uploads/voter_id/".$new_name6;
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = 'uploads/emp_form/';
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form="uploads/emp_form/".$new_name7;
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = 'uploads/pf_doc/';
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc="uploads/pf_doc/".$new_name8;
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = 'uploads/payslip_doc/';
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc="uploads/payslip_doc/".$new_name9;
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = 'uploads/exp_doc/';
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc="uploads/exp_doc/".$new_name10;
			}
		}
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "uploads/edu_certificate/".$filen;
				$fpath="uploads/edu_certificate/".$filen;										
				if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('education_certificate',$data1);
				}
			}
		}
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "uploads/others_doc/".$filen;
				$fpath="uploads/others_doc/".$filen;										
				if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('other_certificate',$data1);
				}
			}
		}
		$data=array("ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc);
			
		$this->db->insert("fhrms",$data);	
	}
	function update_employee()
	{
		$id=$this->uri->segment(3);
		
		$this->db->select("pan_path,aadhar_path,driving_license_path,photo,resume,bank_document,voter_id,emp_form,pf_esic_form,payslip,exp_letter");
		$this->db->from("fhrms");
		$this->db->where('id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		
		$pan_path=$q[0]['pan_path'];
		$aadhar_path=$q[0]['aadhar_path'];
		$license_path=$q[0]['driving_license_path'];
		$photo=$q[0]['photo'];
		$resume=$q[0]['resume'];
		$bank_document=$q[0]['bank_document'];
		
		$voter_id=$q[0]['voter_id'];
		$emp_form=$q[0]['emp_form'];
		$pf_doc=$q[0]['pf_esic_form'];
		$payslip_doc=$q[0]['payslip'];
		$exp_doc=$q[0]['exp_letter'];
		
		$ffi_emp_id=$this->input->post('ffi_emp_id');
		$emp_name=$this->input->post('emp_name');
		$designation=$this->input->post('designation');
		$department=$this->input->post('department');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$gender=$this->input->post('gender');
		$fname=$this->input->post('fname');
		$blood_grp=$this->input->post('blood_grp');
		$qualification=$this->input->post('qualification');
		$phone1=$this->input->post('phone1');
		$phone2=$this->input->post('phone2');
		$email=$this->input->post('email');
		$permanent_address=$this->input->post('permanent_address');
		$present_address=$this->input->post('present_address');
		$pan_no=$this->input->post('pan_no');
		$aadhar_no=$this->input->post('aadhar_no');
		$driving_license=$this->input->post('driving_license');
		$bank_name=$this->input->post('bank_name');
		$bank_account_no=$this->input->post('bank_account_no');
		$ifsc_code=$this->input->post('ifsc_code');
		$uan=$this->input->post('uan');
		$uan_type=$this->input->post('uan_type');
		$uan_no=$this->input->post('uan_no');
		$status=$this->input->post('status');
		
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$st_bonus=$this->input->post('st_bonus');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		$pf_percentage=$this->input->post('pf_percentage');
		$emp_pf=$this->input->post('emp_pf');
		$esic_percentage=$this->input->post('esic_percentage');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		
		$take_home=$this->input->post('take_home');
		
		$employer_pf_percentage=$this->input->post('employer_pf_percentage');
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic_percentage=$this->input->post('employer_esic_percentage');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		$active_status=$this->input->post('active');
		
		$psd=$this->input->post('password');
		$password=md5($psd);
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		
		$db_interview_date="";		
		$db_joining_date="";
		$db_contact_end_date="";
		$db_dob="";
		
		if($interview_date !="")
		{
			$db_interview_date=date("Y-m-d",strtotime($interview_date));	
		}
		if($joining_date !="")
		{
			$db_joining_date=date("Y-m-d",strtotime($joining_date));	
		}
		if($contact_end_date !="")
		{
			$db_contact_end_date=date("Y-m-d",strtotime($contact_end_date));	
		}
		if($dob !="")
		{
			$db_dob=date("Y-m-d",strtotime($dob));	
		}
		if($_FILES['file_pan']['size']>1)
        {
			echo "hello";
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = 'uploads/pan_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file_pan'))
            {
				$pan_path="uploads/pan_doc/".$new_name;
			}
		}
		if ($_FILES['file_aadhar']['size']>1)
        {
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = 'uploads/aadhar_doc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path="uploads/aadhar_doc/".$new_name1;
			}
		}
		if ($_FILES['file_license']['size']>1)
        {
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = 'uploads/license_doc/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if($this->upload->do_upload('file_license'))
            {
				$license_path="uploads/license_doc/".$new_name2;
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = 'uploads/resume/';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
            if($this->upload->do_upload('resume'))
            {
				$resume="uploads/resume/".$new_name3;
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = 'uploads/photo/';
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
            if($this->upload->do_upload('photo'))
            {
				$photo="uploads/photo/".$new_name4;
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = 'uploads/bank_doc/';
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
            if($this->upload->do_upload('file_document'))
            {
				$bank_document="uploads/bank_doc/".$new_name5;
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = 'uploads/voter_id/';
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id="uploads/voter_id/".$new_name6;
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = 'uploads/emp_form/';
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form="uploads/emp_form/".$new_name7;
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = 'uploads/pf_doc/';
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc="uploads/pf_doc/".$new_name8;
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = 'uploads/payslip_doc/';
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc="uploads/payslip_doc/".$new_name9;
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = 'uploads/exp_doc/';
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc="uploads/exp_doc/".$new_name10;
			}
		}
		
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "uploads/edu_certificate/".$filen;
				$fpath="uploads/edu_certificate/".$filen;										
				if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('ffi_education_certificate',$data1);
				}
			}
		}
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "uploads/others_doc/".$filen;
				$fpath="uploads/others_doc/".$filen;										
				if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('ffi_other_certificate',$data1);
				}
			}
		}
		
		$data=array(
			"ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"data_status"=>"1","basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc,"active_status"=>$active_status);
			
		$this->db->where('id',$id);
		$this->db->update("fhrms",$data);	
	}
	
	function update_employee_pending()
	{
		$id=$this->uri->segment(3);
		
		$this->db->select("pan_path,aadhar_path,driving_license_path,photo,resume,bank_document,voter_id,emp_form,pf_esic_form,payslip,exp_letter");
		$this->db->from("fhrms");
		$this->db->where('id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		
		$pan_path=$q[0]['pan_path'];
		$aadhar_path=$q[0]['aadhar_path'];
		$license_path=$q[0]['driving_license_path'];
		$photo=$q[0]['photo'];
		$resume=$q[0]['resume'];
		$bank_document=$q[0]['bank_document'];
		
		$voter_id=$q[0]['voter_id'];
		$emp_form=$q[0]['emp_form'];
		$pf_doc=$q[0]['pf_esic_form'];
		$payslip_doc=$q[0]['payslip'];
		$exp_doc=$q[0]['exp_letter'];
		
		$client=$this->input->post('client');
		$ffi_emp_id=$this->input->post('ffi_emp_id');
		$client_emp_id=$this->input->post('client_emp_id');
		$emp_name=$this->input->post('emp_name');
		$designation=$this->input->post('designation');
		$department=$this->input->post('department');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$gender=$this->input->post('gender');
		$fname=$this->input->post('fname');
		$blood_grp=$this->input->post('blood_grp');
		$qualification=$this->input->post('qualification');
		$phone1=$this->input->post('phone1');
		$phone2=$this->input->post('phone2');
		$email=$this->input->post('email');
		$permanent_address=$this->input->post('permanent_address');
		$present_address=$this->input->post('present_address');
		$pan_no=$this->input->post('pan_no');
		$aadhar_no=$this->input->post('aadhar_no');
		$driving_license=$this->input->post('driving_license');
		$bank_name=$this->input->post('bank_name');
		$bank_account_no=$this->input->post('bank_account_no');
		$ifsc_code=$this->input->post('ifsc_code');
		$uan=$this->input->post('uan');
		$uan_type=$this->input->post('uan_type');
		$uan_no=$this->input->post('uan_no');
		$status=$this->input->post('status');
		
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$st_bonus=$this->input->post('st_bonus');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		$pf_percentage=$this->input->post('pf_percentage');
		$emp_pf=$this->input->post('emp_pf');
		$esic_percentage=$this->input->post('esic_percentage');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		
		$take_home=$this->input->post('take_home');
		
		$employer_pf_percentage=$this->input->post('employer_pf_percentage');
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic_percentage=$this->input->post('employer_esic_percentage');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		$active_status=$this->input->post('active');
		
		$psd=$this->input->post('password');
		$password=md5($psd);
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		
		$db_interview_date="";		
		$db_joining_date="";
		$db_contact_end_date="";
		$db_dob="";
		
		if($interview_date !="")
		{
			$db_interview_date=date("Y-m-d",strtotime($interview_date));	
		}
		if($joining_date !="")
		{
			$db_joining_date=date("Y-m-d",strtotime($joining_date));	
		}
		if($contact_end_date !="")
		{
			$db_contact_end_date=date("Y-m-d",strtotime($contact_end_date));	
		}
		if($dob !="")
		{
			$db_dob=date("Y-m-d",strtotime($dob));	
		}
		if($_FILES['file_pan']['size']>1)
        {
			echo "hello";
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = 'uploads/pan_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file_pan'))
            {
				$pan_path="uploads/pan_doc/".$new_name;
			}
		}
		if ($_FILES['file_aadhar']['size']>1)
        {
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = 'uploads/aadhar_doc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path="uploads/aadhar_doc/".$new_name1;
			}
		}
		if ($_FILES['file_license']['size']>1)
        {
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = 'uploads/license_doc/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if($this->upload->do_upload('file_license'))
            {
				$license_path="uploads/license_doc/".$new_name2;
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = 'uploads/resume/';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
            if($this->upload->do_upload('resume'))
            {
				$resume="uploads/resume/".$new_name3;
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = 'uploads/photo/';
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
            if($this->upload->do_upload('photo'))
            {
				$photo="uploads/photo/".$new_name4;
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = 'uploads/bank_doc/';
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
            if($this->upload->do_upload('file_document'))
            {
				$bank_document="uploads/bank_doc/".$new_name5;
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = 'uploads/voter_id/';
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id="uploads/voter_id/".$new_name6;
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = 'uploads/emp_form/';
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form="uploads/emp_form/".$new_name7;
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = 'uploads/pf_doc/';
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc="uploads/pf_doc/".$new_name8;
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = 'uploads/payslip_doc/';
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc="uploads/payslip_doc/".$new_name9;
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = 'uploads/exp_doc/';
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc="uploads/exp_doc/".$new_name10;
			}
		}
		
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "uploads/edu_certificate/".$filen;
				$fpath="uploads/edu_certificate/".$filen;										
				if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('ffi_education_certificate',$data1);
				}
			}
		}
		
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "uploads/others_doc/".$filen;
				$fpath="uploads/others_doc/".$filen;										
				if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path)) 
				{
					$data1=array("emp_id"=>$id,"path"=>$fpath);	
					$this->db->insert('ffi_other_certificate',$data1);
				}
			}
		}
		
		$data=array(
			"ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc,"active_status"=>$active_status,"password"=>$password,"psd"=>$psd);
	
		$this->db->where('id',$id);
		$this->db->update("fhrms",$data);	
	}
	function get_edu_certificate($id)
	{
		$this->db->where('emp_id',$id);
		$query=$this->db->get('ffi_education_certificate');
		$q=$query->result_array();
		return $q;
	}
	function get_other_certificate($id)
	{
		$this->db->where('emp_id',$id);
		$query=$this->db->get('ffi_other_certificate');
		$q=$query->result_array();
		return $q;
	}
	function delete_education_certificate()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_education_certificate');
	}
	function delete_other_certificate()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_other_certificate');
	}
	function get_all_offer_letter()
	{
		$this->db->select('a.*,c.emp_name,c.email,c.phone1');
		$this->db->from('ffi_offer_letter a');
		$this->db->join('fhrms c','a.employee_id=c.ffi_emp_id','left');
		$this->db->where("a.status","0");
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function save_offer_letter()
	{
		$emp_id=$this->input->post('ffi_emp_id');
		$letter_format=$this->input->post('letter_format');
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		$pf_percentage=$this->input->post('pf_percentage');
		$emp_pf=$this->input->post('emp_pf');
		$esic_percentage=$this->input->post('esic_percentage');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		$employer_pf_percentage=$this->input->post('employer_pf_percentage');
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic_percentage=$this->input->post('employer_esic_percentage');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$date=date("Y-m-d");
		$data=array("employee_id"=>$emp_id,"date"=>$date,"offer_letter_type"=>$letter_format,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc);
		
		$this->db->where('employee_id',$emp_id);
		$query=$this->db->get("ffi_offer_letter");
		if(!$query->num_rows())
		{
			$this->db->insert('ffi_offer_letter',$data);
		}
		/*
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		*/
		
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date');
		$this->db->from('ffi_offer_letter a');
		$this->db->join('fhrms b','a.employee_id=b.ffi_emp_id','left');
		$this->db->where('a.employee_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_offer_letter()
	{
		/*	
			$id=$this->uri->segment(3);
			$this->db->where('id',$id);
			$query1=$this->db->get('ffi_offer_letter');
			$q1=$query1->result_array();
			$emp_id=$q1[0]['employee_id'];
			$this->db->where('ffi_emp_id',$emp_id);
			$query=$this->db->get('fhrms');
			$q=$query->result_array();
			return $q;
		*/
		$id=$this->uri->segment(3);
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date');
		$this->db->from('ffi_offer_letter a');
		$this->db->join('fhrms b','a.employee_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;	
	}
	function delete_offer_letter()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_offer_letter');
	}
	function remove_voter_id()
	{
		$id=$this->input->post('id');
		$data=array("voter_id"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_emp_form()
	{
		$id=$this->input->post('id');
		$data=array("emp_form"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_pf_esic()
	{
		$id=$this->input->post('id');
		$data=array("pf_esic_form"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_payslip()
	{
		$id=$this->input->post('id');
		$data=array("payslip"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_exp_letter()
	{
		$id=$this->input->post('id');
		$data=array("exp_letter"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function get_all_states()
	{
		$this->db->order_by('state_name','ASC');
		$query=$this->db->get("states");
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
	function validate_ffi()
	{
		$emp_id=$this->input->post('emp_id');
		$this->db->where('ffi_emp_id',$emp_id);
		$count=$this->db->count_all_results('fhrms');
		return $count;
	}
	function delete_fhrms()
	{
		$id=$this->input->post('id');
		$data=array("status"=>"2");
		$this->db->where('id',$id);
		$this->db->update("fhrms",$data);
	}


	// get data
	public function make_datatables()
	{
		$this->make_query();   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();
	}

	// make query 
	public function make_query()
	{
	 
		$order_column = array("a.id", "emp_name", "state", "a.status"); 
		
		$this->db->select("a.*,emp_name,state");
		$this->db->from("fhrms a");
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where("a.status","0");
		

		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("emp_name", $_POST["search"]["value"]);  
                $this->db->or_like("joining_date", $_POST["search"]["value"]);  
                $this->db->or_like("phone1", $_POST["search"]["value"]);  
                $this->db->or_like("email", $_POST["search"]["value"]);  
                $this->db->or_like("status", $_POST["search"]["value"]);  
                 
                 
            $this->db->group_end();
		}
		if(isset($_POST["order"]))  
        {  
             $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
             $this->db->order_by('a.id', 'DESC');  
        }  	
	}

	
	public function get_all_data()
	{
		$this->db->select("*");
        $this->db->from('fhrms');  
        return $this->db->count_all_results(); 
	}

	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	} 

	// get data
	public function make_datatable()
	{
		$this->make_queries();   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();
	}

	// make query 
	public function make_queries()
	{
	 
		$order_column = array("a.id", "emp_name","phone","email","a.status","date"); 
		
		$this->db->select('a.*,c.emp_name,c.email,c.phone1');
		$this->db->from('ffi_offer_letter a');
		$this->db->join('fhrms c','a.employee_id=c.ffi_emp_id','left');
		$this->db->where("a.status","0");

		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("emp_name", $_POST["search"]["value"]);  
                $this->db->or_like("date", $_POST["search"]["value"]);  
                $this->db->or_like("phone1", $_POST["search"]["value"]);  
                $this->db->or_like("email", $_POST["search"]["value"]);  
               
                 
                 
            $this->db->group_end();
		}
		if(isset($_POST["order"]))  
        {  
             $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
             $this->db->order_by('a.id', 'DESC');  
        }  	
	}

	
	public function get_all_datas()
	{
		$this->db->select("*");
        $this->db->from('fhrms');  
        return $this->db->count_all_results(); 
	}

	function get_filtered_datas(){  
		$this->make_queries();  
		$query = $this->db->get();  
		return $query->num_rows();  
	} 


	// get data
	public function make_datatab()
	{
		$this->make_quer();   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();
	}

	// make query 
	public function make_quer()
	{
	 
		$order_column = array("a.id"); 
		
		$this->db->select('a.*,b.state_name');
		$this->db->from('fhrms a');
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where("a.status","0");
		$this->db->where("a.dob",date("Y-m-d"));
		//$this->db->where('EXTRACT(month FROM `dob`)','MONTH(NOW())');
		$this->db->order_by('a.id','DESC');

		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
				$this->db->like("a.id", $_POST["search"]["value"]); 
				$this->db->like("ffi_emp_id", $_POST["search"]["value"]);  
                $this->db->or_like("emp_name", $_POST["search"]["value"]);  
				$this->db->or_like("joining_date", $_POST["search"]["value"]);  
				$this->db->or_like("dob", $_POST["search"]["value"]);  
                $this->db->or_like("phone1", $_POST["search"]["value"]);  
                $this->db->or_like("email", $_POST["search"]["value"]);  
               
                 
                 
            $this->db->group_end();
		}
		if(isset($_POST["order"]))  
        {  
             $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
             $this->db->order_by('a.id', 'DESC');  
        }  	
	}

	
	public function get_all_data_elements()
	{
		$this->db->select("*");
        $this->db->from('fhrms');  
        return $this->db->count_all_results(); 
	}

	function get_filter_datas(){  
		$this->make_quer();  
		$query = $this->db->get();  
		return $query->num_rows();  
	} 

}  
?>
