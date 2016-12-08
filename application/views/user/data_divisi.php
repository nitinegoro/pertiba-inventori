<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
	<div class="col-md-5">
		<div class="form-group">
			<h4>Buat Divisi Baru</h4><hr>
		</div>
<?php echo form_open(site_url('user/adddivisi'), array('class' => 'form-horiontal')); ?>
		<div class="form-group">
			<label for="divisi">Nama Divisi</label>
			<input type="text" name="divisi" class="form-control" required="">
		</div>
		<div class="form-group">
			<hr>
			<button type="submit" class="btn btn-primary btn-sm">Buat Divisi</button>
		</div>
<?php echo form_close(); ?>
	</div>
	<div class="col-md-7">
		<div class="col-md-5 pull-right">
	<?php echo form_open(site_url("user/divisi"), array('method' => 'get')); ?>
			<div class="input-group">
				<input class="form-control input-sm" name="q" type="text" placeholder="Pencarian..." />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
	<?php echo form_close(); ?>
			<div class="space-4"></div>
		</div>
<?php echo form_open(site_url('user/bulkdivisi')); ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th>Nama Divisi</th>
					<th width="100">Tindakan</th>
				</tr>
			</thead>
			<tbody>
<?php  
/* Start Loop Category All */
foreach($divisi as $row) :
?>
				<tr>
					<td>
	<?php  
	// cek tidak sama dengan sessionid
	if($row->ID_division != 1) :
	?>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="divisi[]" value="<?php echo $row->ID_division; ?>" /> <span class="lbl"></span>
						</label>
	<?php  
	endif;
	?>
					</td>
					<td><?php echo $row->division_name; ?></td>
					<td>
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green open-modal-divisi" data-id="<?php echo $row->ID_division; ?>" data-name="<?php echo $row->division_name; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
	<?php  
	// cek tidak sama dengan sessionid
	if($row->ID_division != 1) :
	?>
							<a class="red open-divisi-delete" href="#" data-id="<?php echo $row->ID_division; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
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
										<a data-id="<?php echo $row->ID_division; ?>" data-name="<?php echo $row->division_name; ?>" class="tooltip-success open-modal-divisi" data-rel="tooltip" title="Sunting">
											<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
										</a>
									</li>
	<?php  
	// cek tidak sama dengan sessionid
	if($row->ID_division != 1) :
	?>
									<li>
										<a href="#" data-id="<?php echo $row->ID_division; ?>" class="tooltip-error open-divisi-delete" data-rel="tooltip" title="Hapus">
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
					<a class="btn btn-minier btn-white btn-round btn-danger open-divisi-delete-all" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
						<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
					</a>
				</th>
			</tr>
			</thead>
		</table>
<div class="modal" id="modal-delete-divisi-all">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Hapus yang tterpilih?</h5>
			</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<button name="action" value="delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
	</div>
</div>

<div class="modal" id="modal-delete-divisi">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Hapus yang tterpilih?</h5>
			</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modal-update-divisi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-update">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-pencil"></i> Sunting divisi</h5>
			</div>
	<?php echo form_open('', array('id' => 'form-update-divisi')); ?>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 form-group">
						<label for="divisi">Nama Divisi</label>
						<input type="text" name="divisi" id="divisi" class="form-control" required="">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" class="btn btn-primary btn-sm pull-left"><i class="fa fa-check"></i> Simpan Perubahan</button>
			</div>
	<?php echo form_close(); ?>
		</div>
	</div>
</div>