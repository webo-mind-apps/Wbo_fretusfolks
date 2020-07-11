<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Payments_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_payments()
	{
		$this->db->select("a.*,d.invoice_no,d.service_location,b.client_name,c.state_name");
		$this->db->from("payments a");
		$this->db->join("invoice d","d.id=a.invoice_id","left");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","d.service_location=c.id","left");
		$this->db->where("a.payment_received","1");
		$this->db->where("a.status","0");
		$this->db->order_by("a.id","DESC");
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}

	public function make_query()
	{ 
        $order_column = array("a.id", "b.client_name","d.invoice_no", "a.total_amt_gst", "a.payment_received_date","a.amount_received","a.balance_amount","a.month");  
		$this->db->select("a.*,d.invoice_no,d.service_location,b.client_name,c.state_name");
		$this->db->from("payments a");
		$this->db->join("invoice d","d.id=a.invoice_id","left");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","d.service_location=c.id","left");
		$this->db->where("a.payment_received","1");
		$this->db->where("a.status","0");
		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("b.client_name", $_POST["search"]["value"]);   
                $this->db->or_like("d.invoice_no", $_POST["search"]["value"]);
				$this->db->or_like("a.total_amt_gst", $_POST["search"]["value"]);
				$this->db->or_like("a.payment_received_date", $_POST["search"]["value"]); 
				$this->db->or_like("a.amount_received", $_POST["search"]["value"]); 
                $this->db->or_like("a.balance_amount", $_POST["search"]["value"]); 
                $this->db->or_like("a.month", $_POST["search"]["value"]); 
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
           $this->db->from('payments');  
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

	function get_payment_details()
	{
		$id=$this->uri->segment(3); 
		$this->db->select("a.*,d.invoice_no,d.service_location,b.client_name,c.state_name");
		$this->db->from("payments a");
		$this->db->join("invoice d","d.id=a.invoice_id","left");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","d.service_location=c.id","left");
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_invoice_details_popup()
	{
		$id=$this->input->post('id');
		$this->db->select("a.*,d.*,b.client_name,c.state_name,e.code");
		$this->db->from("payments a");
		$this->db->join("invoice d","d.id=a.invoice_id","left");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","d.service_location=c.id","left");
		$this->db->join("tds_code e","a.tds_code=e.id","left");
		$this->db->where("a.id",$id);
		$this->db->where("a.status","0");
		$query=$this->db->get();
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
	function get_client_invoice()
	{
		$client=$this->input->post('client');
		$this->db->where('client_id',$client);
		$this->db->where('status','0');
		$query=$this->db->get('invoice');
		$q=$query->result_array();
		return $q;
	}
	function get_all_client_invoice($client)
	{
		$this->db->where('client_id',$client);
		$this->db->where('payment_received','0');
		$this->db->where('status','0');
		$query=$this->db->get('invoice');
		$q=$query->result_array();
		return $q;
	}
	function get_invoice_amount()
	{
		$invoice=$this->input->post('inv');
		$this->db->where('id',$invoice);
		$query=$this->db->get('invoice');
		$q=$query->result_array();
		
		$gross_value=$q[0]['gross_value'];
		$service_value=$q[0]['service_value'];
		$source_value=$q[0]['source_value'];
		
		$amount_received=$q[0]['amount_received'];
		$balance_amount=$q[0]['balance_amount'];
		
		$total_gst=$gross_value+$service_value+$source_value;
		$total_amount=$q[0]['total_value'];
		
		$result=$total_gst."***".$total_amount."***".$amount_received."***".$balance_amount;
		return $result;
	}
	function save_payments()
	{
		$client=$this->input->post('client');
		$invoice_no=$this->input->post('invoice_no');
		
		$this->db->where('id',$invoice_no);
		$query=$this->db->get('invoice');
		$q=$query->result_array();
		
		$already_paid=$q[0]['amount_received'];
		$already_tds_amount=$q[0]['tds_amount'];
		
		$total_without_gst=$this->input->post('total_gst');
		$total_amount=$this->input->post('total_amount');
		
		$payment_date=$this->input->post('payment_date');
		$month=$this->input->post('month');
		
		$tds_code=$this->input->post('tds_code');
		$tds_percentage=$this->input->post('tds_percentage');
		$tds_amount=$this->input->post('tds_amount');
		$amount_paid=$this->input->post('amount_paid');
		$balance_amount=$this->input->post('balance_amount');
		$admin_id=$this->session->userdata('admin_id');
		$date=date("Y-m-d H:i:s");
		
		$total_amount_paid=$already_paid+$amount_paid;
		$total_tds_amount=$already_tds_amount+$tds_amount;
		
		$db_date=date("Y-m-d",strtotime($payment_date));
		
		$data=array("invoice_id"=>$invoice_no,"client_id"=>$client,"total_amt"=>$total_without_gst,"total_amt_gst"=>$total_amount,"payment_received_date"=>$db_date,"month"=>$month,"tds_code"=>$tds_code,"tds_percentage"=>$tds_percentage,"tds_amount"=>$tds_amount,"amount_received"=>$amount_paid,"balance_amount"=>$balance_amount,"date_time"=>$date,"modify_by"=>$admin_id,"payment_received"=>"1");
		$this->db->insert('payments',$data);
		
		$data1=array("amount_received"=>$total_amount_paid,"balance_amount"=>$balance_amount,"tds_code"=>$tds_code,"tds_amount"=>$total_tds_amount);
		$this->db->where('id',$invoice_no);
		$this->db->update('invoice',$data1);
	}
	function update_payments()
	{
		$id=$this->uri->segment(3);
		
		$client=$this->input->post('client');
		$invoice_no=$this->input->post('invoice_no');
		
		$total_without_gst=$this->input->post('total_gst');
		$total_amount=$this->input->post('total_amount');
		$payment_date=$this->input->post('payment_date');
		$month=$this->input->post('month');
		$tds_code=$this->input->post('tds_code');
		$tds_percentage=$this->input->post('tds_percentage');
		$tds_amount=$this->input->post('tds_amount');
		$amount_paid=$this->input->post('amount_paid');
		$balance_amount=$this->input->post('balance_amount');
		$admin_id=$this->session->userdata('admin_id');
		$date=date("Y-m-d H:i:s");
		
		$db_date=date("Y-m-d",strtotime($payment_date));
		
		$data=array("payment_received_date"=>$db_date,"month"=>$month,"tds_code"=>$tds_code,"tds_percentage"=>$tds_percentage,"tds_amount"=>$tds_amount,"amount_received"=>$amount_paid,"balance_amount"=>$balance_amount,"date_time"=>$date,"modify_by"=>$admin_id,"payment_received"=>"1");
		
		$this->db->where('id',$id);
		$this->db->update('payments',$data);
	}
	
	function get_all_tds_code()
	{
		$this->db->where('status','0');
		$this->db->order_by('id','ASC');
		$query=$this->db->get('tds_code');
		$q=$query->result_array();
		return $q;
	}
	function delete_payments()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		
		
		$query=$this->db->get('payments');
		$q=$query->result_array();
		
		
		
		if($q)
		{
			$total_received=0;
			$total_tds=0;
			$invoice_no=$q['0']['invoice_id'];
			
			$this->db->where('id',$id);
			$this->db->delete("payments");
			
			$query1=$this->db->query("select sum(amount_received)'total_received',sum(tds_amount)'total_tds' from payments where invoice_id='$invoice_no'");
			$q1=$query1->result_array();
			if($q1)
			{
				$total_received=$q1[0]['total_received'];
				$total_tds=$q1[0]['total_tds'];
			}
			$this->db->where('id',$invoice_no);
			$query2=$this->db->get("invoice");
			$q2=$query2->result_array();
			
			$inv_total=$q2[0]['grand_total'];
			if($total_received=="")
			{
				$total_received=0;
			}
			if($total_tds=="")
			{
				$total_tds=0;
			}
			
			$balance_amount=$inv_total-($total_received+$total_tds);
			
			
			$data=array("amount_received"=>$total_received,"tds_amount"=>$tds_amount,"balance_amount"=>$balance_amount);
			$this->db->where("id",$invoice_no);
			$this->db->update('invoice',$data);
		}
	}
}
