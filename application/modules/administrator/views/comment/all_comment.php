<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$query = array(
	'q' => $this->input->get('q'),
	'filter' => $this->input->get('filter'),
	'order' => $this->input->get('order'),
	'order_by' => $this->input->get('order_by'),
	'page' => $this->input->get('page') 
);


/* End of file all_users.php */
/* Location: ./application/modules/administrator/views/comment/all_comment.php */ 
?>
<div class="row">
	<div class="col-xs-12" style="min-height:400px;">
	<?php echo $this->session->flashdata('alert'); ?>
	<?php echo form_open(site_url("administrator/comment"), array('method' => 'get')); ?>
		<div class="col-sm-3 hidden-xs pull-right">
				<div class="input-group">
					<input class="form-control input-sm" name="q" type="text" placeholder="<?php echo lang('form_search') ?>" />
					<span class="input-group-addon" type="button">
						<i class="ace-icon fa fa-search"></i>
					</span>
				</div>
		</div>
		<?php echo $this->config->item('language'); ?>
	<?php echo form_close(); ?>
		<div class="col-sm-5 hidden-xs" style="margin-bottom:20px;">
			<a href="<?php echo site_url('administrator/comment') ?>" style="font-weight: <?php echo (!$query['filter']) ? 'bold' : '200'; ?>;">Semua </a><span style="color: #444;">(<?php echo $this->comment->count_comment() ?>)</span> |
			<a href="<?php echo site_url('administrator/comment?filter=pending') ?>" style="font-weight: <?php echo ($query['filter']=='pending') ? 'bold' : '200'; ?>;">Tunda </a><span style="color: #444;">(<?php echo $this->comment->count_comment('pending') ?>)</span>	|
			<a href="<?php echo site_url('administrator/comment?filter=approve') ?>" style="font-weight: <?php echo ($query['filter']=='approve') ? 'bold' : '200'; ?>;">Disetejui </a><span style="color: #444;">(<?php echo $this->comment->count_comment('approve') ?>)</span>
		</div>
	<?php echo form_open(site_url("administrator/users/bulk_action"), array('id' => 'form_bulk_user')); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th><input type="checkbox"></th>
					<th></th>
					<th width="180"><?php echo lang('t_author'); ?></th>
					<th class="hidden-xs"><?php echo lang('menu_comment'); ?></th>
					<th class="hidden-xs"><?php echo lang('t_user_post'); ?></th>
					<th><?php echo lang('t_date'); ?></th>
					<th><?php echo lang('action'); ?></th>
				</tr>
			</thead>
			<tbody>
	<?php  
	/* Loop Comments */
	foreach($comments as $row) :
	?>
				<tr>
					<td width="40"><input type="checkbox" name="user[]" value=""></td>
					<td><img src="<?php echo base_url('assets/backend/avatars/avatar2.png'); ?>" alt="">	</td>
					<td>
						<?php echo $row->comment_author; ?><br>
						<?php echo mailto($row->comment_author_email); ?>
					</td>
					<td class="hidden-xs"><?php echo $row->comment_content; ?></td>
					<td width="200">
						<a href="<?php echo site_url("administrator/post/get/{$row->ID}") ?>"><?php echo $row->post_title; ?></a><br>
						<i><small>
							<a href="" target="_blank"><?php echo lang('preview'); ?></a>
						</small></i>
					</td>
					<td class="hidden-xs" width="150">
						<small><?php echo lang('published'); ?></small><br><?php echo str_replace('-', '/', $row->comment_date); ?>
					</td>
					<td width="100">
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="<?php echo site_url("administrator/comment/edit/{}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_edit') ?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
							<a class="red open-modal" href="#" data-id="" data-user="" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
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
										<a href="<?php echo site_url("administrator/comment/edit/{}") ?>" class="tooltip-success" data-rel="tooltip" title="<?php echo lang('btn_edit') ?>">
											<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
										</a>
									</li>

									<li>
										<a href="#" data-id="" data-user="" class="tooltip-error open-modal" data-rel="tooltip" title="<?php echo lang('btn_delete') ?>">
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
				<th colspan="8">
					<small style="padding-right:20px;"><?php echo lang('with_selected'); ?></small>
					<button name="action" value="approve" class="btn btn-minier btn-white btn-round btn-success" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('approve') ?>">
						<i class="ace-icon fa fa-check"></i> <small><?php echo lang('approve') ?></small>
					</button>
					<button name="action" value="pending" class="btn btn-minier btn-white btn-round btn-warning" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('pending') ?>">
						<i class="ace-icon fa fa-times"></i> <small><?php echo lang('pending') ?></small>
					</button>
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
