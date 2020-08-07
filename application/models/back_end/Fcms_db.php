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
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
		$this->form_validation->set_rules('client', 'Client', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('gst_no', 'GST No', 'trim|required');
		$this->form_validation->set_rules('invoice_no', 'Invoice No', 'trim|required');
		$this->form_validation->set_rules('gross_value', 'Gross Value', 'trim|required');
		$this->form_validation->set_rules('service_fees', 'Service Fees', 'trim|required');
		$this->form_validation->set_rules('source_fees', 'Sourcing Fees', 'trim|required');
		$this->form_validation->set_rules('cgst', 'CGST', 'trim|required');
		$this->form_validation->set_rules('sgst', 'SGST', 'trim|required');
		$this->form_validation->set_rules('igst', 'IGST', 'trim|required');
		$this->form_validation->set_rules('total_employee', 'Total Employees', 'trim|required');
		$this->form_validation->set_rules('inv_date', 'Invoice Date', 'trim|required');
		$this->form_validation->set_rules('cgst_amt', 'CGST Amount', 'trim|required');
		$this->form_validation->set_rules('sgst_amt', 'SGST Amount', 'trim|required');
		$this->form_validation->set_rules('igst_amt', 'IGST Amount', 'trim|required');
		$this->form_validation->set_rules('total_tax', 'Total Tax', 'trim|required');
		$this->form_validation->set_rules('inv_total', 'Invoice Amount', 'trim|required');
		$this->form_validation->set_rules('credit_note', 'Credit Note', 'trim|required');
		$this->form_validation->set_rules('debit_note', 'Debit Note', 'trim|required');
		$this->form_validation->set_rules('grand_total', 'Grand Total', 'trim');
		$this->form_validation->set_rules('inv_month', 'Invoice Month', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('admin/back_end/invoice/new_invoice');
		}
		else
		{
		
		$client=$this->input->post('client',true);
		$location=$this->input->post('location',true);
		$gst_no=$this->input->post('gst_no',true);
		$invoice_no=$this->input->post('invoice_no',true);
		$gross_value=$this->input->post('gross_value',true);
		$service_fees=$this->input->post('service_fees',true);
		$source_fees=$this->input->post('source_fees',true);
		$cgst=$this->input->post('cgst',true);
		$sgst=$this->input->post('sgst',true);
		$igst=$this->input->post('igst',true);
		$total_employee=$this->input->post('total_employee',true);
		$inv_date=$this->input->post('inv_date',true);
		
		$cgst_amt=$this->input->post('cgst_amt',true);
		$sgst_amt=$this->input->post('sgst_amt',true);
		$igst_amt=$this->input->post('igst_amt',true);
		$total_tax=$this->input->post('total_tax',true);
		
		$inv_total=$this->input->post('inv_total',true);
		$credit_note=$this->input->post('credit_note',true);
		$debit_note=$this->input->post('debit_note',true);
		
		$grand_total=$this->input->post('grand_total',true);
		$inv_month=$this->input->post('inv_month',true);
		
		if ($_FILES['file']['size']>1)
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
            $config['upload_path'] = 'AKJHJG7665BHJG/invoice_doc/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
            if ($this->upload->do_upload('file'))
            {
				$pan_path="AKJHJG7665BHJG/invoice_doc/".$new_name;
			}
		}else{
			return "You upload file is a wrong file mime type";
		}
		}
		$db_date=date("Y-m-d",strtotime($inv_date));
		
		$data=array("invoice_no"=>$invoice_no,"client_id"=>$client,"service_location"=>$location,"gst_no"=>$gst_no,"gross_value"=>$gross_value,"service_value"=>$service_fees,"source_value"=>$source_fees,"total_employee"=>$total_employee,"cgst"=>$cgst,"sgst"=>$sgst,"igst"=>$igst,"cgst_amount"=>$cgst_amt,"sgst_amount"=>$sgst_amt,"igst_amount"=>$igst_amt,"tax_amount"=>$total_tax,"total_value"=>$inv_total,"credit_note"=>$credit_note,"debit_note"=>$debit_note,"grand_total"=>$grand_total,"date"=>$db_date,"inv_month"=>$inv_month,"file_path"=>$pan_path,"balance_amount"=>$grand_total);
		$this->db->insert("invoice",$data);
		}
	}
	function update_invoice()
	{
		$id=$this->uri->segment(3);
		$folder = 'AKJHJG7665BHJG/';
		if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
		$this->form_validation->set_rules('client', 'Client', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('gst_no', 'GST No', 'trim|required');
		$this->form_validation->set_rules('invoice_no', 'Invoice No', 'trim|required');
		$this->form_validation->set_rules('gross_value', 'Gross Value', 'trim|required');
		$this->form_validation->set_rules('service_fees', 'Service Fees', 'trim|required');
		$this->form_validation->set_rules('source_fees', 'Sourcing Fees', 'trim|required');
		$this->form_validation->set_rules('cgst', 'CGST', 'trim|required');
		$this->form_validation->set_rules('sgst', 'SGST', 'trim|required');
		$this->form_validation->set_rules('igst', 'IGST', 'trim|required');
		$this->form_validation->set_rules('total_employee', 'Total Employees', 'trim|required');
		$this->form_validation->set_rules('inv_date', 'Invoice Date', 'trim|required');
		$this->form_validation->set_rules('cgst_amt', 'CGST Amount', 'trim|required');
		$this->form_validation->set_rules('sgst_amt', 'SGST Amount', 'trim|required');
		$this->form_validation->set_rules('igst_amt', 'IGST Amount', 'trim|required');
		$this->form_validation->set_rules('total_tax', 'Total Tax', 'trim|required');
		$this->form_validation->set_rules('inv_total', 'Invoice Amount', 'trim|required');
		$this->form_validation->set_rules('credit_note', 'Credit Note', 'trim|required');
		$this->form_validation->set_rules('debit_note', 'Debit Note', 'trim|required');
		$this->form_validation->set_rules('grand_total', 'Grand Total', 'trim');
		$this->form_validation->set_rules('inv_month', 'Invoice Month', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('admin/back_end/invoice/edit_invoice');
		}
		else
		{
		
		
		$client=$this->input->post('client',true);
		$location=$this->input->post('location',true);
		$gst_no=$this->input->post('gst_no',true);
		$invoice_no=$this->input->post('invoice_no',true);
		$gross_value=$this->input->post('gross_value',true);
		$service_fees=$this->input->post('service_fees',true);
		$source_fees=$this->input->post('source_fees',true);
		$cgst=$this->input->post('cgst',true);
		$sgst=$this->input->post('sgst',true);
		$igst=$this->input->post('igst',true);
		$total_employee=$this->input->post('total_employee',true);
		$inv_date=$this->input->post('inv_date',true);
		
		$cgst_amt=$this->input->post('cgst_amt',true);
		$sgst_amt=$this->input->post('sgst_amt',true);
		$igst_amt=$this->input->post('igst_amt',true);
		$total_tax=$this->input->post('total_tax',true);
		
		$inv_total=$this->input->post('inv_total',true);
		$credit_note=$this->input->post('credit_note',true);
		$debit_note=$this->input->post('debit_note',true);
		
		$grand_total=$this->input->post('grand_total',true);
		
		$balance_amount=$this->input->post('balance_amount',true);
		$tds_amount=$this->input->post('tds_amount',true);
		$amount_received=$this->input->post('amount_received',true);
		
		
		
		
		$db_date=date("Y-m-d",strtotime($inv_date));
		
		$inv_month=$this->input->post('inv_month',true);
		
		if (!empty($_FILES['file']['name']))
        {
			$rand_no=date("is");
			$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
            $config['upload_path'] = 'AKJHJG7665BHJG/invoice_doc/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc';  
			$config['file_name'] = $new_name;	
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			$gftype=pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
			$rftype = explode('/',mime_content_type($_FILES["file"]['tmp_name']))[1];
			$type = array("gif", "jpg", "png", "jpeg", "pdf","doc");
			if(in_array($rftype, $type))
			{
				if ($this->upload->do_upload('file'))
				{
					$pan_path="AKJHJG7665BHJG/invoice_doc/".$new_name;
					
					$data=array("invoice_no"=>$invoice_no,"client_id"=>$client,"service_location"=>$location,"gst_no"=>$gst_no,"gross_value"=>$gross_value,"service_value"=>$service_fees,"source_value"=>$source_fees,"total_employee"=>$total_employee,"cgst"=>$cgst,"sgst"=>$sgst,"igst"=>$igst,"cgst_amount"=>$cgst_amt,"sgst_amount"=>$sgst_amt,"igst_amount"=>$igst_amt,"tax_amount"=>$total_tax,"total_value"=>$inv_total,"credit_note"=>$credit_note,"debit_note"=>$debit_note,"grand_total"=>$grand_total,"date"=>$db_date,"inv_month"=>$inv_month,"file_path"=>$pan_path,"balance_amount"=>$grand_total);	
				}
			}else{
				return "You upload file is a wrong file mime type";
			}
            
		}
		else
		{
				$data=array("invoice_no"=>$invoice_no,"client_id"=>$client,"service_location"=>$location,"gst_no"=>$gst_no,"gross_value"=>$gross_value,"service_value"=>$service_fees,"source_value"=>$source_fees,"total_employee"=>$total_employee,"cgst"=>$cgst,"sgst"=>$sgst,"igst"=>$igst,"cgst_amount"=>$cgst_amt,"sgst_amount"=>$sgst_amt,"igst_amount"=>$igst_amt,"tax_amount"=>$total_tax,"total_value"=>$inv_total,"credit_note"=>$credit_note,"debit_note"=>$debit_note,"grand_total"=>$grand_total,"date"=>$db_date,"inv_month"=>$inv_month,"balance_amount"=>$grand_total);
		}
		$this->db->where("id",$id);
		$this->db->update("invoice",$data);
		}
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


	// get invoice data
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

	// make query for invoice 
	public function make_query()
	{
	 
		$order_column = array("a.id", "b.client_name", "c.state_name", "a.status"); 
		
		$this->db->select("a.*,b.client_name,c.state_name");
		$this->db->from("invoice a");
		$this->db->join("client_management b","a.client_id=b.id","left");
		$this->db->join("states c","a.service_location=c.id","left");
		$this->db->where("a.status","0");

		if(isset($_POST["search"]["value"])){
            $this->db->group_start();
                $this->db->like("a.id", $_POST["search"]["value"]);  
                $this->db->or_like("invoice_no", $_POST["search"]["value"]);  
                $this->db->or_like("service_location", $_POST["search"]["value"]);  
                $this->db->or_like("gst_no", $_POST["search"]["value"]);  
                $this->db->or_like("grand_total", $_POST["search"]["value"]);  
                $this->db->or_like("date", $_POST["search"]["value"]);  
                $this->db->or_like("a.status", $_POST["search"]["value"]);  
                 
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

	// cont of all invoice
	public function get_all_data()
	{
		$this->db->select("*");
        $this->db->from('invoice');  
        return $this->db->count_all_results(); 
	}

	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	} 

}  
?>
