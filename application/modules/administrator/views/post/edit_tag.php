<div class="row">
	<div class="col-md-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
<?php echo form_open(site_url("administrator/post/update_tag/{$get->tag_id}"), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-2" for="tag"> <?php echo lang('t_name') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="tag" class="form-control" id="title" value="<?php echo $get->tag_name; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="slug"> <?php echo lang('menu_post_slug') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="slug" class="form-control" id="custom-uri" value="<?php echo $get->tag_slug; ?>" />
					<i><small class="help-block"><strong>Permalink : </strong> <?php echo base_url('tag') ?>/<span class="text-primary" id="permalink-page"></span></small></i>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="description"> <?php echo lang('t_description') ?> </label>
				<div class="col-sm-6">
					<textarea name="description" id="" class="form-control" rows="5"><?php echo $get->tag_description; ?></textarea>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i> <?php echo lang('update_post_tag'); ?>
					</button>
					&nbsp; &nbsp; &nbsp;
					<a class="btn" href="<?php echo site_url('administrator/post/tags') ?>">
						<i class="ace-icon fa fa-undo bigger-110"></i> <?php echo lang('btn_cancel'); ?>
					</a>
				</div>
			</div>
			<div class="space-4"></div>
<?php echo form_close(); ?>
	</div>
</div>