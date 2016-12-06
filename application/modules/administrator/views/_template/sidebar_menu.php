<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* End of file sidebar_menu.php */
/* Location: ./application/modules/administrator/views/_template/sidebar_menu.php */ 
?>
<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>

	<div id="sidebar" class="sidebar responsive">
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
		</script>
<?php  
/**
 * Setting Menus sidebar area
 *
 * @category template menu
 **/
?>
		<div class="sidebar-shortcuts" id="sidebar-shortcuts">
			<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
				<a href="" class="btn btn-info">
					<i class="ace-icon fa fa-pencil"></i>
				</a>
				<a href="<?php echo site_url('administrator/users') ?>" class="btn btn-warning">
					<i class="ace-icon fa fa-users"></i>
				</a>
				<a href="" class="btn btn-danger">
					<i class="ace-icon fa fa-cogs"></i>
				</a>
			</div>

			<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
				<a href="" class="btn btn-info"></a>
				<a href="<?php echo site_url('administrator/users') ?>" class="btn btn-warning"></a>
				<a href="" class="btn btn-danger"></a>
			</div>
		</div><!-- /.sidebar-shortcuts -->

		<ul class="nav nav-list">
			<li class="<?php echo active_link_controller('dashboard'); ?>">
				<a href="<?php echo site_url('administrator'); ?>">
					<i class="menu-icon fa fa-tachometer"></i>
					<span class="menu-text"> <?php echo lang('menu_main'); ?> </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo active_link_controller('post'); ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-pencil"></i>
					<span class="menu-text"> <?php echo lang('menu_post'); ?> </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?php echo active_link_method('index','post'); ?>">
						<a href="<?php echo site_url('administrator/post') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_post_all'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('add_post'); ?>">
						<a href="<?php echo site_url('administrator/post/add_post') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_post_add'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('category'); ?>">
						<a href="<?php echo site_url('administrator/post/category') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_post_category'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('tags'); ?>">
						<a href="<?php echo site_url('administrator/post/tags') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_post_tags'); ?>
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>

			<li class="<?php echo active_link_method('index','comment'); ?>">
				<a href="<?php echo site_url('administrator/comment') ?>">
					<i class="menu-icon fa fa-comments-o"></i>
					<span class="menu-text"> <?php echo lang('menu_comment'); ?> </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo active_link_controller('page'); ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-file-o"></i>
					<span class="menu-text"> <?php echo lang('menu_pages'); ?> </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?php echo active_link_method('index','page'); ?>">
						<a href="<?php echo site_url('administrator/page') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_pages_all'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('add_page'); ?>">
						<a href="<?php echo site_url('administrator/page/add_page') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_pages_add'); ?>
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>

			<li class="<?php echo active_link_controller('pustaka'); ?>">
				<a href="">
					<i class="menu-icon fa fa-image"></i>
					<span class="menu-text"> <?php echo lang('menu_library'); ?> </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo active_link_controller('appearance'); ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-cogs"></i>
					<span class="menu-text"> <?php echo lang('menu_appearance'); ?> </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?php echo active_link_method('menus'); ?>">
						<a href="">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_appearance_menu'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('banner'); ?>">
						<a href="">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_appearance_banner'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('widget'); ?>">
						<a href="">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_appearance_widget'); ?>
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>

			<li class="<?php echo active_link_controller('users'); ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-users"></i>
					<span class="menu-text"> <?php echo lang('menu_user'); ?> </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?php echo active_link_method('index','users'); ?>">
						<a href="<?php echo site_url('administrator/users'); ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_user_all'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('add'); ?>">
						<a href="<?php echo site_url('administrator/users/add') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_user_add'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('role'); ?>">
						<a href="<?php echo site_url('administrator/users/role') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_user_role'); ?>
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>

			<li class="<?php echo active_link_controller('settings'); ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-wrench"></i>
					<span class="menu-text"> <?php echo lang('menu_setting'); ?> </span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?php echo active_link_method('index', 'settings'); ?>">
						<a href="<?php echo site_url('administrator/settings') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_setting_general'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('reading'); ?>">
						<a href="<?php echo site_url('administrator/settings/reading') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_setting_reading'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('email'); ?>">
						<a href="<?php echo site_url('administrator/settings/email') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_setting_email'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('permalink'); ?>">
						<a href="<?php echo site_url('administrator/settings/permalink') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_setting_permalink'); ?>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php echo active_link_method('addon'); ?>">
						<a href="<?php echo site_url('administrator/settings/addon') ?>">
							<i class="menu-icon fa fa-caret-right"></i><?php echo lang('menu_setting_addon'); ?>
						</a>
						<b class="arrow"></b>
					</li>
				</ul>
			</li>

		</ul><!-- /.nav-list -->

		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>

		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
		</script>
	</div>
	<div class="main-content">
		<div class="main-content-inner">
			<div class="breadcrumbs fixed" id="breadcrumbs">
				<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>
				
<?php 
/**
 * Generate Breadcrumbs from library
 *
 * @var string
 **/
	echo $breadcrumb; 
?>

				<div class="nav-search" id="nav-search">
					<form class="form-search">
						<span class="input-icon">
							<input type="text" placeholder="<?php echo lang('form_search'); ?>" class="nav-search-input" id="nav-search-input" autocomplete="off" />
							<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span>
					</form>
				</div><!-- /.nav-search -->
			</div>

			<div class="page-content">
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="ace-icon fa fa-cog bigger-130"></i>
					</div>
					<div class="ace-settings-box clearfix" id="ace-settings-box">
						<div class="pull-left width-50">
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
								<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
								<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
								<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
								<label class="lbl" for="ace-settings-add-container">
									Inside <b>.container</b>
								</label>
							</div>
						</div><!-- /.pull-left -->
						<div class="pull-left width-50">
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
								<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
								<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
							</div>
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
								<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
							</div>
						</div><!-- /.pull-left -->
					</div><!-- /.ace-settings-box -->
				</div><!-- /.ace-settings-container -->

<div class="page-header">
<?php  
/**
 * Generated Page Title
 *
 * @return string
 **/
	echo $page_title;
?>
</div><!-- /.page-header -->