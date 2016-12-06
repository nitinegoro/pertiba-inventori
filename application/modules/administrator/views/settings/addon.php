<div class="row">
	<div class="col-md-12">
<?php echo form_open(site_url('administrator/settings/set/addon'), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-2" for="option[google_analytic]"> <?php echo lang('field_google_analytics') ?> </label>
				<div class="col-sm-3">
					<input type="text" name="option[google_analytic]" class="form-control" placeholder="UA-68393715-2" value="<?php echo $this->option->get('google_analytic'); ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="phone"> <?php echo lang('field_custom_css') ?> </label>
				<div class="col-sm-9">
	          		<textarea name="css" class="form-control" style="height: 300px;" id="custom-css">
	          		<?php echo $custom_css; ?>
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="phone"> <?php echo lang('field_custom_javascript') ?> </label>
				<div class="col-sm-9">
	          		<textarea name="js" class="form-control" style="height: 300px;" id="custom-js">
	          		<?php echo $custom_js; ?>
					</textarea>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i> <?php echo lang('btn_setting_save'); ?>
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i> <?php echo lang('btn_cancel'); ?>
					</button>
				</div>
			</div>
			<div class="space-4"></div>
<?php echo form_close(); ?>
	</div>
</div>