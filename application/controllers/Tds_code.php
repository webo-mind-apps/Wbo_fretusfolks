<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Tds_code extends CI_Controller 
{
		public function __construct()
        {
				parent::__construct();
				($this->session->userdata('admin_login'))?'': redirect('home/index');
					$this->load->helper('url');
					$this->load->model('back_end/Tds_code_db','tds_code');
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['active_menu']="ffi_masters";
			$data['all_tds']=$this->tds_code->get_all_tds();
			$this->load->view('admin/back_end/tds_code/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function save_tds()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->tds_code->save_tds();
			redirect('tds_code/');
		}
		else
		{
			redirect('home/');
		}
	}
	public function delete_tds_code()
	{
		$data1=$this->tds_code->delete_tds_code();
		$data=$this->tds_code->get_all_tds();
		$i=1;
			foreach($data as $row)
			{
				$status="";
				if($row['status']==0)
				{
					$status="checked";
				}
				echo '
					<tr>
						<td>'.$i.'</td>
						<td style="display:none">'.$row['code'].'</td>
						<td style="display:none">'.$row['code'].'</td>
						<td><input type="text" class="form-control" name="code" id="code_'.$row['id'].'" value="'.$row['code'].'" onchange="change_status(this.id);"></td>
						<td><label class="switch"><input type="checkbox" id="status_'.$row['id'].'" '.$status.' onchange="change_status(this.id);"><span class="slider round"></span></label>
						</td>
						<td><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_tds_code(this.id);"><i class="fa fa-trash"></i> Delete</a></td>
					</tr>';
				$i++;
			}
	}
	public function change_code_details()
	{
		$data=$this->tds_code->change_code_details();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
