<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Licensing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('admin_login'))?'': redirect('home/index');
		$this->load->helper('url');
		$this->load->model('back_end/Licensing_db', 'licensing');
		$this->load->library("pagination");
	}
	
	public function get_all_data() //created for implementing data tables
	{
		if ($this->session->userdata('admin_login')) {
			$folder_id=$this->input->post('folder_id');
			$fetch_data = $this->licensing->make_datatables($folder_id);

			$data = array();
			$status = '<span class="badge bg-blue">Completed</span>';
			$i = 1;
			foreach ($fetch_data as $row) {
				$sub_array   = array();
				$sub_array[] = $i++;
				$sub_array[] = $row->client_name;
				$sub_array[] = $row->file_name;
				$sub_array[] = '
				<a href="'.base_url().$row->file_name.'" id="' . $row->id . '" target="_blank" class="dropdown-item view-click"><i class="fa fa-eye"></i></a>
					 ';
					//  $sub_array[] = '
					//  <a href="javascript:void(0)" id=' . $row->id . ' class="dropdown-item download-click"><i class="fa fa-download"></i></a>
					//  ';
					
					 $sub_array[] = '
					 <a href="javascript:void(0)" id=' . $row->id . ' class="dropdown-item delete-click"><i class="fa fa-trash"></i></a>
					 ';
					
					
				
				$data[] = $sub_array;
			}
			$output = array(
				"draw"                =>     intval($_POST["draw"]),
				"recordsTotal"        =>     $this->licensing->get_all_data($folder_id),
				"recordsFiltered"     =>     $this->licensing->get_filtered_data($folder_id),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			redirect('home/index');
		}
	}

	
	public function create_folder()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "licensing";
			$data['company'] = $this->licensing->all_company();
			$this->load->view('admin/back_end/licensing/create_folder',$data);
		}
	}
	public function save_folder()
	{
		if ($this->session->userdata('admin_login')) {
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('folder_name', 'Folder Name', 'trim|required|max_length[50]|is_unique[client_folder.folder_name]',array('is_unique'=>'This folder name already exist!'));
		
			if ($this->form_validation->run() ==  TRUE):
				$data=array(
					'client_id' 	=> $this->input->post('company_name'),
					'folder_name' 	=> $this->input->post('folder_name'),
					'created_by' 	=> $this->session->userdata('admin_id'),
				);
				$result = $this->licensing->save_folder($data);
				if($result==true):
					$folder='IGYJSDLKDSSADJKAJIK/all_client/'.$data['folder_name'];
					// if (!is_dir($folder)) mkdir($folder, 0777, TRUE);
					$this->session->set_tempdata('folder-success','Folder created successfully', 5);
					redirect('create-folder');
				else:
					$this->session->set_tempdata('folder-failed',"Something went wrong try again!", 5);
					redirect('user_master/edit_user_master/'.$id);
				endif;
			else:
				$msg=validation_errors();
				$this->session->set_tempdata('folder-failed',$msg, 5);
				redirect('create-folder');
			endif;
		}
	}

	public function upload_file()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "licensing";
			$data['company'] = $this->licensing->all_company();
			$this->load->view('admin/back_end/licensing/upload_file',$data);
		}
	}
	public function get_folder()
	{
		if ($this->session->userdata('admin_login')) {
			$data['active_menu'] = "licensing";
			$company=$this->input->post('company');
			$data= $this->licensing->get_folder($company);
			$option='<option vlaue="">Select Folder</option>';
			foreach($data as $row){
				$option.='<option value="'.$row['id'].'-'.$row['folder_name'].'">'.$row['folder_name'].'</option>';
			}
			echo $option;
		}
	}
	public function save_file()
	{
		if ($this->session->userdata('admin_login')) {
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('folder_name', 'Folder Name', 'trim|required|max_length[50]');
			if (empty($_FILES['company_file']['name']))
			{
				$this->form_validation->set_rules('company_file', 'File', 'required');
			}
		
			if ($this->form_validation->run() ==  TRUE):
				$data=array(
					'folder_id' 	=> $this->input->post('folder_name'),
					'client_id' 	=> $this->input->post('company_name'),
					'created_by' 	=> $this->session->userdata('admin_id'),
				);
				$count = count($_FILES['company_file']['name']);
			  	$error="";
				for($i=0;$i<$count;$i++){
			  
				  if(!empty($_FILES['company_file']['name'][$i])){
						$rftype = explode('/',mime_content_type($_FILES["company_file"]['tmp_name'][$i]))[1];
						$type = array("pdf");
						if(in_array($rftype, $type)){
							$folder=explode("-",$this->input->post('folder_name'));
							$path='IGYJSDLKDSSADJKAJIK/all_client/'.$folder[1].'/';
							if (!is_dir($path)) mkdir($path, 0777, TRUE);
							$_FILES['file']['name'] = $_FILES['company_file']['name'][$i];
							$_FILES['file']['type'] = $_FILES['company_file']['type'][$i];
							$_FILES['file']['tmp_name'] = $_FILES['company_file']['tmp_name'][$i];
							$_FILES['file']['error'] = $_FILES['company_file']['error'][$i];
							$_FILES['file']['size'] = $_FILES['company_file']['size'][$i];
							$rand_no=date("is");
							$new_name = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
							$config['upload_path'] = $path; 
							$config['allowed_types'] = 'pdf';
							$config['max_size'] = '5000';
							$config['file_name'] =$new_name;
					
							$this->load->library('upload',$config); 
							$this->upload->initialize($config);
							if($this->upload->do_upload('file')){
								$data['file_name'] = $path.$new_name;
								$this->licensing->save_file($data);
							}
						}else{
							$error.="Please upload the correct file formate(File Name:".$_FILES["company_file"]['name'][$i].")!<br/>";
						}
					}
			 
				}
				if(!empty($error)){
					$this->session->set_tempdata('file-failed',$error, 5);
					redirect('upload-file');
				}else{
					$this->session->set_tempdata('file-success','File uploaded successfully!', 5);
					redirect('upload-file');
				}
			else:
				$msg=validation_errors();
				$this->session->set_tempdata('folder-failed',$msg, 5);
				redirect('upload-file');
			endif;
		}
	}
	public function delete_file()
	{
		if ($this->session->userdata('admin_login')) {
			$id=$this->input->post('id');
			$data['active_menu'] = "licensing";
			if($this->licensing->delete_file($id)){
				echo "Deleted successfully!";
			}else{
				echo "File not deleted";
			}
		}
	}
}
