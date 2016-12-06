<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
<?php 
// data filter and searching
$filter = array(
	'q' => $this->input->get('q'),
	'category' => $this->input->get('category'),
	'sub_category' => $this->input->get('sub_category'),
	'page' => (!$this->input->get('page')) ? 0 : $this->input->get('page')
);
/* Form Filter and searching */
echo form_open(site_url("inventori"), array('method' => 'get')); 
?>
	<div class="col-md-12">
		<div class="col-md-5">
			<a href="<?php echo site_url("inventori/print_data?q={$filter['q']}&from={$filter['category']}&end={$filter['sub_category']}&page={$filter['page']}"); ?>" target="_blank" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-print gray"></i> Print
			</a>
			<a href="<?php echo site_url("inventori/print_data?q={$filter['q']}&from={$filter['category']}&end={$filter['sub_category']}&page={$filter['page']}&pdf=true"); ?>" target="_blank" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-file-pdf-o gray"></i> Export PDF
			</a>
			<div class="space-4"></div>
		</div>

		<div class="col-md-12 form-group"><hr>
			<div class="col-md-2">
				<label for="">Kategori</label>
				<select name="category" id="category" class="form-control input-sm" data-id="<?php echo $filter['sub_category']; ?>">
					<option value="">-- PILIH --</option>
		<?php  
		/* Get All Category */
		foreach($parent_category as $cat) :
		?>
				<option value="<?php echo $cat->item_category_id; ?>" <?php echo ($cat->item_category_id==$filter['category'] OR $cat->item_category_id==$filter['sub_category']) ? 'selected' : ''; ?>><?php echo $cat->category_name; ?></option>
		<?php  
		endforeach;
		?>
				</select>
			</div>
			<div class="col-md-2">
				<label for="">Sub Kategori</label>
				<select name="sub_category" id="sub_category" class="form-control input-sm">
					<option value="">-- PILIH --</option>
				</select>
			</div>
			<div class="col-md-3">
				<button class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
					<i class="ace-icon fa fa-filter gray"></i> Filter Data
				</button>
				<a href="<?php echo site_url('inventori') ?>" class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
					<i class="ace-icon fa fa-times gray"></i> Reset
				</a>
			</div>
			<div class="col-md-3 pull-right" style="margin-top: 24px;">
				<div class="input-group">
					<input class="form-control" name="q" type="text" placeholder="Pencarian..." />
					<span class="input-group-addon" type="button">
						<i class="ace-icon fa fa-search"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
<?php 
/* endfrom filter and seacrhing */
echo form_close(); 

/* Start From Bulk Action */
echo form_open(site_url('pengajuan/bulk_action'));
?>
	<div class="col-md-12">
		<table class="table table-hover table-bordered" id="simple-table">
			<thead>
				<tr>
	<?php  
	// untuk fitur administrator
	if($this->session->userdata('user')->access == 'admin') :
	?>
					<th width="40">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
	<?php  
	endif;
	?>	
					<th width="40">No.</th>
					<th>No. Inventaris</th>
					<th>Nama Barang</th>
					<th>Jenis Barang</th>
					<th>SKU </th>
					<th>Vendor / Merk</th>
					<th>Jumlah</th>
					<th>Harga Satuan (Rp.)</th>
					<th>Sub Total (Rp.)</th>
				</tr>
			</thead>
			<tbody>
<?php  
$total = 0;
/* Start Loops Data Pengajuan */
foreach($inventaris as $row) :
	$sub_total = ($row->quantity *$row->nominal);
?>
				<tr>
	<?php  
	// untuk fitur administrator
	if($this->session->userdata('user')->access == 'admin') :
	?>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="inventaris" value="" id="allpengajuan" /> <span class="lbl"></span>
						</label>
					</td>
	<?php  
	endif;
	?>
					<td><?php echo ++$filter['page']; ?>.</td>
					<td class="show-details-btn pointer"><?php echo $row->NO_inventori; ?></td>
					<td class="show-details-btn pointer"><?php echo $row->inventori_name; ?></td>
					<td><?php echo $row->category_name; ?></td>
					<td><?php echo $row->serial_number; ?></td>
					<td><?php echo $row->vendor; ?></td>
					<td><?php echo $row->quantity; ?></td>
					<td><?php echo number_format($row->nominal) ?>,00</td>
					<td><?php echo number_format($sub_total); ?>,00</td>
				</tr>
				<tr class="detail-row">
					<td colspan="10">
						<div class="table-detail">
							<div class="row">
								<div class="col-md-10">
									<div class="profile-user-info">
		<?php  
		// cek sudak diterima apa belum (kalo admin tetap bisa edit)
		if($this->session->userdata('user')->ID_user == $row->ID_user AND $row->status == 'pending' OR $this->session->userdata('user')->access == 'admin') :
		?>
										<a href="<?php echo site_url("pengajuan/get/{$row->ID_pengajuan}") ?>" class="btn btn-minier btn-white btn-round btn-primary" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting" style="margin-left: 6px;">
											<i class="ace-icon fa fa-pencil"></i> <small> Sunting</small>
										</a>
		<?php  
		endif;
		// untuk fitur administrator
		if($this->session->userdata('user')->access == 'admin') :
		?>
										<a class="btn btn-minier btn-white btn-round btn-danger open-modal-delete" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus" style="margin-left: 6px;" data-id="<?php echo $row->ID_pengajuan; ?>">
											<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
										</a>
		<?php 
		endif; 
		?>
									</div>
									<div class="space-4"></div>
								</div>
								<div class="col-md-12">
									<div class="space visible-xs"></div>
									<div class="profile-user-info profile-user-info-striped">
										<div class="profile-info-row">
											<div class="profile-info-name"> Deskripsi : </div>

											<div class="profile-info-value"> <span><?php echo $row->description; ?></span> </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
<?php  
	$total += $sub_total;
/* End Loops pengajuan */
endforeach;
?>
			</tbody>
	<?php  
	// untuk fitur administrator
	if($this->session->userdata('user')->access == 'admin') :
	?>
			<thead>
			<tr>
				<th>
					<label class="pos-rel">
						<input type="checkbox" class="ace" /> <span class="lbl"></span>
					</label>
				</th>
				<th colspan="3">
					<small style="padding-right:20px;">Yang Terpilih :</small>
					<a class="btn btn-minier btn-white btn-round btn-danger open-modal-delete-all" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
						<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
					</a>
				</th>
				<th colspan="5"><span class="pull-right">Total (Rp.) :</span></th>
				<th><?php echo number_format($total); ?>,00</th>
			</tr>
			</thead>
	<?php  
	endif;
	?>
		</table>
	</div>
<?php  
/* Set Modal in form action */
?>

<!-- Hapus Pengajuan -->
<div class="modal" id="modal-pengajuan-delete-all">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Hapus yang terpilih ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-info bigger-110">
					Ini mungkin akan menyebabkan data barang yang telah diajukan akan ikut terhapus.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<button type="submit" value="delete" name="action" id="button-yes" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
			</div>
		</div>
	</div>
</div>
<?php  
/* End form Bulk Action */
echo form_close();
?>
	<div class="col-md-12 text-center">
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>


<!-- Terima Pengajuan -->
<div class="modal" id="modal-pengajuan-terima-one">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Ubah Status ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-info bigger-110">
					Ubah pengajuan ini menjadi status diterima.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan mengubahnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<a id="button-yes" class="btn btn-sm pull-left btn-success"><i class="fa fa-check"></i> Terima</a>
			</div>
		</div>
	</div>
</div>


<!-- Tunda / Tolak Pengajuan -->
<div class="modal" id="modal-pengajuan-tunda-one">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Ubah Status ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-info bigger-110">
					Ubah pengajuan ini menjadi status ditolak / tertunda.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan mengubahnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<a id="button-yes" class="btn btn-sm pull-left btn-warning"><i class="fa fa-times"></i> Tolak</a>
			</div>
		</div>
	</div>
</div>


<!-- Hapus Pengajuan -->
<div class="modal" id="modal-pengajuan-delete-one">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Hapus data ini ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-info bigger-110">
					Ini mungkin akan menyebabkan data barang yang telah diajukan akan ikut terhapus.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<a id="button-yes" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
			</div>
		</div>
	</div>
</div>
