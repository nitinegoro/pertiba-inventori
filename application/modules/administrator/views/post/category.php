<div class="row">
	<div class="col-md-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-4">
		<div class="form-group">
			<h5><?php echo lang('add_post_category'); ?></h5><hr>
		</div>
<?php echo form_open(site_url('administrator/post/insert_category'), array('class' => 'form-horiontal')); ?>
		<div class="form-group">
			<label for="category"><?php echo lang('menu_post_category'); ?></label>
			<input type="text" name="category" class="form-control input-sm" id="title">
		</div>
		<div class="form-group">
			<label for="slug"><?php echo lang('menu_post_slug'); ?></label>
			<input type="text" name="slug" class="form-control input-sm" id="custom-uri">
			<i><small class="help-block"><strong>Permalink : </strong> <?php echo base_url('category') ?>/<span class="text-primary" id="permalink-page"></span></small></i>
		</div>
		<div class="form-group">
			<label for="parent"><?php echo lang('parent'); ?></label>
			<select name="parent" class="form-control input-sm">
				<option value="">- <?php echo lang('select'); ?> -</option>
		<?php  
		/* Get All Category */
		foreach($all_category as $cat) :
		?>
				<option value="<?php echo $cat->category_id; ?>"><?php echo $cat->name; ?></option>
		<?php  
		endforeach;
		?>
			</select>
		</div>
		<div class="form-group">
			<label for="description"><?php echo lang('t_description'); ?></label>
			<textarea name="description" rows="5" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<hr>
			<button type="submit" class="btn btn-primary btn-sm"><?php echo lang('create_category'); ?></button>
		</div>
<?php echo form_close(); ?>
	</div>
	<div class="col-md-8">
<?php echo form_open(site_url("administrator/post/category"), array('method' => 'get')); ?>
		<div class="col-md-4 hidden-xs pull-right">
			<div class="input-group">
				<input class="form-control input-sm" name="q" type="text" placeholder="<?php echo lang('form_search') ?>" />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
			<div class="space-4"></div>
		</div>
<?php echo form_close(); ?>
<?php echo form_open(site_url("administrator/post/bulk_category")); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="30"><input type="checkbox"></th>
					<th>
				<?php if($this->input->get('order')=='asc') : ?>
						<a href="<?php echo site_url("administrator/post/category?order=desc&q={$this->input->get('q')}&page={$this->input->get('page')}") ?>" style="color: #707070;"><?php echo lang('t_name'); ?> <i class="fa fa-sort"></i></a>
				<?php else : ?>	
						<a href="<?php echo site_url("administrator/post/category?order=asc&q={$this->input->get('q')}&page={$this->input->get('page')}") ?>" style="color: #707070;"><?php echo lang('t_name'); ?> <i class="fa fa-sort"></i></a>
				<?php endif; ?>
					</th>
					<th class="hidden-xs"><?php echo lang('t_description'); ?></th>
					<th class="hidden-xs"><?php echo lang('menu_post_slug'); ?></th>
					<th><?php echo lang('count_post'); ?></th>
					<th width="100"><?php echo lang('action'); ?></th>
				</tr>
			</thead>
			<tbody>
	<?php  
	/* Loop All Category Data */
	foreach($category as $row) :
	?>
				<tr>
					<td>
		<?php  
		/* Not diplayed button default category */
		if($row->category_id != 1) :
		?>
						<input type="checkbox" name="categories[]" value="<?php echo $row->category_id; ?>">
		<?php  
		endif;
		?>
					</td>
					<td width="130"><?php echo $row->name; ?></td>
					<td><small><?php echo word_limiter($row->description,30); ?></small></td>
					<td width="130"><?php echo $row->slug; ?></td>
					<td><?php echo (!$this->category->count_post($row->category_id)) ? '-' : $this->category->count_post($row->category_id); ?></td>
					<td>
					<div class="hidden-sm hidden-xs action-buttons">
						<a class="green" href="<?php echo site_url("administrator/post/get_category/{$row->category_id}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_edit') ?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
						</a>
		<?php  
		/* Not diplayed button default category */
		if($row->category_id != 1) :
		?>
						<a class="red modal-category-delete" href="#" data-id="<?php echo $row->category_id; ?>" data-category="<?php echo $row->name; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
		<?php  
		endif;
		?>
					</div>
					<div class="hidden-md hidden-lg text-center">
						<div class="inline pos-rel">
							<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
								<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
							</button>

							<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo site_url("administrator/post/get_category/{$row->category_id}") ?>" class="tooltip-success" data-rel="tooltip" title="<?php echo lang('btn_edit') ?>">
										<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
									</a>
								</li>
		<?php  
		/* Not diplayed button default category */
		if($row->category_id != 1) :
		?>
								<li>
									<a href="#" data-id="<?php echo $row->category_id; ?>" data-category="<?php echo $row->name; ?>" class="tooltip-error modal-category-delete" data-rel="tooltip" title="<?php echo lang('btn_delete') ?>">
										<span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
									</a>
								</li>
		<?php  
		endif;
		?>
							</ul>
						</div>
					</div>
					</td>
				</tr>
	<?php  
	endforeach;
	?>
			</tbody>
			<thead>
			<tr>
				<th><input type="checkbox"></th>
				<th colspan="7">
					<small style="padding-right:20px;"><?php echo lang('with_selected'); ?></small>
					<button name="action" value="update" class="btn btn-minier btn-white btn-round btn-primary" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_edit') ?>">
						<i class="ace-icon fa fa-pencil"></i> <small><?php echo lang('btn_edit') ?></small>
					</button>
					<button name="action" value="delete" class="btn btn-minier btn-white btn-round btn-danger" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
						<i class="ace-icon fa fa-trash-o"></i> <small><?php echo lang('btn_delete') ?></small>
					</button>
				</th>
			</tr>
			</thead>
		</table>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
<?php echo form_close(); ?>
	</div>
</div>

<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><?php echo lang('dialo_delete'); ?></h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-info bigger-110">
					<?php echo lang('notice_delete'); ?>
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> <?php echo lang('are_you_sure'); ?>
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo lang('btn_cancel'); ?></a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> <?php echo lang('btn_delete') ?></a>
			</div>
		</div>
	</div>
</div>
