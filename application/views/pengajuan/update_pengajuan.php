<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
	<div class="col-md-9 col-md-offset-1">
<?php  
echo form_open(site_url("pengajuan/update/{$get->ID_pengajuan}"), array('class'=>'form-horiontal', 'id' => 'form_buat_pengajuan', 'data-item' => count($this->pengajuan->get_items($get->ID_pengajuan)) ));
?>
	  <div class="form-group col-md-12">
	  	<blockquote>Pengajuan  </blockquote>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="vendor" class="col-sm-3 control-label">Tanggal <strong class="text-danger">*</strong></label>
	    <div class="col-sm-4">
			<div class="input-group">
			  <input type="text" class="form-control date-picker" name="tanggal" value="<?php echo $get->date; ?>" placeholder="Ex : <?php echo date('Y-m-d') ?>" required="">
			  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
	    </div>
	  </div>
<?php  
/* Start Loops Itms */
$no = 0;
foreach($this->pengajuan->get_items($get->ID_pengajuan) as $item) :
	echo form_hidden("item_id[{$no}]", $item->ID_inventori);
?>
	  	  <div class="form-group">
	  	  	<button type="button" class="btn btn-white btn-danger btn-bold btn-round pull-right btn-sm open-modal-delete-item" data-id="<?php echo $item->ID_inventori; ?>" data-ajuan="<?php echo $item->ID_pengajuan; ?>" style="margin-left: 20px;"><i class="fa fa-trash-o"></i> Hapus Barang ini</button>
	  	  </div>

	  	  <div class="form-group col-md-12"><hr></div>
<div id="block-item-<?php echo $item->ID_inventori; ?>" class="animated">
	  <div class="form-group col-md-12">
	    <label for="category[<?php echo $no; ?>]" class="col-sm-3 control-label">Kategori Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <select name="category[<?php echo $no; ?>].category" id="category-<?php echo $no; ?>" class="form-control" required="" data-id="<?php echo $item->item_category_id; ?>" data-name="<?php echo $item->category_name ?>">
	      	<option value="">-- PILIH --</option>
		<?php  
		/* Get All Category */
		foreach($parent_category as $cat) :
		?>
				<option value="<?php echo $cat->item_category_id; ?>" <?php echo ($cat->item_category_id==$item->item_category_id OR $cat->item_category_id==$item->category_parent) ? 'selected' : ''; ?>><?php echo $cat->category_name; ?></option>
		<?php  
		endforeach;
		?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="sub_category" class="col-sm-3 control-label">Sub Kategori Barang</label>
	    <div class="col-sm-6">
	      <select name="sub_category[<?php echo $no; ?>].sub_category" id="sub-<?php echo $no; ?>" class="form-control">
	      	<option value="">-- PILIH --</option>
	      </select>
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="name" class="col-sm-3 control-label">Nama Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="name[<?php echo $no; ?>].name" id="name" value="<?php echo $item->inventori_name; ?>" required="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="nominal" class="col-sm-3 control-label">Harga Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="nominal[<?php echo $no; ?>].nominal" id="nominal" required="" value="<?php echo $item->nominal; ?>" placeholder="Ex : 500000">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="serial" class="col-sm-3 control-label">Nomor Serial Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="serial_number[<?php echo $no; ?>].serial_number" id="serial" value="<?php echo $item->serial_number; ?>" required="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="vendor" class="col-sm-3 control-label">Vendor / Merk <strong class="text-danger">*</strong></label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="vendor[<?php echo $no; ?>].vendor" id="vendor" placeholder="Ex : Samsung, Canon, Olympic" required="" value="<?php echo $item->vendor; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="quantity" class="col-sm-3 control-label">Jumlah yang dibutuhkan <strong class="text-danger">*</strong></label>
	    <div class="col-sm-4">
	      <input type="number" class="form-control" name="quantity[<?php echo $no; ?>].quantity" id="quantity" required="" value="<?php echo $item->quantity; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="deskripsi[<?php echo $no; ?>]" class="col-sm-3 control-label">Deskripsi </label>
	    <div class="col-sm-9">
	      <textarea name="deskripsi[<?php echo $no; ?>]" id="deskripsi[<?php echo $no; ?>].deskripsi" class="form-control" rows="6"><?php echo $item->description; ?></textarea>
	    </div>
	  </div>
</div>
	  <div class="form-group col-md-12"><hr></div>
<?php  
$no++;
/* Ends Loops */
endforeach;
?>
	  	  <div class="form-group">
	  	  	<button type="button" class="btn btn-white btn-default btn-bold btn-round pull-right btn-sm addButton" data-template="barang" data-index="<?php $index = count($this->pengajuan->get_items($get->ID_pengajuan)); echo --$index; ?>"><i class="fa fa-plus"></i> Tambahkan Form Barang</button>
	  	  </div>
<div id="barangTemplate" class="hide">
	  	  <div class="form-group col-md-12"><hr></div>
	  	  <div class="form-group">
	  	  	<button type="button" class="btn btn-white btn-danger btn-bold btn-round pull-right btn-sm removeButton" style="margin-left: 20px;"><i class="fa fa-times"></i> Hapus Form ini</button>
	  	  </div>
	  	  <div class="form-group col-md-12"><hr></div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Kategori Barang <strong class="text-danger">*</strong></label>
		    <div class="col-sm-6">
		      <select name="category-hide" class="form-control" required="">
		      	<option value="">-- PILIH --</option>
			<?php  
			/* Get All Category */
			foreach($parent_category as $cat) :
			?>
					<option value="<?php echo $cat->item_category_id; ?>"><?php echo $cat->category_name; ?></option>
			<?php  
			endforeach;
			?>
		      </select>
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Sub Kategori Barang</label>
		    <div class="col-sm-6">
		      <select name="sub_category-hide" class="form-control">
		      	<option value="">-- PILIH --</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Nama Barang <strong class="text-danger">*</strong></label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" name="name-hide" id="name" required="">
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Harga Barang <strong class="text-danger">*</strong></label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="nominal-hide" id="nominal" required="" placeholder="Ex : 500000">
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Nomor Serial Barang <strong class="text-danger">*</strong></label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="serial_number-hide" id="serial" required="">
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Vendor / Merk <strong class="text-danger">*</strong></label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" name="vendor-hide" id="vendor" placeholder="Ex : Samsung, Canon, Olympic" required="">
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label class="col-sm-3 control-label">Jumlah yang dibutuhkan <strong class="text-danger">*</strong></label>
		    <div class="col-sm-4">
		      <input type="number" class="form-control" name="quantity-hide" required="">
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi </label>
		    <div class="col-sm-9">
		      <textarea name="deskripsi-hide" id="deskripsi" class="form-control" rows="6"></textarea>
		    </div>
		  </div>
</div>
	  <div class="form-group col-md-12">
	  <hr>
	    <strong class="text-danger">* </strong>: Wajib diisi!
	  </div>
	  <div class="col-md-12">
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>Simpan Perubahan
				</button>
				<a href="<?php echo site_url('pengajuan') ?>" class="btn" type="reset" style="margin-left: 100px;">
					<i class="ace-icon fa fa-undo bigger-110"></i> Reset
				</a>
			</div>
		</div>
	  </div>
<?php  
echo form_close();
?>
	</div>
</div>

<!-- Hapus Barang -->
<div class="modal" id="modal-hapus-item">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title text-white"><i class="fa fa-question-circle"></i> Hapus Barang ini ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-warning bigger-110">
					Hapus produk ini dari pengajuan anda.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin akan menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a id="btn-cancel" class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<a id="button-yes" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
			</div>
		</div>
	</div>
</div>
