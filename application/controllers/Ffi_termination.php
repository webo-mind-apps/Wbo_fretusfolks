<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Ffi_termination extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Ffi_termination_db','termination');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="fhrms";
			$data['pip_letter']=$this->termination->get_all_termination_letter();
			$this->load->view('admin/back_end/ffi_termination_letter/index',$data);
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
			$data['active_menu']="fhrms";
			$data['employee']=$this->termination->get_all_employee();
			$data['letter_content']=$this->termination->get_letter_content();
			$this->load->view('admin/back_end/ffi_termination_letter/new_termination_letter',$data);
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
			$data['active_menu']="fhrms";
			$id=$this->uri->segment(3);
			$data['pip_info']=$this->termination->get_termination_info($id);
			$this->load->view('admin/back_end/ffi_termination_letter/edit_termination_letter',$data);
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
			redirect('ffi_termination/');
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
			redirect('ffi_termination/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_ffi_pip_letter()
	{
		$data1=$this->termination->delete_ffi_pip_letter();
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
											<a href="'.site_url('ffi_termination/view_termination_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
											<a href="'.site_url('ffi_termination/edit_termination_letter/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
											<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_ffi_pip_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
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
			$this->load->view('admin/back_end/ffi_termination_letter/print_termination',$data);
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
}
