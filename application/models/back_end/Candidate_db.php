<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Candidate_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_candidate_info()
	{
		$admin_id=$this->session->userdata('admin_id');
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where("a.status","0");
		$this->db->where("a.created_by",$admin_id);
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}

	public function make_query()
	{ 
        $order_column = array("a.id", "client_name","emp_name", "joining_date", "phone1","dcs_approval","data_status");  
		$admin_id=$this->session->userdata('admin_id');
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where("a.status","0");
		$this->db->where("a.created_by",$admin_id);
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("client_name", $_POST["search"]["value"]);   
                $this->db->or_like("emp_name", $_POST["search"]["value"]);
				$this->db->or_like("joining_date", $_POST["search"]["value"]);
				$this->db->or_like("phone1", $_POST["search"]["value"]); 
				$this->db->or_like("dcs_approval", $_POST["search"]["value"]); 
                $this->db->or_like("data_status", $_POST["search"]["value"]); 
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
			return True; 
		}
		// redirect("Backend_team/get_all_data");
		// redirect("Backend_team/");
		// $this->db->update("backend_management",$data);
		
	}

	function get_candidate_details($id)
	{
		$this->db->select('a.*,b.client_name,c.state_name,d.name as username');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->join('muser_master d','a.created_by=d.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	public function save_candidate()
	{
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
		$client=$this->input->post('client', true);
		$emp_name=$this->input->post('emp_name', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('location', true);
		$phone=$this->input->post('phone', true);
		$email=$this->input->post('email', true);
		$interview_date=$this->input->post('interview_date', true);
		$joining_date=$this->input->post('joining_date', true);
		$aadhar_no=$this->input->post('aadhar_no', true);
		$driving_license=$this->input->post('driving_license', true);
		
		$designation=$this->input->post('designation', true);
		$department=$this->input->post('department', true);
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		$db_date=date("Y-m-d");
				
		$db_interview_date="";
		$db_joining_date="";
		
		if($interview_date !="")
		{
			$db_interview_date=date("Y-m-d",strtotime($interview_date));	
		}
		if($joining_date !="")
		{
			$db_joining_date=date("Y-m-d",strtotime($joining_date));	
		}
		$aadhar_path="";
		$license_path="";
		$resume="";
		$photo="";
		
		if ($_FILES['file_aadhar']['size']>1)
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
		if (!empty($_FILES['file_license']['name']))
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
		$data=array(
			"client_id"=>$client,"emp_name"=>$emp_name,"interview_date"=>$db_interview_date,"joining_date"=>$db_joining_date,"designation"=>$designation,"department"=>$department,"state"=>$state,"location"=>$location,"phone1"=>$phone, "email"=>$email,"aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"modify_by"=>$user, "created_at"=>$db_date,"created_by"=>$user);
			
			$this->db->insert('backend_management',$data);
			return $this->db->affected_rows() > 0 ? "true" : "something went wrong!";
	}
	function update_candidate()
	{
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
		$id=$this->uri->segment(3);
		
		$this->db->select("aadhar_path,driving_license_path,photo,resume");
		$this->db->from("backend_management");
		$this->db->where('id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		
		$aadhar_path=$q[0]['aadhar_path'];
		$license_path=$q[0]['driving_license_path'];
		$photo=$q[0]['photo'];
		$resume=$q[0]['resume'];
		
		$client=$this->input->post('client', true);
		$emp_name=$this->input->post('emp_name', true);
		$state=$this->input->post('state', true);
		$location=$this->input->post('location', true);
		$phone=$this->input->post('phone', true);
		$email=$this->input->post('email', true);
		$interview_date=$this->input->post('interview_date', true);
		$joining_date=$this->input->post('joining_date', true);
		
		$aadhar_no=$this->input->post('aadhar_no', true);
		$driving_license=$this->input->post('driving_license', true);
		
		$designation=$this->input->post('designation', true);
		$department=$this->input->post('department', true);
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		$db_date=date("Y-m-d");
				
		$db_interview_date="";
		$db_joining_date="";
		
		if($interview_date !="")
		{
			$db_interview_date=date("Y-m-d",strtotime($interview_date));	
		}
		if($joining_date !="")
		{
			$db_joining_date=date("Y-m-d",strtotime($joining_date));	
		}
		
		if ($_FILES['file_aadhar']['size']>1)
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
		if (!empty($_FILES['file_license']['name']))
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
		$data=array(
			"client_id"=>$client,"emp_name"=>$emp_name,"interview_date"=>$db_interview_date,"joining_date"=>$db_joining_date,"designation"=>$designation,"department"=>$department,"state"=>$state,"location"=>$location,"phone1"=>$phone, "email"=>$email,"aadhar_no"=>$aadhar_no,"aadhar_path"=>$aadhar_path,"driving_license_no"=>$driving_license,"driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"modify_by"=>$user,"modified_date"=>$db_create);
			
			$this->db->where('id',$id);
			$this->db->update('backend_management',$data);
			return $this->db->affected_rows() > 0 ? "true" : "something went wrong!";
	}
	function delete_candidate()
	{
		$id=$this->input->post('id',  true);
		$data=array("status"=>"2");
		$this->db->where("id",$id);
		$this->db->update("backend_management",$data);
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
}  
?>
