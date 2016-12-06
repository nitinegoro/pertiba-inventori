<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  user module 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Users extends Administrator_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();
		// load users model
		$this->load->model('musers','user');
		// generate defaul breadcrumbds page
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_user'), 'administrator/users');
	}

	public function index()
	{
		$this->page_title->push(lang('menu_user'), lang('menu_user_all'));
		$this->ci->load->js(base_url('assets/backend/app/js_user.js'));
		
		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');
		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("administrator/users?q={$keyword}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->user->get_all($keyword, null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => lang('menu_user'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'users' => $this->user->get_all($keyword, $config['per_page'], $page)
		);
		$this->template->view('users/all_users', $this->data);
		
	}

	/**
	 * Page Add user
	 *
	 * @return html output
	 **/
	public function add()
	{
		$this->ci->load->js(base_url('assets/backend/app/js_user.js'));
		$this->breadcrumbs->unshift(2, $this->lang->line('menu_user_add'), 'administrator/users/user_add');
		$this->page_title->push(lang('menu_user'), lang('menu_user_add'));

		// data send with template output 
		$this->data = array(
			'title' => lang('menu_user_add'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'role_access' => $this->user->get_role()->result_array()
		);

		$this->template->view('users/create_user', $this->data);
	}

	/**
	 * page Edit user
	 *
	 * @return html output
	 **/
	public function edit($user = 0)
	{
		$data_user = $this->user->get($user);
		if(!$data_user)
			show_404();

		$this->ci->load->js(base_url('assets/backend/app/js_user.js'));
		$this->breadcrumbs->unshift(2, $this->lang->line('menu_user_add'), 'administrator/users/user_add');
		$this->page_title->push(lang('menu_user'), lang('btn_update_user'));

		// data send with template output 
		$this->data = array(
			'title' => lang('btn_update_user'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'role_access' => $this->user->get_role()->result_array(),
			'obj' => $data_user
		);

		$this->template->view('users/update_user', $this->data);
	}

	/**
	 * Inserting data user
	 *
	 * @return void
	 **/
	public function insert()
	{
		$this->user->insert();
		redirect('administrator/users');
	}

	/**
	 * Updating data user
	 *
	 * @return void
	 **/
	public function update($user = 0)
	{
		$this->user->update($user);
		redirect("administrator/users/edit/{$user}");
	}

	/**
	 * Deleting data user
	 *
	 * @return void
	 **/
	public function delete($user = 0)
	{
		$this->user->delete($user);
		redirect('administrator/users');
	}


	/**
	 * Multiple Action 
	 *
	 * @return void
	 **/
	public function bulk_action()
	{
		for($i = 0; $i < count($this->input->post('user')); $i++)
		{
			$obj = $this->user->get($this->input->post("user[{$i}]"));

			if($obj->user_avatar !== '')
				unlink("assets/images/{$obj->user_avatar}");

			$this->db->delete('tb_users', array('user_id' => $this->input->post("user[{$i}]")));
		}

		if($this->db->affected_rows())
		{
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_user_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_empty_changed'), 
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
		redirect('administrator/users');
	}

	/**
	 * get validating username usages 
	 *
	 * @return string
	 **/
	public function getusername()
	{
		$query = $this->db->query("SELECT username FROM tb_users WHERE username = ?", array($this->input->post('username')));
		if($query->num_rows() >= 2)
		{
			$output = array('valid'=>FALSE);
		} else {
			$output = array('valid'=>TRUE);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Page role user
	 *
	 * @return html output
	 **/
	public function role($role = NULL)
	{
		$this->breadcrumbs->unshift(2, $this->lang->line('menu_user_role'), 'administrator/users/role');
		$this->page_title->push(lang('menu_user'), lang('menu_user_role'));
		$this->data = array(
			'title' => "Dashboard",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);
		$this->template->view('users/role_access', $this->data);
	}



}

/* End of file Users.php */
/* Location: ./application/modules/administrator/controllers/Users.php */