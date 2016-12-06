<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  dashboard page 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  http://teitramega.co.id
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Dashboard extends Administrator_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();
 		$this->page_title->push(lang('menu_main'));
	}

	public function index()
	{
		$this->data = array(
			'title' => "Dashboard",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);
		$this->template->view('index', $this->data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/administrator/controllers/Dashboard.php */