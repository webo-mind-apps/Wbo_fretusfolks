<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cms_labour_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
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
		$client=$this->input->post('client');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$received_date=$this->input->post('received_date');
		$closure_date=$this->input->post('closure_date');
		$fpath="";
		$fpath1="";
		$status=0;
			if($_FILES["file"]["size"]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["file"]['name']; //file name
				$path = "uploads/notice_document/".$filen;
				$fpath="uploads/notice_document/".$filen;										
				if(move_uploaded_file($_FILES["file"]['tmp_name'],$path)) 
				{
				}
			}
			if($_FILES["closure_file"]["size"]>0)
			{
				$digit=rand(0,999);
				$filen1 = $digit.$_FILES["closure_file"]['name']; //file name
				$path1 = "uploads/closure_document/".$filen1;
				$fpath1="uploads/closure_document/".$filen1;										
				if(move_uploaded_file($_FILES["closure_file"]['tmp_name'],$path1)) 
				{
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
	function update_labour()
	{
		$id=$this->uri->segment(3);
		
		$this->db->where('id',$id);
		$query=$this->db->get('cms_labour');
		$q=$query->result_array();
		$notice_path=$q[0]['notice_document'];
		$closure_path=$q[0]['closure_document'];
		
		$client=$this->input->post('client');
		$state=$this->input->post('state');
		$location=$this->input->post('location');
		$received_date=$this->input->post('received_date');
		$closure_date=$this->input->post('closure_date');
		
		$status=0;
		if($_FILES["file"]["size"]>0)
			{
				$digit=rand(0,999);
				$filen = $digit.$_FILES["file"]['name']; //file name
				$path = "uploads/notice_document/".$filen;
				$notice_path="uploads/notice_document/".$filen;										
				if(move_uploaded_file($_FILES["file"]['tmp_name'],$path)) 
				{
				}
			}
			if($_FILES["closure_file"]["size"]>0)
			{
				$digit=rand(0,999);
				$filen1 = $digit.$_FILES["closure_file"]['name']; //file name
				$path1 = "uploads/closure_document/".$filen1;
				$closure_path="uploads/closure_document/".$filen1;										
				if(move_uploaded_file($_FILES["closure_file"]['tmp_name'],$path1)) 
				{
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