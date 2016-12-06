<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-4">
			<a href="<?php echo site_url('user/adduser') ?>" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Tambahkan Pengguna
			</a>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3 pull-right">
	<?php echo form_open(site_url("user"), array('method' => 'get')); ?>
			<div class="input-group">
				<input class="form-control input-sm" name="q" type="text" placeholder="Pencarian..." value="<?php echo $this->input->get('q') ?>" />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
	<?php echo form_close(); ?>
			<div class="space-4"></div>
		</div>
<?php echo form_open(site_url('user/bulkuser')); ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th>Username</th>
					<th>Nama Lengkap</th>
					<th>Divisi Kerja</th>
					<th width="100">Tindakan</th>
				</tr>
			</thead>
			<tbody>
<?php  
/* Start Loop Users All */
foreach($users as $row) :
?>
				<tr>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="users[]" value="<?php echo $row->ID_user; ?>" /> <span class="lbl"></span>
						</label>
					</td>
					<td><?php echo $row->username; ?></td>
					<td><?php echo $row->full_name; ?></td>
					<td><?php echo $row->division_name; ?></td>
					<td>
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
							<a class="red modal-category-delete" href="#" data-id="" data-category="" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
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
										<a href="" class="tooltip-success" data-rel="tooltip" title="Sunting">
											<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
										</a>
									</li>
									<li>
										<a href="#" data-id="" data-category="" class="tooltip-error modal-category-delete" data-rel="tooltip" title="Hapus">
											<span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
<?php  
/* End Loops */
endforeach;
?>
			</tbody>
			<thead>
			<tr>
				<th>
					<label class="pos-rel">
						<input type="checkbox" class="ace" /> <span class="lbl"></span>
					</label>
				</th>
				<th colspan="7">
					<small style="padding-right:20px;">Yang Terpilih :</small>
					<button name="action" value="set_update" class="btn btn-minier btn-white btn-round btn-primary" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting">
						<i class="ace-icon fa fa-pencil"></i> <small> Sunting</small>
					</button>
					<button name="action" value="delete" class="btn btn-minier btn-white btn-round btn-danger" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
						<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
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
				<h5 class="modal-title"><i class="fa fa-question-circle text-danger"></i> <?php echo lang('dialo_delete'); ?></h5>
			</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo lang('btn_cancel'); ?></a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> <?php echo lang('btn_delete') ?></a>
			</div>
		</div>
	</div>
</div>