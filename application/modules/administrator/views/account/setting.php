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
					<li class="active">
						<a href="<?php echo site_url('administrator/account'); ?>">
							<i class="green ace-icon fa fa-user bigger-120"></i> <?php echo lang('account'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('administrator/account/security') ?>">
							<i class="red ace-icon fa fa-key bigger-120"></i> <?php echo lang('user_change_password'); ?>
						</a>
					</li>
				</ul>

				<div class="tab-content no-border padding-24">
					<div id="home" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 col-sm-3 center">
								<span class="profile-picture">
									<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php echo base_url('assets/backend/avatars/profile-pic.jpg'); ?>" />
								</span>
								<div class="space space-4"></div>
							</div><!-- /.col -->
							<div class="col-xs-12 col-sm-9">
								<h4 class="blue">
									<span class="middle">Alex M. Doe</span>
									<span class="label label-purple arrowed-in-right">
										<i class="ace-icon fa fa-circle smaller-80 align-middle"></i> online
									</span>
								</h4>
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> <?php echo lang('field_username'); ?> </div>
										<div class="profile-info-value">
											<span class="editable" id="username">alexdoe</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> <?php echo lang('field_email'); ?> </div>
										<div class="profile-info-value">
											<span class="editable" id="user_email">alexdoe</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> <?php echo lang('field_phone'); ?> </div>
										<div class="profile-info-value">
											<span class="editable" id="user_phone">alexdoe</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> <?php echo lang('about_me'); ?> </div>
										<div class="profile-info-value">
											<span class="editable" id="about" style="width:100%;">Editable as WYSIWYG</span>
										</div>
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /#home -->
				</div>
			</div>
		</div>		
	</div>
</div>