<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  Comments module 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Comment extends Administrator_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();
		// load Settings model
		$this->load->model('mcomment','comment');
		// generate defaul breadcrumbds page
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_comment'), 'administrator/comment');
	}

	public function index()
	{
		$this->page_title->push(lang('menu_comment'));

		$query = array(
			'q' => $this->input->get('q'),
			'filter' => $this->input->get('filter'),
			'order' => $this->input->get('order'),
			'order_by' => $this->input->get('order_by'),
			'page' => $this->input->get('page') 
		);	

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("administrator/comment?q={$query['q']}&filter={$query['filter']}&order={$query['order']}&order_by={$query['order_by']}");
		$config['per_page'] = 1;
		$config['total_rows'] = $this->comment->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => lang('menu_comment'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'comments' => $this->comment->get_all($config['per_page'], $query['page'], 'result')
		);
		$this->template->view('comment/all_comment', $this->data);
	}

}

/* End of file Comment.php */
/* Location: ./application/modules/administrator/controllers/Comment.php */