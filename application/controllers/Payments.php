<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Payments extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Payments_db', 'payments');
		$this->load->library("pagination");
	}
	public function index()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			//$data['payments'] = $this->payments->get_all_payments();
			$this->load->view('admin/back_end/payments/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->payments->make_datatables();
			$data = array();
			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->invoice_no;
				$sub_array[] = $row->total_amt_gst;
				$sub_array[] = $row->payment_received_date;
				$sub_array[] = $row->amount_received;
				$sub_array[] = $row->balance_amount;
				$sub_array[] = $row->month;
				if ($this->session->userdata('admin_type') == 0) {
					$sub_array[] = '
				<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item" id="' . $row->id . '" onclick="view_invoice_details(this.id);"><i class="fa fa-eye"></i> View Details</a> 
						
							 <a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_payments(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>;
							 
						</div>
					</div>
				</div>
			</td>
					 ';
				}

				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->payments->get_all_data(),
				"recordsFiltered"     =>     $this->payments->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}


	function new_payments()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			$data['clients'] = $this->payments->get_all_clients();
			$data['tds_code'] = $this->payments->get_all_tds_code();
			$this->load->view('admin/back_end/payments/new_payments', $data);
		} else {
			redirect('home/index');
		}
	}
	function edit_payments()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			$data['clients'] = $this->payments->get_all_clients();
			$data['payment'] = $this->payments->get_payment_details();
			$data['tds_code'] = $this->payments->get_all_tds_code();
			$client_id = $data['payment'][0]['client_id'];
			//$data['client_invoice']=$this->payments->get_all_client_invoice($client_id);

			$this->load->view('admin/back_end/payments/edit_payments', $data);
		} else {
			redirect('home/index');
		}
	}
	function save_payments()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data = $this->payments->save_payments();
			redirect('payments/');
		} else {
			redirect('home/index');
		}
	}
	function update_payments()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data = $this->payments->update_payments();
			redirect('payments/');
		} else {
			redirect('home/index');
		}
	}
	function get_client_invoice()
	{
		$data = $this->payments->get_client_invoice();
		echo '<option value="">Select Invoice</option>';
		foreach ($data as $res1) {
			echo '<option value="' . $res1['id'] . '">' . $res1['invoice_no'] . '</option>';
		}
	}
	function get_invoice_amount()
	{
		$data = $this->payments->get_invoice_amount();
		echo $data;
	}
	function view_invoice_details()
	{
		$id = $this->input->post('id');
		$data = $this->payments->get_invoice_details_popup($id);

		echo '
					<div class="modal-header bg-primary">
						<h6 class="modal-title">' . ucwords($data[0]['client_name']) . '</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Invoice No :</b> <span>' . ucwords($data[0]['invoice_no']) . '</span></p>
								<p><b>GST No:</b> <span>' . ucwords($data[0]['gst_no']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>' . ucwords($data[0]['client_name']) . '</span></p>
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Location :</b> <span>' . ucwords($data[0]['state_name']) . '</span></p>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Manpower Supply :</b> Rs. <span>' . $data[0]['gross_value'] . '</span></p>
								<p><b>CGST (%) :</b> <span>' . $data[0]['cgst'] . '</span></p>
								<p><b>CGST Amount :</b> Rs. <span>' . ucwords($data[0]['cgst_amount']) . '</span></p>								
								<p><b>Total Tax :</b> Rs. <span>' . ucwords($data[0]['tax_amount']) . '</span></p>	
								<p><b>Invoice Generated On :</b><span>' . date("d-m-Y", strtotime($data[0]['date'])) . '</span></p>								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Service Fees :</b> Rs. <span>' . $data[0]['service_value'] . '</span></p>
								<p><b>SGST (%) :</b> <span>' . $data[0]['sgst'] . '</span></p>
								<p><b>SGST Amount :</b> Rs. <span>' . ucwords($data[0]['sgst_amount']) . '</span></p>
								<p><b>Total Amount <br>(Without GST) :</b> Rs. <span>' . ($data[0]['gross_value'] + $data[0]['service_value'] + $data[0]['source_value']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Sourcing Fees :</b> Rs. <span>' . $data[0]['source_value'] . '</span></p>
								<p><b>IGST (%) :</b> <span>' . $data[0]['igst'] . '</span></p>
								<p><b>IGST Amount :</b> Rs. <span>' . ucwords($data[0]['igst_amount']) . '</span></p>
								<p><b>Grand Total : Rs. <span>' . ucwords($data[0]['total_value']) . '</span></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Credit Note :</b> Rs. <span>' . $data[0]['credit_note'] . '</span></p>						
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Debit Note :</b> Rs. <span>' . $data[0]['debit_note'] . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Payable Amount :</b> Rs. <span>' . $data[0]['grand_total'] . '</span></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>TDS Code :</b><span> ' . $data[0]['code'] . '</span></p>							
								<p><b> Payable Amount :</b> Rs. <span>' . ($data[0]['grand_total'] - $data[0]['tds_amount']) . '</span></p>							
								<p><b> Last Updated On :</b> <span>' . date("d-m-Y h:i:s a", strtotime($data[0]['date_time'])) . '</span></p>							
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>TDS % :</b><span>' . $data[0]['tds_percentage'] . '</span></p>		
								<p><b>Paid Amount :</b> Rs. <span>' . $data[0]['amount_received'] . '</span></p>											
								
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>TDS Amount :</b> Rs. <span>' . $data[0]['tds_amount'] . '</span></p>		
								<p><b>Balance Amount :</b> Rs. <span>' . $data[0]['balance_amount'] . '</span></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>
					</div>';
	}
	function delete_payments()
	{
		$data1 = $this->payments->delete_payments();
		// $data = $this->payments->get_all_payments();
		// $i = 1;
		// foreach ($data as $row) {
		// 	echo '
		// 			<tr>
		// 				<td>' . $i . '</td>
		// 				<td>' . $row['client_name'] . '</td>
		// 				<td>' . $row['invoice_no'] . '</td>
		// 				<td>Rs.' . $row['total_amt_gst'] . '</td>
		// 				<td>' . date("d-m-Y", strtotime($row['payment_received_date'])) . '</td>
		// 				<td style="width:10%">Rs.' . $row['amount_received'] . '</td>
		// 				<td style="width:10%">Rs. ' . $row['balance_amount'] . '</td>
		// 				<td style="width:10%">' . $row['month'] . '</td>
		// 				<td class="text-center">
		// 					<div class="list-icons">
		// 						<div class="dropdown">
		// 							<a href="#" class="list-icons-item" data-toggle="dropdown">
		// 								<i class="icon-menu9"></i>
		// 							</a>
		// 							<div class="dropdown-menu dropdown-menu-right">
		// 								<a href="javascript:void(0);" class="dropdown-item" id="' . $row['id'] . '" onclick="view_invoice_details(this.id);"><i class="fa fa-eye"></i> View Details</a>';
		// 	if ($this->session->userdata('admin_type') == 0) {
		// 		echo '<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_payments(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
		// 	}
		// 	echo '			</div>
		// 						</div>
		// 					</div>
		// 				</td>
		// 			</tr>';
		// 	$i++;
		// }
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
