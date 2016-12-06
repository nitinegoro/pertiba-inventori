<div class="row">
	<div class="col-md-12">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
<?php echo form_open(site_url("administrator/users/update/{$obj->user_id}"), array('class' => 'form-horizontal', 'id' => 'form_add_user')); ?>
			<div class="form-group">
				<label class="col-sm-2" for="username"> <?php echo lang('field_username') ?> <small><i>(<?php echo lang('required'); ?>)</i></small> </label>
				<div class="col-sm-6">
					<input type="text" name="username" class="form-control" value="<?php echo $obj->username; ?>" required="" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="email"> <?php echo lang('field_email') ?> <small><i>(<?php echo lang('required'); ?>)</i></small> </label>
				<div class="col-sm-6">
					<input type="email" name="email" class="form-control" value="<?php echo $obj->user_email; ?>" required="" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="full_name"> <?php echo lang('field_full_name') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="full_name" value="<?php echo $obj->full_name; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="phone"> <?php echo lang('field_phone') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="phone" value="<?php echo $obj->user_phone; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="role"> <?php echo lang('field_role_access') ?></label>
				<div class="col-sm-6 col-xs-10">
	<?php 
	/**
	 * Role acces data (result_array)
	 *
	 **/
	echo form_dropdown('role', array_column($role_access, 'role_name', 'role_id'), $obj->role_id, array('class' => 'form-control col-sm-10'));
	?>
				</div>
				<div class="col-sm-2 col-xs-2">
					<span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="<?php echo lang('help_role_access'); ?>">?</span>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i> <?php echo lang('btn_update_user'); ?>
					</button>
					&nbsp; &nbsp; &nbsp;
					<a class="btn" href="<?php echo site_url('administrator/users') ?>">
						<i class="ace-icon fa fa-undo bigger-110"></i> <?php echo lang('btn_cancel'); ?>
					</a>
				</div>
			</div>
			<div class="space-4"></div>
<?php echo form_close(); ?>
	</div>
</div>