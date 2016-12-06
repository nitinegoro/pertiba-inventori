<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* End of file setting.php */
/* Location: ./application/modules/administrator/views/account/setting.php */
?>
<div class="row">
	<div class="col-md-12" style="min-height:400px;">
		<div id="user-profile-2" class="user-profile">
			<div class="tabbable">
				<ul class="nav nav-tabs padding-18">
					<li>
						<a href="<?php echo site_url('administrator/account'); ?>">
							<i class="green ace-icon fa fa-user bigger-120"></i> <?php echo lang('account'); ?>
						</a>
					</li>
					<li class="active">
						<a href="<?php echo site_url('administrator/account/security') ?>">
							<i class="red ace-icon fa fa-key bigger-120"></i> <?php echo lang('user_change_password'); ?>
						</a>
					</li>
				</ul>

				<div class="tab-content no-border padding-24">
					<div id="home" class="tab-pane in active">
						<div class="row">
							<div class="col-md-12">
<?php echo form_open(site_url(''), array('class' => 'form-horizontal', 'id' => 'change_password')); ?>
							<div class="form-group">
								<label class="col-sm-2" for="new_pass"> <?php echo lang('new_pass') ?>  </label>
								<div class="col-sm-6">
					            <input type="password" class="form-control" name="password"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2" for="pass_again"> <?php echo lang('pass_again') ?> </label>
								<div class="col-sm-6">
					            <input type="password" class="form-control" name="again" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2" for="old_password"> <?php echo lang('old_pass') ?> </label>
								<div class="col-sm-6">
									<input type="password" name="old_password" class="form-control" />
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i> <?php echo lang('btn_create_new_user'); ?>
									</button>
									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="submit">
										<i class="ace-icon fa fa-undo bigger-110"></i> <?php echo lang('btn_cancel'); ?>
									</button>
								</div>
							</div>
							<div class="space-4"></div>
<?php echo form_close(); ?>
							</div>
						</div><!-- /.row -->
					</div><!-- /#home -->
				</div>
			</div>
		</div>		
	</div>
</div>