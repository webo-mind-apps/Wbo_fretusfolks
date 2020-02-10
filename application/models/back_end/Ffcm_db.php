<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Ffcm_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_expenses()
	{
		$month=date("m");
		$year=date("Y");
		$this->db->where('status','0');
		$this->db->where('MONTH(date)',$month);
		$this->db->where('YEAR(date)',$year);
		$this->db->order_by('date','DESC');
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}

	public function make_query()
	{ 
        $order_column = array("id","date","month","nature_expenses","amount");  
		$this->db->select('*');
		$this->db->from('expenses');
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("id", $_POST["search"]["value"]);  
                $this->db->or_like("date", $_POST["search"]["value"]);   
                $this->db->or_like("month", $_POST["search"]["value"]);
				$this->db->or_like("nature_expenses", $_POST["search"]["value"]);
				$this->db->or_like("amount", $_POST["search"]["value"]); 
				
            $this->db->group_end();
		}
		if(isset($_POST["order"]))  
        {  
             $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
             $this->db->order_by('id', 'DESC');  
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
	function search_expenses()
	{
		$month=$this->input->post('month');;
		$year=$this->input->post('year');
		
		$this->db->where('status','0');
		$this->db->where('MONTH(date)',$month);
		$this->db->where('YEAR(date)',$year);
		$this->db->order_by('date','DESC');
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}
	function delete_expenses()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('expenses');
	}
	function get_expenses_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('expenses');
		$q=$query->result_array();
		return $q;
	}
	function save_expenses()
	{
		$exp_date=$this->input->post('exp_date');
		$month=$this->input->post('month');
		$expenses=$this->input->post('expenses');
		$amount=$this->input->post('amount');
		
		$db_date=date("Y-m-d",strtotime($exp_date));
		
		$data=array("date"=>$db_date,"month"=>$month,"nature_expenses"=>$expenses,"amount"=>$amount);
		
		$this->db->insert('expenses',$data);	
	}
	function update_expenses()
	{
		$id=$this->uri->segment(3);
		
		$exp_date=$this->input->post('exp_date');
		$month=$this->input->post('month');
		$expenses=$this->input->post('expenses');
		$amount=$this->input->post('amount');
		
		$db_date=date("Y-m-d",strtotime($exp_date));
		
		$data=array("date"=>$db_date,"month"=>$month,"nature_expenses"=>$expenses,"amount"=>$amount);
		$this->db->where('id',$id);
		$this->db->update('expenses',$data);	
	}
}  
?>