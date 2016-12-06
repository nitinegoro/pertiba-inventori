<div class="row">
	<div class="col-ms-12">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
<?php echo form_open(site_url('administrator/settings/set/general'), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_title]"> <?php echo lang('field_site_title') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[site_title]" value="<?php echo $this->option->get('site_title'); ?>" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_description]"> <?php echo lang('field_site_description') ?> </label>
				<div class="col-sm-7">
					<textarea name="option[site_description]" id="" cols="30" rows="3" class="form-control"><?php echo $this->option->get('site_description'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_email]"> <?php echo lang('field_site_email') ?> </label>
				<div class="col-sm-7">
					<input type="email" name="option[site_email]" value="<?php echo $this->option->get('site_email'); ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_phone]"> <?php echo lang('field_site_phone') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[site_phone]" value="<?php echo $this->option->get('site_phone'); ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_fax]"> <?php echo lang('field_site_fax') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[site_fax]" value="<?php echo $this->option->get('site_fax'); ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_timezone]"> <?php echo lang('field_timezone') ?> </label>
				<div class="col-sm-4">
					<select name="option[site_timezone]" class="form-control" id="timezone" data-selected="<?php echo $this->option->get('site_timezone'); ?>"></select>
				</div>
				<div class="col-sm-5">
					<p class="help-block">
						<?php echo lang('date'); ?> : <span class="blue">Nov 09, 2016</span> 
						- <?php echo lang('time'); ?> : <span class="blue">10:18:39</span>	
					</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[site_address]"> <?php echo lang('field_site_address') ?> </label>
				<div class="col-sm-7">
					<textarea name="option[site_address]" id="" cols="30" rows="3" class="form-control"><?php echo $this->option->get('site_address'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="option[geocode]"> <?php echo lang('field_site_geocode') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[geocode]" value="<?php echo $this->option->get('geocode'); ?>" class="form-control" />
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
