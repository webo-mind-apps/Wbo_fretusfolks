<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Home_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_cdms_report()
	{
		$this->db->select('count(id) as total_client');
		$this->db->from('client_management');
		$query=$this->db->get();
		$q1=$query->result_array();
		$total_client=$q1[0]['total_client'];
		
		$this->db->select('count(id) as active_client');
		$this->db->where('active_status','0');
		$this->db->from('client_management');
		$query2=$this->db->get();
		$q2=$query2->result_array();
		$active_client=$q2[0]['active_client'];
		
		$this->db->select('count(id) as inactive_client');
		$this->db->where('active_status','1');
		$this->db->from('client_management');
		$query3=$this->db->get();
		$q3=$query3->result_array();
		$inactive_client=$q3[0]['inactive_client'];
		$result=array("total_client"=>$total_client,"active_client"=>$active_client,"inactive_client"=>$inactive_client);
		return $result;
	}
	function get_contract_end_data()
	{
		$today=date("Y-m-d");
		$end_date = date('Y-m-d', strtotime("+30 days"));
		
		$this->db->where("contract_end >=",$today);
		$this->db->where("contract_end <=",$end_date);
		$this->db->where('active_status','0');
		$this->db->order_by("contract_end","ASC");
		$this->db->limit(10);
		$query=$this->db->get('client_management');
		$q=$query->result_array();
		return $q;
	}
	function get_company_details()
	{
		$this->db->where('status','0');
		$query=$this->db->get('client_management');
		$q=$query->result_array();
		$result=array();
		$i=0;
		foreach($q as $res)
		{
			$res_data = array();
			$res_data['client_name']=$res['client_name'];
			$res_data['active_emp']=$this->count_active_employees($res['id']);
			$res_data['inactive_emp']=$this->count_inactive_employees($res['id']);
			$result[$i]=$res_data;
			$i++;
		}
		
		/*$query=$this->db->query("select a.client_id,count(a.id)as total,sum(a.active_status=0) as active,sum(a.active_status=1) as inactive,b.client_name from backend_management a  join client_management b on b.id=a.client_id where a.status='0' group by client_id order by count(*) desc");
		$q=$query->result_array();*/
		return $result;
	}
	function count_active_employees($id)
	{
		$this->db->where('emp_name!=','');
		$this->db->where('active_status','0');
		$this->db->where("status","0");
		$this->db->where("dcs_approval","1");
		$this->db->where('client_id',$id);
		$num = $this->db->count_all_results('backend_management');
		return $num;
	}
	function count_inactive_employees($id)
	{
		$this->db->where('active_status','1');
		$this->db->where("dcs_approval","1");
		$this->db->where('client_id',$id);
		$num = $this->db->count_all_results('backend_management');
		return $num;
	}
	function get_total_employee()
	{
		$this->db->where('emp_name!=','');
		$this->db->where('active_status','0');
		$this->db->where("status","0");
		$this->db->where("dcs_approval","1");
		$active_num = $this->db->count_all_results('backend_management');
		
		$this->db->where('emp_name!=','');
		$this->db->where('active_status','1');
		$this->db->where("dcs_approval","1");
		$inactive_num = $this->db->count_all_results('backend_management');
		
		$total=$active_num+$inactive_num;
		return $total;
		/*$query=$this->db->query("select count(id)as total_employee from backend_management where dcs_approval='1' and (active_status='1')");
		$q=$query->result_array();
		return $q;*/
	}
	function get_fhrms_details()
	{
		$query=$this->db->query("select count(a.id)as total,sum(a.active_status=0) as active,sum(a.active_status=1) as inactive from fhrms a");
		$q=$query->result_array();
		return $q;
	}
	function get_cfis_report()
	{
		if($this->session->userdata('admin_type')==4)
		{
			$adm_id=$this->session->userdata('admin_id');
			
			$query=$this->db->query("SELECT a.client_id,a.state,sum(a.data_status=1) as selected,sum(a.data_status=0) as lineups,a.location,b.client_name,c.state_name FROM backend_management a left join client_management b on b.id=a.client_id left join states c on c.id=a.state where a.created_by='".$adm_id."' group by a.client_id limit 20");
		}
		else
		{
			$query=$this->db->query("SELECT a.client_id,a.state,sum(a.data_status=1) as selected,sum(a.data_status=0) as lineups,a.location,b.client_name,c.state_name FROM backend_management a left join client_management b on b.id=a.client_id left join states c on c.id=a.state group by a.client_id limit 20");
		}
		$q=$query->result_array();
		return $q;
	}
	function get_dcs_report()
	{
		$query=$this->db->query("SELECT a.client_id,a.state,sum(a.active_status=1) as inactive,sum(a.active_status=0) as active,a.location,b.client_name,c.state_name FROM backend_management a left join client_management b on b.id=a.client_id left join states c on c.id=a.state where a.data_status=1 group by a.client_id,a.state,a.location limit 20");
		$q=$query->result_array();
		return $q;
	}
	function get_fhrms_report()
	{
		$query=$this->db->query("SELECT a.state,sum(a.active_status=1) as inactive,sum(a.active_status=0) as active,a.location,c.state_name FROM fhrms a left join states c on c.id=a.state where a.data_status=1 group by a.state,a.location limit 20");
		$q=$query->result_array();
		return $q;
	}
	function get_labour_notice()
	{
		$this->db->select('a.*,b.client_name,c.state_name');
		$this->db->from('cms_labour a');
		$this->db->join('client_management b','a.client_id=b.id','left');
		$this->db->join('states c','a.state_id=c.id','left');
		$this->db->limit(20);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_cims_details()
	{
		$this->db->select("a.*,b.client_name,c.state_name");
		$this->db->from("invoice a");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","a.service_location=c.id","left");
		$this->db->where("a.status","0");
		$this->db->where("a.balance_amount !=","0");
		$this->db->limit(20);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_asset_details()
	{
		$this->db->select('a.*,b.emp_name,b.ffi_emp_id');
		$this->db->from('assets_management a');
		$this->db->join('fhrms b','a.employee_id=b.id');
		$this->db->where('a.status','0');
		$this->db->order_by('a.id','DESC');
		$this->db->limit(20);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_tds_details()
	{
		$this->db->select("a.*,b.client_name,c.state_name,d.code");
		$this->db->from("invoice a");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","a.service_location=c.id","left");
		$this->db->join("tds_code d","a.tds_code=d.id","left");
		$this->db->where("a.status","0");
		$this->db->limit(20);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	
	public function todays_dob()
	{ 
		//$day=date('d');
		$month=date('m'); 
		$this->db->select('a.*,b.state_name');
		$this->db->from('fhrms a');
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where("a.status","0");
		//$this->db->where('day(dob)',$day);	
		$this->db->where('month(dob)',$month);
		$this->db->order_by('a.id','DESC');
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
}  
?>