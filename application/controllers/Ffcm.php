<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Ffcm extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Ffcm_db', 'ffcm');
		$this->load->library("pagination");
	}
	public function index()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			//$data['expenses']=$this->ffcm->get_all_expenses();
			$this->load->view('admin/back_end/ffcm/index', $data);
		} else {
			redirect('home/index');
		}
	}

	public function get_all_data($var = null) //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$fetch_data = $this->ffcm->make_datatables();
			$data = array();
			// $status = '<span class="badge bg-blue">Completed</span>';

			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = date("d-m-Y", strtotime($row->date));
				$sub_array[] = $row->month;
				$sub_array[] = $row->nature_expenses;
				$sub_array[] = $row->amount;
				$action = "";
				if ($this->session->userdata('admin_type') == 0) {
					$action = '<a href="javascript:void(0);" id="' . $row->id . '" onclick="delete_expenses(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
				}
				$sub_array[] = '
					 <div class="list-icons">
					 <div class="dropdown">
						 <a href="#" class="list-icons-item" data-toggle="dropdown">
							 <i class="icon-menu9"></i>
						 </a>
						 <div class="dropdown-menu dropdown-menu-right">
						 <a href="' . site_url('ffcm/edit_expenses/' . $row->id) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
						 ' . $action . '
			 	</div>
					 </div>
				 </div>
					 ';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->ffcm->get_all_data(),
				"recordsFiltered"     =>     $this->ffcm->get_filtered_data(),
				"data" => $data
			);

			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	public function new_expenses()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			$this->load->view('admin/back_end/ffcm/new_expenses', $data);
		} else {
			redirect('home/index');
		}
	}
	public function edit_expenses()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data['active_menu'] = "fcms";
			$data['expenses'] = $this->ffcm->get_expenses_details();
			$this->load->view('admin/back_end/ffcm/edit_expenses', $data);
		} else {
			redirect('home/index');
		}
	}
	public function save_expenses()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data = $this->ffcm->save_expenses();
			redirect('ffcm/');
		} else {
			redirect('home/index');
		}
	}
	public function update_expenses()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$data = $this->ffcm->update_expenses();
			redirect('ffcm/');
		} else {
			redirect('home/index');
		}
	}
	public function search_expenses()
	{
		$data = $this->ffcm->search_expenses();

		$i = 1;
		foreach ($data as $row) {
			echo '
						<tr>
							<td>' . $i . '</td>
							<td>' . date("d-m-Y", strtotime($row['date'])) . '</td>
							<td>' . $row['month'] . '</td>
							<td>' . $row['nature_expenses'] . '</td>
							<td style="width:15%">Rs. ' . $row['amount'] . '</td>
							<td class="text-center">
								<div class="list-icons">
									<div class="dropdown">
										<a href="#" class="list-icons-item" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="' . site_url('ffcm/edit_expenses/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>';
			if ($this->session->userdata('admin_type') == 0) {
				echo '<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_expenses(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
			}
			echo '		</div>
									</div>
								</div>
							</td>
						</tr>';
			$i++;
		}
	}
	function delete_expenses()
	{
		$data1 = $this->ffcm->delete_expenses();
		$data = $this->ffcm->search_expenses();

		$i = 1;
		foreach ($data as $row) {
			echo '
						<tr>
							<td>' . $i . '</td>
							<td>' . date("d-m-Y", strtotime($row['date'])) . '</td>
							<td>' . $row['month'] . '</td>
							<td>' . $row['nature_expenses'] . '</td>
							<td style="width:15%">Rs. ' . $row['amount'] . '</td>
							<td class="text-center">
								<div class="list-icons">
									<div class="dropdown">
										<a href="#" class="list-icons-item" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="' . site_url('ffcm/edit_expenses/' . $row['id']) . '" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>';
			if ($this->session->userdata('admin_type') == 0) {
				echo '<a href="javascript:void(0);" id="' . $row['id'] . '" onclick="delete_expenses(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>';
			}
			echo 	'		</div>
									</div>
								</div>
							</td>
						</tr>';
			$i++;
		}
	}
	public function download_expenses()
	{
		if (($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type') == 0 || $this->session->userdata('admin_type') == 1)) {
			$this->load->library('Excel');
			$this->excel->setActiveSheetIndex(0);

			$this->excel->getActiveSheet()->setTitle('Expenses Details');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);


			$this->excel->getActiveSheet()->getStyle("A1:E1")->applyFromArray(array("font" => array("bold" => true)));
			$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
			$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Date');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Month');
			$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Nature Of Expenses');
			$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Amount');

			$data = $this->ffcm->search_expenses();
			/**************************************************************************************************************************/
			$n = 2;
			$i = 1;
			foreach ($data as $row) {


				$this->excel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
				$this->excel->setActiveSheetIndex(0)->setCellValue('B' . $n, date("d-m-Y", strtotime($row['date'])));
				$this->excel->setActiveSheetIndex(0)->setCellValue('C' . $n, $row['month']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('D' . $n, $row['nature_expenses']);
				$this->excel->setActiveSheetIndex(0)->setCellValue('E' . $n, $row['amount']);
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
