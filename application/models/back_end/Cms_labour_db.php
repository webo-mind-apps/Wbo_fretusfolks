<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cms_labour_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
		$this->load->library('form_validation');
    }
	function get_all_clients()
	{
		$this->db->where("status","0");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
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
	function save_labour()
	{
		$this->form_validation->set_rules('client', 'Client', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('received_date', 'Received Date', 'trim|required');
		$this->form_validation->set_rules('closure_date', 'Closure Date', 'trim');
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('admin/back_end/cms_labour/new_labour');
		}
		else
		{
		
			$client=$this->input->post('client',true);
			$state=$this->input->post('state',true);
			$location=$this->input->post('location',true);
			$received_date=$this->input->post('received_date',true);
			$closure_date=$this->input->post('closure_date',true);
			$fpath="";
			$fpath1="";
			$status=0;
			if($_FILES["file"]["size"]>0)
			{
				$gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name']))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{
					$digit=rand(0,999);
					$filen = $digit.$_FILES["file"]['name']; //file name
					$path = "AKJHJG7665BHJG/notice_document/".$filen;
					$fpath="AKJHJG7665BHJG/notice_document/".$filen;										
					if(move_uploaded_file($_FILES["file"]['tmp_name'],$path)) 
					{
					}
				}
			}
			if($_FILES["closure_file"]["size"]>0)
			{
				$gftype=pathinfo($_FILES["closure_file"]['name'], PATHINFO_EXTENSION);
				$rftype = explode('/',mime_content_type($_FILES["closure_file"]['tmp_name']))[1];
				$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
				if(in_array($rftype, $type))
				{
					$digit=rand(0,999);
					$filen1 = $digit.$_FILES["closure_file"]['name']; //file name
					$path1 = "AKJHJG7665BHJG/closure_document/".$filen1;
					$fpath1="AKJHJG7665BHJG/closure_document/".$filen1;										
					if(move_uploaded_file($_FILES["closure_file"]['tmp_name'],$path1)) 
					{
					}
				}
			}
			$db_notice_date="";
			$db_closure_date="";
			$db_notice_date=date("Y-m-d",strtotime($received_date));
			if($closure_date !="")
			{
				$db_closure_date=date("Y-m-d",strtotime($closure_date));
			}
			if($closure_date !="" && $_FILES["closure_file"]["size"]>0)
			{
				$status=1;
			}
			$data=array("client_id"=>$client,"state_id"=>$state,"location"=>$location,"notice_received_date"=>$db_notice_date,"notice_document"=>$fpath,"closure_date"=>$db_closure_date,"closure_document"=>$fpath1,"status"=>$status);
			$this->db->insert('cms_labour',$data);
		}
	}
	function update_labour()
	{
		$id=$this->uri->segment(3);
		
		$this->db->where('id',$id);
		$query=$this->db->get('cms_labour');
		$q=$query->result_array();
		$notice_path=$q[0]['notice_document'];
		$closure_path=$q[0]['closure_document'];
		
		$this->form_validation->set_rules('client', 'Client', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('received_date', 'Received Date', 'trim|required');
		$this->form_validation->set_rules('closure_date', 'Closure Date', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('admin/back_end/cms_labour/edit_labour');
		}
		else
		{
		
			$client=$this->input->post('client',true);
			$state=$this->input->post('state',true);
			$location=$this->input->post('location',true);
			$received_date=$this->input->post('received_date',true);
			$closure_date=$this->input->post('closure_date',true);
			
			$status=0;
			if($_FILES["file"]["size"]>0)
				{
					$gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
					$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name']))[1];
					$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
					if(in_array($rftype, $type))
					{
						$digit=rand(0,999);
						$filen = $digit.$_FILES["file"]['name']; //file name
						$path = "AKJHJG7665BHJG/notice_document/".$filen;
						$notice_path="AKJHJG7665BHJG/notice_document/".$filen;										
						if(move_uploaded_file($_FILES["file"]['tmp_name'],$path)) 
						{
						}
					}
				}
				if($_FILES["closure_file"]["size"]>0)
				{
					$gftype=pathinfo($_FILES["closure_file"]['name'], PATHINFO_EXTENSION);
					$rftype = explode('/',mime_content_type($_FILES["closure_file"]['tmp_name']))[1];
					$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
					if(in_array($rftype, $type))
					{
						$digit=rand(0,999);
						$filen1 = $digit.$_FILES["closure_file"]['name']; //file name
						$path1 = "AKJHJG7665BHJG/closure_document/".$filen1;
						$closure_path="AKJHJG7665BHJG/closure_document/".$filen1;										
						if(move_uploaded_file($_FILES["closure_file"]['tmp_name'],$path1)) 
						{
						}
					}
				}
				$db_notice_date="";
				$db_closure_date="";
				$db_notice_date=date("Y-m-d",strtotime($received_date));
				if($closure_date !="")
				{
					$db_closure_date=date("Y-m-d",strtotime($closure_date));
				}
				if($closure_date !="" && $_FILES["closure_file"]["size"]>0)
				{
					$status=1;
				}
				$data=array("client_id"=>$client,"state_id"=>$state,"location"=>$location,"notice_received_date"=>$db_notice_date,"notice_document"=>$notice_path,"closure_date"=>$db_closure_date,"closure_document"=>$closure_path,"status"=>$status);
			
			$this->db->where('id',$id);
			$this->db->update('cms_labour',$data);
		}
		
	}
	function search_cms_labour()
	{
		$client=$this->input->post('client');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('cms_labour a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state_id=c.id','left');
		if($client !="")
		{
			$this->db->where('a.client_id',$client);
		}
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_cms_labour_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('cms_labour');
		$q=$query->result_array();
		return $q;
	}
	function delete_cms_labour()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('cms_labour');
	}
}  
?>
