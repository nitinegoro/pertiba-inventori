<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Sunting Pilihan Kondisi Baru</h4><hr>
			</div>
	<?php echo form_open(site_url("inventori/editcondition/{$get->condition_id}"), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="kondisi" class="col-sm-2 control-label">Kondisi</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="kondisi" value="<?php echo $get->c_name; ?>" required="">
		    	</div>
		  	</div>
			<div class="form-group col-md-12">
				<label class="col-sm-2 control-label" for="deskripsi">Deskripsi</label>
				<div class="col-sm-10">
					<textarea name="deskripsi" class="form-control" rows="3"><?php echo $get->c_description; ?></textarea>
				</div>
			</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Simpan Perubahan
						</button>
						<a href="<?php echo site_url('inventori/condition') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Kembali
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>