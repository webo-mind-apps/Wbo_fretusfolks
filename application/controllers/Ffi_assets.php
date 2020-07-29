<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Ffi_assets extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Ffi_assets_db', 'ffi_assets');
		$this->load->library("pagination");
	}
	public function index()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			//$data['ffi_assets']=$this->ffi_assets->get_all_ffi_assets();
			$this->load->view('admin/back_end/ffi_assets/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->ffi_assets->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';

			$i = 1;
			foreach ($fetch_data as $row) {
				$db_date1 = "";
				$db_date2 = "";
				$status = "";
				if ($row->issued_date != "0000-00-00") {
					$db_date1 = date("d-m-Y", strtotime($row->issued_date));
				}
				if ($row->returned_date != "0000-00-00") {
					$db_date2 = date("d-m-Y", strtotime($row->returned_date));
				}
				if ($row->status == 0) {
					$status = "Issued";
				}
				if ($row->status == 1) {
					$status = "Returned";
				}
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->emp_name;
				$sub_array[] = $row->asset_name;
				$sub_array[] = $row->asset_code;
				$sub_array[] = $db_date1;
				$sub_array[] = $db_date2;
				$sub_array[] = $status;

				if ($this->session->userdata('admin_type') == 0) {
					$action = '<a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_assets(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
				}
				$sub_array[] = '
					 <div class="list-icons">
					 <div class="dropdown">
						 <a href="#" class="list-icons-item" data-toggle="dropdown">
							 <i class="icon-menu9"></i>
						 </a>
						 <div class="dropdown-menu dropdown-menu-right">
																<a href="' . site_url('ffi_assets/edit_assets_details/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
																' . $action . '
																
									</div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->ffi_assets->get_all_data(),
				"recordsFiltered"     =>     $this->ffi_assets->get_filtered_data(),
				"data" => $data
			);
			// echo "<pre>";
			// print_r($output);
			// exit;
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	public function new_entry()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			$data['all_employee'] = $this->ffi_assets->get_all_employee();
			$this->load->view('admin/back_end/ffi_assets/new_entry', $data);
		} else {
			redirect('home/index');
		}
	}
	public function edit_assets_details()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			$data['all_employee'] = $this->ffi_assets->get_all_employee();
			$data['assets'] = $this->ffi_assets->get_asset_details();
			$this->load->view('admin/back_end/ffi_assets/edit_entry', $data);
		} else {
			redirect('home/index');
		}
	}
	public function save_assets()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data = $this->ffi_assets->save_assets();
			redirect('ffi_assets/');
		} else {
			redirect('home/index');
		}
	}
	public function update_assets()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data = $this->ffi_assets->update_assets();
			redirect('ffi_assets/');
		} else {
			redirect('home/index');
		}
	}
	public function search_assets()
	{
		$data = $this->ffi_assets->search_assets();

		$i = 1;

		foreach ($data as $row) {
			$db_date1 = "";
			$db_date2 = "";
			$status = "";
			if ($row['issued_date'] != "0000-00-00") {
				$db_date1 = date("d-m-Y", strtotime($row['issued_date']));
			}
			if ($row['returned_date'] != "0000-00-00") {
				$db_date2 = date("d-m-Y", strtotime($row['returned_date']));
			}
			if ($row['status'] == 0) {
				$status = "Issued";
			}
			if ($row['status'] == 1) {
				$status = "Returned";
			}
			echo '
					<tr>
						<td>' . $i . '</td>
						<td>' . $row['emp_name'] . '</td>
						<td>' . $row['asset_name'] . '</td>
						<td>' . $row['asset_code'] . '</td>
						<td style="width:15%">' . $db_date1 . '</td>
						<td style="width:15%">' . $db_date2 . '</td>
						<td style="width:15%">' . $status . '</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="' . site_url('ffi_assets/edit_assets_details/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>';
			if ($this->session->userdata('admin_type') == 0) {
				echo '<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_assets(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
			}
			echo '			</div>
								</div>
							</div>
						</td>
					</tr>';
			$i++;
		}
	}
	function delete_assets()
	{
		$data1 = $this->ffi_assets->delete_assets();
	}
	public function download_assets()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);

			$this->excel->getActiveSheet()->setTitle('FFI Assets Details');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);


			$this->excel->getActiveSheet()->getStyle("A1:E1")->applyFromArray(array("font" => array("bold" => true)));
			$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Employee ID');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Employee Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Asset Name');
			$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Asset Code');
			$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Issued On');
			$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Returned On');
			$this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Status');

			$data = $this->ffi_assets->search_assets();
			/**************************************************************************************************************************/
			$n = 2;
			$i = 1;
			foreach ($data as $row) {
				$db_date1 = "";
				$db_date2 = "";
				$status = "";
				if ($row['issued_date'] != "0000-00-00") {
					$db_date1 = date("d-m-Y", strtotime($row['issued_date']));
				}
				if ($row['returned_date'] != "0000-00-00") {
					$db_date2 = date("d-m-Y", strtotime($row['returned_date']));
				}
				if ($row['status'] == 0) {
					$status = "Issued";
				}
				if ($row['status'] == 1) {
					$status = "Returned";
				}

				$this->excel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
				$this->excel->setActiveSheetIndex(0)->setCellValue('B' . $n, $row['ffi_emp_id']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('C' . $n, $row['emp_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('D' . $n, $row['asset_name']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('E' . $n, $row['asset_code']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('F' . $n, $db_date1);
				$this->excel->setActiveSheetIndex(0)->setCellValue('G' . $n, $db_date2);
				$this->excel->setActiveSheetIndex(0)->setCellValue('H' . $n, $status);
				$i++;
				$n++;
			}
			/**************************************************************************************************************************/
			$filename = date("d-m-Y") . ' Expenses Details.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$objWriter->save('php://output');
		} else {
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
