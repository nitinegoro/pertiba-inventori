<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo (isset($title)) ? $title : "Unknow Title"; ?> - Web Administrator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/font-awesome/4.2.0/css/font-awesome.min.css'); ?>" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/jquery-ui.min.css'); ?>" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/fonts/fonts.googleapis.com.css'); ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ace.min.css'); ?>" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/validation/css/formValidation.css') ?>">
    	<link rel="stylesheet" href="<?php echo base_url('assets/backend/codemirror/lib/codemirror.css'); ?>"/>
    	<link rel="stylesheet" href="<?php echo base_url('assets/backend/codemirror/theme/3024-day.css'); ?>"/>
    	<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap-editable.min.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/jquery.gritter.min.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('vendor/tinymce/skins/light/skin.min.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('vendor/tinymce/skins/light/content.inline.min.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('vendor/tinymce/filemanager/fancybox/jquery.fancybox.css'); ?>" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap-duallistbox.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap-multiselect.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/select2.min.css'); ?>" />
		<style>
			ul .submenu .active { font-weight: bold; }
		</style>
<?php 
/**
 * Load css from loader core
 *
 * @return CI_OUTPUT
 **/
if(isset($css) !== FALSE) : foreach($css as $file) : ?>
		<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
<?php endforeach; endif; ?>
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ace-part2.min.css'); ?>" class="ace-main-stylesheet" />
		<![endif]-->
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ace-ie.min.css'); ?>" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<!-- ace settings handler -->
		<script src="<?php echo base_url('assets/backend/js/ace-extra.min.js'); ?>"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="<?php echo base_url('assets/backend/js/html5shiv.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/backend/js/respond.min.js'); ?>"></script>
		<![endif]-->
		<style>
			.turun-20 { margin-top: 20px;  }
		</style>
	</head>
