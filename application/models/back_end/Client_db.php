<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Client_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function save_client()
	{
		$client=$this->input->post('client');
		$land_line=$this->input->post('land_line');
		$client_email=$this->input->post('client_email');
		$contact_person=$this->input->post('contact_person');
		$contact_person_mobile=$this->input->post('contact_person_mobile');
		$contact_person_email=$this->input->post('contact_person_email');
		$registered_address=$this->input->post('registered_address');
		$communication_address=$this->input->post('communication_address');
		$pan_no=$this->input->post('pan_no');
		$tan_no=$this->input->post('tan_no');
		
		$website=$this->input->post('website');
		$agreement_mode=$this->input->post('agreement_mode');
		$agreement_type=$this->input->post('agreement_type');
		$other_agreement=$this->input->post('other_agreement');
		$region=$this->input->post('region');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$rate=$this->input->post('rate');
		$commercial_type=$this->input->post('commercial_type');
		$remark=$this->input->post('remark');
		
		$state_service=$this->input->post('state_service');
		
		$client_code=$this->input->post('client_code');
		$contact_person_comm=$this->input->post('contact_person_comm');
		$contact_person_phone_comm=$this->input->post('contact_person_phone_comm');
		$contact_person_email_comm=$this->input->post('contact_person_email_comm');
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		
		$db_start_date="";
		$db_end_date="";
		$path="";
		
		$gstn=$this->input->post('gstn');
		$state=$this->input->post('state');
		
		if($start_date !="")
		{
			$db_start_date=date("Y-m-d",strtotime($start_date));	
		}
		if($end_date !="")
		{
			$db_end_date=date("Y-m-d",strtotime($end_date));	
		}
		if (!empty($_FILES['file']['name']))
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
            $config['upload_path'] = 'uploads/agreement_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);

            if ($this->upload->do_upload('file'))
            {
				$path="uploads/agreement_doc/".$new_name;
			}
		}
		$data=array(
					"client_code"=>$client_code,
					"client_name"=>$client,
					"land_line"=>$land_line,
					"client_email"=>$client_email,
					"contact_person"=>$contact_person,
					"contact_person_phone"=>$contact_person_mobile,
					"contact_person_email"=>$contact_person_email,
					"contact_name_comm"=>$contact_person_comm,
					"contact_phone_comm"=>$contact_person_phone_comm,
					"contact_email_comm"=>$contact_person_email_comm,
					"registered_address"=>$registered_address,
					"communication_address"=>$communication_address,
					"pan"=>$pan_no,
					"tan"=>$tan_no,
					"website_url"=>$website,
					"mode_agreement"=>$agreement_mode,
					"agreement_type"=>$agreement_type,
					"other_agreement"=>$other_agreement,
					"agreement_doc"=>$path,
					"region"=>$region,
					"service_state"=>$state_service,
					"contract_start"=>$db_start_date,
					"contract_end"=>$db_end_date,
					"rate"=>$rate,
					"commercial_type"=>$commercial_type,
					"remark"=>$remark,
					"status"=>'0',
					"modify_by"=>$user,
					"modify_date"=>$db_create
			);
		$this->db->insert("client_management",$data);
		$client_id=$this->db->insert_id();
		for($i=0;$i<count($gstn);$i++)
		{
			$gst_no=$gstn[$i];
			$state_id=$state[$i];
			
			$data1=array("client_id"=>$client_id,"state"=>$state_id,"gstn_no"=>$gst_no);
			$this->db->insert("client_gstn",$data1);
		}
	}
	function update_client()
	{
		$id=$this->uri->segment(3);
		
		$client=$this->input->post('client');
		$land_line=$this->input->post('land_line');
		$client_email=$this->input->post('client_email');
		$contact_person=$this->input->post('contact_person');
		$contact_person_mobile=$this->input->post('contact_person_mobile');
		$contact_person_email=$this->input->post('contact_person_email');
		$registered_address=$this->input->post('registered_address');
		$communication_address=$this->input->post('communication_address');
		$pan_no=$this->input->post('pan_no');
		$tan_no=$this->input->post('tan_no');
		
		$website=$this->input->post('website');
		$agreement_mode=$this->input->post('agreement_mode');
		$agreement_type=$this->input->post('agreement_type');
		$other_agreement=$this->input->post('other_agreement');
		$region=$this->input->post('region');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$rate=$this->input->post('rate');
		$commercial_type=$this->input->post('commercial_type');
		$remark=$this->input->post('remark');
		
		$active_status=$this->input->post('active');
		
		$state_service=$this->input->post('state_service');
		
		$client_code=$this->input->post('client_code');
		$contact_person_comm=$this->input->post('contact_person_comm');
		$contact_person_phone_comm=$this->input->post('contact_person_phone_comm');
		$contact_person_email_comm=$this->input->post('contact_person_email_comm');
		
		$user=$this->session->userdata('admin_id');
		$db_create=date("Y-m-d H:i:s");
		$db_start_date="";
		$db_end_date="";
		
		$path="";
		
		if($start_date !="")
		{
			$db_start_date=date("Y-m-d",strtotime($start_date));	
		}
		if($end_date !="")
		{
			$db_end_date=date("Y-m-d",strtotime($end_date));	
		}
		
		if (!empty($_FILES['file']['name']))
        {
			
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
            $config['upload_path'] = 'uploads/agreement_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);

            if ($this->upload->do_upload('file'))
            {
				$path="uploads/agreement_doc/".$new_name;
			}
			
			$data=array(
					"client_code"=>$client_code,
					"client_name"=>$client,
					"land_line"=>$land_line,
					"client_email"=>$client_email,
					"contact_person"=>$contact_person,
					"contact_person_phone"=>$contact_person_mobile,
					"contact_person_email"=>$contact_person_email,
					"contact_name_comm"=>$contact_person_comm,
					"contact_phone_comm"=>$contact_person_phone_comm,
					"contact_email_comm"=>$contact_person_email_comm,
					"registered_address"=>$registered_address,
					"communication_address"=>$communication_address,
					"pan"=>$pan_no,
					"tan"=>$tan_no,
					"website_url"=>$website,
					"mode_agreement"=>$agreement_mode,
					"agreement_type"=>$agreement_type,
					"other_agreement"=>$other_agreement,
					"agreement_doc"=>$path,
					"region"=>$region,
					"service_state"=>$state_service,
					"contract_start"=>$db_start_date,
					"contract_end"=>$db_end_date,
					"rate"=>$rate,
					"commercial_type"=>$commercial_type,
					"remark"=>$remark,
					"status"=>'0',
					"modify_by"=>$user,
					"modify_date"=>$db_create,
					"active_status"=>$active_status);
		}
		else
		{
			$data=array(
					"client_code"=>$client_code,
					"client_name"=>$client,
					"land_line"=>$land_line,
					"client_email"=>$client_email,
					"contact_person"=>$contact_person,
					"contact_person_phone"=>$contact_person_mobile,
					"contact_person_email"=>$contact_person_email,
					"contact_name_comm"=>$contact_person_comm,
					"contact_phone_comm"=>$contact_person_phone_comm,
					"contact_email_comm"=>$contact_person_email_comm,
					"registered_address"=>$registered_address,
					"communication_address"=>$communication_address,
					"pan"=>$pan_no,
					"tan"=>$tan_no,
					"website_url"=>$website,
					"mode_agreement"=>$agreement_mode,
					"agreement_type"=>$agreement_type,
					"other_agreement"=>$other_agreement,
					"region"=>$region,
					"service_state"=>$state_service,
					"contract_start"=>$db_start_date,
					"contract_end"=>$db_end_date,
					"rate"=>$rate,
					"commercial_type"=>$commercial_type,
					"remark"=>$remark,
					"status"=>'0',
					"modify_by"=>$user,
					"modify_date"=>$db_create,
					"active_status"=>$active_status);
		}
		$this->db->where('id',$id);
		$this->db->update("client_management",$data);	
	}
	function get_all_clients()
	{
		$this->db->where("status","0");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
		$q=$query->result_array();
		return $q;
	}
	function get_client_details($id)
	{
		$this->db->select("a.*,b.state_name,c.name as username");
		$this->db->from("client_management a");
		$this->db->join("states b","a.service_state=b.id","left");
		$this->db->join("muser_master c","a.modify_by=c.id","left");
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_client_gst($id)
	{
		$this->db->select("a.*,b.state_name");
		$this->db->from("client_gstn a");
		$this->db->join("states b","a.state=b.id","left");
		$this->db->where('a.client_id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_client_gst_download($id)
	{
		$this->db->select("a.*,b.state_name");
		$this->db->from("client_gstn a");
		$this->db->join("states b","a.state=b.id","left");
		$this->db->where('a.client_id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_all_states()
	{
		$this->db->order_by('state_name','ASC');
		$query=$this->db->get("states");
		$q=$query->result_array();
		return $q;
	}
	function add_client_gst()
	{
		$id=$this->uri->segment(3);
		$state=$this->input->post('state');
		$gstn=$this->input->post('gstn');
		
		$data1=array("client_id"=>$id,"state"=>$state,"gstn_no"=>$gstn);
		$this->db->insert("client_gstn",$data1);
	}
	function update_client_gst_details()
	{
		$id=$this->input->post('id');
		$gst_no=$this->input->post('gst_no');
		$state=$this->input->post('state');
		
		$data1=array("state"=>$state,"gstn_no"=>$gst_no);
		$this->db->where('id',$id);
		$this->db->update('client_gstn',$data1);
	}
	function delete_client_gst_no()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('client_gstn');
	}
	function get_all_client_description()
	{
		$this->db->select('a.*,b.client_name');
		$this->db->from('client_content a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_client_description()
	{
		$id=$this->uri->segment(3);
		
		$this->db->where('id',$id);
		$query=$this->db->get('client_content');
		$q=$query->result_array();
		return $q;
	}
	function save_client_description()
	{
		$client_id=$this->input->post('client');
		$description=$this->input->post('description');
		
		$data=array("client_id"=>$client_id,"description"=>$description);
		
		$this->db->insert('client_content',$data);
		
	}
	function update_client_description()
	{
		$id=$this->uri->segment(3);
		
		$client_id=$this->input->post('client');
		$description=$this->input->post('description');
		
		$data=array("client_id"=>$client_id,"description"=>$description);
		
		$this->db->where('id',$id);
		$this->db->update('client_content',$data);
	}
	function delete_descriptions()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('client_content');
	}
	function delete_clients()
	{
		$id=$this->input->post('id');
		$data=array("status"=>"2");
		$this->db->where('id',$id);
		$this->db->update('client_management',$data);
	}
}  
?>