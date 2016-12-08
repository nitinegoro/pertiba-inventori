<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
	<div class="col-md-10 col-md-offset-1">
<?php  
echo form_open(site_url("inventori/update/{$get->ID_inventori}"), array('class'=>'form-horiontal', 'id' => 'form_buat_pengajuan'));
?>
	  <div class="form-group col-md-12">
	    <label for="name" class="col-sm-3 control-label">Nomor Inventaris</strong></label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="name" id="name" value="<?php echo $get->NO_inventori; ?>" disabled="" readonly="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="category" class="col-sm-3 control-label">Kategori Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <select name="category" id="category" class="form-control" required="" data-id="<?php echo $get->item_category_id; ?>">
	      	<option value="">-- PILIH --</option>
		<?php  
		/* Get All Category */
		foreach($parent_category as $cat) :
		?>
				<option value="<?php echo $cat->item_category_id; ?>" <?php echo ($cat->item_category_id==$get->item_category_id OR $cat->item_category_id==$get->category_parent) ? 'selected' : ''; ?>><?php echo $cat->category_name; ?></option>
		<?php  
		endforeach;
		?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="sub_category" class="col-sm-3 control-label">Sub Kategori Barang</label>
	    <div class="col-sm-6">
	      <select name="sub_category" id="sub_category" class="form-control">
	      	<option value="">-- PILIH --</option>
	      </select>
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="name" class="col-sm-3 control-label">Nama Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="name" id="name" required="" value="<?php echo $get->inventori_name; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="nominal" class="col-sm-3 control-label">Harga Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="nominal" id="nominal" required="" placeholder="Ex : 500000" value="<?php echo $get->nominal; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="serial" class="col-sm-3 control-label">Nomor Serial Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="serial_number" id="serial" required="" value="<?php echo $get->serial_number; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="vendor" class="col-sm-3 control-label">Vendor / Merk <strong class="text-danger">*</strong></label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="vendor" id="vendor" placeholder="Ex : Samsung, Canon, Olympic" required="" value="<?php echo $get->vendor; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="quantity" class="col-sm-3 control-label">Jumlah yang dibutuhkan <strong class="text-danger">*</strong></label>
	    <div class="col-sm-4">
	      <input type="number" class="form-control" name="quantity" id="quantity" required="" value="<?php echo $get->quantity; ?>">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi </label>
	    <div class="col-sm-9">
	      <textarea name="deskripsi" id="deskripsi" class="form-control" rows="6"><?php echo $get->description; ?></textarea>
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="kondisi" class="col-sm-3 control-label">Kondisi </label>
	    <div class="col-sm-6">
	      <select name="kondisi" id="kondisi" class="form-control">
	      	<option value="">-- PILIH --</option>
		<?php  
		/* Get All Category */
		foreach($condition as $c) :
		?>
				<option value="<?php echo $c->condition_id; ?>" <?php echo ($c->condition_id==$get->kondisi) ? 'selected' : ''; ?>><?php echo $c->c_name; ?></option>
		<?php  
		endforeach;
		?>
	      </select>
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
					<i class="ace-icon fa fa-check bigger-110"></i>Buat Pengajuan
				</button>
				<button class="btn" type="reset" style="margin-left: 100px;">
					<i class="ace-icon fa fa-undo bigger-110"></i> Reset
				</button>
			</div>
		</div>
	  </div>
<?php  
echo form_close();
?>
	</div>
</div>