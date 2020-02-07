<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
error_reporting(0);
class Termination_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Termination_db','termination');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['pip_letter']=$this->termination->get_all_termination_letter();
			$this->load->view('admin/back_end/termination_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_termination_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['employee']=$this->termination->get_all_employee();
			$data['letter_content']=$this->termination->get_letter_content();
			$this->load->view('admin/back_end/termination_letter/new_termination_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_termination_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$id=$this->uri->segment(3);
			$data['pip_info']=$this->termination->get_termination_info($id);
			$this->load->view('admin/back_end/termination_letter/edit_termination_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->termination->save_letter();
			redirect('termination_letter/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->termination->update_letter();
			redirect('termination_letter/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_termination_letter()
	{
		$data1=$this->termination->delete_termination_letter();
		$data=$this->termination->get_all_termination_letter();
		$i=1;
		foreach($data as $row)
		{
			
			echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['emp_id'].'</td>
						<td>'.$row['emp_name'].'</td>
						<td style="width:15%">'.date("d-m-Y",strtotime($row['date'])).'</td>
						<td>'.$row['phone1'].'</td>
						<td style="width:15%">'.$row['designation'].'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('termination_letter/view_termination_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
										<a href="'.site_url('termination_letter/edit_termination_letter/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_termination_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>';
			$i++;
		}
	}
	function get_emp_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->termination->get_emp_details();
			if($data)
			{
				if($data[0]['data_status']==1)
				{
					echo $data[0]['emp_name']."****".$data[0]['designation'];
				}
				else
				{
					echo "0";
				}
			}
			else
			{
				echo "failed";
			}
		}
	}
	function view_termination_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['pip']=$this->termination->view_termination_letter();
			$this->load->view('admin/back_end/termination_letter/print_termination',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}

	// excel Import for ADMS OFFER LETTER 
public function adms_termination_letter_import()
{
	
	$data = array();
	 // Load form validation library
	if(!empty($_FILES['import']['name'])) { 
		// get file extension
		$valid_extentions = array('xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw');
		$extension = pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION);
		$valid = false;
		foreach ($valid_extentions as $key => $value) {
			if($extension == $value){
				$valid = true;
			}
		}
		
		if($valid){
			if($extension == 'csv'):
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			elseif($extension == 'xlsx'):
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			else:
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			endif;

			$date=date("Y-m-d");
		
			// file path
			$spreadsheet = $reader->load($_FILES['import']['tmp_name']);
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			
			
			
			for ($i=2; $i <= count($allDataInSheet); $i++) { 

				$data=array(
					"emp_id"				=>	(empty($allDataInSheet[$i]['A'])? 'null' : $allDataInSheet[$i]['A'] ),
					"date"					=>	(empty($allDataInSheet[$i]['B'])? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['B']))),
					"absent_date"			=>	(empty($allDataInSheet[$i]['C'])? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['C']))),
					"show_cause_date"		=>	(empty($allDataInSheet[$i]['D'])? 'null' :date('Y-m-d', strtotime($allDataInSheet[$i]['D']))), 
					"termination_date"		=>	(empty($allDataInSheet[$i]['E'])? 'null' : date('Y-m-d', strtotime($allDataInSheet[$i]['E']))), 
					"content"				=>	(empty($allDataInSheet[$i]['F'])? 'null' : $allDataInSheet[$i]['F'] ), 
					"date_of_update"		=>   $date,
				);
				
				
				
				$this->termination->importEmployee_termination_letter($data);

			}

			$this->session->set_flashdata('success', 'Import successfully');
			redirect('termination_letter','refresh');
			
		}
		else{
			
			$this->session->set_flashdata('error', 'Please Choose Valid file formate ');
			
		}
	}	
}

}
