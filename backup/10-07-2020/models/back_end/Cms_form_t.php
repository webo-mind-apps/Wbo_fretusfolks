<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Cms_form_t extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Cms_form_t_db','cms_form_t');
					$this->load->library("pagination");
					$this->load->library('form_validation');
        }
	public function index()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data['active_menu']="cms";
			$data['clients']=$this->cms_form_t->get_all_clients();
			$this->load->view('admin/back_end/cms_form_t/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_cms_form_t()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data['active_menu']="cms";
			$data['clients']=$this->cms_form_t->get_all_clients();
			$data['state']=$this->cms_form_t->get_all_states();
			$this->load->view('admin/back_end/cms_form_t/new_cms_form_t',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function add_doc_div()
	{
		
		$counter=$this->input->post('counter');
		$counter++;
			
		echo '
				<tr id="row_'.$counter.'">
					<td>
						<select name="month[]" id="month_'.$counter.'" class="form-control" required>
								<option value="">Select Month</option>';
								
									for($i=1;$i<=12;$i++)
									{
										echo '<option value="'.$i.'">'.date("F",strtotime("12-$i-2017")).'</option>';
									}
				echo '
						</select>	
					</td>
					<td>
						<select name="year[]" id="year_'.$counter.'" class="form-control" required>
							<option value="">Select Year</option>';
							
								for($i=2018;$i<=date("Y");$i++)
								{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
				echo '			
						</select>
					</td>							
					<td>
							<input type="file" name="file[]" id="file_'.$counter.'" required class="form-control">
					</td>
						<td><a href="javascript:void(0);" id="'.$counter.'" onclick="remove_cycle_div(this.id)"><i class="fa fa-times-circle" aria-hidden="true"></i></i></td>
				</tr>';
		
	}
	public function save_form_t()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data=$this->cms_form_t->save_form_t();
			redirect('cms_form_t/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_form_t()
	{
		$data1=$this->cms_form_t->delete_form_t();
		$data=$this->cms_form_t->search_cms_form_t();
		if($data)
		{
			$i=1;
			foreach($data as $row)
			{
				$file_name=substr($row['path'],19);
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['state_name'].'</td>
						<td>'.date("F",strtotime("01-".$row['month']."-2018")).'</td>
						<td>'.$row['year'].'</td>
						<td><a href="'.base_url().$row['path'].'"  target="_blank"><i class="fa-fa-file"></i> '.$file_name.'</a></td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="javascrip:void(0);" id="'.$row['id'].'" onclick="delete_form_t(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
				$i++;
			}
		}
	}
	public function search_cms_form_t()
	{
		$data=$this->cms_form_t->search_cms_form_t();
		if($data)
		{
			
			$i=1;
			foreach($data as $row)
			{
				$file_name=substr($row['path'],19);
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['state_name'].'</td>
						<td>'.date("F",strtotime("01-".$row['month']."-2018")).'</td>
						<td>'.$row['year'].'</td>
						<td><a href="'.base_url().$row['path'].'"  target="_blank"><i class="fa-fa-file"></i>'.$file_name.'</a></td>
						<td class="text-center">';
						if($this->session->userdata('admin_type')==0)
						{
							echo '
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="javascrip:void(0);" id="'.$row['id'].'" onclick="delete_form_t(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>';
						}
				echo '	</td>
					</tr>
				';
				$i++;
			}
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
