<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Licensing_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function make_query($folder_id=null)
	{
	 
        $order_column = array("file_name,client_name,id");  
        $this->db->select('a.file_name,a.id,a.file_name,b.client_name');
		$this->db->from('client_upload_files a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->where('a.folder_id',$folder_id);
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.file_name", $_POST["search"]["value"]);  
                $this->db->or_like("b.client_name", $_POST["search"]["value"]);  
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

	function get_all_data($folder_id=null)  
    {  
    	$this->db->select("*");
		$this->db->from('client_upload_files');  
		$this->db->where('folder_id',$folder_id);
    	return $this->db->count_all_results();  
	}
	
	function get_filtered_data($folder_id=null){  
		$this->make_query($folder_id);  
		$query = $this->db->get();  
		return $query->num_rows();  
	} 

	function make_datatables($folder_id=null){  
        $this->make_query($folder_id);   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();  
    }
	
	

	function all_company()
	{
		return $this->db->select('id,client_name')->get('client_management')->result_array();
	}

	function save_folder($data=null)
	{
		$this->db->insert('client_folder',$data);
		return $this->db->affected_rows() > 0 ? true:false;
	}
	function get_folder($company=null)
	{
		return $this->db->select('id,folder_name')->where('client_id',$company)->get('client_folder')->result_array();
	}
	function save_file($data=null)
	{
		$this->db->insert('client_upload_files',$data);
		return $this->db->affected_rows() > 0 ? true:false;
	}
	public function delete_file($id=null)
	{
		$this->db->where('id',$id)->delete('client_upload_files');
		return $this->db->affected_rows() > 0 ? true:false;
	}
}
