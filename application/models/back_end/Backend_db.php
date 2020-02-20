<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Backend_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_backend_team()
	{
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('emp_name!=','');
		$this->db->where("a.status","0");
		$this->db->where("a.dcs_approval","1");
		$this->db->where('a.active_status',0); 
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
	
		return $q;
	}
	public function get_all_backend_team_for_download()
	{
		$client=$this->input->post('backend_download_client'); 
		$status=$this->input->post('emp_status'); 
		$from=$this->input->post('backend_download_date'); 
		$to=$this->input->post('backend_download_date2'); 
		$date = date("Y-m-d", strtotime($from));
		$date2 = date("Y-m-d", strtotime($to));
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('emp_name!=','');
		if (!empty($client)) {
			$this->db->where("a.client_id",$client);
			}
		
		if (!empty($status)) {
			$this->db->where("a.active_status",$status);
			}
		if (!empty($from)) {
		$this->db->where("a.joining_date >=",$date);
		}
		if (!empty($to)) {
			$this->db->where("a.joining_date <=",$date2);
			}

		$query=$this->db->get();
		$q=$query->result_array();
	
		return $q;
	}

	public function make_query()
	{
	 
        $order_column = array("a.id", "b.client_name", "a.ffi_emp_id", "a.emp_name", "a.joining_date", "a.phone1","a.data_status");  
        $this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('emp_name!=','');
		$this->db->where("a.dcs_approval","1");
		$this->db->where('a.active_status',0);
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("b.client_name", $_POST["search"]["value"]);  
                $this->db->or_like("a.ffi_emp_id", $_POST["search"]["value"]);  
                $this->db->or_like("a.emp_name", $_POST["search"]["value"]);
				$this->db->or_like("a.joining_date", $_POST["search"]["value"]);
				$this->db->or_like("a.phone1", $_POST["search"]["value"]); 
                $this->db->or_like("a.data_status", $_POST["search"]["value"]); 
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

	function get_all_data()  
    {  
           $this->db->select("*");
           $this->db->from('backend_management');  
           return $this->db->count_all_results();  
	}
	
	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	} 

	function make_datatables(){  
        $this->make_query();   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();  
    }
	
	function delete_backend_team()
	{
		$id=$this->input->post('id'); 
		// $data=array("status"=>"1");
		$this->db->where("id",$id);
		if($this->db->delete("backend_management")){
			return true; 
		}
		// redirect("Backend_team/get_all_data");
		// redirect("Backend_team/");
		// $this->db->update("backend_management",$data); 
	}

	function get_backend_team_details($id)
	{
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	public function save_team()
	{
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
		
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
				
		$db_joining_date="";
		$db_contact_end_date="";
		$db_dob="";
		$pan_path="";
		$aadhar_path="";
		$license_path="";
		
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
		if (!empty($_FILES['file_pan']['name']))
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
		if (!empty($_FILES['file_aadhar']['name']))
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
		if (!empty($_FILES['file_license']['name']))
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
		$data=array(
			"client_id"=>$client,"ffi_emp_id"=>$ffi_emp_id,"client_emp_id"=>$client_emp_id, "emp_name"=>$emp_name, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path, "bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code, "uan_generatted"=>$uan, "uan_type"=>$uan_type, "uan_no"=>$uan_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"data_status"=>"1",
			"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc);
			
			$this->db->insert('backend_management',$data);
	}
	function update_team()
	{
		$id=$this->uri->segment(3);
		
		$this->db->select("pan_path,aadhar_path,driving_license_path,photo,resume,bank_document,voter_id,emp_form,pf_esic_form,payslip,exp_letter");
		$this->db->from("backend_management");
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
		
		$uan_no=$this->input->post('uan_no');
		$esic_no=$this->input->post('esic_no');
		$status=$this->input->post('status');
		
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$st_bonus=$this->input->post('st_bonus');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		
		$emp_pf=$this->input->post('emp_pf');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		$take_home=$this->input->post('take_home');
		
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		$active=$this->input->post('active');
		$psd=$this->input->post('password');
		$password=md5($psd);
		
		$entity_name=$this->input->post('entity_name');
		$console_id=$this->input->post('console_id');
		$grade=$this->input->post('grade');
		$middle_name=$this->input->post('middle_name');
		$last_name=$this->input->post('last_name');
		$branch=$this->input->post('branch');
		$mname=$this->input->post('mname');
		$religion=$this->input->post('religion');
		$languages=$this->input->post('languages');
		$mother_tongue=$this->input->post('mother_tongue');
		$marital_status=$this->input->post('marital_status');
		$emer_contact_no=$this->input->post('emer_contact_no');
		$spouse_name=$this->input->post('spouse_name');
		$no_of_childrens=$this->input->post('no_of_childrens');
		$official_email=$this->input->post('official_email');
		
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
			//echo "hello";
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
		
		$data=array(
		 "entity_name"=>$entity_name,"console_id"=>$console_id,"grade"=>$grade,"middle_name"=>$middle_name,"last_name"=>$last_name,"branch"=>$branch,"mother_name"=>$mname,"religion"=>$religion,"languages"=>$languages,"mother_tongue"=>$mother_tongue,"maritial_status"=>$marital_status,"emer_contact_no"=>$emer_contact_no,"spouse_name"=>$spouse_name,"no_of_childrens"=>$no_of_childrens,"official_mail_id"=>$official_email,"client_id"=>$client,"ffi_emp_id"=>$ffi_emp_id,"client_emp_id"=>$client_emp_id, "emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code,"uan_no"=>$uan_no,"esic_no"=>$esic_no, "status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"data_status"=>"1","basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"emp_pf"=>$emp_pf,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf"=>$employer_pf,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc,"active_status"=>$active);
		$this->db->where('id',$id);
		$this->db->update("backend_management",$data);	
	}
	function update_team_pending()
	{
		$id=$this->uri->segment(3);
		
		$this->db->select("pan_path,aadhar_path,driving_license_path,photo,resume,bank_document,voter_id,emp_form,pf_esic_form,payslip,exp_letter");
		$this->db->from("backend_management");
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
		
		$uan_no=$this->input->post('uan_no');
		$esic_no=$this->input->post('esic_no');
		$status=$this->input->post('status');
		
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$st_bonus=$this->input->post('st_bonus');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		
		$emp_pf=$this->input->post('emp_pf');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		$take_home=$this->input->post('take_home');
		
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$contact_end_date=$this->input->post('contact_end_date');
		$dob=$this->input->post('dob');
		
		$active=$this->input->post('active');
		$psd=$this->input->post('password');
		$password=md5($psd);
		
		$entity_name=$this->input->post('entity_name');
		$console_id=$this->input->post('console_id');
		$grade=$this->input->post('grade');
		$middle_name=$this->input->post('middle_name');
		$last_name=$this->input->post('last_name');
		$branch=$this->input->post('branch');
		$mname=$this->input->post('mname');
		$religion=$this->input->post('religion');
		$languages=$this->input->post('languages');
		$mother_tongue=$this->input->post('mother_tongue');
		$marital_status=$this->input->post('marital_status');
		$emer_contact_no=$this->input->post('emer_contact_no');
		$spouse_name=$this->input->post('spouse_name');
		$no_of_childrens=$this->input->post('no_of_childrens');
		$official_email=$this->input->post('official_email');
		
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
		
		$data=array(
			"entity_name"=>$entity_name,"console_id"=>$console_id,"grade"=>$grade,"middle_name"=>$middle_name,"last_name"=>$last_name,"branch"=>$branch,"mother_name"=>$mname,"religion"=>$religion,"languages"=>$languages,"mother_tongue"=>$mother_tongue,"maritial_status"=>$marital_status,"emer_contact_no"=>$emer_contact_no,"spouse_name"=>$spouse_name,"no_of_childrens"=>$no_of_childrens,"official_mail_id"=>$official_email,"client_id"=>$client,"ffi_emp_id"=>$ffi_emp_id,"client_emp_id"=>$client_emp_id, "emp_name"=>$emp_name, "interview_date"=>$db_interview_date, "joining_date"=>$db_joining_date, "contract_date"=>$db_contact_end_date, "designation"=>$designation, "department"=>$department, "state"=>$state, "location"=>$location, "dob"=>$db_dob, "gender"=>$gender, "father_name"=>$fname, "blood_group"=>$blood_grp, "qualification"=>$qualification, "phone1"=>$phone1, "phone2"=>$phone2, "email"=>$email, "permanent_address"=>$permanent_address, "present_address"=>$present_address, "pan_no"=>$pan_no, "pan_path"=>$pan_path, "aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"bank_document"=>$bank_document,"bank_name"=>$bank_name, "bank_account_no"=>$bank_account_no, "bank_ifsc_code"=>$ifsc_code,"uan_no"=>$uan_no,"esic_no"=>$esic_no,"status"=>$status, "modify_by"=>$user, "modified_date"=>$db_create,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"st_bonus"=>$st_bonus,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"emp_pf"=>$emp_pf,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"take_home"=>$take_home,"employer_pf"=>$employer_pf,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"password"=>$password,"psd"=>$psd,"voter_id"=>$voter_id,"emp_form"=>$emp_form,"pf_esic_form"=>$pf_doc,"payslip"=>$payslip_doc,"exp_letter"=>$exp_doc,"active_status"=>$active);
	
		$this->db->where('id',$id);
		$this->db->update("backend_management",$data);	
	}
	function get_edu_certificate($id)
	{
		$this->db->where('emp_id',$id);
		$query=$this->db->get('education_certificate');
		$q=$query->result_array();
		return $q;
	}
	function get_other_certificate($id)
	{
		$this->db->where('emp_id',$id);
		$query=$this->db->get('other_certificate');
		$q=$query->result_array();
		return $q;
	}
	function delete_education_certificate()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('education_certificate');
	}
	function delete_other_certificate()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('other_certificate');
	}
	
	function remove_voter_id()
	{
		$id=$this->input->post('id');
		$data=array("voter_id"=>"");
		$this->db->where('id',$id);
		$this->db->update('backend_management',$data);
	}
	function remove_emp_form()
	{
		$id=$this->input->post('id');
		$data=array("emp_form"=>"");
		$this->db->where('id',$id);
		$this->db->update('backend_management',$data);
	}
	function remove_pf_esic()
	{
		$id=$this->input->post('id');
		$data=array("pf_esic_form"=>"");
		$this->db->where('id',$id);
		$this->db->update('backend_management',$data);
	}
	function remove_payslip()
	{
		$id=$this->input->post('id');
		$data=array("payslip"=>"");
		$this->db->where('id',$id);
		$this->db->update('backend_management',$data);
	}
	function remove_exp_letter()
	{
		$id=$this->input->post('id');
		$data=array("exp_letter"=>"");
		$this->db->where('id',$id);
		$this->db->update('backend_management',$data);
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
		$count=$this->db->count_all_results('backend_management');
		return $count;
		
	}

	// excel import
	public function importEmployee($data = null)
	{
		$this->db->where('ffi_emp_id', $data['backend']['ffi_emp_id']);
		$query = $this->db->get("backend_management");
		if ($query->num_rows() <= 0)
		{
			$backendData=$data['backend'];
			$inM=$this->insertMangment($backendData);

				$explode=explode("|",$data['education_certificate']['path']);
				$length=sizeof($explode);
				
				for($i=0;$i<$length;$i++)
				{
					 
					$row=trim($explode[$i]);
					$insertData=array(
						"emp_id"	=>	 $data['education_certificate']['emp_id'],
						"path"		=>	 $row,
					);	
					$inE=$this->insertEducation($insertData);
			
				}
				
			$explode1=explode("|",$data['other_certificate']['path']);
				$length1=sizeof($explode1);
				for($i=0;$i<$length1;$i++)
				{
					$row1=trim($explode1[$i]);
					$insertData1=array(
						"emp_id"	=>	 $data['other_certificate']['emp_id'],
						"path"		=>	 $row1,
					);	
					$inO=$this->insertOther($insertData1);
				}

				if($inM && $inE && $inO)
				{
					return "insert";
				}
			
			}
		else 
		{
			$upM=$this->updateMangment($data);
			// $upE=$this->updateEducation($data);
			// $upO=$this->updateOther($data);
			$this->db->where("emp_id",$data['education_certificate']['emp_id']);
			$this->db->delete("education_certificate");
			$explode=explode("|",$data['education_certificate']['path']);
				$length=sizeof($explode);
				for($i=0;$i<$length;$i++)
				{
					 
					$row=trim($explode[$i]);
					$insertData=array(
						"emp_id"	=>	 $data['education_certificate']['emp_id'],
						"path"		=>	 $row,
					);	
					$upE=$this->insertEducation($insertData);
				
				}


				$this->db->where("emp_id",$data['other_certificate']['emp_id']);
				$this->db->delete("other_certificate");
			$explode1=explode("|",$data['other_certificate']['path']);
				$length1=sizeof($explode1);
				for($i=0;$i<$length1;$i++)
				{
					$row1=trim($explode1[$i]);
					$insertData1=array(
						"emp_id"	=>	 $data['other_certificate']['emp_id'],
						"path"		=>	 $row1,
					);	
					$upO=$this->insertOther($insertData1);
				}
			if($upM || $upE || $upO)
			{
				return "update";
			}	
			
		}
		
	
	return "nochanges";
}

public function insertMangment($data)
{
	$this->db->insert('backend_management', $data);
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
		$this->db->where('ffi_emp_id', $data['backend']['ffi_emp_id']);
		$this->db->update('backend_management', $data['backend']);
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	// public function updateEducation($data)
	// {
	// 	$this->db->where("emp_id",$data['education_certificate']['emp_id']);
	// 	$this->db->delete("education_certificate");
	// 	$explode=explode("|",$data['education_certificate']['path']);
	// 	$length=sizeof($explode);
	// 	for($i=0;$i<$length;$i++)
	// 	{
	// 		$row=trim($explode[$i]);
	// 		$updateData=array(
	// 			"emp_id"	=>	 $data['education_certificate']['emp_id'],
	// 			"path"		=>	 $row,
	// 		);	
	// 	$this->db->insert('education_certificate', $updateData);
	// 	if ($this->db->affected_rows() > 0)
	// 	{
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	// }

	public function updateOther($data)
	{
		$this->db->where("emp_id",$data['other_certificate']['emp_id']);
		$this->db->delete("other_certificate");

		$explode=explode("|",$data['other_certificate']['path']);
		$length=sizeof($explode);
		for($i=0;$i<$length;$i++)
		{
			$row=trim($explode[$i]);
			$updateData=array(
				"emp_id"	=>	 $data['other_certificate']['emp_id'],
				"path"		=>	 $row,
			);	
		$this->db->insert('other_certificate', $updateData);
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	}


	
}
