<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  Account module 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Account extends Administrator_Controller 
{

	public $data = array();

	public function __construct()
	{
		parent::__construct();
		// load Settings model
		//$this->load->model('moption','option');
		// generate defaul breadcrumbds page
		$this->breadcrumbs->unshift(1, $this->lang->line('account'), 'administrator/account');
		$this->ci->load->js(base_url('assets/backend/app/js_account.js'));
	}

	public function index()
	{
		//$this->breadcrumbs->unshift(2, $this->lang->line('user_setting'), 'administrator/account');
		$this->page_title->push(lang('account'), lang('user_setting'));

		$this->data = array(
			'title' => lang('account')."\n".lang('user_setting'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
		);
		$this->template->view('account/setting', $this->data);
	}


	public function security()
	{
		$this->breadcrumbs->unshift(2, $this->lang->line('user_change_password'), 'administrator/account');
		$this->page_title->push(lang('account'), lang('user_change_password'));

		$this->data = array(
			'title' => lang('user_change_password')."\n".lang('user_setting'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
		);
		$this->template->view('account/change_password', $this->data);
	}

}

/* End of file Account.php */
/* Location: ./application/modules/administrator/controllers/Account.php */