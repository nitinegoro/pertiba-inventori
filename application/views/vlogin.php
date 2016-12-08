<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login - Sistem Inventaris</title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome & animate -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.2.0/css/font-awesome.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/fonts/fonts.googleapis.com.css'); ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css'); ?>" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css'); ?>" />
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

	<body class="login-layout blur-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<span class="red">Sistem</span>
									<span class="white" id="id-text2">Inventaris</span>
								</h1>
								<h4 class="blue" id="id-company-text">STIE Pertiba Pangkalpinang</h4>
							</div>

							<div class="space-6"></div>
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border animated <?php echo ($this->session->flashdata('alert')) ? 'shake' : ''; ?>">
									<div class="widget-body">
										<div class="widget-main">
											<?php echo $this->session->flashdata('alert'); ?>
											<div class="space-6"></div>
											<form action="<?php echo site_url('login?from_url='.$this->input->get('from_url')); ?>" method="post">
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

									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
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
		<script src="<?php echo base_url('assets/js/jquery.2.1.1.min.js'); ?>"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url('assets/js/jquery.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			
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
			 $('input[name="username"]').focus();
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
