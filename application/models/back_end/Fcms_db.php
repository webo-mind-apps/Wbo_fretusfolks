<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Fcms_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_invoice()
	{
		$this->db->select("a.*,b.client_name,c.state_name");
		$this->db->from("invoice a");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","a.service_location=c.id","left");
		$this->db->where("a.status","0");
		$this->db->order_by("a.id","DESC");
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_invoice_details_popup()
	{
		$id=$this->input->post('id');
		$this->db->select("a.*,b.client_name,c.state_name");
		$this->db->from("invoice a");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","a.service_location=c.id","left");
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
	function get_invoice_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get("invoice");
		$q=$query->result_array();
		return $q;
	}
	function save_invoice()
	{
		$client=$this->input->post('client');
		$location=$this->input->post('location');
		$gst_no=$this->input->post('gst_no');
		$invoice_no=$this->input->post('invoice_no');
		$gross_value=$this->input->post('gross_value');
		$service_fees=$this->input->post('service_fees');
		$source_fees=$this->input->post('source_fees');
		$cgst=$this->input->post('cgst');
		$sgst=$this->input->post('sgst');
		$igst=$this->input->post('igst');
		$total_employee=$this->input->post('total_employee');
		$inv_date=$this->input->post('inv_date');
		
		$cgst_amt=$this->input->post('cgst_amt');
		$sgst_amt=$this->input->post('sgst_amt');
		$igst_amt=$this->input->post('igst_amt');
		$total_tax=$this->input->post('total_tax');
		
		$inv_total=$this->input->post('inv_total');
		$credit_note=$this->input->post('credit_note');
		$debit_note=$this->input->post('debit_note');
		
		$grand_total=$this->input->post('grand_total');
		$inv_month=$this->input->post('inv_month');
		
		if ($_FILES['file']['size']>1)
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
            $config['upload_path'] = 'uploads/invoice_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file'))
            {
				$pan_path="uploads/invoice_doc/".$new_name;
			}
		}
		$db_date=date("Y-m-d",strtotime($inv_date));
		
		$data=array("invoice_no"=>$invoice_no,"client_id"=>$client,"service_location"=>$location,"gst_no"=>$gst_no,"gross_value"=>$gross_value,"service_value"=>$service_fees,"source_value"=>$source_fees,"total_employee"=>$total_employee,"cgst"=>$cgst,"sgst"=>$sgst,"igst"=>$igst,"cgst_amount"=>$cgst_amt,"sgst_amount"=>$sgst_amt,"igst_amount"=>$igst_amt,"tax_amount"=>$total_tax,"total_value"=>$inv_total,"credit_note"=>$credit_note,"debit_note"=>$debit_note,"grand_total"=>$grand_total,"date"=>$db_date,"inv_month"=>$inv_month,"file_path"=>$pan_path,"balance_amount"=>$grand_total);
		$this->db->insert("invoice",$data);
	}
	function update_invoice()
	{
		$id=$this->uri->segment(3);
		
		$client=$this->input->post('client');
		$location=$this->input->post('location');
		$gst_no=$this->input->post('gst_no');
		$invoice_no=$this->input->post('invoice_no');
		$gross_value=$this->input->post('gross_value');
		$service_fees=$this->input->post('service_fees');
		$source_fees=$this->input->post('source_fees');
		$cgst=$this->input->post('cgst');
		$sgst=$this->input->post('sgst');
		$igst=$this->input->post('igst');
		$total_employee=$this->input->post('total_employee');
		$inv_date=$this->input->post('inv_date');
		
		$cgst_amt=$this->input->post('cgst_amt');
		$sgst_amt=$this->input->post('sgst_amt');
		$igst_amt=$this->input->post('igst_amt');
		$total_tax=$this->input->post('total_tax');
		
		$inv_total=$this->input->post('inv_total');
		$credit_note=$this->input->post('credit_note');
		$debit_note=$this->input->post('debit_note');
		
		$grand_total=$this->input->post('grand_total');
		
		$balance_amount=$this->input->post('balance_amount');
		$tds_amount=$this->input->post('tds_amount');
		$amount_received=$this->input->post('amount_received');
		
		
		
		
		$db_date=date("Y-m-d",strtotime($inv_date));
		
		$inv_month=$this->input->post('inv_month');
		
		if (!empty($_FILES['file']['name']))
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
            $config['upload_path'] = 'uploads/invoice_doc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
            if ($this->upload->do_upload('file'))
            {
				$pan_path="uploads/invoice_doc/".$new_name;
				
				$data=array("invoice_no"=>$invoice_no,"client_id"=>$client,"service_location"=>$location,"gst_no"=>$gst_no,"gross_value"=>$gross_value,"service_value"=>$service_fees,"source_value"=>$source_fees,"total_employee"=>$total_employee,"cgst"=>$cgst,"sgst"=>$sgst,"igst"=>$igst,"cgst_amount"=>$cgst_amt,"sgst_amount"=>$sgst_amt,"igst_amount"=>$igst_amt,"tax_amount"=>$total_tax,"total_value"=>$inv_total,"credit_note"=>$credit_note,"debit_note"=>$debit_note,"grand_total"=>$grand_total,"date"=>$db_date,"inv_month"=>$inv_month,"file_path"=>$pan_path,"balance_amount"=>$grand_total);	
			}
		}
		else
		{
				$data=array("invoice_no"=>$invoice_no,"client_id"=>$client,"service_location"=>$location,"gst_no"=>$gst_no,"gross_value"=>$gross_value,"service_value"=>$service_fees,"source_value"=>$source_fees,"total_employee"=>$total_employee,"cgst"=>$cgst,"sgst"=>$sgst,"igst"=>$igst,"cgst_amount"=>$cgst_amt,"sgst_amount"=>$sgst_amt,"igst_amount"=>$igst_amt,"tax_amount"=>$total_tax,"total_value"=>$inv_total,"credit_note"=>$credit_note,"debit_note"=>$debit_note,"grand_total"=>$grand_total,"date"=>$db_date,"inv_month"=>$inv_month,"balance_amount"=>$grand_total);
		}
		$this->db->where("id",$id);
		$this->db->update("invoice",$data);
	}
	function get_client_location()
	{
		$client=$this->input->post('client');
		
		$this->db->select('a.*,b.state_name');
		$this->db->from('client_gstn a');
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where('a.client_id',$client);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function client_location($id)
	{
		$this->db->select('a.*,b.state_name');
		$this->db->from('client_gstn a');
		$this->db->join('states b','a.state=b.id','left');
		$this->db->where('a.client_id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_client_gst()
	{
		$client=$this->input->post('client');
		$client_location=$this->input->post('client_location');
		
		$this->db->where('client_id',$client);
		$this->db->where('state',$client_location);
		$query=$this->db->get("client_gstn");
		$q=$query->result_array();
		if($q[0]['gstn_no'])
		{
			return $q[0]['gstn_no'];
		}
		else
		{
			return "Not Available";
		}
	}
	function delete_invoice()
	{
		$id=$this->input->post('id');
		$data=array("status"=>"2");
		$this->db->where('id',$id);
		$this->db->update("invoice",$data);
	}
}  
?>