<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Ffi_pip_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_pip_letter()
	{
		$this->db->select('a.*,b.emp_name,phone1,designation');
		$this->db->from('ffi_pip_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->order_by('a.id','DESC');
		$this->db->where('a.status','0');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}

	public function make_query()
	{ 
		
        $order_column = array("e.id", "e.from_name","e.emp_id", "d.emp_name", "e.date","d.phone1","d.designation");  
		$this->db->select('e.*,d.emp_name,d.phone1,d.designation');
		$this->db->from('ffi_pip_letter e');
		$this->db->join('fhrms d','e.emp_id=d.ffi_emp_id','left');
		$this->db->where('e.status',0);
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("e.id", $_POST["search"]["value"]);  
                $this->db->or_like("e.from_name", $_POST["search"]["value"]);   
                $this->db->or_like("e.emp_id", $_POST["search"]["value"]);
				$this->db->or_like("d.emp_name", $_POST["search"]["value"]);
				$this->db->or_like("e.date", $_POST["search"]["value"]); 
				$this->db->or_like("d.phone1", $_POST["search"]["value"]); 
                $this->db->or_like("d.designation", $_POST["search"]["value"]); 
            $this->db->group_end();
		}
		if(isset($_POST["order"]))  
        {  
             $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
             $this->db->order_by('e.id', 'DESC');  
        }  	
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

	function make_datatables(){  
        $this->make_query();   
		if($_POST["length"] != -1)  
		{  
			 $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();  
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
		$from_name=$this->input->post('from_name');
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		$observation=$this->input->post('observation');
		$goals=$this->input->post('goals');
		$updates=$this->input->post('updates');
		$timeline=$this->input->post('timeline');
		
		$db_date=date("Y-m-d",strtotime($date));
		
		$today=date("Y-m-d");
		
		$data=array("from_name"=>$from_name,"emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"observation"=>$observation,"goals"=>$goals,"updates"=>$updates,"timeline"=>$timeline,"date_of_update"=>$today);
		$this->db->insert("ffi_pip_letter",$data);
	}
	function update_letter()
	{
		$id=$this->uri->segment(3);
		$from_name=$this->input->post('from_name');
		$employee=$this->input->post('employee');
		$date=$this->input->post('date');
		$content=$this->input->post('content');
		$observation=$this->input->post('observation');
		$goals=$this->input->post('goals');
		$updates=$this->input->post('updates');
		$timeline=$this->input->post('timeline');
		
		$db_date=date("Y-m-d",strtotime($date));	
		
		$data=array("from_name"=>$from_name,"emp_id"=>$employee,"date"=>$db_date,"content"=>$content,"observation"=>$observation,"goals"=>$goals,"updates"=>$updates,"timeline"=>$timeline,"date_of_update"=>$today);
		
		
		$this->db->where('id',$id);
		$this->db->update('ffi_pip_letter',$data);
	}
	function delete_pip_letter()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_pip_letter');
	}
	function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id');
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function view_pip_letter()
	{
		$id=$this->uri->segment('3');
		$this->db->select('a.*,b.emp_name');
		$this->db->from('ffi_pip_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_pip_info($id)
	{
		$this->db->select('a.*,b.emp_name,designation');
		$this->db->from('ffi_pip_letter a');
		$this->db->join('fhrms b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
}  
?>