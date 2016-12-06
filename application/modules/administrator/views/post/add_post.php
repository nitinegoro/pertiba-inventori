<div class="row">
	<div class="col-md-12" style="min-height: 700px;">
<?php echo form_open_multipart(site_url('administrator/post/insert'), array('class' => 'form-horizontal', 'id' => 'form_add_user')); ?>
		<div class="col-md-9">
			<div class="form-group">
				<input type="text" name="title" class="form-control" placeholder="<?php echo lang('enter_title') ?>" id="title" required />
				<p class="help-block">
					<strong>Permalink :</strong> 
					<span class="blue"><?php echo base_url(); ?><span id="permalink-page"></span> </span>
				</p>
			</div>
			<div class="form-group">
				<textarea class="form-control" id="editor-tinymce" name="content"></textarea>
			</div>
			<div class="space-4"></div>
		</div>

		<div class="col-md-3">
			<div class="widget-box">
				<div class="widget-header">
					<h6 class="widget-title"><?php echo lang('menu_setting'); ?></h6>
					<div class="widget-toolbar">
						<a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="padding">
							<label for="form-field-select-1"><?php echo lang('status') ?></label>
							<?php 
							/**
							 * Post Status
							 *
							 **/
							echo form_dropdown(
									'status', 
									array('open' => lang('open'), 'pending' => lang('pending'), 'draft' => lang('draft')),
									'publish', 
									array('class' => 'form-control input-sm')
								);
							?>
						</div>
						<div class="space-4"></div>
						<div class="padding">
							<label for="form-field-select-1"><?php echo lang('menu_comment') ?></label>
							<?php 
							/**
							 * Comment Config
							 *
							 **/
							echo form_dropdown(
									'comment', 
									array('open' => lang('activated'), 'close' => lang('no')),
									'open', 
									array('class' => 'form-control input-sm')
								);
							?>
						</div>
						<div class="space-4"></div>
						<div class="padding">
							<label for="form-field-select-1"><?php echo lang('seo_title') ?></label>
							<input type="text" class="form-control" name="page_uri" id="custom-uri">
						</div>
						<div class="space-4"></div>
						<div class="padding">
							<label for="form-field-select-1"><?php echo lang('meta_description') ?></label>
							<textarea class="form-control" name="meta_description"></textarea>
						</div>
						<div class="padding center">
							<hr>
							<button type="submit" class="btn btn-app btn-primary btn-xs"><i class="ace-icon fa fa-save"></i><?php echo lang('btn_save'); ?></button>
							<a href="<?php echo site_url('administrator/post') ?>" class="btn btn-app btn-default btn-xs"><i class="ace-icon fa fa-times"></i><?php echo lang('btn_cancel') ?></a>
						</div>	
					</div>
				</div>
			</div>
			<hr>
			<div class="widget-box">
				<div class="widget-header">
					<h6 class="widget-title"><?php echo lang('group_widget'); ?></h6>
					<div class="widget-toolbar">
						<a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">	
						<div id="image-preview"></div>
						<div class="space-4"></div>
						<label for=""><?php echo lang('menu_post_category') ?></label><br>
						<select multiple="" id="state" name="category[]" class="select2" data-placeholder="<?php echo lang('menu_post_category') ?>..">
					<?php  
					/* Get All Category */
					foreach($all_category as $cat) :
					?>
							<option value="<?php echo $cat->category_id; ?>"><?php echo $cat->name; ?></option>
					<?php  
					endforeach;
					?>
						</select>
						<div class="space-4"></div>
						<div class="space-4"></div>
						<label for=""><?php echo lang('menu_post_tags') ?></label><br>
						<div class="padding">
							<input type="text" name="tags" id="form-field-tags" value="" placeholder="Enter <?php echo lang('menu_post_tags') ?> ..." />
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="widget-box">
				<div class="widget-header">
					<h6 class="widget-title"><?php echo lang('set_featured_image'); ?></h6>
					<div class="widget-toolbar">
						<a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">	
						<div id="image-preview"></div>
						<div class="space-4"></div>
						<div class="input-group">
							<input type="text" name="image" class="form-control" id="picture" name="post_picture" value="" placeholder="" >
							<span class="input-group-btn">
								<a href="<?php echo base_url("vendor/tinymce/filemanager/dialog.php?type=1&akey={$this->session->userdata('random_filemanager_key')}&field_id=picture") ?>" id="browse-file" class="btn btn-primary btn-sm" >Pilih Gambar</a>
							</span>
						</div>
						<div class="space-4"></div>
						<div class="padding">
							<label for="image_description"><?php echo lang('attribute_description'); ?></label>
							<textarea class="form-control" name="image_description"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>	
<?php echo form_close(); ?>
	</div>
</div>

