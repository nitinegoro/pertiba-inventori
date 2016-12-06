<div class="row">
	<div class="col-md-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
<?php echo form_open(site_url("administrator/post/update_category/{$get->category_id}"), array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-2" for="category"> <?php echo lang('t_name') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="category" class="form-control input-sm" id="title" value="<?php echo $get->name; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="slug"> <?php echo lang('menu_post_slug') ?> </label>
				<div class="col-sm-6">
					<input type="text" name="slug" class="form-control input-sm" id="custom-uri" value="<?php echo $get->slug; ?>" />
					<i><small class="help-block"><strong>Permalink : </strong> <?php echo base_url('category') ?>/<span class="text-primary" id="permalink-page"></span></small></i>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="parent"> <?php echo lang('parent') ?> </label>
				<div class="col-sm-6">
					<select name="parent" class="form-control input-sm">
						<option value="">- <?php echo lang('select'); ?> -</option>
				<?php  
				/* Get All Category */
				foreach($all_category as $cat) :
				?>
						<option value="<?php echo $cat->category_id; ?>" <?php echo ($cat->category_id==$get->parent_id) ? 'selected' : ''; ?>><?php echo $cat->name; ?></option>
				<?php  
				endforeach;
				?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2" for="description"> <?php echo lang('t_description') ?> </label>
				<div class="col-sm-6">
					<textarea name="description" id="" class="form-control" rows="5"><?php echo $get->description; ?></textarea>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i> <?php echo lang('update_post_category'); ?>
					</button>
					&nbsp; &nbsp; &nbsp;
					<a class="btn" href="<?php echo site_url('administrator/post/category') ?>">
						<i class="ace-icon fa fa-undo bigger-110"></i> <?php echo lang('btn_cancel'); ?>
					</a>
				</div>
			</div>
			<div class="space-4"></div>
<?php echo form_close(); ?>
	</div>
</div>