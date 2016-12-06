<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  Post Controller 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Post extends Administrator_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model
		$this->load->model('mpost','post');
		$this->load->model('mcategory','category');
		$this->load->model('mtag','tag');
		// generate defaul breadcrumbds post
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_post'), 'administrator/post');
		$this->ci->load->js(base_url('assets/backend/app/js_post.js'));
	}

	public function index()
	{
		$this->page_title->push(lang('menu_post'), lang('menu_post_all'));

		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("administrator/post?q={$keyword}&order=asc");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->post->get_all($keyword, null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('menu_post_all'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'pages' => $this->post->get_all($config['per_page'], $page, 'result')
		);
		$this->template->view('post/all_post', $this->data);
	}

	public function add_post()
	{
		$this->page_title->push(lang('menu_post'), lang('menu_post_add'));
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_post_add'), 'administrator/post');

		$this->filemanager();
		
		$this->data = array(
			'title' => lang('menu_post')."\n".lang('menu_post_add'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category(),
			'all_tags' => $this->post->get_all_tags()
		);
		$this->template->view('post/add_post', $this->data);
	}

	/**
	 * Handle Inserting post data
	 *
	 * @return void
	 **/
	public function insert()
	{
		$this->post->insert();

		redirect('administrator/post');
	}

	/**
	 * Handle Updating post data
	 *
	 * @param Integer
	 * @return void
	 **/
	public function update($param = 0)
	{
		$this->post->update($param);

		redirect("administrator/post/get/{$param}");
	}

	/**
	 * Update Post
	 *
	 * @param Integer (ID)
	 * @return html Output
	 **/
	public function get($param = 0 )
	{
		$this->page_title->push(lang('menu_post'), lang('menu_post_edit'));
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_post_edit'), 'administrator/post');

		$this->filemanager();
		
		$this->data = array(
			'title' => lang('menu_post')."\n".lang('menu_post_edit'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category(),
			'all_tags' => $this->post->get_all_tags(),
			'get' => $this->post->get($param)
		);
		$this->template->view('post/edit_post', $this->data);
	}

	/**
	 * Get Tags JSON data
	 *
	 * @return string
	 **/
	public function get_all_tags()
	{
		foreach($this->post->get_all_tags() as $row) :
			$output[] = $row->tag_name;
		endforeach;
		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function delete($action = 0)
	{
		$this->post->delete($action);
		redirect('administrator/post');
	}

	/**
	 * handle Multiple Action
	 *
	 * @return void
	 **/
	public function bulk_action()
	{
		for($i = 0; $i < count($this->input->post('post')); $i++)
		{
			$obj = $this->post->get($this->input->post("post[{$i}]"));

			$this->db->delete('tb_posts', array('ID' => $this->input->post("post[{$i}]")));
			$this->db->delete('tb_post_category', array('post_ID' => $this->input->post("post[{$i}]")));
			$this->db->delete('tb_comments', array('comment_post_ID' => $this->input->post("post[{$i}]")));

		}

		if(count($this->input->post('post')))
		{
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_post_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_empty_changed'), 
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
		redirect('administrator/post');
	}

	/**
	 * Category Page
	 *
	 * @return html output
	 **/
	public function category()
	{
		$this->page_title->push(lang('menu_post'), lang('menu_post_category'));
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_post_category'), 'administrator/post');

		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("administrator/post/category?q={$keyword}&order=asc");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->category->get_all($keyword, null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('menu_post_category'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category(),
			'category' => $this->category->get_all($config['per_page'], $page)
		);
		$this->template->view('post/category', $this->data);
	}

	/**
	 * Handle Insert data category
	 *
	 * @return void
	 **/
	public function insert_category()
	{
		$this->category->insert();
		redirect('administrator/post/category');
	}

	/**
	 * Handle Delete Category
	 * and update post category followed to default
	 *
	 * @param Integer (category_id)
	 * @return void
	 **/
	public function delete_category($param = 0)
	{
		$this->category->delete($param);
		redirect('administrator/post/category');
	}

	/**
	 * get category detail page
	 *
	 * @param Integer (category_id)
	 * @return html Output
	 **/
	public function get_category($param = 0)
	{
		$this->page_title->push(lang('menu_post'), lang('update_post_category'));
		$this->breadcrumbs->unshift(1, $this->lang->line('update_post_category'), 'administrator/post');

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('update_post_category'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category(),
			'get' => $this->category->get($param)
		);
		$this->template->view('post/edit_category', $this->data);
	}

	/**
	 * Hnadle Updating data category
	 *
	 * @param Integer (categori_id)
	 * @return void
	 **/
	public function update_category($action = 0)
	{
		$this->category->update($action);

		redirect("administrator/post/get_category/{$action}");
	}


	/**
	 * Handle Delete Category
	 *
	 * @return String
	 **/
	public function bulk_category()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->category->multiple_delete();
				redirect('administrator/post/category');
				break;
			case 'update':
				$this->multiple_update_category();
				break;
			default:
				$this->template->alert(
					lang('alert_empty_changed'), 
					array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
				);
				redirect('administrator/post/category');
				break;
		}		
	}

	/**
	 * Handle Form Update Multiple Category
	 *
	 * @access private 
	 * @return html output
	 **/
	private function multiple_update_category()
	{
		$this->page_title->push(lang('menu_post'), lang('update_post_category'));
		$this->breadcrumbs->unshift(1, $this->lang->line('update_post_category'), 'administrator/post');

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('update_post_category'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category()
		);
		$this->template->view('post/multiple_category', $this->data);
	}

	/**
	 * Get Updating Multiple category
	 *
	 * @return string
	 **/
	public function set_multiple_update_category()
	{
		$this->category->multiple_update();
		redirect('administrator/post/category');
	}

	/**
	 * Tags Page
	 *
	 * @return html output
	 **/
	public function tags()
	{
		$this->page_title->push(lang('menu_post'), lang('menu_post_tags'));
		$this->breadcrumbs->unshift(1, $this->lang->line('menu_post_tags'), 'administrator/post');

		$this->filemanager();

		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("administrator/post/category?q={$keyword}&order=asc");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->tag->get_all($keyword, null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('menu_post_tags'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_tags' => $this->tag->get_all($config['per_page'], $page)
		);
		$this->template->view('post/tags', $this->data);
	}

	/**
	 * Handle Insert data tag
	 *
	 * @return Void
	 **/
	public function insert_tag()
	{
		$this->tag->insert();
		redirect('administrator/post/tags');
	}

	/**
	 * get tag detail
	 *
	 * @return html output
	 **/
	public function get_tag($param = 0)
	{
		$this->page_title->push(lang('menu_post'), lang('update_post_tag'));
		$this->breadcrumbs->unshift(1, $this->lang->line('update_post_tag'), 'administrator/post');

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('update_post_tag'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category(),
			'get' => $this->tag->get($param)
		);
		$this->template->view('post/edit_tag', $this->data);
	}

	/**
	 * Handle Update tag
	 *
	 * @param Integer (tag_id)
	 * @return void
	 **/
	public function update_tag($action = 0)
	{
		$this->tag->update($action);
		redirect("administrator/post/get_tag/{$action}");
	}

	/**
	 * Handle delete data tag
	 *
	 * @param Integer (tag_id)
	 * @return void
	 **/
	public function delete_tag($action = 0)
	{
		$this->tag->delete($action);
		redirect('administrator/post/tags');
	}

	/**
	 * Bulk Action Tags
	 *
	 * @return void
	 **/
	public function bulk_tags()
	{
		switch ($this->input->post('action')) 
		{
			// delete tag
			case 'delete':
				$this->tag->multiple_delete();
				redirect('administrator/post/tags');
				break;
			// update tag
			case 'update':
				$this->tags_update();
				break;
			default:
				$this->template->alert(
					lang('alert_empty_changed'), 
					array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
				);
				redirect('administrator/post/tags');
				break;
		}
	}

	/**
	 * Handle Update Multiple Tags
	 *
	 * @access private 
	 * @return html output
	 **/
	private function tags_update()
	{
		$this->page_title->push(lang('menu_post'), lang('update_post_tag'));
		$this->breadcrumbs->unshift(1, $this->lang->line('update_post_tag'), 'administrator/post');

		$this->data = array(
			'title' => lang('menu_post')."\n".lang('update_post_tag'),
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->ci->load->get_js_files(),
			'all_category' => $this->post->get_all_category(),
		);
		$this->template->view('post/multiple_tags', $this->data);
	}

	/**
	 * Handle Update Multiple Tags
	 *
	 * @return void
	 **/
	public function update_multiple_tag()
	{
		$this->tag->multiple_update();
		redirect('administrator/post/tags');
	}
}

/* End of file Post.php */
/* Location: ./application/modules/administrator/controllers/Post.php */
