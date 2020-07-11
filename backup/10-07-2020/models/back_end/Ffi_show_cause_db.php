<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Ffi_show_cause_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_termination_letter()
	{
		$this->db->select('a.*,b.emp_name,phone1,designation');
		$this->db->from('ffi_show_cause a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->order_by('a.id','DESC');
		$this->db->where('a.status','0');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_all_employee()
	{
		$this->db->where("data_status","1");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("fhrms");
		$q=$query->result_array();
		return $q;
	}
	function save_letter()
	{
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		
		$db_date=date("Y-m-d",strtotime($date));
		$today=date("Y-m-d");
		$data=array("emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"date_of_update"=>$today);
		$this->db->insert("ffi_show_cause",$data);
	}
	function update_letter()
	{
		$id=$this->uri->segment(3);
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		
		$db_date=date("Y-m-d",strtotime($date));
		$today=date("Y-m-d");
		$data=array("emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"date_of_update"=>$today);
		
		$this->db->where('id',$id);
		$this->db->update('ffi_show_cause',$data);
	}
	function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id');
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function view_showcause_letter()
	{
		$id=$this->uri->segment('3');
		$this->db->select('a.*,b.emp_name,b.location');
		$this->db->from('ffi_show_cause a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_termination_info($id)
	{
		$this->db->select('a.*,b.emp_name,designation');
		$this->db->from('ffi_show_cause a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function delete_show_cause_letter()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_show_cause');
	}
	function get_letter_content()
	{
		$this->db->where('type','3');
		$query=$this->db->get('letter_content');
		$q=$query->result_array();
		return $q;
	}
	// get  data
	public function make_datatables()
	{
		$this->make_query();   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();
	}

	// make query 
	public function make_query()
	{
	 
		$order_column = array("a.id", "b.emp_name", "a.status"); 
		
		$this->db->select('a.*,b.emp_name,b.phone1,b.designation');
		$this->db->from('ffi_show_cause a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		
		$this->db->where('a.status','0');

		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("a.emp_id", $_POST["search"]["value"]);  
                $this->db->or_like("b.emp_name", $_POST["search"]["value"]);  
                $this->db->or_like("a.date", $_POST["search"]["value"]);  
                $this->db->or_like("b.phone1", $_POST["search"]["value"]);  
                $this->db->or_like("b.designation", $_POST["search"]["value"]);  
                
                 
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

	// cont 
	public function get_all_data()
	{
		$this->db->select("*");
        $this->db->from('ffi_show_cause');  
        return $this->db->count_all_results(); 
	}

	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	}
}  
?>