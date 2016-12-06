<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Sunting Kategori Baru</h4><hr>
			</div>
<?php 
echo form_open(site_url("inventori/bulkcategory"), array('class' => 'form-horiontal')); 
	/* Checking data */
	if(is_array($this->input->post('categories'))) :
		/* Loop Tags */
		foreach($this->input->post('categories') as $key => $value) :
		echo form_hidden('category[]', $value); 
		echo form_hidden('action', 'update');
		$get = $this->category->get($value); 
?>
		  	<div class="form-group col-md-12">
		    	<label for="name[]" class="col-sm-2 control-label">Nama Kategori</label>
		    	<div class="col-sm-10">
		      	<input type="text" class="form-control" name="name[]" value="<?php echo $get->category_name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="parent[]" class="col-sm-2 control-label">Turunan</label>
		    	<div class="col-sm-10">
				<select name="parent[]" class="form-control">
					<option value="">- PILIH -</option>
			<?php  
			/* Get All Category */
			foreach($parent_category as $cat) :
			?>
					<option value="<?php echo $cat->item_category_id; ?>" <?php echo ($cat->item_category_id==$get->category_parent) ? 'selected' : ''; ?>><?php echo $cat->category_name; ?></option>
			<?php  
			endforeach;
			?>
				</select>
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
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Simpan Perubahan
						</button>
						<a href="<?php echo site_url('inventori/category') ?>" class="btn" type="reset" style="margin-left: 100px;">
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
		redirect('inventori/category');
	endif;
echo form_close(); 
?>
		</div>
	</div>

</div>