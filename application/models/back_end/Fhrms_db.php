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
		$emp_id=$this->input->post('emp_id', true);
		
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function save_employee()
	{
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
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
		
		$ffi_emp_id=$this->input->post('ffi_emp_id', true);
		$emp_name=$this->input->post('emp_name', true);
		$designation=$this->input->post('designation', true);
		$department=$this->input->post('department', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('location', true);
		$gender=$this->input->post('gender', true);
		$fname=$this->input->post('fname', true);
		$blood_grp=$this->input->post('blood_grp', true);
		$qualification=$this->input->post('qualification', true);
		$phone1=$this->input->post('phone1', true);
		$phone2=$this->input->post('phone2', true);
		$email=$this->input->post('email', true);
		$permanent_address=$this->input->post('permanent_address', true);
		$present_address=$this->input->post('present_address', true);
		$pan_no=$this->input->post('pan_no', true);
		$aadhar_no=$this->input->post('aadhar_no', true);
		$driving_license=$this->input->post('driving_license', true);
		$bank_name=$this->input->post('bank_name', true);
		$bank_account_no=$this->input->post('bank_account_no', true);
		$ifsc_code=$this->input->post('ifsc_code', true);
		$uan=$this->input->post('uan', true);
		$uan_type=$this->input->post('uan_type', true);
		$uan_no=$this->input->post('uan_no', true);
		$status=$this->input->post('status', true);
		$basic_salary=$this->input->post('basic_salary', true);
		$hra=$this->input->post('hra', true);
		$conveyance=$this->input->post('conveyance', true);
		$medical=$this->input->post('medical', true);
		$special_allowance=$this->input->post('special_allowance', true);
		$st_bonus=$this->input->post('st_bonus', true);
		$other_allowance=$this->input->post('other_allowance', true);
		$gross_salary=$this->input->post('gross_salary', true);
		$pf_percentage=$this->input->post('pf_percentage', true);
		$emp_pf=$this->input->post('emp_pf', true);
		$esic_percentage=$this->input->post('esic_percentage', true);
		$emp_esic=$this->input->post('emp_esic', true);
		$pt=$this->input->post('pt', true);
		$total_deduction=$this->input->post('total_deduction', true);
		$employer_pf_percentage=$this->input->post('employer_pf_percentage', true);
		$employer_pf=$this->input->post('employer_pf', true);
		$employer_esic_percentage=$this->input->post('employer_esic_percentage', true);
		$employer_esic=$this->input->post('employer_esic', true);
		$mediclaim=$this->input->post('mediclaim', true);
		$ctc=$this->input->post('ctc', true);
		
		$take_home=$this->input->post('take_home', true);
		
		$interview_date=$this->input->post('interview_date', true);
		$joining_date=$this->input->post('joining_date', true);
		$contact_end_date=$this->input->post('contact_end_date', true);
		$dob=$this->input->post('dob', true);
		
		
		$psd=$this->input->post('password', true);
		$password = $this->bcrypt->hash_password($psd);
		
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
		if($_FILES['file_pan']['size']>0)
        {
			$pan_path='AKJHJG7665BHJG/pan_doc/';
			if (!is_dir($pan_path)) mkdir($pan_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = $pan_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$gftype=pathinfo($_FILES["file_pan"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_pan"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
			if ($this->upload->do_upload('file_pan'))
            {
				$pan_path=$pan_path.$new_name;
			}
			}else{
				return "For pan card please upload the correct file format";
			}
		}
		if ($_FILES['file_aadhar']['size']>0)
        {
			$aadhar_path='AKJHJG7665BHJG/aadhar_doc/';
			if (!is_dir($aadhar_path)) mkdir($aadhar_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = $aadhar_path;
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            $gftype=pathinfo($_FILES["file_aadhar"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_aadhar"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path=$aadhar_path.$new_name1;
			}
			}else{
			return "For aadhar card please upload the correct file format";
			}
		}
		if ($_FILES['file_license']['size']>0)
        {
			$license_path='AKJHJG7665BHJG/license_doc/';
			if (!is_dir($license_path)) mkdir($license_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = $license_path;
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
			$gftype=pathinfo($_FILES["file_license"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_license"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_license'))
            {
				$license_path=$license_path.$new_name2;
			}
			}else{
			return "For license please upload the correct file format";
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$resume_path='AKJHJG7665BHJG/resume/';
			if (!is_dir($resume_path)) mkdir($resume_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = $resume_path;
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
			$gftype=pathinfo($_FILES["resume"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["resume"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('resume'))
            {
				$resume=$resume_path.$new_name3;
			}
			}else{
			return "For resume card please upload the correct file format";
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$photo_path='AKJHJG7665BHJG/photo/';
			if (!is_dir($photo_path)) mkdir($photo_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = $photo_path;
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
			$gftype=pathinfo($_FILES["photo"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["photo"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('photo'))
            {
				$photo=$photo_path.$new_name4;
			}
			}else{
			return "For photo please upload the correct file format";
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$bank_path='AKJHJG7665BHJG/bank_doc/';
			if (!is_dir($bank_path)) mkdir($bank_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = $bank_path;
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
            $gftype=pathinfo($_FILES["file_document"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_document"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx"	);
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_document'))
            {
				$bank_document=$bank_path.$new_name5;
			}
			}else{
			return "For Bank document please upload the correct file format";
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$votor_path='AKJHJG7665BHJG/voter_id/';
			if (!is_dir($votor_path)) mkdir($votor_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = $votor_path;
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
            $gftype=pathinfo($_FILES["voter_id"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["voter_id"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id=$votor_path.$new_name6;
			}
			}else{
				return "For voter id please upload the correct file format";
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$emp_path='AKJHJG7665BHJG/emp_form/';
			if (!is_dir($emp_path)) mkdir($emp_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = $emp_path;
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
            $gftype=pathinfo($_FILES["emp_form"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["emp_form"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form=$emp_path.$new_name7;
			}
			}else{
				return "For emp form please upload the correct file format";
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$pf_path='AKJHJG7665BHJG/pf_doc/';
			if (!is_dir($pf_path)) mkdir($pf_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = $pf_path;
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
            $gftype=pathinfo($_FILES["pf_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["pf_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc=$pf_path.$new_name8;
			}
			}else{
				return "For pf document please upload the correct file format";
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$payslip_path='AKJHJG7665BHJG/payslip_doc/';
			if (!is_dir($payslip_path)) mkdir($payslip_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = $payslip_path;
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
            $gftype=pathinfo($_FILES["payslip_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["payslip_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc=$payslip_path.$new_name9;
			}
			}else{
				return "For payslip document please upload the correct file format";
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$experience_path='AKJHJG7665BHJG/exp_doc/';
			if (!is_dir($experience_path)) mkdir($experience_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = $experience_path;
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
			$gftype=pathinfo($_FILES["exp_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["exp_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc=$experience_path.$new_name10;
			}
			}else{
				return "For experience letter please upload the correct file format";
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
				$path = "AKJHJG7665BHJG/edu_certificate/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/edu_certificate/".$filen;
				$gftype=pathinfo($_FILES["edu_certificate"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["edu_certificate"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{										
					if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('education_certificate',$data1);
					}
				}else{
						return "For education certificate please upload the correct file formate";
					}
			}
		}
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/others_doc/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/others_doc/".$filen;		
				$gftype=pathinfo($_FILES["others_doc"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["others_doc"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{								
					if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('other_certificate',$data1);
					}
				}else{
						return "For Other certificate please upload the correct file formate";
					}
			}
		}
		return "true";
	}
	public function importEmployee($data = null)
	{
		$this->db->where('ffi_emp_id', $data['fhrms']['ffi_emp_id']);
		$query = $this->db->get("fhrms");
		if ($query->num_rows() <= 0)
		{
			$backendData 	= $data['fhrms'];
			$eduData 		= $data['education_certificate'];
			$othData 		= $data['other_certificate'];
			$insertData 	= $this->insertMangment($backendData); // Insert employee info
			$insertEdCer 	= $this->insertEducationCertificates($eduData); // Insert education Certificate
			$insertoth 		= $this->insertOtherCertificates($othData); // Insert other Certificate
			if($insertData && $insertoth && $insertEdCer)
			{
				return "insert";
			}
		}
		else 
		{
			$backendData 	= $data['fhrms'];
			$eduData 		= $data['education_certificate'];
			$othData 		= $data['other_certificate'];
			$upM 			= $this->updateMangment($backendData);
			$insertEdCer 	= $this->insertEducationCertificates($eduData); // Insert education Certificate
			$insertoth 		= $this->insertOtherCertificates($othData); // Insert other Certificate
			if($upM || $insertEdCer || $insertoth)
			{
				return "update";
			}	
			
		}
	return "nochanges";
}

// education Certificte
function insertEducationCertificates($data){
		
	$this->db->where("emp_id",$data['emp_id']);
	$this->db->delete("education_certificate");
	$explode=explode("|",$data['path']);
	$length=sizeof($explode);
	for($i=0;$i<$length;$i++)
	{
		$row=trim($explode[$i]);
		$insertData=array(
			"emp_id"	=>	 $data['emp_id'],
			"path"		=>	 $row,
		);	
		$inE=$this->insertEducation($insertData);
	}
	return $inE;
}

// Other Certificate
function insertOtherCertificates($data){
	$this->db->where("emp_id",$data['emp_id']);
	$this->db->delete("other_certificate");
	$explode1=explode("|",$data['path']);
	$length1=sizeof($explode1);
	for($i=0;$i<$length1;$i++)
	{
		$row1=trim($explode1[$i]);
		$insertData1=array(
			"emp_id"	=>	 $data['emp_id'],
			"path"		=>	 $row1,
		);	
		$inO =$this->insertOther($insertData1);
	}
	return $inO ;
}

public function insertMangment($data)
{
	$this->db->insert('fhrms', $data);
	if ($this->db->affected_rows() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
public function insertEducation($insertData)
{
	$this->db->insert('education_certificate',$insertData);
	if ($this->db->affected_rows() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}

}
public function insertOther($insertData1)
{
	$this->db->insert('other_certificate',$insertData1);

	if ($this->db->affected_rows() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}

}

public function updateMangment($data)
{
	$this->db->where('ffi_emp_id', $data['ffi_emp_id']);
	$this->db->update('fhrms', $data);
	if ($this->db->affected_rows() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}

}


	function save_emp_pending()
	{
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
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
		
		$ffi_emp_id=$this->input->post('ffi_emp_id', true);
		$emp_name=$this->input->post('emp_name', true);
		$designation=$this->input->post('designation', true);
		$department=$this->input->post('department', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('location', true);
		$gender=$this->input->post('gender', true);
		$fname=$this->input->post('fname', true);
		$blood_grp=$this->input->post('blood_grp', true);
		$qualification=$this->input->post('qualification', true);
		$phone1=$this->input->post('phone1', true);
		$phone2=$this->input->post('phone2', true);
		$email=$this->input->post('email', true);
		$permanent_address=$this->input->post('permanent_address', true);
		$present_address=$this->input->post('present_address', true);
		$pan_no=$this->input->post('pan_no', true);
		$aadhar_no=$this->input->post('aadhar_no', true);
		$driving_license=$this->input->post('driving_license', true);
		$bank_name=$this->input->post('bank_name', true);
		$bank_account_no=$this->input->post('bank_account_no', true);
		$ifsc_code=$this->input->post('ifsc_code', true);
		$uan=$this->input->post('uan', true);
		$uan_type=$this->input->post('uan_type', true);
		$uan_no=$this->input->post('uan_no', true);
		$status=$this->input->post('status', true);
		$basic_salary=$this->input->post('basic_salary', true);
		$hra=$this->input->post('hra', true);
		$conveyance=$this->input->post('conveyance', true);
		$medical=$this->input->post('medical', true);
		$special_allowance=$this->input->post('special_allowance', true);
		$st_bonus=$this->input->post('st_bonus', true);
		$other_allowance=$this->input->post('other_allowance', true);
		$gross_salary=$this->input->post('gross_salary', true);
		$pf_percentage=$this->input->post('pf_percentage', true);
		$emp_pf=$this->input->post('emp_pf', true);
		$esic_percentage=$this->input->post('esic_percentage', true);
		$emp_esic=$this->input->post('emp_esic', true);
		$pt=$this->input->post('pt', true);
		$total_deduction=$this->input->post('total_deduction', true);
		$employer_pf_percentage=$this->input->post('employer_pf_percentage', true);
		$employer_pf=$this->input->post('employer_pf', true);
		$employer_esic_percentage=$this->input->post('employer_esic_percentage', true);
		$employer_esic=$this->input->post('employer_esic', true);
		$mediclaim=$this->input->post('mediclaim', true);
		$ctc=$this->input->post('ctc', true);
		
		$take_home=$this->input->post('take_home', true);
			
		
		$interview_date=$this->input->post('interview_date', true);
		$joining_date=$this->input->post('joining_date', true);
		$contact_end_date=$this->input->post('contact_end_date', true);
		$dob=$this->input->post('dob', true);
		
		$psd=$this->input->post('password', true);
		$password = $this->bcrypt->hash_password($psd);
		
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
		if($_FILES['file_pan']['size']>0)
        {
			$pan_path='AKJHJG7665BHJG/pan_doc/';
			if (!is_dir($pan_path)) mkdir($pan_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = $pan_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$gftype=pathinfo($_FILES["file_pan"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_pan"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
			if ($this->upload->do_upload('file_pan'))
            {
				$pan_path=$pan_path.$new_name;
			}
			}else{
				return "For pan card please upload the correct file format";
			}
		}
		if ($_FILES['file_aadhar']['size']>0)
        {
			$aadhar_path='AKJHJG7665BHJG/aadhar_doc/';
			if (!is_dir($aadhar_path)) mkdir($aadhar_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = $aadhar_path;
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
			$gftype=pathinfo($_FILES["file_aadhar"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_aadhar"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path=$aadhar_path.$new_name1;
			}
			}else{
			return "For aadhar card please upload the correct file format";
			}
		}
		if ($_FILES['file_license']['size']>0)
        {
			$license_path='AKJHJG7665BHJG/license_doc/';
			if (!is_dir($license_path)) mkdir($license_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = $license_path;
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
			$gftype=pathinfo($_FILES["file_license"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_license"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_license'))
            {
				$license_path=$license_path.$new_name2;
			}
			}else{
			return "For license please upload the correct file format";
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$resume_path='AKJHJG7665BHJG/resume/';
			if (!is_dir($resume_path)) mkdir($resume_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = $resume_path;
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
			$gftype=pathinfo($_FILES["resume"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["resume"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('resume'))
            {
				$resume=$resume_path.$new_name3;
			}
			}else{
			return "For resume card please upload the correct file format";
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$photo_path='AKJHJG7665BHJG/photo/';
			if (!is_dir($photo_path)) mkdir($photo_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = $photo_path;
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
			$gftype=pathinfo($_FILES["photo"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["photo"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('photo'))
            {
				$photo=$photo_path.$new_name4;
			}
			}else{
			return "For photo please upload the correct file format";
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$bank_path='AKJHJG7665BHJG/bank_doc/';
			if (!is_dir($bank_path)) mkdir($bank_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = $bank_path;
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
			$gftype=pathinfo($_FILES["file_document"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_document"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx"	);
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_document'))
            {
				$bank_document=$bank_path.$new_name5;
			}
			}else{
			return "For Bank document please upload the correct file format";
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$voter_path='AKJHJG7665BHJG/voter_id/';
			if (!is_dir($voter_path)) mkdir($voter_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = $voter_path;
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
			$gftype=pathinfo($_FILES["voter_id"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["voter_id"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id=$voter_path.$new_name6;
			}
			}else{
				return "For voter id please upload the correct file format";
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$emp_path='AKJHJG7665BHJG/emp_form/';
			if (!is_dir($emp_path)) mkdir($emp_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = $emp_path;
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
			$gftype=pathinfo($_FILES["emp_form"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["emp_form"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form=$emp_path.$new_name7;
			}
			}else{
				return "For emp form please upload the correct file format";
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$pf_path='AKJHJG7665BHJG/pf_doc/';
			if (!is_dir($pf_path)) mkdir($pf_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = $pf_path;
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
			$gftype=pathinfo($_FILES["pf_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["pf_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc=$pf_path.$new_name8;
			}
			}else{
				return "For pf document please upload the correct file format";
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$payslip_path='AKJHJG7665BHJG/payslip_doc/';
			if (!is_dir($payslip_path)) mkdir($payslip_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = $payslip_path;
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
			$gftype=pathinfo($_FILES["payslip_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["payslip_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc=$payslip_path.$new_name9;
			}
			}else{
				return "For payslip document please upload the correct file format";
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$experience_path='AKJHJG7665BHJG/exp_doc/';
			if (!is_dir($experience_path)) mkdir($experience_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = $experience_path;
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
			$gftype=pathinfo($_FILES["exp_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["exp_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc=$experience_path.$new_name10;
			}
			}else{
				return "For experience letter please upload the correct file format";
			}
		}
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/edu_certificate/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/edu_certificate/".$filen;
				$gftype=pathinfo($_FILES["edu_certificate"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["edu_certificate"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{										
					if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('education_certificate',$data1);
					}
				}else{
						return "For education certificate please upload the correct file formate";
					}
			}
		}
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/others_doc/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/others_doc/".$filen;		
				$gftype=pathinfo($_FILES["others_doc"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["others_doc"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{								
					if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('other_certificate',$data1);
					}
				}else{
						return "For Other certificate please upload the correct file formate";
					}
			}
			
		}
		$data=array("ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc);
			
		$this->db->insert("fhrms",$data);	
		return $this->db->affected_rows() > 0 ? "true" : "something went wrong!";
	}
	function update_employee()
	{
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
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
		
		$ffi_emp_id=$this->input->post('ffi_emp_id', true);
		$emp_name=$this->input->post('emp_name', true);
		$designation=$this->input->post('designation', true);
		$department=$this->input->post('department', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('location', true);
		$gender=$this->input->post('gender', true);
		$fname=$this->input->post('fname', true);
		$blood_grp=$this->input->post('blood_grp', true);
		$qualification=$this->input->post('qualification', true);
		$phone1=$this->input->post('phone1', true);
		$phone2=$this->input->post('phone2', true);
		$email=$this->input->post('email', true);
		$permanent_address=$this->input->post('permanent_address', true);
		$present_address=$this->input->post('present_address', true);
		$pan_no=$this->input->post('pan_no', true);
		$aadhar_no=$this->input->post('aadhar_no', true);
		$driving_license=$this->input->post('driving_license', true);
		$bank_name=$this->input->post('bank_name', true);
		$bank_account_no=$this->input->post('bank_account_no', true);
		$ifsc_code=$this->input->post('ifsc_code', true);
		$uan=$this->input->post('uan', true);
		$uan_type=$this->input->post('uan_type', true);
		$uan_no=$this->input->post('uan_no', true);
		$status=$this->input->post('status', true);
		
		$basic_salary=$this->input->post('basic_salary', true);
		$hra=$this->input->post('hra', true);
		$conveyance=$this->input->post('conveyance', true);
		$medical=$this->input->post('medical', true);
		$special_allowance=$this->input->post('special_allowance', true);
		$st_bonus=$this->input->post('st_bonus', true);
		$other_allowance=$this->input->post('other_allowance', true);
		$gross_salary=$this->input->post('gross_salary', true);
		$pf_percentage=$this->input->post('pf_percentage', true);
		$emp_pf=$this->input->post('emp_pf', true);
		$esic_percentage=$this->input->post('esic_percentage', true);
		$emp_esic=$this->input->post('emp_esic', true);
		$pt=$this->input->post('pt', true);
		$total_deduction=$this->input->post('total_deduction', true);
		
		$take_home=$this->input->post('take_home', true);
		
		$employer_pf_percentage=$this->input->post('employer_pf_percentage', true);
		$employer_pf=$this->input->post('employer_pf', true);
		$employer_esic_percentage=$this->input->post('employer_esic_percentage', true);
		$employer_esic=$this->input->post('employer_esic', true);
		$mediclaim=$this->input->post('mediclaim', true);
		$ctc=$this->input->post('ctc', true);
		
		$interview_date=$this->input->post('interview_date', true);
		$joining_date=$this->input->post('joining_date', true);
		$contact_end_date=$this->input->post('contact_end_date', true);
		$dob=$this->input->post('dob', true);
		
		$active_status=$this->input->post('active', true);
		
		$psd=$this->input->post('password', true);
		$password = $this->bcrypt->hash_password($psd);
		
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
		if($_FILES['file_pan']['size']>0)
        {
			$pan_path='AKJHJG7665BHJG/pan_doc/';
			if (!is_dir($pan_path)) mkdir($pan_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = $pan_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$gftype=pathinfo($_FILES["file_pan"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_pan"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
			if ($this->upload->do_upload('file_pan'))
            {
				$pan_path=$pan_path.$new_name;
			}
			}else{
				return "For pan card please upload the correct file format";
			}
		}
		if ($_FILES['file_aadhar']['size']>0)
        {
			$aadhar_path='AKJHJG7665BHJG/aadhar_doc/';
			if (!is_dir($aadhar_path)) mkdir($aadhar_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = $aadhar_path;
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
			$gftype=pathinfo($_FILES["file_aadhar"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_aadhar"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path=$aadhar_path.$new_name1;
			}
			}else{
			return "For aadhar card please upload the correct file format";
			}
		}
		if ($_FILES['file_license']['size']>0)
        {
			$license_path='AKJHJG7665BHJG/license_doc/';
			if (!is_dir($license_path)) mkdir($license_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = $license_path;
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
			$gftype=pathinfo($_FILES["file_license"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_license"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_license'))
            {
				$license_path=$license_path.$new_name2;
			}
			}else{
			return "For license please upload the correct file format";
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$resume_path='AKJHJG7665BHJG/resume/';
			if (!is_dir($resume_path)) mkdir($resume_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = $resume_path;
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
			$gftype=pathinfo($_FILES["resume"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["resume"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('resume'))
            {
				$resume=$resume_path.$new_name3;
			}
			}else{
			return "For resume card please upload the correct file format";
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$photo_path='AKJHJG7665BHJG/photo/';
			if (!is_dir($photo_path)) mkdir($photo_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = $photo_path;
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
			$gftype=pathinfo($_FILES["photo"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["photo"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('photo'))
            {
				$photo=$photo_path.$new_name4;
			}
			}else{
			return "For photo please upload the correct file format";
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$bank_path='AKJHJG7665BHJG/bank_doc/';
			if (!is_dir($bank_path)) mkdir($bank_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = $bank_path;
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
			$gftype=pathinfo($_FILES["file_document"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_document"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx"	);
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_document'))
            {
				$bank_document=$bank_path.$new_name5;
			}
			}else{
			return "For Bank document please upload the correct file format";
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$voter_path='AKJHJG7665BHJG/voter_id/';
			if (!is_dir($voter_path)) mkdir($voter_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = $voter_path;
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
			$gftype=pathinfo($_FILES["voter_id"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["voter_id"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id=$voter_path.$new_name6;
			}
			}else{
				return "For voter id please upload the correct file format";
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$emp_path='AKJHJG7665BHJG/emp_form/';
			if (!is_dir($emp_path)) mkdir($emp_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = $emp_path;
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
			$gftype=pathinfo($_FILES["emp_form"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["emp_form"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form=$emp_path.$new_name7;
			}
			}else{
				return "For emp form please upload the correct file format";
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$pf_path='AKJHJG7665BHJG/pf_doc/';
			if (!is_dir($pf_path)) mkdir($pf_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = $pf_path;
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
			$gftype=pathinfo($_FILES["pf_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["pf_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc=$pf_path.$new_name8;
			}
			}else{
				return "For pf document please upload the correct file format";
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$payslip_path='AKJHJG7665BHJG/payslip_doc/';
			if (!is_dir($payslip_path)) mkdir($payslip_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = $payslip_path;
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
			$gftype=pathinfo($_FILES["payslip_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["payslip_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc=$payslip_path.$new_name9;
			}
			}else{
				return "For payslip document please upload the correct file format";
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$experience_path='AKJHJG7665BHJG/exp_doc/';
			if (!is_dir($experience_path)) mkdir($experience_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = $experience_path;
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
			$gftype=pathinfo($_FILES["exp_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["exp_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc=$experience_path.$new_name10;
			}
			}else{
				return "For experience letter please upload the correct file format";
			}
		}
		
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/edu_certificate/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/edu_certificate/".$filen;
				$gftype=pathinfo($_FILES["edu_certificate"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["edu_certificate"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{										
					if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('education_certificate',$data1);
					}
				}else{
						return "For education certificate please upload the correct file formate";
					}
			}
		}
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/others_doc/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/others_doc/".$filen;		
				$gftype=pathinfo($_FILES["others_doc"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["others_doc"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{								
					if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('other_certificate',$data1);
					}
				}else{
						return "For Other certificate please upload the correct file formate";
					}
			}
		}
		
		$data=array(
			"ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"data_status"=>"1","basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc,"active_status"=>$active_status);
			
		$this->db->where('id',$id);
		$this->db->update("fhrms",$data);	
		return $this->db->affected_rows() > 0 ? "true" : "something went wrong!";
	}
	
	function update_employee_pending()
	{
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
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
		
		$client=$this->input->post('client', true);
		$ffi_emp_id=$this->input->post('ffi_emp_id', true);
		$client_emp_id=$this->input->post('client_emp_id', true);
		$emp_name=$this->input->post('emp_name', true);
		$designation=$this->input->post('designation', true);
		$department=$this->input->post('department', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('location', true);
		$gender=$this->input->post('gender', true);
		$fname=$this->input->post('fname', true);
		$blood_grp=$this->input->post('blood_grp', true);
		$qualification=$this->input->post('qualification', true);
		$phone1=$this->input->post('phone1', true);
		$phone2=$this->input->post('phone2', true);
		$email=$this->input->post('email', true);
		$permanent_address=$this->input->post('permanent_address', true);
		$present_address=$this->input->post('present_address', true);
		$pan_no=$this->input->post('pan_no', true);
		$aadhar_no=$this->input->post('aadhar_no', true);
		$driving_license=$this->input->post('driving_license', true);
		$bank_name=$this->input->post('bank_name', true);
		$bank_account_no=$this->input->post('bank_account_no', true);
		$ifsc_code=$this->input->post('ifsc_code', true);
		$uan=$this->input->post('uan', true);
		$uan_type=$this->input->post('uan_type', true);
		$uan_no=$this->input->post('uan_no', true);
		$status=$this->input->post('status', true);
		
		$basic_salary=$this->input->post('basic_salary', true);
		$hra=$this->input->post('hra', true);
		$conveyance=$this->input->post('conveyance', true);
		$medical=$this->input->post('medical', true);
		$special_allowance=$this->input->post('special_allowance', true);
		$st_bonus=$this->input->post('st_bonus', true);
		$other_allowance=$this->input->post('other_allowance', true);
		$gross_salary=$this->input->post('gross_salary', true);
		$pf_percentage=$this->input->post('pf_percentage', true);
		$emp_pf=$this->input->post('emp_pf', true);
		$esic_percentage=$this->input->post('esic_percentage', true);
		$emp_esic=$this->input->post('emp_esic', true);
		$pt=$this->input->post('pt', true);
		$total_deduction=$this->input->post('total_deduction', true);
		
		$take_home=$this->input->post('take_home', true);
		
		$employer_pf_percentage=$this->input->post('employer_pf_percentage', true);
		$employer_pf=$this->input->post('employer_pf', true);
		$employer_esic_percentage=$this->input->post('employer_esic_percentage', true);
		$employer_esic=$this->input->post('employer_esic', true);
		$mediclaim=$this->input->post('mediclaim', true);
		$ctc=$this->input->post('ctc', true);
		
		$interview_date=$this->input->post('interview_date', true);
		$joining_date=$this->input->post('joining_date', true);
		$contact_end_date=$this->input->post('contact_end_date', true);
		$dob=$this->input->post('dob', true);
		
		$active_status=$this->input->post('active', true);
		
		$psd=$this->input->post('password', true);
		$password = $this->bcrypt->hash_password($psd);
		
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
		if($_FILES['file_pan']['size']>0)
        {
			$pan_path='AKJHJG7665BHJG/pan_doc/';
			if (!is_dir($pan_path)) mkdir($pan_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_pan"]['name']));
            $config['upload_path'] = $pan_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$gftype=pathinfo($_FILES["file_pan"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_pan"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
			if ($this->upload->do_upload('file_pan'))
            {
				$pan_path=$pan_path.$new_name;
			}
			}else{
				return "For pan card please upload the correct file format";
			}
		}
		if ($_FILES['file_aadhar']['size']>0)
        {
			$aadhar_path='AKJHJG7665BHJG/aadhar_doc/';
			if (!is_dir($aadhar_path)) mkdir($aadhar_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config1['upload_path'] = $aadhar_path;
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
			$gftype=pathinfo($_FILES["file_aadhar"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_aadhar"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path=$aadhar_path.$new_name1;
			}
			}else{
			return "For aadhar card please upload the correct file format";
			}
		}
		if ($_FILES['file_license']['size']>0)
        {
			$license_path='AKJHJG7665BHJG/license_doc/';
			if (!is_dir($license_path)) mkdir($license_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config2['upload_path'] = $license_path;
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
			$gftype=pathinfo($_FILES["file_license"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_license"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_license'))
            {
				$license_path=$license_path.$new_name2;
			}
			}else{
			return "For license please upload the correct file format";
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$resume_path='AKJHJG7665BHJG/resume/';
			if (!is_dir($resume_path)) mkdir($resume_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = $resume_path;
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
			$gftype=pathinfo($_FILES["resume"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["resume"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('resume'))
            {
				$resume=$resume_path.$new_name3;
			}
			}else{
			return "For resume card please upload the correct file format";
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$photo_path='AKJHJG7665BHJG/photo/';
			if (!is_dir($photo_path)) mkdir($photo_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name4 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config4['upload_path'] = $photo_path;
            $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config4['file_name'] = $new_name4;	
			$this->load->library('upload',$config4);
			$this->upload->initialize($config4);
			$gftype=pathinfo($_FILES["photo"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["photo"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('photo'))
            {
				$photo=$photo_path.$new_name4;
			}
			}else{
			return "For photo please upload the correct file format";
			}
		}
		if (!empty($_FILES['file_document']['name']))
        {
			$bank_path='AKJHJG7665BHJG/bank_doc/';
			if (!is_dir($bank_path)) mkdir($bank_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name5 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_document"]['name']));
            $config5['upload_path'] = $bank_path;
            $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config5['file_name'] = $new_name5;	
			$this->load->library('upload',$config5);
			$this->upload->initialize($config5);
			$gftype=pathinfo($_FILES["file_document"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file_document"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx"	);
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('file_document'))
            {
				$bank_document=$bank_path.$new_name5;
			}
			}else{
			return "For Bank document please upload the correct file format";
			}
		}
		if (!empty($_FILES['voter_id']['name']))
        {
			$voter_path='AKJHJG7665BHJG/voter_id/';
			if (!is_dir($voter_path)) mkdir($voter_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name6 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["voter_id"]['name']));
            $config6['upload_path'] = $voter_path;
            $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config6['file_name'] = $new_name6;	
			$this->load->library('upload',$config6);
			$this->upload->initialize($config6);
			$gftype=pathinfo($_FILES["voter_id"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["voter_id"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('voter_id'))
            {
				$voter_id=$voter_path.$new_name6;
			}
			}else{
				return "For voter id please upload the correct file format";
			}
		}
		if (!empty($_FILES['emp_form']['name']))
        {
			$emp_path='AKJHJG7665BHJG/emp_form/';
			if (!is_dir($emp_path)) mkdir($emp_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name7 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["emp_form"]['name']));
            $config7['upload_path'] = $emp_path;
            $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config7['file_name'] = $new_name7;	
			$this->load->library('upload',$config7);
			$this->upload->initialize($config7);
			$gftype=pathinfo($_FILES["emp_form"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["emp_form"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('emp_form'))
            {
				$emp_form=$emp_path.$new_name7;
			}
			}else{
				return "For emp form please upload the correct file format";
			}
		}
		if (!empty($_FILES['pf_doc']['name']))
        {
			$pf_path='AKJHJG7665BHJG/pf_doc/';
			if (!is_dir($pf_path)) mkdir($pf_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name8 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["pf_doc"]['name']));
            $config8['upload_path'] = $pf_path;
            $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config8['file_name'] = $new_name8;	
			$this->load->library('upload',$config8);
			$this->upload->initialize($config8);
			$gftype=pathinfo($_FILES["pf_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["pf_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc","docx");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('pf_doc'))
            {
				$pf_doc=$pf_path.$new_name8;
			}
			}else{
				return "For pf document please upload the correct file format";
			}
		}
		if (!empty($_FILES['payslip_doc']['name']))
        {
			$payslip_path='AKJHJG7665BHJG/payslip_doc/';
			if (!is_dir($payslip_path)) mkdir($payslip_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name9 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["payslip_doc"]['name']));
            $config9['upload_path'] = $payslip_path;
            $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config9['file_name'] = $new_name9;	
			$this->load->library('upload',$config9);
			$this->upload->initialize($config9);
			$gftype=pathinfo($_FILES["payslip_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["payslip_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('payslip_doc'))
            {
				$payslip_doc=$payslip_path.$new_name9;
			}
			}else{
				return "For payslip document please upload the correct file format";
			}
		}
		if (!empty($_FILES['exp_doc']['name']))
        {
			$experience_path='AKJHJG7665BHJG/exp_doc/';
			if (!is_dir($experience_path)) mkdir($experience_path, 0777, TRUE);
			$rand_no=date("is");
			$new_name10 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["exp_doc"]['name']));
            $config10['upload_path'] = $experience_path;
            $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';  
			$config10['file_name'] = $new_name10;	
			$this->load->library('upload',$config10);
			$this->upload->initialize($config10);
			$gftype=pathinfo($_FILES["exp_doc"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["exp_doc"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if($this->upload->do_upload('exp_doc'))
            {
				$exp_doc=$experience_path.$new_name10;
			}
			}else{
				return "For experience letter please upload the correct file format";
			}
		}
		
		for($i=0;$i<count($_FILES["edu_certificate"]["name"]);$i++)
		{
			if($_FILES["edu_certificate"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["edu_certificate"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/edu_certificate/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/edu_certificate/".$filen;
				$gftype=pathinfo($_FILES["edu_certificate"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["edu_certificate"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{										
					if(move_uploaded_file($_FILES["edu_certificate"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('education_certificate',$data1);
					}
				}else{
						return "For education certificate please upload the correct file formate";
					}
			}
		}
		
		for($i=0;$i<count($_FILES["others_doc"]["name"]);$i++)
		{
			if($_FILES["others_doc"]["size"][$i]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["others_doc"]['name'][$i]; //file name
				$path = "AKJHJG7665BHJG/others_doc/";
				if (!is_dir($path)) mkdir($path, 0777, TRUE);
				$fpath="AKJHJG7665BHJG/others_doc/".$filen;		
				$gftype=pathinfo($_FILES["others_doc"]['name'][$i], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["others_doc"]['tmp_name'][$i]))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{								
					if(move_uploaded_file($_FILES["others_doc"]['tmp_name'][$i],$path.$filen)) 
					{
						$data1=array("emp_id"=>$id,"path"=>$fpath);	
						$this->db->insert('other_certificate',$data1);
					}
				}else{
						return "For Other certificate please upload the correct file formate";
					}
			}
		}
		
		$data=array(
			"ffi_emp_id"=>$ffi_emp_id,"emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc,"active_status"=>$active_status,"password"=>$password,"psd"=>$psd);
	
		$this->db->where('id',$id);
		$this->db->update("fhrms",$data);	
		return $this->db->affected_rows() > 0 ? "true" : "something went wrong!";
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
		$id=$this->input->post('id', true);
		$this->db->where('id',$id);
		$this->db->delete('ffi_education_certificate');
	}
	function delete_other_certificate()
	{
		$id=$this->input->post('id', true);
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
		$emp_id=$this->input->post('ffi_emp_id', true);
		$letter_format=$this->input->post('letter_format', true);
		$basic_salary=$this->input->post('basic_salary', true);
		$hra=$this->input->post('hra', true);
		$conveyance=$this->input->post('conveyance', true);
		$medical=$this->input->post('medical', true);
		$special_allowance=$this->input->post('special_allowance', true);
		$other_allowance=$this->input->post('other_allowance', true);
		$gross_salary=$this->input->post('gross_salary', true);
		$pf_percentage=$this->input->post('pf_percentage', true);
		$emp_pf=$this->input->post('emp_pf', true);
		$esic_percentage=$this->input->post('esic_percentage', true);
		$emp_esic=$this->input->post('emp_esic', true);
		$pt=$this->input->post('pt', true);
		$total_deduction=$this->input->post('total_deduction', true);
		$employer_pf_percentage=$this->input->post('employer_pf_percentage', true);
		$employer_pf=$this->input->post('employer_pf', true);
		$employer_esic_percentage=$this->input->post('employer_esic_percentage', true);
		$employer_esic=$this->input->post('employer_esic', true);
		$mediclaim=$this->input->post('mediclaim', true);
		$ctc=$this->input->post('ctc', true);
		
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
		$id=$this->input->post('id', true);
		$this->db->where('id',$id);
		$this->db->delete('ffi_offer_letter');
	}
	function remove_voter_id()
	{
		$id=$this->input->post('id', true);
		$data=array("voter_id"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_emp_form()
	{
		$id=$this->input->post('id', true);
		$data=array("emp_form"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_pf_esic()
	{
		$id=$this->input->post('id', true);
		$data=array("pf_esic_form"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_payslip()
	{
		$id=$this->input->post('id', true);
		$data=array("payslip"=>"");
		$this->db->where('id',$id);
		$this->db->update('fhrms',$data);
	}
	function remove_exp_letter()
	{
		$id=$this->input->post('id', true);
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
		$emp_id=$this->input->post('emp_id', true);
		$this->db->where('ffi_emp_id',$emp_id);
		$count=$this->db->count_all_results('fhrms');
		return $count;
	}
	function delete_fhrms()
	{
		$id=$this->input->post('id', true);
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
