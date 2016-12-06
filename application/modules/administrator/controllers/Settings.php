<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  Settings module 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Settings extends Administrator_Controller
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		// load Settings model
		$this->load->model('moption','option');
		// generate defaul breadcrumbds page
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_setting'), 'administrator/settings');
		$this->ci->load->js(base_url('assets/backend/app/js_setting.js'));
		$this->load->helper(array('file'));
	}

	/**
	* page setting general
	* @return html output 
	*/
	public function index()
	{
		$this->page_title->push(lang('menu_setting'), lang('menu_setting_general'));

		$this->data = array(
			'title' => lang('menu_setting')."\n".lang('menu_setting_general'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files()
		);
		$this->template->view('settings/general', $this->data);
	}

	/**
	* page setting reading
	* @return html output 
	*/
	public function reading()
	{

		$this->page_title->push(lang('menu_setting'), lang('menu_setting_reading'));

		$this->data = array(
			'title' => lang('menu_setting')."\n".lang('menu_setting_reading'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);
		$this->template->view('settings/reading', $this->data);
	}

	/**
	* page setting email
	* @return html output 
	*/
	public function email()
	{
		$this->page_title->push(lang('menu_setting'), lang('menu_setting_email'));

		$this->data = array(
			'title' => lang('menu_setting')."\n".lang('menu_setting_email'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);
		$this->template->view('settings/email', $this->data);
	}

	/**
	* page setting permalink
	* @return html output 
	*/
	public function permalink()
	{
		$this->page_title->push(lang('menu_setting'), lang('menu_setting_permalink'));

		$this->data = array(
			'title' => lang('menu_setting')."\n".lang('menu_setting_permalink'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);
		$this->template->view('settings/permalink', $this->data);
	}

	/**
	* page setting addon
	* @return html output 
	*/
	public function addon()
	{
		$this->page_title->push(lang('menu_setting'), lang('menu_setting_addon'));
		$this->ci->load->js(base_url('assets/backend/app/js_setting.js'));
		
		$this->data = array(
			'title' => lang('menu_setting')."\n".lang('menu_setting_addon'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'custom_css' => read_file(FCPATH . "assets/includes/style.css"),
			'custom_js' => read_file(FCPATH . "assets/includes/javascript.js")
		);
		$this->template->view('settings/addon', $this->data);
	}


	/**
	 * Update option settings
	 *
	 * @return String (flash_data)
	 **/
	public function set($param = '')
	{
		foreach ($this->input->post('option') as $key => $value) 
		{
			$this->option->update($key, $value);
		}
		$this->template->alert(
			lang('alert_setting_success'), 
			array('type' => 'success','title' => lang('success'), 'icon' => 'check')
		);

		if($param == 'addon')
		{
			write_file(FCPATH . "assets/includes/style.css", $this->input->post('css'));
			write_file(FCPATH . "assets/includes/javascript.js", $this->input->post('js'));	
		}

		if($param == 'general')
			redirect('administrator/settings');
		
		redirect("administrator/settings/{$param}");
	}

}

/* End of file Settings.php */
/* Location: ./application/modules/administrator/controllers/Settings.php */