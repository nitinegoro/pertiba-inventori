<div class="row">
	<div class="col-ms-12">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
<?php echo form_open(site_url('administrator/settings/set/email'), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-2" for="username"> <?php echo lang('field_mail_protocol') ?> </label>
				<div class="col-sm-7">
	<?php 
	/**
	 * Protocol name
	 *
	 **/
	echo form_dropdown(
			'option[mail_protocol]', 
			array('SMTP' => 'SMTP', 'Mail' => 'Mail'),
			$this->option->get('mail_protocol'), 
			array('class' => 'form-control')
		);
	?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[mail_host]"> <?php echo lang('field_email_host') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[mail_host]" class="form-control" value="<?php echo $this->option->get('mail_host'); ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[mail_username]"> <?php echo lang('field_email_username') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[mail_username]" class="form-control" value="<?php echo $this->option->get('mail_username'); ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[mail_password]"> <?php echo lang('field_email_pass') ?> </label>
				<div class="col-sm-7">
					<input type="password" name="option[mail_password]" class="form-control" value="<?php echo $this->option->get('mail_password'); ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[mail_port]"> <?php echo lang('field_email_port') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[mail_port]" class="form-control" value="<?php echo $this->option->get('mail_port'); ?>" />
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