<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class User_master_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }

	function get_all_user_master()
	{
		$this->db->order_by('id','DESC');
		$query=$this->db->get("muser_master");
		$q=$query->result_array();
		return $q;
	}
	function save_user_master()
	{
		$username=$this->input->post('username');
		$emp_id=$this->input->post('emp_id');
		$name=$this->input->post('name');
		$password=$this->input->post('password');
		$enc_pass=md5($this->input->post('password'));
		$user_type=$this->input->post('userType');
		$status=$this->input->post('status');
		$db_date=date("Y-m-d");
		$data=array("name"=>$name,"emp_id"=>$emp_id,"user_type"=>$user_type,"username"=>$username,"password"=>$password,"enc_pass"=>$enc_pass,"status"=>$status,"date"=>$db_date);
		$this->db->insert("muser_master",$data);
		
	}
	function change_status()
	{		
		$id=$_POST['id'];
		$status=$_POST['value'];
		$data=array("status"=>$status);	
		$this->db->where('id',$id);
		$this->db->update('muser_master',$data);
	}
	function get_user_master_details($id)
	{
		$this->db->select('a.*');
		$this->db->from('muser_master a');		
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();	
		return $q;
	}
	function update_user_master()
	{	
		$id=$this->uri->segment(3); 
		$user_type=$this->input->post('userType');
		$emp_id=$this->input->post('emp_id');
		$name=$this->input->post('name');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$enc_pass=md5($password);
		$status=$this->input->post('status');
		$db_date=date("Y-m-d");
		$data=array("name"=>$name,"emp_id"=>$emp_id,"user_type"=>$user_type,"username"=>$username,"password"=>$password,"enc_pass"=>$enc_pass,"status"=>$status,"date"=>$db_date);
		$this->db->where('id',$id);
		$this->db->update("muser_master",$data);
	}
	function delete_user_master()
	{		
	  	$id=$_POST['id'];			
		 $this->db->where('id',$id);
		 $this->db->delete('muser_master');
	}
}  
?>