<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtag extends Administrator_Model 
{
	public function get_all($limit = 0, $offset = 0, $type = 'result')
	{
		// set ordering
		if($this->input->get('order') == 'asc')
		{
			$this->db->order_by('tag_name', 'asc');
		} else {
			$this->db->order_by('tag_name', 'desc');
		}

		// set like from $_GET['q']
		if($this->input->get('q') != '')
			$this->db->like('tag_name', $this->input->get('q'))
					->or_like('tag_description', $this->input->get('q'));

		// resulting data type num or result
		if($type == 'result')
		{
			$result = $this->db->get('tb_tags', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_tags')->num_rows();
		}

		return $result;
	}

	/**
	 * Get one tag
	 *
	 *  @param Integer (tag_id)
	 * @return Array
	 **/
	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_tags WHERE tag_id = ?", array($param));
		return $query->row();
	}

	/**
	 * Insert Tag
	 *
	 * @return String
	 **/
	public function insert()
	{
		$tag = array(
			'tag_name' => $this->input->post('tag'),
			'tag_slug' => $this->set_tag_slug($this->input->post('slug')),
			'tag_description' => $this->input->post('description')
		);

		$this->db->insert('tb_tags', $tag);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_create_tag_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_create_tag_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * handle Update tag
	 *
	 * @param Integer (tag_id)
	 * @return String
	 **/
	public function update($param = 0)
	{
		$tag = array(
			'tag_name' => $this->input->post('tag'),
			'tag_slug' => $this->set_tag_slug($this->input->post('slug')),
			'tag_description' => $this->input->post('description')
		);

		$this->db->update('tb_tags', $tag, array('tag_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_setting_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_setting_warning'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Handle Delete tag
	 * and updating remove tag from post 
	 *
	 * @param Integer (ttag_id)
	 * @return String
	 **/
	public function delete($action = 0)
	{
		$tag 		= $this->get($action);
		$all_post 	= $this->db->query("SELECT ID, post_tag FROM tb_posts WHERE post_type = 'post' AND post_tag LIKE '%{$tag->tag_name}%'");

		foreach ($all_post->result() as $row) 
		{
			$this->db->update(
				'tb_posts', 
				array('post_tag' => str_replace($tag->tag_name, '', $row->post_tag)), 
				array('ID' => $row->ID)
			);
		}

		$this->db->delete('tb_tags', array('tag_id' => $action));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_delete_tag_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_delete_tag_warning'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * handle Multiple delete
	 *
	 * @return void
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('tags')))
		{
			foreach ($this->input->post('tags') as $key => $value) 
			{
				$tag 		= $this->get($value);
				$all_post 	= $this->db->query("
					SELECT ID, post_tag FROM tb_posts WHERE post_type = 'post' AND post_tag LIKE '%{$tag->tag_name}%'"
				);
				foreach ($all_post->result() as $row) 
				{
					$this->db->update(
						'tb_posts', 
						array('post_tag' => str_replace($tag->tag_name, '', $row->post_tag)), 
						array('ID' => $row->ID)
					);
				}
				$this->db->delete('tb_tags', array('tag_id' => $value));
			}
			$this->template->alert(
				lang('alert_delete_tag_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_empty_changed'), 
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
	}

	/**
	 * Handle Multiple Update
	 *
	 * @return string
	 **/
	public function multiple_update()
	{
		if(is_array($this->input->post('tag')))
		{
			foreach ($this->input->post('tag') as $key => $value) 
			{
				$tag = array(
					'tag_name' => $this->input->post('name')[$key],
					'tag_slug' => $this->set_tag_slug($this->input->post('slug')[$key]),
					'tag_description' => $this->input->post('description')[$key]
				);

				$this->db->update('tb_tags', $tag, array('tag_id' => $value));
			}
			$this->template->alert(
				lang('alert_setting_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_empty_changed'), 
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'info')
			);
		}
	}

	/**
	 * set Slug tag
	 * 
	 * @param String
	 * @return string (slug uri)
	 **/
	public function set_tag_slug($string = '')
	{
		$string = $this->slug->create_slug($string);
		$query = $this->db->query("SELECT tag_slug FROM tb_tags WHERE tag_slug = ?", array($string));

		if($query->num_rows() > 1)
		{
			return $this->slug->create_slug($string)."-".$query->num_rows();
		} else {
			return $this->slug->create_slug($string);
		}
	}

}

/* End of file Mtag.php */
/* Location: ./application/modules/administrator/models/Mtag.php */