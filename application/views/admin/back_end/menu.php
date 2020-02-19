<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="<?php echo base_url();?>admin_assets/assets/images/logo.png" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold"><?php echo ucwords($this->session->userdata('admin_name'));?></div>
								<div class="font-size-xs opacity-50">
									 
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="<?php echo site_url('home/dashboard');?>" class="nav-link <?php if($active_menu=="dashboard") { echo "active"; } ?>">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						
				<?php 
					if($this->session->userdata('admin_type')==0)
					{
						
				?>
						<li class="nav-item nav-item-submenu">
							<a href="" class="nav-link <?php if($active_menu=="ffi_masters") { echo "active"; } ?>">
								<i class="icon-stack2"></i> <span>FFI Masters</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
									<li class="nav-item">
										<a href="<?php echo site_url('tds_code/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>TDS Code</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('letter_content/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Letter Content</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('user_master/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>User Masters</a>
									</li>
									<!-- <li class="nav-item">
										<a href="<?php echo site_url('increment_letter/letter_content');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Increment Master</a>
									</li> -->
								</ul>
						</li>
				<?php 
					}
					if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1)
					{
					
				?>
						<li class="nav-item nav-item-submenu">
							<a href="javascript:void(0);" class="nav-link <?php if($active_menu=="client") { echo "active"; } ?>"><i class="icon-stack2"></i> <span>CDMS</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item">
									<a href="<?php echo site_url('client_management/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CDMS</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('reports_cdms/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CDMS Reports</a>
								</li>
							</ul>
							
						</li>
				<?php 
					}
					if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==2 || $this->session->userdata('admin_type')==4)
					{
					
				?>
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('candidate_system/');?>" class="nav-link <?php if($active_menu=="adms") { echo "active"; } ?>">
								<i class="icon-stack2"></i> <span>ADMS</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
									
									<?php 
										
										if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==4)
										{
									
									?>
									<li class="nav-item"><a href="<?php echo site_url('candidate_system/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CFIS</a></li>
									
										<?php
										
										}
										if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==2)
										{
									?>
									
									<?php if($this->session->userdata('admin_type')==2)
									{
										?>
										<li class="nav-item">
											<a href="<?php echo site_url('reports_cfis/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CFIS Reports</a>
										</li>
									 <?php
									}
									 ?>
									
									<li class="nav-item"><a href="<?php echo site_url('dcs_approval/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>DCS Approval</a></li>
									<li class="nav-item"><a href="<?php echo site_url('backend_team/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>DCS</a></li>
									<li class="nav-item">
										<a href="<?php echo site_url('dcs_report/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>DCS Reports</a>
									</li>
									<li class="nav-item"><a href="<?php echo site_url('offer_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Offer Letter</a></li>
									<li class="nav-item"><a href="<?php echo site_url('increment_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Increment Letter</a></li>
									<li class="nav-item"><a href="<?php echo site_url('payslips/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Payslips</a></li>
									<li class="nav-item"><a href="<?php echo site_url('pip_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>PIP Letter</a></li>
									<li class="nav-item">
										<a href="<?php echo site_url('termination_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Termination Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('show_cause/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Show Cause Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('warning_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Warning Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('bulk_update/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Bulk Update</a>
									</li>
									<?php
										}
									?>
								</ul>
						</li>
						<?php
							if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==2)
							{
						?>
						
						<?php
							}
					}
					if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==3)
					{
					
				?>
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('fhrms/');?>" class="nav-link <?php if($active_menu=="fhrms") { echo "active"; } ?>">
								<i class="icon-stack2"></i> <span>FHRMS</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
									<li class="nav-item">
										<a href="<?php echo site_url('fhrms/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FHRMS</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('reports_fhrms/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FHRMS Reports</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('fhrms/ffi_offer_letter');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Offer Letter</a>
									</li>
									<li class="nav-item"><a href="<?php echo site_url('ffi_increment_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Increment Letter</a></li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffi_payslips/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Payslips</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffi_pip_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI PIP Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffi_termination/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Termination Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffi_show_cause/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Show Cause Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffi_warning_letter/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Warning Letter</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('fhrms/todays_dob');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Birthday Details</a>
									</li>
								</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="" class="nav-link <?php if($active_menu=="cms") { echo "active"; } ?>">
								<i class="icon-stack2"></i> <span>CMS</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
									<li class="nav-item">
										<a href="<?php echo site_url('cms_esic/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>ESIC Challan</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('cms_pf/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>PF Challan</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('cms_pt/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>PT Challan</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('cms_lwf/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>LWF Challan</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('cms_form_t/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Form-T Register</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('cms_labour/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Labour Notice</a>
									</li>
								</ul>
						</li>
				<?php 
					}
					if($this->session->userdata('admin_type')==0 || $this->session->userdata('admin_type')==1)
					{
					
				?>
						<li class="nav-item nav-item-submenu">
							<a href="" class="nav-link <?php if($active_menu=="fcms") { echo "active"; } ?>">
								<i class="icon-stack2"></i> <span>FCMS</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
									<li class="nav-item">
										<a href="<?php echo site_url('fcms/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CIMS</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('reports_cims/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CIMS Reports</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('payments/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Receivables</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('reports_payments/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Receivables Reports</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('reports_tds/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>TDS Reports</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffcm/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFCM</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('reports_ffcm/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFCM Reports</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo site_url('ffi_assets/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFI Asstes</a>
									</li>
								</ul>
						</li>
				<?php 
					}
					if($this->session->userdata('admin_type')==5)
					{
				?>
					<li class="nav-item nav-item-submenu">
						<a href="" class="nav-link <?php if($active_menu=="reports") { echo "active"; } ?>">
							<i class="icon-stack2"></i> <span>Reports</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item">
									<a href="<?php echo site_url('reports_cdms/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CDMS Reports</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('reports_cims/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>CIMS Reports</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('reports_payments/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>Payment Reports</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('reports_ffcm/');?>" class="nav-link"><i class="fa fa-angle-right" aria-hidden="true"></i>FFCM Reports</a>
								</li>
							</ul>
					<li>
				<?php
					}
				?>
						<!-- /page kits -->
					</ul>
				</div>
				<!-- /main navigation -->

			</div><!-- /sidebar content -->
			
		</div>