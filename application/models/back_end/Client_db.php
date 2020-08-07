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
	function get_all_clients()
	{
		$this->db->where("status",0);
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
		$q=$query->result_array();
		return $q;
	}
	
	public function make_query()
	{ 
		$order_column = array("id", "client_name","contact_person", "contact_person_phone", "contact_person_email"); 
		$this->db->select("*");
		$this->db->from("client_management"); 
		$this->db->where("status",0);
		
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("id", $_POST["search"]["value"]);  
                $this->db->or_like("client_name", $_POST["search"]["value"]);   
				$this->db->or_like("contact_person", $_POST["search"]["value"]);
				$this->db->or_like("contact_person_phone", $_POST["search"]["value"]);
				$this->db->or_like("contact_person_email", $_POST["search"]["value"]);
				
            $this->db->group_end();
		}
		if(isset($_POST["order"]))  
        {  
             $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
             $this->db->order_by('id', 'DESC');  
        }  	
	}

	function get_all_data()  
    {  
           $this->db->select("*");
           $this->db->from('client_management');  
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
	public function save_client()
	{
		$client=$this->input->post('client', true);
		$land_line=$this->input->post('land_line', true);
		$client_email=$this->input->post('client_email', true);
		$contact_person=$this->input->post('contact_person', true);
		$contact_person_mobile=$this->input->post('contact_person_mobile', true);
		$contact_person_email=$this->input->post('contact_person_email', true);
		$registered_address=$this->input->post('registered_address', true);
		$communication_address=$this->input->post('communication_address', true);
		$pan_no=$this->input->post('pan_no', true);
		$tan_no=$this->input->post('tan_no', true);
		
		$website=$this->input->post('website', true);
		$agreement_mode=$this->input->post('agreement_mode', true);
		$agreement_type=$this->input->post('agreement_type', true);
		$other_agreement=$this->input->post('other_agreement', true);
		$region=$this->input->post('region', true);
		$start_date=$this->input->post('start_date', true);
		$end_date=$this->input->post('end_date', true);
		$rate=$this->input->post('rate', true);
		$commercial_type=$this->input->post('commercial_type', true);
		$remark=$this->input->post('remark', true);
		
		$state_service=$this->input->post('state_service', true);
		
		$client_code=$this->input->post('client_code', true);
		$contact_person_comm=$this->input->post('contact_person_comm', true);
		$contact_person_phone_comm=$this->input->post('contact_person_phone_comm', true);
		$contact_person_email_comm=$this->input->post('contact_person_email_comm', true);
		
		$user=$this->session->userdata('admin_id', true);
		$db_create=date("Y-m-d H:i:s");
		
		$db_start_date="";
		$db_end_date="";
		$path="";
		
		$gstn=$this->input->post('gstn', true);
		$state=$this->input->post('state', true);
		
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
            $gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
			$upload_path='AKJHJG7665BHJG/agreement_doc/';
			if (!is_dir($upload_path)) mkdir($upload_path, 0777, TRUE);
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);

            if ($this->upload->do_upload('file'))
            {
				$path="AKJHJG7665BHJG/agreement_doc/".$new_name;
			}
			}else{
			return "Mime error upload the correct format file!";
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
		$not_insert_count=0;
		for($i=0;$i<count($gstn);$i++)
		{
			$gst_no=$gstn[$i];
			$state_id=$state[$i];
			
			$data1=array("client_id"=>$client_id,"state"=>$state_id,"gstn_no"=>$gst_no);
			if($this->db->insert("client_gstn",$data1))
			{
				
			}
			else{
				$not_insert_count=$not_insert_count+1;
			}
		}
		if($not_insert_count<=0){
			return "true";
		}
		else{
			return "Something went wrong try again!";
		}
	}
	function update_client()
	{
		$id=$this->uri->segment(3);
		
		$client=$this->input->post('client', true);
		$land_line=$this->input->post('land_line', true);
		$client_email=$this->input->post('client_email', true);
		$contact_person=$this->input->post('contact_person', true);
		$contact_person_mobile=$this->input->post('contact_person_mobile', true);
		$contact_person_email=$this->input->post('contact_person_email', true);
		$registered_address=$this->input->post('registered_address', true);
		$communication_address=$this->input->post('communication_address', true);
		$pan_no=$this->input->post('pan_no', true);
		$tan_no=$this->input->post('tan_no', true);
		
		$website=$this->input->post('website', true);
		$agreement_mode=$this->input->post('agreement_mode', true);
		$agreement_type=$this->input->post('agreement_type', true);
		$other_agreement=$this->input->post('other_agreement', true);
		$region=$this->input->post('region', true);
		$start_date=$this->input->post('start_date', true);
		$end_date=$this->input->post('end_date', true);
		$rate=$this->input->post('rate', true);
		$commercial_type=$this->input->post('commercial_type', true);
		$remark=$this->input->post('remark', true);
		
		$active_status=$this->input->post('active', true);
		
		$state_service=$this->input->post('state_service', true);
		
		$client_code=$this->input->post('client_code', true);
		$contact_person_comm=$this->input->post('contact_person_comm', true);
		$contact_person_phone_comm=$this->input->post('contact_person_phone_comm', true);
		$contact_person_email_comm=$this->input->post('contact_person_email_comm', true);
		
		$user=$this->session->userdata('admin_id', true);
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
			$gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
			$upload_path='AKJHJG7665BHJG/agreement_doc/';
			if (!is_dir($upload_path)) mkdir($upload_path, 0777, TRUE);
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);

            if ($this->upload->do_upload('file'))
            {
				$path="AKJHJG7665BHJG/agreement_doc/".$new_name;
			}
			}
			else{
				return "Mime error upload the correct format file!";
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
		return $this->db->affected_rows() > 0 ? "true" : "something went wrong!";
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
		$state=$this->input->post('state', true);
		$gstn=$this->input->post('gstn', true);
		
		$data1=array("client_id"=>$id,"state"=>$state,"gstn_no"=>$gstn);
		$this->db->insert("client_gstn",$data1);
	}
	function update_client_gst_details()
	{
		$id=$this->input->post('id', true);
		$gst_no=$this->input->post('gst_no', true);
		$state=$this->input->post('state', true);
		
		$data1=array("state"=>$state,"gstn_no"=>$gst_no);
		$this->db->where('id',$id);
		$this->db->update('client_gstn',$data1);
	}
	function delete_client_gst_no()
	{
		$id=$this->input->post('id', true);
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
		$client_id=$this->input->post('client', true);
		$description=$this->input->post('description', true);
		
		$data=array("client_id"=>$client_id,"description"=>$description);
		
		$this->db->insert('client_content',$data);
		
	}
	function update_client_description()
	{
		$id=$this->uri->segment(3);
		
		$client_id=$this->input->post('client', true);
		$description=$this->input->post('description', true);
		
		$data=array("client_id"=>$client_id,"description"=>$description);
		
		$this->db->where('id',$id);
		$this->db->update('client_content',$data);
	}
	function delete_descriptions()
	{
		$id=$this->input->post('id', true);
		$this->db->where('id',$id);
		$this->db->delete('client_content');
	}
	function delete_clients()
	{
		$id=$this->input->post('id', true);
		$data=array("status"=>"2");
		$this->db->where('id',$id);
		$this->db->update('client_management',$data);
	}
}  
?>
