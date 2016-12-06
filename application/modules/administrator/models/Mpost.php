<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpost extends Administrator_Model 
{

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
		$this->db->select('tb_users.full_name, tb_posts.*');
		$this->db->join('tb_users', 'tb_posts.post_author = tb_users.user_id', 'left');

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

		$this->db->where('tb_posts.post_type', 'post');

		// resulting data type num or result
		if($type == 'result')
		{
			$this->db->limit($limit);
			$this->db->offset($offset);
			$result = $this->db->get('tb_posts')->result();
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
	 * Get Post Category
	 *
	 * @param Integer (post_ID)
	 * @return Array
	 **/
	public function get_post_category($post = 0)
	{
		$query = $this->db->query("SELECT tb_post_category.*, tb_category.* FROM tb_post_category LEFT JOIN tb_category ON tb_post_category.category_id = tb_category.category_id WHERE tb_post_category.post_ID = ?", array($post));
		return $query->result();
	}

	/**
	 * Auth Category Id
	 *
	 * @param Integer (ID)
	 * @param Integer (category_id)
	 * @return Boolean
	 **/
	public function category_id($post = 0, $category = 0)
	{
		$query = $this->db->query("SELECT category_id, post_ID FROM tb_post_category WHERE post_ID = ? AND category_id = ?", array($post, $category));

		if($query->num_rows())
			return "selected";
	}

	/**
	 * Get Post Tags
	 *
	 * @param Integer (ID)
	 * @return Array
	 **/
	public function get_post_tags($post = 0)
	{
		$get = $this->db->query("SELECT ID, post_tag FROM tb_posts WHERE ID = ?", array($post))->row();
		$tags = explode(', ', $get->post_tag);
		return $tags;
	}

	/**
	 * Get tag id from string
	 *
	 * @param String
	 * @return Integer
	 **/
	public function get_tag_id($string = 0)
	{
		// generate slug
		$string = $this->slug->create_slug($string);
		$get = $this->db->query("SELECT tag_id FROM tb_tags WHERE tag_slug = ?", array($string));
		if($get->num_rows())
		{
			return $get->row()->tag_id;
		} else {
			return FALSE;
		}
	}

	/**
	 * Get All Category
	 *
	 * @return Array
	 **/
	public function get_all_category()
	{
		$query = $this->db->query("SELECT category_id, name FROM tb_category");
		return $query->result();
	}

	/**
	 * Get All Tags
	 *
	 * @return Array
	 **/
	public function get_all_tags()
	{
		if($this->input->get('q') != '')
			$this->db->like('tag_name', $this->input->get('q'));

		$query = $this->db->get('tb_tags');

		return $query->result();
	}

	/**
	 * Checking Last ID
	 *
	 * @return Integer
	 **/
	public function insert_id()
	{
		$query = $this->db->query("SELECT MAX(ID) AS ID FROM tb_posts")->row();
		return ++$query->ID;
	}

	/**
	 * Inserting Post Data
	 *
	 * @return string
	 **/
	public function insert()
	{
		// insert category
		$this->insert_category();

		// insert Tag
		$this->insert_tags();

		$page = array(
			'ID' => $this->insert_id(),
			'post_author' => $this->author_id(), 
			'post_date' => date('Y-m-d H:i:s'),
			'post_uri' => $this->set_post_slug($this->input->post('page_uri')),
			'post_title' => $this->input->post('title'),
			'post_tag' => $this->input->post('tags'),
			'post_content' => $this->input->post('content'),
			'post_description_meta' => $this->input->post('meta_description'),
			'post_status' => $this->input->post('status'),
			'post_modified' => '0000-00-00 00:00:00',
			'post_image' => $this->input->post('image'),
			'post_image_description' => $this->input->post('image_description'),
			'comment_status' => $this->input->post('comment'),
			'post_type' => 'post',
			'hits' => 0
		);

		$this->db->insert('tb_posts', $page);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_create_post_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_create_post_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Handle Updating dan Post
	 *
	 * @param Integer 
	 * @return String
	 **/
	public function update($param = 0)
	{
		// insert category
		$this->insert_category($param);

		// insert Tag
		$this->insert_tags();

		$page = array(
			'post_uri' => $this->set_post_slug($this->input->post('page_uri')),
			'post_title' => $this->input->post('title'),
			'post_tag' => $this->input->post('tags'),
			'post_content' => $this->input->post('content'),
			'post_description_meta' => $this->input->post('meta_description'),
			'post_status' => $this->input->post('status'),
			'post_modified' => date('Y-m-d H:i:s'),
			'post_image' => $this->input->post('image'),
			'post_image_description' => $this->input->post('image_description'),
			'comment_status' => $this->input->post('comment'),
			'hits' => 0
		);

		$this->db->update('tb_posts', $page, array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_update_post_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_update_post_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Inserting Multiple Post Category
	 *
	 * @return void
	 **/
	public function insert_category($param = FALSE)
	{
		if($param) {
			$this->db->delete('tb_post_category', array('post_ID' => $param));
			if(is_array($this->input->post('category')))
			{
				foreach($this->input->post('category') as $key => $value)
				{
					$data[] = array(
						'post_ID' => $param,
						'category_id' => $value
					);
				}
				$this->db->insert_batch('tb_post_category', $data);
			} else {
				$this->db->insert('tb_post_category', array('post_ID' => $param, 'category_id' => 1));
			}
		} else {
			if(is_array($this->input->post('category')))
			{
				foreach($this->input->post('category') as $key => $value)
				{
					$data[] = array(
						'post_ID' => $this->insert_id(),
						'category_id' => $value
					);
				}
				$this->db->insert_batch('tb_post_category', $data);
			} else {
				$this->db->insert('tb_post_category', array('post_ID' => $this->insert_id(), 'category_id' => 1));
			}
		}
	}

	/**
	 * Inserting Multiple Tags
	 *
	 * @return vodi
	 **/
	public function insert_tags()
	{
		foreach (explode(', ', $this->input->post('tags')) as $key => $value) 
		{
			// skip duplicat data
			if($this->get_tag_id($value))
				continue;

			if(!$value) 
				continue;

			// insert other data 
			$data = array(
				'tag_name' => $value,
				'tag_slug' => $this->slug->create_slug($value),
				'tag_description' => '' 
			);
			$this->db->insert('tb_tags', $data);
		}
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
		$this->db->delete('tb_post_category', array('post_ID' => $action));
		$this->db->delete('tb_comments', array('comment_post_ID' => $action));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_post_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);

		} else {
			$this->template->alert(
				$this->db->affected_rows()."\n".lang('alert_delete_post_warning'),
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
	}
}

/* End of file Mpost.php */
/* Location: ./application/modules/administrator/models/Mpost.php */