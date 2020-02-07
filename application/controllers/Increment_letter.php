<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

error_reporting(0);
class Increment_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Increment_letter_db','increment');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['offer_letter']=$this->increment->get_all_increment_letters();
			$data['client_management']=$this->increment->get_all_client();
			$this->load->view('admin/back_end/increment_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_increment()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['letter_content']=$this->increment->get_letter_content();
			$data['states']=$this->increment->get_all_states();
			$data['clients']=$this->increment->get_all_clients();
			$this->load->view('admin/back_end/increment_letter/new_offer_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function get_employee_detail()
	{
		$data=$this->increment->get_employee_detail();
		$joining_date="";
		$contract_date="";
		if($data)
		{
			if($data[0]['joining_date']!="0000-00-00")
			{
				$joining_date=date("d-m-Y",strtotime($data[0]['joining_date']));
			}
			if($data[0]['contract_date']!="0000-00-00")
			{
				$contract_date=date("d-m-Y",strtotime($data[0]['contract_date']));
			}
			if($data[0]['data_status']==1)
			{
				echo $data[0]['client_id']."****".$data[0]['emp_name']."****".$joining_date."****".$contract_date."****".$data[0]['designation']."****".$data[0]['location']."****".$data[0]['department']."****".$data[0]['basic_salary']."****".$data[0]['hra']."****".$data[0]['conveyance']."****".$data[0]['medical_reimbursement']."****".$data[0]['special_allowance']."****".$data[0]['other_allowance']."****".$data[0]['st_bonus']."****".$data[0]['gross_salary']."****".$data[0]['emp_pf']."****".$data[0]['emp_esic']."****".$data[0]['pt']."****".$data[0]['total_deduction']."****".$data[0]['take_home']."****".$data[0]['employer_pf']."****".$data[0]['employer_esic']."****".$data[0]['mediclaim']."****".$data[0]['ctc'];
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
	
	function save_increment_letter()
	{
		$data=$this->increment->save_increment_letter();
		redirect('increment_letter/');
	}
	function view_increment_letter()
	{
		$data['letter_details']=$this->increment->get_increment_letter_details();
		
		$this->load->view('admin/back_end/increment_letter/print_letter',$data);	
	}
	function delete_increment_letter()
	{
		$data1=$this->increment->delete_increment_letter();
		$data=$this->increment->get_all_increment_letters();
		
		$i=1;
		foreach($data as $row)
		{
			$status="";
			echo '
			<tr>
				<td>'.$i.'</td>
				<td>'.$row['employee_id'].'</td>
				<td>'.$row['client_name'].'</td>
				<td>'.$row['emp_name'].'</td>
				<td style="width:15%">'.date("d-m-Y",strtotime($row['date'])).'</td>
				<td>'.$row['phone1'].'</td>
				<td>'.$row['email'].'</td>
				<td class="text-center">
					<div class="list-icons">
						<div class="dropdown">
							<a href="#" class="list-icons-item" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="'.site_url('offer_letter/view_offer_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Offer Letter</a>
								<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_increment_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
							</div>
						</div>
					</div>
				</td>
			</tr>';
			$i++;
		}
	}

	public function download_increment()
	{
		if($this->session->userdata('admin_login'))
		{
			
			if($data=$this->increment->download_increment())
			{
				
					$this->load->library('zip');
			
					$path = 'increment_letter/increment_'.date('Ymdhis');
					if(!is_dir($path)) mkdir($path, 0777, TRUE);

					foreach($data as $row)	
					{
						$mpdf = new \Mpdf\Mpdf();
						$datas['letter_details']=$row;
						$html = $this->load->view('admin/back_end/increment_letter/pdf_increment',$datas,true);
						$mpdf->WriteHTML($html);
						$mpdf->Output($path.'/'.$row['ffi_emp_id']."_".$row['emp_name'].".pdf", 'F');
					}
					$this->zip->read_dir($path,false);
					$download = $this->zip->download($path.'.zip');
			}
			else
			{
				$this->session->set_flashdata('error', 'No datas found');
				redirect('increment_letter');
			}
					
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

// excel Import for ADMS increment LETTER 
public function adms_increment_letter_import()
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
		
			// file path
			$spreadsheet = $reader->load($_FILES['import']['tmp_name']);
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			
			for ($i=2; $i <= count($allDataInSheet); $i++) { 

				$client=empty($allDataInSheet[$i]['B'])? 'null' : $allDataInSheet[$i]['B'];
				$this->db->where("client_name",$client);
				$query=$this->db->get("client_management");
				$q=$query->result_array();
				// print_r($q);
				// exit;
				$client_id=$q[0]['id'];
				
				$date=date("Y-m-d");

				$offer_letter=empty($allDataInSheet[$i]['C'])? 'null' : $allDataInSheet[$i]['C'];
				$offer_letter_type="";
				if($offer_letter=="Format 1")
				{
					$offer_letter_type=1;
				}
				elseif($offer_letter=="Format 2")
				{
					$offer_letter_type=2;
				}
				elseif($offer_letter=="Format 3")
				{
					$offer_letter_type=3;
				}
				elseif($offer_letter=="Udaan")
				{
					$offer_letter_type=4;
				}

				$content1="After reviewing you performance, management has decided to give increment, effective from 01-Sep-2018 & your new CTC will be Rs. 322584/- (PA). This letter serves as your final increment and the copy of the same is being sent to the payroll department for further proceedings.\n";

				$content2="It is a pride for us to have an employee like to you who have taken organization’s success to greater heights. We wish that you will continue to work with the same dedication in future also.";

				$content3="Note: Salary Annexure enclosed.";

				$content=$content1.$content2.$content3;


				
				$data=array(
					"employee_id"			=>	(empty($allDataInSheet[$i]['A'])? 'null' : $allDataInSheet[$i]['A'] ),
					"company_id"			=>	$client_id,
					"date"					=>	$date,
					"offer_letter_type"		=>	$offer_letter_type,
					"basic_salary"			=>	(empty($allDataInSheet[$i]['D'])? 'null' :$allDataInSheet[$i]['D']),
					"hra"					=>	(empty($allDataInSheet[$i]['E'])? 'null' :$allDataInSheet[$i]['E']), 
					"conveyance"			=>	(empty($allDataInSheet[$i]['F'])? 'null' : $allDataInSheet[$i]['F'] ), 
					"medical_reimbursement"	=>	(empty($allDataInSheet[$i]['G'])? 'null' : $allDataInSheet[$i]['G'] ), 
					"special_allowance"		=>	(empty($allDataInSheet[$i]['H'])? 'null' : $allDataInSheet[$i]['H'] ),
					"st_bonus"				=>	(empty($allDataInSheet[$i]['I'])? 'null' : $allDataInSheet[$i]['I'] ), 
					"other_allowance"		=>	(empty($allDataInSheet[$i]['J'])? 'null' : $allDataInSheet[$i]['J'] ), 
					"gross_salary"			=>	(empty($allDataInSheet[$i]['K'])? 'null' : $allDataInSheet[$i]['K'] ),
					"emp_pf"				=>	(empty($allDataInSheet[$i]['L'])? 'null' :$allDataInSheet[$i]['L']),
					"emp_esic"				=>	(empty($allDataInSheet[$i]['M'])? 'null' : $allDataInSheet[$i]['M'] ), 
					"pt"					=>	(empty($allDataInSheet[$i]['N'])? 'null' : $allDataInSheet[$i]['N'] ), 
					"total_deduction"		=>	(empty($allDataInSheet[$i]['O'])? 'null' : $allDataInSheet[$i]['O'] ),
					"take_home"				=>	(empty($allDataInSheet[$i]['P'])? 'null' : $allDataInSheet[$i]['P'] ),
					"employer_pf"			=>	(empty($allDataInSheet[$i]['Q'])? 'null' : $allDataInSheet[$i]['Q'] ),
					"employer_esic"			=>	(empty($allDataInSheet[$i]['R'])? 'null' : $allDataInSheet[$i]['R'] ),
					"mediclaim"				=>	(empty($allDataInSheet[$i]['S'])? 'null' : $allDataInSheet[$i]['S'] ),
					"ctc"					=>	(empty($allDataInSheet[$i]['T'])? 'null' : $allDataInSheet[$i]['T'] ),
					"content"				=>  $content,
				);
				
				
				
				$this->increment->importEmployee_increment_letter($data);

			}

			$this->session->set_flashdata('success', 'Import successfully');
			redirect('increment_letter','refresh');
			
		}
		else{
			
			$this->session->set_flashdata('error', 'Please Choose Valid file formate ');
			
		}
	}	
}

}
