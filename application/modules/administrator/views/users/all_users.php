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
	<?php echo form_open(site_url("administrator/users"), array('method' => 'get')); ?>
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
			<a href="<?php echo site_url('administrator/users/add') ?>" class="btn btn-sm btn-white btn-primary btn-bold">
				<i class="ace-icon fa fa-plus"></i> <?php echo lang('menu_user_add'); ?>
			</a>
		</div>
	<?php echo form_open(site_url("administrator/users/bulk_action"), array('id' => 'form_bulk_user')); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th><input type="checkbox"></th>
					<th><?php echo lang('t_number'); ?></th>
					<th class="hidden-xs"><?php echo lang('t_username'); ?></th>
					<th><?php echo lang('t_user_name'); ?></th>
					<th class="hidden-xs"><?php echo lang('t_user_email'); ?></th>
					<th class="hidden-xs"><?php echo lang('t_user_post'); ?></th>
					<th class="hidden-xs"><?php echo lang('t_user_role'); ?></th>
					<th><?php echo lang('action'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($users as $row) : ?>
				<tr>
					<td width="40"><input type="checkbox" name="user[]" value="<?php echo $row->user_id; ?>"></td>
					<td><?php echo ++$page; ?>.</td>
					<td class="hidden-xs"><?php echo $row->username; ?></td>
					<td><?php echo $row->full_name; ?></td>
					<td class="hidden-xs"><?php echo $row->user_email; ?></td>
					<td class="hidden-xs">
						<a href="#" target="_blank" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('all_preview') ?>">
							0
						</a>
					</td>
					<td class="hidden-xs"><?php echo $row->role_name; ?></td>
					<td width="100">
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="<?php echo site_url("administrator/users/edit/{$row->user_id}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_edit') ?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
							<a class="red open-modal" href="#" data-id="<?php echo $row->user_id; ?>" data-user="<?php echo $row->full_name; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="<?php echo lang('btn_delete') ?>">
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
										<a href="<?php echo site_url("administrator/users/edit/{$row->user_id}") ?>" class="tooltip-success" data-rel="tooltip" title="<?php echo lang('btn_edit') ?>">
											<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
										</a>
									</li>

									<li>
										<a href="#" data-id="<?php echo $row->user_id; ?>" data-user="<?php echo $row->full_name; ?>" class="tooltip-error open-modal" data-rel="tooltip" title="<?php echo lang('btn_delete') ?>">
											<span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
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
