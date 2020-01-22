<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Letter_content_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_letter_content()
	{
		$this->db->order_by('id','ASC');
		$query=$this->db->get('letter_content');
		$q=$query->result_array();
		return $q;
	}
	function get_letter_content()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('letter_content');
		$q=$query->result_array();
		return $q;
	}
	function save_letter()
	{
		$content=$this->input->post('content');
		
		$data=array("content"=>$content);
		$this->db->insert("letter_content",$data);
	}
	function update_letter()
	{
		$id=$this->uri->segment(3);
		$content=$this->input->post('content');
		
		$data=array("content"=>$content);
		$this->db->where('id',$id);
		$this->db->update('letter_content',$data);
	}
	
}  
?>