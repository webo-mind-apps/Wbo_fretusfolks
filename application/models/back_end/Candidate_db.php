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
		$client=$this->input->post('client');
		$emp_name=$this->input->post('emp_name');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		$aadhar_no=$this->input->post('aadhar_no');
		$driving_license=$this->input->post('driving_license');
		
		$designation=$this->input->post('designation');
		$department=$this->input->post('department');
		
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
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config['upload_path'] = 'uploads/aadhar_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path="uploads/aadhar_doc/".$new_name;
			}
		}
		if (!empty($_FILES['file_license']['name']))
        {
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config1['upload_path'] = 'uploads/license_doc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if($this->upload->do_upload('file_license'))
            {
				$license_path="uploads/license_doc/".$new_name1;
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config2['upload_path'] = 'uploads/photo/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if($this->upload->do_upload('photo'))
            {
				$photo="uploads/photo/".$new_name2;
			}
		}
		if (!empty($_FILES['resume']['name']))
        {
			$rand_no=date("is");
			$new_name3 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["resume"]['name']));
            $config3['upload_path'] = 'uploads/resume/';
            $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config3['file_name'] = $new_name3;	
			$this->load->library('upload',$config3);
			$this->upload->initialize($config3);
            if($this->upload->do_upload('resume'))
            {
				$resume="uploads/resume/".$new_name3;
			}
		}
		$data=array(
			"client_id"=>$client,"emp_name"=>$emp_name,"interview_date"=>$db_interview_date,"joining_date"=>$db_joining_date,"designation"=>$designation,"department"=>$department,"state"=>$state,"location"=>$location,"phone1"=>$phone, "email"=>$email,"aadhar_no"=>$aadhar_no, "aadhar_path"=>$aadhar_path, "driving_license_no"=>$driving_license, "driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"modify_by"=>$user, "created_at"=>$db_date,"created_by"=>$user);
			
			$this->db->insert('backend_management',$data);
	}
	function update_candidate()
	{
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
		
		$client=$this->input->post('client');
		$emp_name=$this->input->post('emp_name');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$interview_date=$this->input->post('interview_date');
		$joining_date=$this->input->post('joining_date');
		
		$aadhar_no=$this->input->post('aadhar_no');
		$driving_license=$this->input->post('driving_license');
		
		$designation=$this->input->post('designation');
		$department=$this->input->post('department');
		
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
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_aadhar"]['name']));
            $config['upload_path'] = 'uploads/aadhar_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file_aadhar'))
            {
				$aadhar_path="uploads/aadhar_doc/".$new_name;
				
			}
		}
		if (!empty($_FILES['file_license']['name']))
        {
			$rand_no=date("is");
			$new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file_license"]['name']));
            $config1['upload_path'] = 'uploads/license_doc/';
            $config1['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config1['file_name'] = $new_name1;	
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if($this->upload->do_upload('file_license'))
            {
				$license_path="uploads/license_doc/".$new_name1;
			}
		}
		if (!empty($_FILES['photo']['name']))
        {
			$rand_no=date("is");
			$new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["photo"]['name']));
            $config2['upload_path'] = 'uploads/photo/';
            $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config2['file_name'] = $new_name2;	
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if($this->upload->do_upload('photo'))
            {
				$photo="uploads/photo/".$new_name2;
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
		$data=array(
			"client_id"=>$client,"emp_name"=>$emp_name,"interview_date"=>$db_interview_date,"joining_date"=>$db_joining_date,"designation"=>$designation,"department"=>$department,"state"=>$state,"location"=>$location,"phone1"=>$phone, "email"=>$email,"aadhar_no"=>$aadhar_no,"aadhar_path"=>$aadhar_path,"driving_license_no"=>$driving_license,"driving_license_path"=>$license_path,"photo"=>$photo,"resume"=>$resume,"modify_by"=>$user,"modified_date"=>$db_create);
			
			$this->db->where('id',$id);
			$this->db->update('backend_management',$data);
	}
	function delete_candidate()
	{
		$id=$this->input->post('id');
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