<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
<?php 
// data filter and searching
$filter = array(
	'q' => $this->input->get('q'),
	'category' => $this->input->get('category'),
	'sub_category' => $this->input->get('sub_category'),
	'status' => $this->input->get('status'),
	'from' => $this->input->get('from'),
	'end' => $this->input->get('end'),
	'page' => $this->input->get('page')
);
/* Form Filter and searching */
echo form_open(site_url("pengajuan"), array('method' => 'get')); 
?>
	<div class="col-md-12">
		<div class="col-md-5">
			<a href="<?php echo site_url('pengajuan/create') ?>" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Buat Pengajuan
			</a>
			<a href="<?php echo site_url("pengajuan/print_data?q={$filter['q']}&status={$filter['status']}&from={$filter['from']}&end={$filter['end']}&page={$filter['page']}"); ?>" target="_blank" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-print gray"></i> Print
			</a>
			<a href="<?php echo site_url("pengajuan/print_data?q={$filter['q']}&status={$filter['status']}&from={$filter['from']}&end={$filter['end']}&page={$filter['page']}&pdf=true"); ?>" target="_blank" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-file-pdf-o gray"></i> Export PDF
			</a>
			<div class="space-4"></div>
		</div>

		<div class="col-md-12 form-group"><hr>
			<div class="col-md-2">
				<label for="">Status</label>
				<select name="status" id="input" class="form-control input-sm">
					<option value="">-- PILIH --</option>
					<option value="pending" <?php echo ('pending'==$this->input->get('status')) ? 'selected' : ''; ?>>Tertunda</option>
					<option value="approve" <?php echo ('approve'==$this->input->get('status')) ? 'selected' : ''; ?>>Diterima</option>
				</select>
			</div>
			<div class="col-md-3">
				<label for="">Tanggal</label>
				<div class="input-daterange input-group">
					<input type="text" class="input-sm form-control" name="from" value="<?php echo $this->input->get('from') ?>" />
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<span class="input-group-addon"><i class="fa fa-exchange"></i></span>
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" class="input-sm form-control" name="end" value="<?php echo $this->input->get('end') ?>" />
				</div>
			</div>
			<div class="col-md-3">
				<button class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
					<i class="ace-icon fa fa-filter gray"></i> Filter Data
				</button>
				<a href="<?php echo site_url('pengajuan') ?>" class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
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
					<th>Tanggal</th>
					<th>Pengaju</th>
					<th>Divisi Kerja</th>
					<th width="50">Status</th>
				</tr>
			</thead>
			<tbody>
<?php  
/* Start Loops Data Pengajuan */
foreach($pengajuan as $row) :
?>
				<tr>
	<?php  
	// untuk fitur administrator
	if($this->session->userdata('user')->access == 'admin') :
	?>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="pengajuan[]" value="<?php echo $row->ID_pengajuan; ?>" id="allpengajuan" /> <span class="lbl"></span>
						</label>
					</td>
	<?php  
	endif;
	?>
					<td class="show-details-btn pointer"><?php echo ++$filter['page']; ?>.</td>
					<td class="show-details-btn pointer"><?php echo str_replace('-', '/', $row->date) ?></td>
					<td><?php echo $row->full_name; ?></td>
					<td><?php echo $row->division_name; ?></td>
					<td>
		<?php  
			if($row->status == 'pending') :
		?>				
						<span class="label label-sm label-warning">Tertunda</span>
		<?php else : ?>
						<span class="label label-sm label-success">Diterima</span>
		<?php  
		endif;
		?>
					</td>
				</tr>
				<tr class="detail-row">
					<td colspan="10">
						<div class="table-detail">
							<div class="row">
								<div class="col-md-10">
									<div class="profile-user-info">
										<a href="<?php echo site_url("pengajuan/print_out/{$row->ID_pengajuan}") ?>" target="_blank" class="btn btn-minier btn-white btn-round btn-default" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Print" style="margin-left: 6px;">
											<i class="ace-icon fa fa-print"></i> <small> Print</small>
										</a>
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
										<button class="btn btn-minier btn-white btn-round btn-success open-modal-terima" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Terima" style="margin-left: 6px;" data-id="<?php echo $row->ID_pengajuan; ?>">
											<i class="ace-icon fa fa-check"></i> <small> Terima</small>
										</button>
										<a class="btn btn-minier btn-white btn-round btn-warning open-modal-tunda" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Tolak" style="margin-left: 6px;" data-id="<?php echo $row->ID_pengajuan; ?>">
											<i class="ace-icon fa fa-times"></i> <small> Tolak</small>
										</a>
<!-- 										<a class="btn btn-minier btn-white btn-round btn-default open-modal-message" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Kirim Pesan" style="margin-left: 6px;" data-id="<?php echo $row->ID_pengajuan; ?>">
	<i class="ace-icon fa fa-send-o"></i> <small> Kirim Pesan</small>
</a> -->
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
									<table class="table table-hover table-bordered mini-font">
										<thead>
											<tr>
												<th width="30">No.</th>
												<th>Nama Barang</th>
												<th>Jenis Barang</th>
												<th>SKU </th>
												<th>Vendor / Merk</th>
												<th>Jumlah</th>
												<th>Harga Satuan (Rp.)</th>
												<th>Total (Rp.)</th>
												<th width="300">Deskripsi</th>
											</tr>
										</thead>
										<tbody>
			<?php  
			/* Start Loops Itms */
			$no = 1;
			$total = 0;
			foreach($this->pengajuan->get_items($row->ID_pengajuan) as $item) :
				$sub_total = ($item->quantity *$item->nominal);
			?>
											<tr>
												<td><?php echo $no++; ?>.</td>
												<td><?php echo $item->inventori_name; ?></td>
												<td><?php echo $item->category_name; ?></td>
												<td><?php echo $item->serial_number; ?></td>
												<td><?php echo $item->vendor; ?></td>
												<td><?php echo $item->quantity; ?></td>
												<td><?php echo number_format($item->nominal) ?>,00</td>
												<td><?php echo number_format($sub_total); ?>,00</td>
												<td><?php echo $item->description; ?></td>
											</tr>
			<?php  
			$total += $sub_total;
			/* End items */
			endforeach;
			?>
											<tr>
												<td colspan="7"><strong class="pull-right">Total (Rp.) :</strong></td>
												<td colspan="2"><?php echo number_format($total); ?>,00</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</td>
				</tr>
<?php  
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
				<th colspan="10">
					<small style="padding-right:20px;">Yang Terpilih :</small>
					<a class="btn btn-minier btn-white btn-round btn-success open-modal-terima-all" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Terima">
						<i class="ace-icon fa fa-check"></i> <small> Terima</small>
					</a>
					<a class="btn btn-minier btn-white btn-round btn-warning open-modal-tunda-all" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Tolak">
						<i class="ace-icon fa fa-times"></i> <small> Tolak</small>
					</a>
					<a class="btn btn-minier btn-white btn-round btn-danger open-modal-delete-all" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
						<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
					</a>
				</th>
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
<!-- Terima Pengajuan -->
<div class="modal" id="modal-pengajuan-terima-all">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-terima">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Ubah Status ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-success bigger-110">
					Ubah pengajuan ini menjadi status diterima.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan mengubahnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<button type="submit" value="terima" name="action" id="button-yes" class="btn btn-sm pull-left btn-success"><i class="fa fa-check"></i> Terima</a>
			</div>
		</div>
	</div>
</div>
<!-- Tunda Pengajuan -->
<div class="modal" id="modal-pengajuan-tunda-all">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-pending">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Ubah Status ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-warning bigger-110">
					Ubah pengajuan ini menjadi status ditolak / ditunda.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan mengubahnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<button type="submit" value="tunda" name="action" id="button-yes" class="btn btn-sm pull-left btn-warning"><i class="fa fa-times"></i> Tolak</a>
			</div>
		</div>
	</div>
</div>
<!-- Hapus Pengajuan -->
<div class="modal" id="modal-pengajuan-delete-all">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Hapus yang terpilih ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger bigger-110">
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
			<div class="modal-header bg-terima">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Ubah Status ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-success bigger-110">
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
			<div class="modal-header bg-pending">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Ubah Status ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-warning bigger-110">
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
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Hapus data ini ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger bigger-110">
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
