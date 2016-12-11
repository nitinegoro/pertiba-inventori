<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
	<div class="col-md-10 col-md-offset-1">
<?php  
echo form_open(site_url('pengajuan/insert'), array('class'=>'form-horiontal', 'id' => 'form_buat_pengajuan'));
?>
	  <div class="form-group col-md-12">
	  	<blockquote>Pengajuan  </blockquote>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="vendor" class="col-sm-3 control-label">Tanggal <strong class="text-danger">*</strong></label>
	    <div class="col-sm-4">
			<div class="input-group">
			  <input type="text" class="form-control date-picker" name="tanggal" placeholder="Ex : <?php echo date('Y-m-d') ?>" required="">
			  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
	    </div>
	  </div>
	  	  <div class="form-group">
	  	  	<button type="button" class="btn btn-white btn-default btn-bold btn-round pull-right btn-sm addButton" data-template="barang"><i class="fa fa-plus"></i> Tambahkan Form Barang</button>
	  	  </div>
	  	  <div class="form-group col-md-12"><hr></div>
	  <div class="form-group col-md-12">
	    <label for="category[]" class="col-sm-3 control-label">Kategori Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <select name="category[0].category" id="category" class="form-control" required="">
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
	    <label for="sub_category" class="col-sm-3 control-label">Sub Kategori Barang</label>
	    <div class="col-sm-6">
	      <select name="sub_category[0].sub_category" id="sub_category" class="form-control">
	      	<option value="">-- PILIH --</option>
	      </select>
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="name" class="col-sm-3 control-label">Nama Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="name[0].name" id="name" required="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="nominal" class="col-sm-3 control-label">Harga Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="nominal[0].nominal" id="nominal" required="" placeholder="Ex : 500000">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="serial" class="col-sm-3 control-label">Nomor Serial Barang <strong class="text-danger">*</strong></label>
	    <div class="col-sm-6">
	      <input type="text" class="form-control" name="serial_number[0].serial_number" id="serial" required="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="vendor" class="col-sm-3 control-label">Vendor / Merk <strong class="text-danger">*</strong></label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="vendor[0].vendor" id="vendor" placeholder="Ex : Samsung, Canon, Olympic" required="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="quantity" class="col-sm-3 control-label">Jumlah yang dibutuhkan <strong class="text-danger">*</strong></label>
	    <div class="col-sm-4">
	      <input type="number" class="form-control" name="quantity[0].quantity" id="quantity" required="">
	    </div>
	  </div>
	  <div class="form-group col-md-12">
	    <label for="deskripsi[]" class="col-sm-3 control-label">Deskripsi </label>
	    <div class="col-sm-9">
	      <textarea name="deskripsi[0]" id="deskripsi[0].deskripsi" class="form-control" rows="6"></textarea>
	    </div>
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