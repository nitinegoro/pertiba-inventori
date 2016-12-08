	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="" class="navbar-brand">
						<small>
							<img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="">
						</small>
					</a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>
					</button>

					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
						<li class="transparent dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i> <span class="badge badge-danger"><?php echo count($this->app->notifications()) ?></span>
							</a>

							<div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<div class="tabbable">
									<ul class="nav nav-tabs">
										<li>
											<a data-toggle="active tab" href="#navbar-messages">
												Pengajuan anda
												<span class="badge badge-danger"><?php echo count($this->app->notifications()) ?></span>
											</a>
										</li>
									</ul><!-- .nav-tabs -->
	<?php  
	// jika tidak sama dengan kosong
	if(count($this->app->notifications()) != FALSE) :
	?>
									<div class="tab-content">
										<div id="navbar-messages" class="tab-pane active">
											<ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
												<li class="dropdown-content">
													<ul class="dropdown-menu dropdown-navbar">
						<?php  
						/* Start Loop */
						foreach($this->app->notifications() as $row) :
						?>
														<li>
															<a href="#">
																	<span class="msg-title">
																		<span class="blue"><?php echo $row->full_name; ?>:</span>
																		<?php echo $row->notif_content; ?>
																	</span><br>
																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span data-livestamp="<?php echo $row->notif_date; ?>"></span>
																	</span>
															</a>
														</li>
						<?php  
						/* End Loop */
						endforeach;
						?>
													</ul>
												</li>
												<li class="dropdown-footer">
													<a href="#"  data-toggle="modal" data-target='#modal-id'>
														Lihat Selengkapnya..
														<i class="ace-icon fa fa-arrow-right"></i>
													</a>
												</li>
											</ul>
										</div><!-- /.tab-pane -->
									</div><!-- /.tab-content -->
	<?php  
	endif;
	?>
								</div><!-- /.tabbable -->
							</div><!-- /.dropdown-menu -->
						</li>

						<li class="light-blue dropdown-modal user-min">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="bigger-130"><i class="fa fa-user"></i></span>
								<span class="user-info">
									<?php echo $this->session->userdata('user')->full_name; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo site_url('user/account') ?>">
										<i class="ace-icon fa fa-cog"></i>
										Pengaturan
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('login/signout?from_url=' . current_url()); ?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>

				<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
					<ul class="nav navbar-nav">

					</ul>
				</nav>
			</div><!-- /.navbar-container -->
		</div>
