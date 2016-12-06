<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login - Web Administrator</title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/font-awesome/4.2.0/css/font-awesome.min.css'); ?>" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/fonts/fonts.googleapis.com.css'); ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ace.min.css'); ?>" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ace-rtl.min.css'); ?>" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<style>
			.text-red { color: red; }
		</style>
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<span class="red">Web</span>
									<span class="white" id="id-text2">Administrator</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; Company Name</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<?php echo $this->session->flashdata('alert'); ?>
											<div class="space-6"></div>
											<form action="<?php echo site_url('administrator/adm_auth?from_url='.$this->input->get('from_url')); ?>" method="post">
												<fieldset>
													<label for="username">Username :</label>
													<label class="block clearfix has-feedback" for="username">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" />
															<i class="ace-icon fa fa-user"></i>
															<?php echo form_error('username', '<small class="text-red">', '</small>'); ?>
														</span>
													</label>
													<label for="password">Password :</label>
													<label class="block clearfix" for="password">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" id="login-password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
														<?php echo form_error('password', '<small class="text-red">', '</small>'); ?>
													</label>
 														<label class="inline">
															<input type="checkbox" class="ace" onclick="showPassword()" />
															<span class="lbl"> Show password</span>
														</label>
													<div class="space"></div>

													<div class="clearfix">
														<button type="submit" class="btn-block pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->
							</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url('assets/backend/js/jquery.2.1.1.min.js'); ?>"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url('assets/backend/js/jquery.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/backend/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			function showPassword() {
			    var key_attr = $('#login-password').attr('type');
			    if(key_attr != 'text') {
					$('.checkbox').addClass('show');
					$('#login-password').attr('type', 'text');
			    } else {
					$('.checkbox').removeClass('show');
					$('#login-password').attr('type', 'password');
			    }
			}
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });

			});
		</script>
	</body>
</html>
