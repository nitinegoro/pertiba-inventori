<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  Page Controller 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Page extends Administrator_Controller 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		// load Settings model
		$this->load->model('mpage','page');
		// generate defaul breadcrumbds page
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_pages'), 'administrator/page');
		$this->ci->load->js(base_url('assets/backend/app/js_page.js'));
	}

	/**
	* All page
	* @return html output 
	*/
	public function index()
	{
		$this->page_title->push(lang('menu_pages'), lang('menu_pages_all'));

		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("administrator/page?q={$keyword}&order=asc");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->page->get_all($keyword, null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => lang('menu_pages')."\n".lang('menu_pages_all'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'pages' => $this->page->get_all($config['per_page'], $page, 'result')
		);
		$this->template->view('pages/all_pages', $this->data);
	}

	/**
	 * Handle insert data
	 *
	 * @return void
	 **/
	public function insert()
	{
		$this->page->insert();
		redirect('administrator/page');
	}

	/**
	 * Handle update page
	 *
	 * @param Integer
	 * @return string
	 **/
	public function get($action = 0)
	{
		$this->filemanager();
		
		if(is_numeric($action))
		{
			$this->page_title->push(lang('menu_pages'), lang('menu_pages_edit'));
			
			$this->data = array(
				'title' => lang('menu_pages'),
				'breadcrumb' => $this->breadcrumbs->show(),
				'page_title' => $this->page_title->show(),
				'js' => $this->ci->load->get_js_files(),
				'get' => $this->page->get($action)
			);
			$this->template->view('pages/edit_page', $this->data);
		} else {
			show_404();
		}
	}

	/**
	 * Handle Update data post
	 *
	 * @param Integer
	 * @return void
	 **/
	public function update($action = 0)
	{
		$this->page->update($action);
		redirect("administrator/page/get/{$action}");
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function delete($action = 0)
	{
		$this->page->delete($action);
		redirect('administrator/page');
	}

	/**
	* Create page
	* @return html output 
	*/
	public function add_page()
	{
		$this->page_title->push(lang('menu_pages'), lang('menu_pages_add'));
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_pages_add'), 'administrator/pages');
		$this->filemanager();
		
		$this->data = array(
			'title' => lang('menu_pages')."\n".lang('menu_pages_add'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
		);
		$this->template->view('pages/add_page', $this->data);
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return string
	 **/
	public function bulk_action()
	{
		for($i = 0; $i < count($this->input->post('page')); $i++)
		{
			$obj = $this->page->get($this->input->post("page[{$i}]"));

			$this->db->delete('tb_posts', array('ID' => $this->input->post("page[{$i}]")));
		}

		if($this->db->affected_rows())
		{
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_page_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_empty_changed'), 
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
		redirect('administrator/page');
	}
}

/* End of file Page.php */
/* Location: ./application/modules/administrator/controllers/Page.php */