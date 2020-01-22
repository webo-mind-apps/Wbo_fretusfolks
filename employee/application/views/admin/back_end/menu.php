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
								<div class="media-title font-weight-semibold"><?php echo ucwords($this->session->userdata('emp_name'));?></div>
								 
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
						
						
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('offer_letter/');?>" target="_blank" class="nav-link <?php if($active_menu=="client") { echo "active"; } ?>"><i class="icon-stack2"></i> <span>Offer Letter</span></a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('payslips/');?>" class="nav-link <?php if($active_menu=="payslips") { echo "active"; } ?>"><i class="icon-stack2"></i> <span>Payslips</span></a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('increment_letter/');?>" class="nav-link <?php if($active_menu=="increment") { echo "active"; } ?>" target="_blank"><i class="icon-stack2"></i> <span>Increment Letter</span></a>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('termination_letter/');?>" target="_blank" class="nav-link <?php if($active_menu=="termination") { echo "active"; } ?>"><i class="icon-stack2"></i> <span>Termination Letter</span></a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('show_cause/');?>" target="_blank" class="nav-link <?php if($active_menu=="termination") { echo "active"; } ?>"><i class="icon-stack2"></i> <span>Show Cause Letter</span></a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="<?php echo site_url('warning_letter/');?>" class="nav-link <?php if($active_menu=="termination") { echo "active"; } ?>"><i class="icon-stack2"></i> <span>Warning Letter</span></a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($active_menu=="settings") { echo "active"; } ?>"><i class="icon-tree5"></i>Settings</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="<?php echo site_url('home/reset_password');?>"  class="nav-link">Change Password</a></li>
							</ul>
							
						</li>
						<!-- /page kits -->

					</ul>
				</div>
				<!-- /main navigation -->

			</div><!-- /sidebar content -->
			
		</div>