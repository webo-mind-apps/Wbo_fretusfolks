<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Cms_labour extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Cms_labour_db','cms_labour');
					$this->load->library("pagination");
        }
	public function index()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data['active_menu']="cms";
			$data['clients']=$this->cms_labour->get_all_clients();
			$this->load->view('admin/back_end/cms_labour/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function new_cms_labour()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data['active_menu']="cms";
			$data['clients']=$this->cms_labour->get_all_clients();
			$data['state']=$this->cms_labour->get_all_states();
			$this->load->view('admin/back_end/cms_labour/new_labour',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function edit_cms_labour()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data['active_menu']="cms";
			$data['cms_details']=$this->cms_labour->get_cms_labour_details();
			$data['clients']=$this->cms_labour->get_all_clients();
			$data['state']=$this->cms_labour->get_all_states();
			$this->load->view('admin/back_end/cms_labour/edit_labour',$data);
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
	public function save_labour()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data=$this->cms_labour->save_labour();
			redirect('cms_labour/');
		}
		else
		{
			redirect('home/index');
		}
	}
	public function update_labour()
	{
		if(($this->session->userdata('admin_login')) && ($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3))
		{
			$data=$this->cms_labour->update_labour();
			redirect('cms_labour/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_cms_labour()
	{
		$data1=$this->cms_labour->delete_cms_labour();
		$data=$this->cms_labour->search_cms_labour();
		if($data)
		{
			$i=1;
			foreach($data as $row)
			{
				$notice_date="";
				$closure_date="";
				$status="";
				if($row['notice_received_date']!="0000-00-00")
				{
					$notice_date=date("d-m-Y",strtotime($row['notice_received_date']));
				}
				if($row['closure_date']!="0000-00-00")
				{
					$closure_date=date("d-m-Y",strtotime($row['closure_date']));
				}
				if($row['status']==0)
				{
					$status='<span class="badge bg-danger">Pending</span>';
				}
				if($row['status']==1)
				{
					$status='<span class="badge bg-blue">Completed</span>';
				}
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['state_name'].'</td>
						<td>'.$row['location'].'</td>
						<td>'.$notice_date.'</td>
						<td><a href="'.base_url().$row['notice_document'].'"><i class="fa fa-file" target="_blank"></i> Notice Document</a></td>
						<td><a href="'.base_url().$row['closure_document'].'"><i class="fa fa-file" target="_blank"></i> Closure Document</a></td>
						<td>'.$closure_date.'</td>
						<td>'.$status.'</td>
						<td class="text-center">
							<div class="list-icons">
								<div class="dropdown">
									<a href="#" class="list-icons-item" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="'.site_url('cms_labour/edit_cms_labour/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
										<a href="javascrip:void(0);" id="'.$row['id'].'" onclick="delete_cms_labour(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
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
	public function search_cms_labour()
	{
		$data=$this->cms_labour->search_cms_labour();
		if($data)
		{
			$i=1;
			foreach($data as $row)
			{
				$notice_date="";
				$closure_date="";
				$status="";
				if($row['notice_received_date']!="0000-00-00")
				{
					$notice_date=date("d-m-Y",strtotime($row['notice_received_date']));
				}
				if($row['closure_date']!="0000-00-00")
				{
					$closure_date=date("d-m-Y",strtotime($row['closure_date']));
				}
				if($row['status']==0)
				{
					$status='<span class="badge bg-danger">Pending</span>';
				}
				if($row['status']==1)
				{
					$status='<span class="badge bg-blue">Completed</span>';
				}
				echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['client_name'].'</td>
						<td>'.$row['state_name'].'</td>
						<td>'.$row['location'].'</td>
						<td>'.$notice_date.'</td>
						<td><a href="'.base_url().$row['notice_document'].'"><i class="fa fa-file" target="_blank"></i> Notice Document</a></td>
						<td><a href="'.base_url().$row['closure_document'].'"><i class="fa fa-file" target="_blank"></i> Closure Document</a></td>
						<td>'.$closure_date.'</td>
						<td>'.$status.'</td>
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
										<a href="'.site_url('cms_labour/edit_cms_labour/'.$row['id']).'" class="dropdown-item"><i class="fa fa-pencil"></i> Edit Details</a>
										<a href="javascrip:void(0);" id="'.$row['id'].'" onclick="delete_cms_labour(this.id);" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
									</div>
								</div>
							</div>';
						}
		echo '			</td>
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
