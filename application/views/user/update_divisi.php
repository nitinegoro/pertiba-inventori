<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Sunting Divisi</h4><hr>
			</div>
<?php 
echo form_open(site_url("user/bulkdivisi"), array('class' => 'form-horiontal')); 
	/* Checking data */
	if(is_array($this->input->post('divisi'))) :
		/* Loop Tags */
		foreach($this->input->post('divisi') as $key => $value) :
		echo form_hidden('divisi[]', $value); 
		$get = $this->divisi->get($value); 
?>
		  	<div class="form-group col-md-12">
		    	<label for="name[]" class="col-sm-2 control-label">Nama Divisi</label>
		    	<div class="col-sm-10">
		      	<input type="text" class="form-control" name="name[]" value="<?php echo $get->division_name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12"><hr></div>
<?php  
		/* end Loops */
		endforeach;
?>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit" name="action" value="update">
							<i class="ace-icon fa fa-check bigger-110"></i>Simpan Perubahan
						</button>
						<a href="<?php echo site_url('user/divisi') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Kembali
						</a>
					</div>
				</div>
			  </div>
<?php 
	else :
		// else not array tags back to list tags page
		$this->template->alert(
			" Tidak ada yang dipilih", 
			array('type' => 'warning', 'icon' => 'info')
		);
		redirect('user/divisi');
	endif;
echo form_close(); 
?>
		</div>
	</div>

</div>