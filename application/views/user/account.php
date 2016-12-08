<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Pengaturan Password</h4><hr>
			</div>
	<?php echo form_open(site_url("user/account_setting"), array('class' => 'form-horiontal', 'id' => 'account_setting')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="username" class="col-sm-3 control-label">Username <strong class="text-danger">*</strong></label>
		    	<div class="col-sm-9">
		      		<input type="text" class="form-control" name="username" value="<?php echo $this->session->userdata('user')->username; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="password" class="col-sm-3 control-label">Password Baru</label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="password" id="password" value="">
		      		<p class="help-block"><i>Masukkan password baru bila ingin mengganti password.</i></p>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="pass_again" class="col-sm-3 control-label">Ulangi Password</label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="pass_again" value="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="old_pass" class="col-sm-3 control-label">Password Lama <strong class="text-danger">*</strong></label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="old_pass" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		  		<hr>
		    	<strong class="text-danger">*</strong> : <i>Wajib diisi!</i>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Simpan
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Kembali
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>