<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Bulk_update_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
    public function make_query()
	{
        $order_column = array("a.id", "client_name", "ffi_emp_id", "emp_name");  
        $this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('emp_name!=','');
		$this->db->where("a.status","1");
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("client_name", $_POST["search"]["value"]);  
                $this->db->or_like("ffi_emp_id", $_POST["search"]["value"]);  
                $this->db->or_like("emp_name", $_POST["search"]["value"]); 
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

	function inactive_update($id,$status) //For making inactive
	{
		$this->db->where('id',$id);
		$this->db->update('backend_management',array('status'=>$status));
	}

	function active_update($id,$status) //For making active
	{
		$this->db->where('id',$id);
		$this->db->update('backend_management',array('status'=>$status));
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
	function get_all_clients()
	{
		$this->db->where("status","0");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
		$q=$query->result_array();
		return $q;
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
	// excel import
	public function importEmployee($data = null)
	{
		$data1= array(
			"contract_date"			=> $data['bulk_inactive']['contract_date'],
			"status"				=> 1,
			// 'modified_date'			=>	date('Y-m-d H:i:s')
		);
		if(!empty($data['bulk_inactive']['ffi_emp_id']) || $data['bulk_inactive']['ffi_emp_id']!=''){
		$this->db->where('ffi_emp_id', $data['bulk_inactive']['ffi_emp_id']);
		
		}
		if(!empty($data['bulk_inactive']['emp_name']) || $data['bulk_inactive']['emp_name']!=''){
		$this->db->where('emp_name', $data['bulk_inactive']['emp_name']);
		}
		
		$query = $this->db->get("backend_management");
		if ($query->num_rows() > 0)
		{
			if(!empty($data['bulk_inactive']['ffi_emp_id']) || $data['bulk_inactive']['ffi_emp_id']!=''){
				$this->db->where('ffi_emp_id', $data['bulk_inactive']['ffi_emp_id']);
				}
				
				if(!empty($data['bulk_inactive']['emp_name']) || $data['bulk_inactive']['emp_name']!=''){
				$this->db->where('emp_name', $data['bulk_inactive']['emp_name']);
				}
			$this->db->update('backend_management', $data1);
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
public function get_all_bulk_update_for_download()
	{
		$client=$this->input->post('bulk_inactive_client', true); 
		//$status=$this->input->post('emp_status', true); 
		$date_of_leaving=$this->input->post('date_of_leaving', true); 
		$date = date("Y-m-d", strtotime($from));
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('backend_management a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state=c.id','left');
		$this->db->where('emp_name!=','');
		$this->db->where("a.status","1");
		if (!empty($client)) {
			$this->db->where("a.client_id",$client);
			}
		
		// if (!empty($status)) {
		// 	$this->db->where("a.status",$status);
		// 	}
		if (!empty($date_of_leaving)) {
		$this->db->where("a.contract_date >=",$date);
		}
		
		$query=$this->db->get();
		$q=$query->result_array();
	
		return $q;
	}
	public function get_education_details($emp_id)
	{
		$this->db->select("*");
		$this->db->from("education_certificate");
		$this->db->where('emp_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	public function get_other_certificate_details($emp_id)
	{
		$this->db->select("*");
		$this->db->from("other_certificate");
		$this->db->where('emp_id',$emp_id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
}  
?>