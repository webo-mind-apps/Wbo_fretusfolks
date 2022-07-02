	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="<?php echo site_url('home/dashboard');?>" class="d-inline-block">
				<img src="<?php echo base_url();?>admin_assets/assets/images/logo-in.png" alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>

				
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
				<span class="badge bg-success">Online</span>
			</span>

			<ul class="navbar-nav">
				
				

				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url();?>admin_assets/assets/images/logo.png" class="rounded-circle" alt="">
						<span><?php echo ucwords($this->session->userdata('admin_name'));?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?php echo site_url('home/logout');?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>