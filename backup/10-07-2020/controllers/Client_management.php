<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Client_management extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('back_end/admin');
		$this->load->model('back_end/Client_db', 'client');
		$this->load->library("pagination");
	}
	public function index()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "client";
			//$data['clients']=$this->client->get_all_clients();
			$this->load->view('admin/back_end/client_management/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->client->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';
			$i=1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->client_name; 
				$sub_array[] = $row->contact_person;
				$sub_array[] = $row->contact_person_phone;
				$sub_array[] = $row->contact_person_email;

				$sub_array[] = '
					 <div class="list-icons">
					 <div class="dropdown">
						 <a href="#" class="list-icons-item" data-toggle="dropdown">
							 <i class="icon-menu9"></i>
						 </a>
						 <div class="dropdown-menu dropdown-menu-right">
						 <a href="javascript:void(0)" id=' . $row->id . ' onclick="view_client_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
						 <a href="' . site_url('client_management/edit_clients/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
						 <a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_clients(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
						 </div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
				$i++;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->client->get_all_data(),
				"recordsFiltered"     =>     $this->client->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	function new_client()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "client";
			$data['states'] = $this->client->get_all_states();
			$this->load->view('admin/back_end/client_management/new_client', $data);
		} else {
			redirect('home/index');
		}
	}
	function edit_clients()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "client";
			$id = $this->uri->segment(3);
			$data['client'] = $this->client->get_client_details($id);
			$data['client_gst'] = $this->client->get_client_gst($id);
			$data['states'] = $this->client->get_all_states();
			$this->load->view('admin/back_end/client_management/edit_client', $data);
		} else {
			redirect('home/index');
		}
	}
	function save_client()
	{
		if ($this->session->userdata('admin_login')) {

			$this->form_validation->set_rules('client', 'Client', 'trim|required');
			$this->form_validation->set_rules('land_line', 'Land Line', 'trim|required');
			$this->form_validation->set_rules('client_email', 'Email Id', 'trim|required');
			$this->form_validation->set_rules('contact_person', 'Contact Person', 'trim|required');
			$this->form_validation->set_rules('contact_person_mobile', 'Contact person mobile', 'trim|required');
			$this->form_validation->set_rules('contact_person_email', 'Contact person email', 'trim|required');
			$this->form_validation->set_rules('registered_address', 'Registered Address', 'trim|required');
			$this->form_validation->set_rules('communication_address', 'Communication address', 'trim|required');
			$this->form_validation->set_rules('pan_no', 'Pan No', 'trim|required');
			$this->form_validation->set_rules('tan_no', 'TAN No', 'trim|required');
			$this->form_validation->set_rules('website', 'Website', 'trim|required');
			$this->form_validation->set_rules('agreement_mode', 'Agreement Mode', 'trim|required');
			$this->form_validation->set_rules('agreement_type', 'Agreement Type', 'trim');
			$this->form_validation->set_rules('other_agreement', 'Other Agreement', 'trim');
			$this->form_validation->set_rules('region', 'Region', 'trim');
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim');
			$this->form_validation->set_rules('end_date', 'End date', 'trim');
			$this->form_validation->set_rules('rate', 'Rate', 'trim');
			$this->form_validation->set_rules('commercial_type', 'Commercial Type', 'trim');
			$this->form_validation->set_rules('remark', 'Remark', 'trim');
			$this->form_validation->set_rules('state_service', 'State Service', 'trim');
			$this->form_validation->set_rules('client_code', 'Client Code', 'trim|required');
			$this->form_validation->set_rules('contact_person_comm', 'Contact Person Comm', 'trim|required');
			$this->form_validation->set_rules('contact_person_phone_comm', 'Contact Person Phone Comm', 'trim|required');
			$this->form_validation->set_rules('contact_person_email_comm', 'Contact Person Email Comm', 'trim|required');
			if ($this->form_validation->run() ==  TRUE):
				if($data = $this->client->save_client()):
					$msg="Client details stored successfully";
					$this->session->set_flashdata('insert-status', $msg);
				else:
					$msg="Something went wrong";
					$this->session->set_flashdata('insert-status', $msg);
				endif;

				redirect('client_management/');
			else:
				print_r(validation_errors());
				$data['active_menu'] = "client";
				$data['states'] = $this->client->get_all_states();
				$msg=print_r(validation_errors());
				$this->session->set_flashdata('insert-status', $msg);
				$this->load->view('admin/back_end/client_management/new_client', $data);
			endif;
		} else {
			redirect('home/index');
		}
	}
	function update_client()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->client->update_client();

			redirect('client_management/');
		} else {
			redirect('home/index');
		}
	}
	function view_client_details()
	{
		$id = $this->input->post('id', true);
		$data = $this->client->get_client_details($id);
		$gst = $this->client->get_client_gst($id);
		$agree_mode = "";
		$agree_type = "";
		$commercial = "";
		if ($data[0]['mode_agreement'] == 1) {
			$agree_mode = "LOI";
		} else if ($data[0]['mode_agreement'] == 2) {
			$agree_mode = "Agreement";
		}
		if ($data[0]['agreement_type'] == 1) {
			$agree_type = "One Time Sourcing";
		} else if ($data[0]['agreement_type'] == 2) {
			$agree_type = "Contractual";
		} else if ($data[0]['agreement_type'] == 3) {
			$agree_type = "Other (" . $data[0]['other_agreement'] . " )";
		}
		if ($data[0]['commercial_type'] == 1) {
			$commercial = "%";
		} else if ($data[0]['commercial_type'] == 2) {
			$commercial = "Rs";
		}
		echo '
					
					<div class="modal-header bg-primary">
						<div class="col-md-10 col-sm-6">
							<h4 class="modal-title">' . ucwords($data[0]['client_name']) . '</h5>
							<h7>Client Code : ' . $data[0]['client_code'] . '</h7>
						</div>
						<div class="col-md-2 col-sm-6">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
					</div>
					<div class="modal-body">
						<h6 class="font-weight-semibold">Client Details</h6>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>' . ucwords($data[0]['client_name']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Email :</b> <span>' . $data[0]['client_email'] . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Landline No :</b> <span>' . $data[0]['land_line'] . '</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Contact Person Name :</b> <span>' . ucwords($data[0]['contact_person']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>' . $data[0]['contact_person_email'] . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone No :</b> <span>' . $data[0]['contact_person_phone'] . '</span></p>								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Contact Name (Comm) :</b> <span>' . ucwords($data[0]['contact_name_comm']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Contact Email (Comm):</b> <span>' . $data[0]['contact_email_comm'] . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Contact Phone (Comm):</b> <span>' . $data[0]['contact_phone_comm'] . '</span></p>								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>PAN No :</b> <span>' . strtoupper($data[0]['pan']) . '</span></p>
								<p><b>Agreement Mode :</b> <span>' . $agree_mode . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>TAN No :</b> <span>' . strtoupper($data[0]['tan']) . '</span></p>
								<p><b>Agreement Type :</b> <span>' . $agree_type . '</span></p>		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Website URL :</b> <span>' . $data[0]['website_url'] . '</span></p>							
														
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Registered Address :</b> <span>' . ucwords($data[0]['registered_address']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Communication Address :</b> <span>' . ucwords($data[0]['communication_address']) . '</span></p>
							</div>
						</div>
						
						<hr>
						<h6 class="font-weight-semibold">Agreement Details</h6>
						<div class="row">
							<div class="col-md-4 col-sm-6">';

		if ($data[0]['region'] != "") {
			echo '	<p><b>Zone :</b> <span>' . ucwords($data[0]['region']) . '</span></p>';
		}
		if ($data[0]['service_state'] != 0) {
			echo '	<p><b>Servicing State :</b> <span>' . ucwords($data[0]['state_name']) . '</span></p>';
		}

		echo '	<p><b>Rate :</b> <span>' . ucwords($data[0]['rate']) . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Contract Start :</b> <span>' . date("d-m-Y", strtotime($data[0]['contract_start'])) . '</span></p>
								<p><b>Commercial Type :</b> <span>' . $commercial . '</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Contract End :</b> <span>' . date("d-m-Y", strtotime($data[0]['contract_end'])) . '</span></p>
								<p><b>Remarks :</b> <span>' . ucwords($data[0]['remark']) . '</span></p>
							</div>
						</div>
						
						<hr>
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b><a href="' . base_url() . $data[0]['agreement_doc'] . '" target="_blank"><i class="fa fa-book"></i> Agreement Document </a></b></p>
							</div>
						</div>
						<hr>
						<h6 class="font-weight-semibold">GSTN Details</h6>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<table class="table table-bordered">
									<tr>
										<th>Si No</th>
										<th>State</th>
										<th>GSTN No</th>
									</tr>';
		$i = 1;
		if ($gst) {
			foreach ($gst as $res) {
				echo '
											<tr>
												<td>' . $i . '</td>
												<td>' . $res['state_name'] . '</td>
												<td>' . $res['gstn_no'] . '</td>
											</tr>';
				$i++;
			}
		} else {
			echo '<tr><td colspan="3" style="text-align:center;">No Data Available	</td></tr>';
		}

		echo '	</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>
					</div>';
	}
	function download_client_details()
	{
		if ($this->session->userdata('admin_login')) {
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);

			$this->excel->getActiveSheet()->setTitle('Client Details');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);



			$this->excel->getActiveSheet()->getStyle("A1:AA1")->applyFromArray(array("font" => array("bold" => true)));
			$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Client Code');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Client Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Landline');
			$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Client Email');
			$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Contact Person');
			$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Contact Person Phone');
			$this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Contact Person Email');
			$this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Contact Person (Communication)');
			$this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Contact Person Phone (Communication)');
			$this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Contact Person Email (Communication)');
			$this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Registered Address');
			$this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Communication Address');
			$this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'PAN No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'TAN No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Website Url');
			$this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Mode Agreement');
			$this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Agreement Type');
			$this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Agreement Document');
			$this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Region');
			$this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'Contract Start');
			$this->excel->setActiveSheetIndex(0)->setCellValue('V1', 'Contract End');
			$this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'Rate');
			$this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'Commercial Type');
			$this->excel->setActiveSheetIndex(0)->setCellValue('Y1', 'Remark');
			$this->excel->setActiveSheetIndex(0)->setCellValue('Z1', 'State Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('AA1', 'GSTN No');

			/**************************************************************************************************************************/
			$n = 2;
			$i = 1;
			$data = $this->client->get_all_clients();
			foreach ($data as $row) {
				$gst_data = $this->client->get_client_gst_download($row['id']);
				$agree_mode = "";
				$agree_type = "";
				$commercial = "";
				if ($row['mode_agreement'] == 1) {
					$agree_mode = "LOI";
				} else if ($row['mode_agreement'] == 2) {
					$agree_mode = "Agreement";
				}
				if ($row['agreement_type'] == 1) {
					$agree_type = "One Time Sourcing";
				} else if ($row['agreement_type'] == 2) {
					$agree_type = "Contractual";
				} else if ($row['agreement_type'] == 3) {
					$agree_type = "Other (" . $row['other_agreement'] . " )";
				}
				if ($row['commercial_type'] == 1) {
					$commercial = "%";
				} else if ($row['commercial_type'] == 2) {
					$commercial = "Rs";
				}
				$this->excel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
				$this->excel->setActiveSheetIndex(0)->setCellValue('B' . $n, $row['client_code']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('C' . $n, $row['client_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('D' . $n, $row['land_line']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('E' . $n, $row['client_email']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('F' . $n, $row['contact_person']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('G' . $n, $row['contact_person_phone']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('H' . $n, $row['contact_person_email']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('I' . $n, $row['contact_name_comm']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('J' . $n, $row['contact_phone_comm']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('K' . $n, $row['contact_email_comm']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('L' . $n, $row['registered_address']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('M' . $n, $row['communication_address']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('N' . $n, $row['pan']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('O' . $n, $row['tan']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('P' . $n, $row['website_url']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('Q' . $n, $agree_mode);
				$this->excel->setActiveSheetIndex(0)->setCellValue('R' . $n, $agree_type);
				$this->excel->setActiveSheetIndex(0)->setCellValue('S' . $n, $row['agreement_doc']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('T' . $n, $row['region']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('U' . $n, date("d-m-Y", strtotime($row['contract_start'])));
				$this->excel->setActiveSheetIndex(0)->setCellValue('V' . $n, date("d-m-Y", strtotime($row['contract_end'])));
				$this->excel->setActiveSheetIndex(0)->setCellValue('W' . $n, $row['rate']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('X' . $n, $commercial);
				$this->excel->setActiveSheetIndex(0)->setCellValue('Y' . $n, $row['remark']);

				foreach ($gst_data as $res) {
					$this->excel->setActiveSheetIndex(0)->setCellValue('Z' . $n, $res['state_name']);
					$this->excel->setActiveSheetIndex(0)->setCellValue('AA' . $n, $res['gstn_no']);
					$n++;
				}
				$i++;
				$n++;
			}
			/**************************************************************************************************************************/
			$filename = date("d-m-Y") . ' Client Details.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$objWriter->save('php://output');
		} else {
			redirect('home/index');
		}
	}
	function add_gstn_row()
	{
		$counter = $this->input->post('counter', true);
		$states = $this->client->get_all_states();
		$counter++;

		echo '
					<tr id="row_' . $counter . '">
						<td>
							<select class="form-control required" name="state[]" id="state_1" required>
								<option value="">Select State</option>';
		foreach ($states as $row) {
			echo '<option value="' . $row['id'] . '">' . $row['state_name'] . '</option>';
		}
		echo '
							</select>
						</td>
						<td>
							<input type="text" name="gstn[]" id="gstn" class="form-control">
								
						</td>		
						<td><a href="javascript:void(0);" id="' . $counter . '" onclick="remove_cycle_div(this.id)"><i class="fa fa-times-circle" aria-hidden="true"></i></i></td>
					</tr>';
	}
	function add_client_gst()
	{
		$id = $this->uri->segment(3);
		$data = $this->client->add_client_gst();
		redirect('client_management/edit_clients/' . $id);
	}
	function update_client_gst_details()
	{
		$data = $this->client->update_client_gst_details();
	}
	function delete_client_gst_no()
	{
		$data = $this->client->delete_client_gst_no();
	}
	function client_description()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "client";
			$data['clients'] = $this->client->get_all_client_description();
			$this->load->view('admin/back_end/client_offer_letter_content/index', $data);
		} else {
			redirect('home/index');
		}
	}
	function new_client_content()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "client";
			$data['clients'] = $this->client->get_all_clients();
			$this->load->view('admin/back_end/client_offer_letter_content/new_client', $data);
		} else {
			redirect('home/index');
		}
	}
	function edit_client_description()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "client";
			$data['clients'] = $this->client->get_all_clients();
			$data['client_description'] = $this->client->get_client_description();
			$this->load->view('admin/back_end/client_offer_letter_content/edit_client_description', $data);
		} else {
			redirect('home/index');
		}
	}
	function save_client_description()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->client->save_client_description();
			redirect('client_management/client_description');
		} else {
			redirect('home/index');
		}
	}
	function update_client_description()
	{
		if ($this->session->userdata('admin_login')) {
			$data = $this->client->update_client_description();
			redirect('client_management/client_description');
		} else {
			redirect('home/index');
		}
	}
	function delete_descriptions()
	{
		$data = $this->client->delete_descriptions();
	}
	function delete_clients()
	{
		$data1 = $this->client->delete_clients();
		$data = $this->client->get_all_clients();
		$i = 1;
		foreach ($data as $row) {
			echo '
						<tr>
							<td>' . $i . '</td>
							<td>' . $row['client_name'] . '</td>
							<td>' . $row['contact_person'] . '</td>
							<td>' . $row['contact_person_phone'] . '</td>
							<td>' . $row['contact_person_email'] . '</td>
							<td class="text-center">
								<div class="list-icons">
									<div class="dropdown">
										<a href="#" class="list-icons-item" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>

										<div class="dropdown-menu dropdown-menu-right">
											<a href="javascript:void(0)" id=' . $row['id'] . ' onclick="view_client_details(this.id);" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
											<a href="' . site_url('client_management/edit_clients/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
											<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_clients(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
										</div>
									</div>
								</div>
							</td>
						</tr>';
			$i++;
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
