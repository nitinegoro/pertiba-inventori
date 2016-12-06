						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<small class="bigger-30">
							Copyright &copy; <?php echo date('Y') ?>
							<span class="blue bolder">STIE Pertiba</span> All Rights reserved
						</small>
					</div>
				</div>
			</div>

			<a href="#" class="go-top btn btn-white btn-round"><i class="fa fa-hand-o-up"></i> Keatas</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js'); ?>"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		<!-- ace scripts -->
		<script src="<?php echo base_url('assets/js/ace-elements.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/ace.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.gritter.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery-ui.custom.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.ui.touch-punch.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.tableCheckbox.js'); ?>"></script>
		<script src="<?php echo base_url('assets/validation/js/formValidation.js') ?>"></script>
		<script src="<?php echo base_url('assets/validation/js/framework/bootstrap.js') ?>"></script>
		<script src="<?php echo base_url('assets/validation/js/language/id_ID.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/daterangepicker.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/pass-strength/src/i18n.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/pass-strength/dist/pwstrength-bootstrap.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/pass-strength/pwstrength.js'); ?>"></script>

		<script src="<?php echo base_url('assets/app/backend.js'); ?>"></script>
		<script type="text/javascript"> 
			var base_url 	= '<?php echo site_url(); ?>';
			var base_path 	= '<?php echo base_url(); ?>';
			var current_url = '<?php echo current_url(); ?>';
		</script>
<?php 

/**
 * Load js from loader core
 *
 * @return CI_OUTPUT
 **/
if(isset($js) ==! FALSE) : foreach($js as $file) :  ?>
		<script src="<?php echo $file; ?>"></script>
<?php endforeach; endif; ?>
	</body>
</html>
