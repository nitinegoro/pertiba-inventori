<div class="row">
	<div class="col-ms-12">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
<?php echo form_open(site_url('administrator/settings/set/reading'), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-3" for="username"> <?php echo lang('field_language') ?> </label>
				<div class="col-sm-3">
				<?php 
				/**
				 * Protocol name
				 *
				 **/
				echo form_dropdown(
						'option[language]', 
						array('indonesia' => 'Indonesia', 'english' => 'English'),
						$this->option->get('language'), 
						array('class' => 'form-control')
					);
				?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="option[post_per_page]"> <?php echo lang('field_max_post') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[post_per_page]" id="spinner1" class="input-sm" value="<?php echo $this->option->get('post_per_page') ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="option[comments_per_page]"> <?php echo lang('field_max_comments') ?> </label>
				<div class="col-sm-7">
					<input type="text" name="option[comments_per_page]" id="spinner2" class="input-sm" value="<?php echo $this->option->get('comments_per_page') ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="option[approve_comments]"> <?php echo lang('field_allow_comment') ?> </label>
				<div class="col-sm-7">
					<div class="radio">
						<label>
							<input name="option[approve_comments]" type="radio" value="activated" class="ace" <?php if($this->option->get('approve_comments')=='activated') echo 'checked'; ?> />
							<span class="lbl"> <?php echo lang('activated'); ?></span>
						</label>
					</div>
					<div class="radio">
						<label>
							<input name="option[approve_comments]" type="radio" value="disabled" class="ace" <?php if($this->option->get('approve_comments')=='disabled') echo 'checked'; ?> />
							<span class="lbl"> <?php echo lang('no'); ?></span>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3" for="option[send_subcribber]"> <?php echo lang('field_allow_subcribber') ?> </label>
				<div class="col-sm-7">
					<div class="radio">
						<label>
							<input name="option[send_subcribber]" value="activated" type="radio" class="ace" <?php if($this->option->get('send_subcribber')=='activated') echo 'checked'; ?> />
							<span class="lbl"> <?php echo lang('activated'); ?></span>
						</label>
					</div>
					<div class="radio">
						<label>
							<input name="option[send_subcribber]" value="disabled" type="radio" class="ace" <?php if($this->option->get('send_subcribber')=='disabled') echo 'checked'; ?> />
							<span class="lbl"> <?php echo lang('no'); ?></span>
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