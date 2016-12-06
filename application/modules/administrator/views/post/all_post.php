<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$keyword = $this->input->get('q');
$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

/* End of file all_users.php */
/* Location: ./application/modules/administrator/views/users/all_users.php */ 
?>
<div class="row">
	<div class="col-xs-12" style="min-height:400px;">
	<?php echo $this->session->flashdata('alert'); ?>
	<?php echo form_open(site_url("administrator/post"), array('method' => 'get')); ?>
		<div class="col-sm-3 hidden-xs pull-right">
				<div class="input-group">
					<input class="form-control input-sm" name="q" type="text" placeholder="<?php echo lang('form_search') ?>" />
					<span class="input-group-addon" type="button">
						<i class="ace-icon fa fa-search"></i>
					</span>
				</div>
		</div>
	<?php echo form_close(); ?>
		<div class="col-sm-2 hidden-xs" style="margin-bottom:20px;">
			<a href="<?php echo site_url('administrator/post/add_post') ?>" class="btn btn-sm btn-white btn-primary btn-bold">
				<i class="ace-icon fa fa-plus"></i> <?php echo lang('menu_user_add'); ?>
			</a>
		</div>
	<?php echo form_open(site_url("administrator/post/bulk_action"), array('id' => 'form_bulk_user')); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="30"><input type="checkbox"></th>
					<th width="250">
				<?php if($this->input->get('order')=='asc') : ?>
						<a href="<?php echo site_url("administrator/post?order=desc&q={$this->input->get('q')}&page={$this->input->get('page')}") ?>" style="color: #707070;"><?php echo lang('t_title'); ?> <i class="fa fa-sort"></i></a>
				<?php else : ?>	
						<a href="<?php echo site_url("administrator/post?order=asc&q={$this->input->get('q')}&page={$this->input->get('page')}") ?>" style="color: #707070;"><?php echo lang('t_title'); ?> <i class="fa fa-sort"></i></a>
				<?php endif; ?>
					</th>
					<th class="hidden-xs"><?php echo lang('t_author'); ?></th>
					<th class="hidden-xs"><?php echo lang('menu_post_category') ?></th>
					<th class="hidden-xs"><?php echo lang('menu_post_tags') ?></th>
					<th class="hidden-xs"><?php echo lang('t_date'); ?></th>
					<th><i class="fa fa-comments"></i></th>
					<th><?php echo lang('action'); ?></th>
				</tr>
			</thead>
			<tbody>
	<?php  
	/* Loop data pages */
	foreach($pages as $row) :
	?>
			<tr>
				<td><input type="checkbox" name="post[]" value="<?php echo $row->ID; ?>"></td>
				<td>
					<a href="<?php echo site_url("administrator/post/get/{$row->ID}") ?>"><?php echo $row->post_title; ?></a> 
					<small><i>[<?php echo lang($row->post_status); ?>]</i></small><br>
					<i><small>
						<a href="" target="_blank"><?php echo lang('preview'); ?></a>
					</small></i>
				</td>
				<td><?php echo $row->full_name; ?></td>
				<td width="150">
		<?php  
		/* Loop Category Post */
		if(!$this->post->get_post_category($row->ID)) :
					echo "-";
		else :
			foreach($this->post->get_post_category($row->ID) as $cat) :
		?>
				<small><a href="<?php echo site_url("administrator/post/get_category/{$cat->category_id}") ?>"><i>
					<?php echo $cat->name; ?>,
				</a></i></small>
		<?php  
			endforeach;
		endif;
		?>
				</td>
				<td width="150">
		<?php  
		/* Loop Post Tags */
		if($row->post_tag != '') :
			foreach($this->post->get_post_tags($row->ID) as $tag) :
				if(!$tag) 
					continue; 
		?>
				<small><a href="<?php echo site_url("administrator/post/get_tag/{$this->post->get_tag_id($tag)}") ?>"><i>
					#<?php echo $tag; ?>,
				</a></i></small>
		<?php  
			endforeach;
		endif;
		?>
				</td>
				<td>
					<small>
					<?php if($row->post_modified != '0000-00-00 00:00:00') : ?>
						<i><?php echo lang('last_modified'); ?></i> 
						<br><?php echo str_replace('-', '/', $row->post_modified); ?><br>
					<?php endif; ?>
						<i><?php echo lang('published'); ?></i> 
						<br><?php echo str_replace('-', '/', $row->post_date); ?>
					</small>
				</td>
				<td>
		<?php if($this->post->comments_count($row->ID)) : ?>
					<a href="<?php echo base_url("administrator/comments/get/$row->ID"); ?>">
						<?php echo $this->post->comments_count($row->ID); ?>
					</a>
		<?php else : ?>
					<strong>-</strong>
		<?php endif; ?>
				</td>
				<td width="100">
					<div class="hidden-sm hidden-xs action-buttons">
						<a class="green" href="<?php echo site_url("administrator/post/get/{$row->ID}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_edit') ?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
						</a>
						<a class="red modal-post-delete" href="#" data-id="<?php echo $row->ID; ?>" data-post="<?php echo $row->post_title; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
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
									<a href="<?php echo site_url("administrator/post/get/{$row->ID}") ?>" class="tooltip-success" data-rel="tooltip" title="<?php echo lang('btn_edit') ?>">
										<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
									</a>
								</li>

								<li>
									<a href="#" data-id="<?php echo $row->ID; ?>" data-post="<?php echo $row->post_title; ?>" class="tooltip-error modal-post-delete" data-rel="tooltip" title="<?php echo lang('btn_delete') ?>">
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
					<button name="action" value="delete" class="btn btn-minier btn-white btn-round btn-danger" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
						<i class="ace-icon fa fa-trash-o"></i> <small><?php echo lang('btn_delete') ?></small>
					</button>
				</th>
			</tr>
			</thead>
		</table>
	<?php echo form_close(); ?>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
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


