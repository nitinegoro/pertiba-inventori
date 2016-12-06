<body class="no-skin">
	<div id="navbar" class="navbar navbar-default">
		<script type="text/javascript">
			try{ace.settings.check('navbar' , 'fixed')}catch(e){}
		</script>

		<div class="navbar-container" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" title="<?php echo lang('toggle_sidebar'); ?>" data-rel="tooltip" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only"><?php echo lang('toggle_sidebar'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="<?php echo site_url('administrator') ?>" class="navbar-brand"><!-- <small></small> --></a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="green" data-rel="tooltip" title="<?php echo lang('new_messages') ?>">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
							<span class="badge badge-success">5</span>
						</a>
						<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
							<li class="dropdown-header"><i class="ace-icon fa fa-envelope-o"></i>5 <?php echo lang('new_messages') ?></li>
<?php /* start loop */ ?>
							<li class="dropdown-content">
								<ul class="dropdown-menu dropdown-navbar">
									<li><a href="#" class="clearfix">
											<img src="<?php echo base_url('assets/backend/avatars/avatar.png'); ?>" class="msg-photo" alt="Alex's Avatar" />
											<span class="msg-body">
												<span class="msg-title">
													<span class="blue">Alex:</span>
													Ciao sociis natoque penatibus et auctor ...
												</span>

												<span class="msg-time">
													<i class="ace-icon fa fa-clock-o"></i>
													<span>a moment ago</span>
												</span>
											</span>
									</a></li>

								</ul>
							</li>
<?php /* end Loop*/ ?>
							<li class="dropdown-footer">
								<a href="">
									<?php echo lang('see_all_messages'); ?>
									<i class="ace-icon fa fa-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li>

					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="<?php echo base_url('assets/backend/avatars/user.jpg'); ?>" alt="Jason's Photo" />
							<span class="user-info">
								<small><?php echo lang('welcome'); ?></small> Jason
							</span>
							<i class="ace-icon fa fa-caret-down"></i>
						</a>
						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="<?php echo site_url('administrator/account') ?>"><i class="ace-icon fa fa-user"></i><?php echo lang('account'); ?></a>
							</li>
							<li>
								<a href="<?php echo site_url('administrator/account/security') ?>"><i class="ace-icon fa fa-key"></i><?php echo lang('user_change_password'); ?></a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="<?php echo site_url('administrator/adm_auth/signout?from_url=' . current_url()) ?>"><i class="ace-icon fa fa-power-off"></i><?php echo lang('signout'); ?></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>