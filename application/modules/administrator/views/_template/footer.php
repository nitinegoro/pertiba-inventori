
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<small class="bigger-30">
							Powered By
							<a class="blue bolder">Teitra Mega</a>
							Application &copy; 2013-2014
						</small>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<!--[if !IE]> -->
		<script src="<?php echo base_url('assets/backend/js/jquery.2.1.1.min.js'); ?>"></script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script src="<?php echo base_url('assets/backend/js/jquery.1.11.1.min.js'); ?>"></script>
		<![endif]-->
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url('assets/backend/js/jquery.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='<?php echo base_url('assets/backend/js/jquery1x.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/backend/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url('assets/backend/js/bootstrap.min.js'); ?>"></script>
		<!-- page specific plugin scripts -->
		<!--[if lte IE 8]>
		  <script src="<?php echo base_url('assets/backend/js/excanvas.min.js'); ?>"></script>
		<![endif]-->
		<script src="<?php echo base_url('assets/backend/js/jquery-ui.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.ui.touch-punch.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.easypiechart.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.sparkline.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.flot.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.flot.pie.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.flot.resize.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.gritter.min.js') ?>"></script>
		<!-- ace scripts -->
		<script src="<?php echo base_url('assets/backend/js/ace-elements.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/ace.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.tableCheckbox.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/validation/js/formValidation.js') ?>"></script>
		<script src="<?php echo base_url('assets/backend/validation/js/framework/bootstrap.js') ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/fuelux.spinner.min.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/backend/codemirror/lib/codemirror.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/backend/codemirror/mode/javascript/javascript.js') ?>"></script>
   		<script src="<?php echo base_url('assets/backend/codemirror/mode/css/css.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.gritter.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/bootbox.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/select2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/bootstrap-editable.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/ace-editable.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.maskedinput.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/bootstrap-wysiwyg.min.js'); ?>"></script>
		<script src="<?php echo base_url('vendor/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
		<script src="<?php echo base_url('vendor/tinymce/filemanager/fancybox/jquery.fancybox.js'); ?>"></script>
		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url('assets/backend/js/jquery.bootstrap-duallistbox.m'); ?>in.js"></script>
		<script src="<?php echo base_url('assets/backend/js/jquery.raty.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/bootstrap-multiselect.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/select2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/typeahead.jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/bootstrap-tag.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/app/backend.js'); ?>"></script>
		<script type="text/javascript"> 
			var base_url 	= '<?php echo site_url('administrator'); ?>';
			var base_path 	= '<?php echo base_url(); ?>';
			var encript 	= '<?php echo $this->session->userdata('random_filemanager_key'); ?>';
		</script>
<?php 
/**
 * Swicth lang validation JS
 **/
if($this->session->userdata('ci_lang')=='indonesia') : ?>
		<script src="<?php echo base_url('assets/backend/validation/js/language/id_ID.js') ?>"></script>
<?php 
endif;
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
