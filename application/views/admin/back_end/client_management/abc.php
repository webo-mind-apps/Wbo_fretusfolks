<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);
?>

<?php 

echo '
<div class="modal-header bg-primary">
						<h6 class="modal-title">'.ucwords($data[0]['emp_name']).'</h6>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Employee Name :</b> <span>'.ucwords($data[0]['emp_name']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Client Name :</b> <span>'.ucwords($data[0]['client_name']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>FFI EMP ID :</b> <span>'.ucwords($data[0]['ffi_emp_id']).'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Client Emp ID :</b> <span>'.ucwords($data[0]['client_emp_id']).'</span></p>
								<p><b>Date of Birth :</b> <span>'.$dob.'</span></p>		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Joining Date :</b> <span>'.$joining_date.'</span></p>
								<p><b>Qualification :</b> <span>'.ucwords($data[0]['qualification']).'</span></p>		
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Contract Date :</b> <span>'.$contract_date.'</span></p>		
								<p><b>Designation :</b> <span>'.ucwords($data[0]['designation']).'</span></p>		
																	
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Email :</b> <span>'.ucwords($data[0]['email']).'</span></p>								
								<p><b>Gender :</b> <span>'.$gender.'</span></p>								
								<p><b>Permanent Address:</b> <span>'.ucwords($data[0]['permanent_address']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 1:</b> <span>'.ucwords($data[0]['phone1']).'</span></p>
								<p><b>Location:</b> <span>'.ucwords($data[0]['location']).'</span></p>
								<p><b>Present Address :</b> <span>'.ucwords($data[0]['present_address']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Phone 2 :</b> <span>'.ucwords($data[0]['phone2']).'</span></p>
								<p><b>Father Name :</b> <span>'.ucwords($data[0]['father_name']).'</span></p>	
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>PAN No :</b> <span>'.ucwords($data[0]['pan_no']).'</span></p>
								<p><b>Bank Name :</b> <span>'.ucwords($data[0]['bank_name']).'</span></p>
								<p><b>UAN Generatted :</b> <span>'.ucwords($data[0]['uan_generatted']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Aadhar No :</b> <span>'.ucwords($data[0]['aadhar_no']).'</span></p>
								<p><b>Bank Account No :</b> <span>'.$data[0]['bank_account_no'].'</span></p>
								<p><b>UAN Type :</b> <span>'.ucwords($data[0]['uan_type']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Driving License No :</b> <span>'.ucwords($data[0]['driving_license_no']).'</span></p>								
								<p><b>Bank IFSC Code :</b> <span>'.$data[0]['bank_ifsc_code'].'</span></p>	
								<p><b>UAN No :</b> <span>'.ucwords($data[0]['uan_no']).'</span></p>
								
							</div>
						</div>
						<hr>
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b><a href="'.base_url().$data[0]['pan_path'].'" target="_blank"><i class="fa fa-book"></i> Pan Card</a></b></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b><a href="'.base_url().$data[0]['aadhar_path'].'" target="_blank"><i class="fa fa-book"></i> Aadhar Card</a></b></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b><a href="'.base_url().$data[0]['driving_license_path'].'" target="_blank"><i class="fa fa-book"></i> Driving License</a></b></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-primary" data-dismiss="modal">Close</button>';
						
					</div>
