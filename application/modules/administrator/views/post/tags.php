<div class="row">
	<div class="col-md-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-4">
		<div class="form-group">
			<h5><?php echo lang('add_post_tag'); ?></h5><hr>
		</div>
<?php echo form_open(site_url('administrator/post/insert_tag'), array('class' => 'form-horiontal')); ?>
		<div class="form-group">
			<label for="tag"><?php echo lang('t_name'); ?></label>
			<input type="text" name="tag" class="form-control input-sm" id="title" required>
		</div>
		<div class="form-group">
			<label for="slug"><?php echo lang('menu_post_slug'); ?></label>
			<input type="text" name="slug" class="form-control input-sm" id="custom-uri">
			<i><small class="help-block"><strong>Permalink : </strong> <?php echo base_url('tag') ?>/<span class="text-primary" id="permalink-page"></span></small></i>
		</div>
		<div class="form-group">
			<label for="description"><?php echo lang('t_description'); ?></label>
			<textarea name="description" rows="5" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<hr>
			<button type="submit" class="btn btn-primary btn-sm"><?php echo lang('add_tag'); ?></button>
		</div>
<?php echo form_close(); ?>
	</div>
	<div class="col-md-8">
<?php echo form_open(site_url("administrator/post/tags"), array('method' => 'get')); ?>
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
<?php echo form_open(site_url("administrator/post/bulk_tags")); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="30"><input type="checkbox"></th>
					<th>
				<?php if($this->input->get('order')=='asc') : ?>
						<a href="<?php echo site_url("administrator/post/tags?order=desc&q={$this->input->get('q')}&page={$this->input->get('page')}") ?>" style="color: #707070;"><?php echo lang('t_name'); ?> <i class="fa fa-sort"></i></a>
				<?php else : ?>	
						<a href="<?php echo site_url("administrator/post/tags?order=asc&q={$this->input->get('q')}&page={$this->input->get('page')}") ?>" style="color: #707070;"><?php echo lang('t_name'); ?> <i class="fa fa-sort"></i></a>
				<?php endif; ?>
					</th>
					<th class="hidden-xs"><?php echo lang('t_description'); ?></th>
					<th class="hidden-xs"><?php echo lang('menu_post_slug'); ?></th>
					<th width="100"><?php echo lang('action'); ?></th>
				</tr>
			</thead>
			<tbody>
	<?php  
	/* Loop All Category Data */
	foreach($all_tags as $row) :
	?>
				<tr>
					<td>
						<input type="checkbox" name="tags[]" value="<?php echo $row->tag_id; ?>">
					</td>
					<td width="130"><?php echo $row->tag_name; ?></td>
					<td><small><?php echo word_limiter($row->tag_description,30); ?></small></td>
					<td width="130"><?php echo $row->tag_slug; ?></td>
					<td>
					<div class="hidden-sm hidden-xs action-buttons">
						<a class="green" href="<?php echo site_url("administrator/post/get_tag/{$row->tag_id}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_edit') ?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
						</a>
						<a class="red modal-tag-delete" href="#" data-id="<?php echo $row->tag_id; ?>" data-category="<?php echo $row->tag_name; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
					</div>
					<div class="hidden-md hidden-lg text-center">
						<div class="inline pos-rel">
							<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
								<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
							</button>

							<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo site_url("administrator/post/get_tag/{$row->tag_id}") ?>" class="tooltip-success" data-rel="tooltip" title="<?php echo lang('btn_edit') ?>">
										<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
									</a>
								</li>
								<li>
									<a href="#" data-id="<?php echo $row->tag_id; ?>" data-category="<?php echo $row->tag_name; ?>" class="tooltip-error modal-tag-delete" data-rel="tooltip" title="<?php echo lang('btn_delete') ?>">
										<span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
									</a>
								</li>
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
