<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Ffi_increment_letter_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	public function get_all_increment_letters()
	{
		$this->db->select('a.*,c.emp_name,c.email,c.phone1');
		$this->db->from('ffi_increment_letter a');
		$this->db->join('fhrms c','a.employee_id=c.ffi_emp_id','left');
		$this->db->where("a.status","0");
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		
		return $q;
	}
	function save_increment_letter()
	{
		$emp_id=$this->input->post('ffi_emp_id');
		
		$department=$this->input->post('departments');
		$designation=$this->input->post('designation');
		
		$basic_salary=$this->input->post('basic_salary');
		$hra=$this->input->post('hra');
		$conveyance=$this->input->post('conveyance');
		$medical=$this->input->post('medical');
		$special_allowance=$this->input->post('special_allowance');
		$other_allowance=$this->input->post('other_allowance');
		$gross_salary=$this->input->post('gross_salary');
		$pf_percentage=$this->input->post('pf_percentage');
		$emp_pf=$this->input->post('emp_pf');
		$esic_percentage=$this->input->post('esic_percentage');
		$emp_esic=$this->input->post('emp_esic');
		$pt=$this->input->post('pt');
		$total_deduction=$this->input->post('total_deduction');
		$employer_pf_percentage=$this->input->post('employer_pf_percentage');
		$employer_pf=$this->input->post('employer_pf');
		$employer_esic_percentage=$this->input->post('employer_esic_percentage');
		$employer_esic=$this->input->post('employer_esic');
		$mediclaim=$this->input->post('mediclaim');
		$ctc=$this->input->post('ctc');
		$content=$this->input->post('content');
		
		$data=array(
			"designation"=>$designation,"department"=>$department,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc);
			
		$this->db->where("ffi_emp_id",$emp_id);
		
		$this->db->update("fhrms",$data);
		
		$date=date("Y-m-d");
		$data1=array("employee_id"=>$emp_id,"date"=>$date,"basic_salary"=>$basic_salary,"hra"=>$hra,"conveyance"=>$conveyance,"medical_reimbursement"=>$medical,"special_allowance"=>$special_allowance,"other_allowance"=>$other_allowance,"gross_salary"=>$gross_salary,"pf_percentage"=>$pf_percentage,"emp_pf"=>$emp_pf,"esic_percentage"=>$esic_percentage,"emp_esic"=>$emp_esic,"pt"=>$pt,"total_deduction"=>$total_deduction,"employer_pf_percentage"=>$employer_pf_percentage,"employer_pf"=>$employer_pf,"employer_esic_percentage"=>$employer_esic_percentage,"employer_esic"=>$employer_esic,"mediclaim"=>$mediclaim,"ctc"=>$ctc,"content"=>$content);
		
		$this->db->insert("ffi_increment_letter",$data1);
		
	}
	function get_increment_letter_details()
	{
		$id=$this->uri->segment(3);
		
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id,b.joining_date,b.location,b.designation,b.department,b.father_name,b.contract_date');
		$this->db->from('ffi_increment_letter a');
		$this->db->join('fhrms b','a.employee_id=b.ffi_emp_id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		
		
		return $q;
	}
	function get_employee_detail()
	{
		$emp_id=$this->input->post('emp_id');
		$this->db->where('ffi_emp_id',$emp_id);
		$query=$this->db->get('fhrms');
		$q=$query->result_array();
		return $q;
	}
	function get_letter_content()
	{
		$this->db->where('type','1');
		$query=$this->db->get('letter_content');
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
	function get_all_clients()
	{
		$this->db->where("status","0");
		$this->db->order_by('id','DESC');
		$query=$this->db->get("client_management");
		$q=$query->result_array();
		return $q;
	}
	function delete_increment_letter()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('ffi_increment_letter');
	}
	// get data
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
	 
		$order_column = array("a.id", "emp_name", "email", "a.status"); 
		
		$this->db->select('a.*,c.emp_name,c.email,c.phone1');
		$this->db->from('ffi_increment_letter a');
		$this->db->join('fhrms c','a.employee_id=c.ffi_emp_id','left');
		$this->db->where("a.status","0");
		

		


		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("emp_name", $_POST["search"]["value"]);  
                $this->db->or_like("date", $_POST["search"]["value"]);  
                $this->db->or_like("phone1", $_POST["search"]["value"]);  
                $this->db->or_like("email", $_POST["search"]["value"]);  
                 
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

	
	public function get_all_data()
	{
		$this->db->select("*");
        $this->db->from('ffi_increment_letter');  
        return $this->db->count_all_results(); 
	}

	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	}
}  
?>