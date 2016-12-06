<div class="row">
	<div class="col-md-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
<?php 
echo form_open(site_url("administrator/post/update_multiple_tag"), array('class' => 'form-horizontal')); 
	/* Checking data */
	if(is_array($this->input->post('tags'))) :
		/* Loop Tags */
		foreach($this->input->post('tags') as $key => $value) :
		echo form_hidden('tag[]', $value); 
		$row = $this->tag->get($value); 
?>

			<div class="form-group">
				<label class="col-sm-2" for="name[]"> <?php echo lang('t_name') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="name[]" class="form-control" value="<?php echo $row->tag_name; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="slug[]"> <?php echo lang('menu_post_slug') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="slug[]" class="form-control" value="<?php echo $row->tag_slug; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="description[]"> <?php echo lang('t_description') ?> </label>
				<div class="col-sm-6">
					<textarea name="description[]" id="" class="form-control" rows="5"><?php echo $row->tag_description; ?></textarea>
				</div>
			</div>
			<div class="form-group"><hr></div>
<?php  
		/* end Loops */
		endforeach;
?>
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
<?php 
	else :
		// else not array tags back to list tags page
		$this->template->alert(
			lang('alert_empty_changed'), 
			array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
		);
		redirect('administrator/post/tags');
	endif;
echo form_close(); 
?>
	</div>
</div>