<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Termination_db extends CI_Model 
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
		$this->db->from('termination_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->order_by('a.id','DESC');
		$this->db->where('a.status','0');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}

    public function make_query()
	{ 
        $order_column = array("a.id", "emp_id","emp_name", "date", "phone1","designation");  
		$this->db->select('a.*,b.emp_name,phone1,designation');
		$this->db->from('termination_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.status','0');
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("emp_id", $_POST["search"]["value"]);   
                $this->db->or_like("emp_name", $_POST["search"]["value"]);
				$this->db->or_like("date", $_POST["search"]["value"]);
				$this->db->or_like("phone1", $_POST["search"]["value"]); 
				$this->db->or_like("designation", $_POST["search"]["value"]); 
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

	function get_all_data()  
    {  
           $this->db->select("*");
           $this->db->from('termination_letter');  
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
		$query=$this->db->get("backend_management");
		$q=$query->result_array();
		return $q;
	}
	function save_letter()
	{
		$employee=$this->input->post('employee', true);
		$date=$this->input->post('date', true);
		
		$date2=$this->input->post('absent_date', true);
		$date3=$this->input->post('show_cause_date', true);
		$date4=$this->input->post('termination_date', true);
		
		$absent_date=date("Y-m-d",strtotime($date2));
		$show_cause_date=date("Y-m-d",strtotime($date3));
		$termination_date=date("Y-m-d",strtotime($date4));
			
		$content=$this->input->post('content', true);
		
		$db_date=date("Y-m-d",strtotime($date));
		$today=date("Y-m-d");
		$data=array("emp_id"=>$employee,"date"=>$db_date,"absent_date"=>$absent_date,"show_cause_date"=>$show_cause_date,"termination_date"=>$termination_date,"content"=>$content,"date_of_update"=>$today);
		$this->db->insert("termination_letter",$data);
	}
	
	function update_letter()
	{
		$id=$this->uri->segment(3);
		$employee=$this->input->post('employee', true);
		$date=$this->input->post('date', true);
		
		$date2=$this->input->post('absent_date', true);
		$date3=$this->input->post('show_cause_date', true);
		$date4=$this->input->post('termination_date', true);
		
		$absent_date=date("Y-m-d",strtotime($date2));
		$show_cause_date=date("Y-m-d",strtotime($date3));
		$termination_date=date("Y-m-d",strtotime($date4));
		
		$content=$this->input->post('content', true);
		
		$db_date=date("Y-m-d",strtotime($date));
		$today=date("Y-m-d");
		$data=array("emp_id"=>$employee,"date"=>$db_date,"absent_date"=>$absent_date,"show_cause_date"=>$show_cause_date,"termination_date"=>$termination_date,"content"=>$content,"date_of_update"=>$today);
		
		$this->db->where('id',$id);
		$this->db->update('termination_letter',$data);
	}
	
	function delete_termination_letter()
	{
		$id=$this->input->post('id', true);
		$this->db->where('id',$id);
		$this->db->delete('termination_letter');
	}
	function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id', true);
		$this->db->where('ffi_emp_id',$emp_id);
		$this->db->where("status","0");
		$query=$this->db->get('backend_management');
		$q=$query->result_array();
		return $q;
	}
	function view_termination_letter()
	{
		$id=$this->uri->segment('3');
		$this->db->select('a.*,b.emp_name,b.location');
		$this->db->from('termination_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_termination_info($id)
	{
		$this->db->select('a.*,b.emp_name,designation');
		$this->db->from('termination_letter a');
		$this->db->join('backend_management b','a.emp_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_letter_content()
	{
		$this->db->where('type','2');
		$query=$this->db->get('letter_content');
		$q=$query->result_array();
		return $q;
	}
// excel import
public function importEmployee_termination_letter($data = null)
{

	$this->db->where('ffi_emp_id', $data['backend']['ffi_emp_id']);
		$query = $this->db->get("backend_management");
		if ($query->num_rows() <= 0)
		{
			$this->db->where('emp_id',$data['emp_id']);
			
			$query=$this->db->get("termination_letter");
			if(!$query->num_rows())
			{
				$this->db->insert('termination_letter',$data);
				if ($this->db->affected_rows() > 0)
				{
					return "insert";
				}
			}
			else
			{
				$this->db->where('emp_id',$data['employee_id']);
				$this->db->update('termination_letter',$data);
				if ($this->db->affected_rows() > 0)
				{
					return "update";
				}
			}
		}
		else
			{
				return "not_exist";
			}
	
}

}  
?>