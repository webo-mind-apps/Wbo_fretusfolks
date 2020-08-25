<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Cms_form_t_db extends CI_Model 
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
	function save_form_t()
	{
		$this->form_validation->set_rules('client', 'Client', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('month', 'Month', 'trim|required');
		$this->form_validation->set_rules('year', 'Year', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('admin/back_end/cms_form_t/new_cms_form_t');
		}
		else
		{
		
			$client=$this->input->post('client',true);
			$state=$this->input->post('state',true);
			$month=$this->input->post('month',true);
			$year=$this->input->post('year',true);
			
			for($i=0;$i<count($_FILES["file"]["name"]);$i++)
			{
				if($_FILES["file"]["size"][$i]>0)
				{
					$gftype=pathinfo($_FILES["file"]['name'][$i], PATHINFO_EXTENSION);
					$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name'][$i]))[1];
					$type = array("gif", "jpg", "png","gif", "jpeg", "pdf","doc");
					if(in_array($rftype, $type))
					{
						$digit=rand(0,999);
						$filen = $digit.$_FILES["file"]['name'][$i]; //file name
						$path = "AKJHJG7665BHJG/cms_form_t/";
						if (!is_dir($path)) mkdir($path, 0777, TRUE);
						$fpath="AKJHJG7665BHJG/cms_form_t/".$filen;										
						if(move_uploaded_file($_FILES["file"]['tmp_name'][$i],$path.$filen)) 
						{
							$month1=$month[$i];
							$year1=$year[$i];
							$data1=array("client_id"=>$client,"state_id"=>$state,"year"=>$year1,"month"=>$month1,"path"=>$fpath);	
							$this->db->insert('cms_form_t',$data1);
						}
					}
				}
			}
		}
	}
	function search_cms_form_t()
	{
		$client=$this->input->post('client');
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('cms_form_t a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state_id=c.id','left');
		if($client !="")
		{
			$this->db->where('a.client_id',$client);
		}
		if($month !="")
		{
			$this->db->where('a.month',$month);
		}
		if($year !="")
		{
			$this->db->where('a.year',$year);
		}
		$this->db->where('a.status','0');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function delete_form_t()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('cms_form_t');
	}
}  
?>
