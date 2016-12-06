<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  Page Model 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Mpage extends Administrator_Model {

	private $data = array();

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get all loop page data
	 *
	 * @param Integer
	 * @param Integer
	 * @param String
	 * @return Results
	 **/
	public function get_all($limit = 10, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_users', 'tb_posts.post_author = tb_users.user_id', 'left');

		$this->db->select('tb_users.full_name, tb_posts.*');

		// set ordering
		if($this->input->get('order') == 'asc')
		{
			$this->db->order_by('tb_posts.post_title', 'asc');
		} else {
			$this->db->order_by('tb_posts.post_title', 'desc');
		}

		// set like from $_GET['q']
		if($this->input->get('q') != '')
			$this->db->like('tb_posts.post_title', $this->input->get('q'))
					->or_like('tb_users.full_name', $this->input->get('q'));

		$this->db->where('tb_posts.post_type', 'page');

		// resulting data type num or result
		if($type == 'result')
		{
			$result = $this->db->get('tb_posts', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_posts')->num_rows();
		}

		return $result;
	}

	/**
	 * Get One Data
	 *
	 * @return Object
	 **/
	public function get($param = 0)
	{
		$query = $this->db->query("
			SELECT tb_users.user_id, tb_posts.* FROM tb_posts LEFT JOIN tb_users ON tb_posts.post_author = tb_users.user_id WHERE tb_posts.ID = ?", array($param)
		);
		return $query->row();
	}

	/**
	 * Deletng Data
	 *
	 * @param Integer
	 * @return string
	 **/
	public function delete($action = 0)
	{
		$obj = $this->get($action);

		$this->db->delete('tb_posts', array('ID' => $action));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_page_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);

		} else {
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_page_warning'),
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
	}

	/**
	 * Inserting to Post type =  'Page'
	 *
	 * @return string
	 **/
	public function insert()
	{
		$page = array(
			'post_author' => $this->author_id(), 
			'post_date' => date('Y-m-d H:i:s'),
			'post_uri' => $this->set_post_slug($this->input->post('page_uri')),
			'post_title' => $this->input->post('title'),
			'post_tag' => '',
			'post_content' => $this->input->post('content'),
			'post_description_meta' => $this->input->post('meta_description'),
			'post_status' => $this->input->post('status'),
			'post_modified' => '0000-00-00 00:00:00',
			'post_image' => $this->input->post('image'),
			'post_image_description' => $this->input->post('image_description'),
			'comment_status' => $this->input->post('comment'),
			'post_type' => 'page',
			'hits' => 0
		);

		$this->db->insert('tb_posts', $page);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_create_page_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_create_page_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Updating data post
	 *
	 * @param Integer
	 * @return string
	 **/
	public function update($action = 0)
	{
		$page = array(
			'post_uri' => $this->set_post_slug($this->input->post('page_uri')),
			'post_title' => $this->input->post('title'),
			'post_content' => $this->input->post('content'),
			'post_description_meta' => $this->input->post('meta_description'),
			'post_status' => $this->input->post('status'),
			'post_modified' => date('Y-m-d H:i:s'),
			'post_image' => $this->input->post('image'),
			'post_image_description' => $this->input->post('image_description'),
			'comment_status' => $this->input->post('comment'),
		);

		$this->db->update('tb_posts', $page, array('ID' => $action));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_create_page_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_create_page_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

}

/* End of file Mpage.php */
/* Location: ./application/modules/administrator/models/Mpage.php */