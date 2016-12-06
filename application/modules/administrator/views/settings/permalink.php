<div class="row">
	<div class="col-ms-12">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
<?php echo form_open(site_url('administrator/settings/set/permalink'), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-2"> <?php echo lang('permalink_default') ?> </label>
				<div class="col-sm-7">
					<div class="radio">
						<label>
							<input name="option[permalink]" type="radio" class="ace" value="default" <?php if($this->option->get('permalink')=='default') echo 'checked'; ?> />
							<span class="lbl">
								<i class="permalink"><?php echo base_url('post/read/23'); ?></i>
							</span>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2"> <?php echo lang('permalink_date') ?> </label>
				<div class="col-sm-7">
					<div class="radio">
						<label>
							<input name="option[permalink]" type="radio" class="ace" value="date_slug" <?php if($this->option->get('permalink')=='date_slug') echo 'checked'; ?> />
							<span class="lbl">
								<i class="permalink"><?php echo base_url(date('Y/m/d').'/sample-text-permalink'); ?></i>
							</span>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2"> <?php echo lang('permalink_month') ?> </label>
				<div class="col-sm-7">
					<div class="radio">
						<label>
							<input name="option[permalink]" type="radio" class="ace" value="month_slug" <?php if($this->option->get('permalink')=='month_slug') echo 'checked'; ?> />
							<span class="lbl">
								<i class="permalink"><?php echo base_url(date('Y/m').'/sample-text-permalink'); ?></i>
							</span>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2"> <?php echo lang('permalink_uri') ?> </label>
				<div class="col-sm-7">
					<div class="radio">
						<label>
							<input name="option[permalink]" type="radio" class="ace" value="slug" <?php if($this->option->get('permalink')=='slug') echo 'checked'; ?> />
							<span class="lbl">
								<i class="permalink"><?php echo base_url('/sample-text-permalink'); ?></i>
							</span>
						</label>
					</div>
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