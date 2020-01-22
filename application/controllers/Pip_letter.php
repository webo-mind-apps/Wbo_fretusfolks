<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Pip_letter extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Pip_db','pip');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['pip_letter']=$this->pip->get_all_pip_letter();
			$this->load->view('admin/back_end/pip_letter/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_pip_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$data['employee']=$this->pip->get_all_employee();
			$this->load->view('admin/back_end/pip_letter/new_pip_letter',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_pip_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="adms";
			$id=$this->uri->segment(3);
			$data['pip_info']=$this->pip->get_pip_info($id);
			$this->load->view('admin/back_end/pip_letter/edit_pip_letter',$data);
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
			$data=$this->pip->save_letter();
			redirect('pip_letter/');
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
			$data=$this->pip->update_letter();
			redirect('pip_letter/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_pip_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data1=$this->pip->delete_pip_letter();
			$data=$this->pip->get_all_pip_letter();
			$i=1;
				foreach($data as $row)
				{
					echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['from_name'].'</td>
						<td>'.$row['emp_name'].'</td>
						<td>'.$row['emp_id'].'</td>
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
										<a href="'.site_url('pip_letter/view_pip_letter/'.$row['id']).'" target="_blank" class="dropdown-item"><i class="fa fa-eye"></i> View Details</a>
										<a href="'.site_url('pip_letter/edit_pip_letter/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
										<a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_pip_letter(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>';
					$i++;
				}
		}
		else
		{
			redirect('home/index');
		}
	}
	function get_emp_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->pip->get_emp_details();
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
		else
		{
			
		}
	}
	function view_pip_letter()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['pip']=$this->pip->view_pip_letter();
			$this->load->view('admin/back_end/pip_letter/print_pip',$data);
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
