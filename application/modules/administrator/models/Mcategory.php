<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcategory extends Administrator_Model 
{

	public function get_all($limit = 0, $offset = 0, $type = 'result')
	{
		// set ordering
		if($this->input->get('order') == 'asc')
		{
			$this->db->order_by('name', 'asc');
		} else {
			$this->db->order_by('name', 'desc');
		}

		// set like from $_GET['q']
		if($this->input->get('q') != '')
			$this->db->like('name', $this->input->get('q'))
					->or_like('description', $this->input->get('q'));

		// resulting data type num or result
		if($type == 'result')
		{
			$result = $this->db->get('tb_category', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_category')->num_rows();
		}

		return $result;
	}

	/**
	 * Get one category
	 *
	 *  @param Integer (category_id)
	 * @return Array
	 **/
	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_category WHERE category_id = ?", array($param));
		return $query->row();
	}

	/**
	 * set Slug category
	 * 
	 * @param String
	 * @return string (slug uri)
	 **/
	public function set_category_slug($string = '')
	{
		$string = $this->slug->create_slug($string);
		$query = $this->db->query("SELECT slug FROM tb_category WHERE slug = ?", array($string));

		if($query->num_rows() > 1)
		{
			return $this->slug->create_slug($string)."-".$query->num_rows();
		} else {
			return $this->slug->create_slug($string);
		}
	}

	/**
	 * Handle Inserting data Category
	 *
	 * @return String
	 **/
	public function insert()
	{
		$category = array(
			'parent_id' => $this->input->post('parent'),
			'slug' => $this->set_category_slug($this->input->post('slug')),
			'name' => $this->input->post('category'),
			'description' => $this->input->post('description')
		);

		$this->db->insert('tb_category', $category);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_create_category_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_create_category_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Hnadle Updating data
	 *
	 * @param Integer (categori_id)
	 * @return void
	 **/
	public function update($param = 0)
	{
		$category = array(
			'parent_id' => $this->input->post('parent'),
			'slug' => $this->set_category_slug($this->input->post('slug')),
			'name' => $this->input->post('category'),
			'description' => $this->input->post('description')
		);

		$this->db->update('tb_category', $category, array('category_id' => $param));

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
	 * Handle Delete Category
	 * and update post category followed to default
	 *
	 * @param Integer (category_id)
	 * @return String
	 **/
	public function delete($param = 0)
	{
		$this->db->delete('tb_post_category', array('category_id' => $param));
		$this->db->update('tb_category',array('parent_id' => 0), array('parent_id' => $param));
		$this->db->delete('tb_category', array('category_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_delete_category_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_delete_category_warning'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Handle Multile Delete Category
	 *
	 * @return String
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('categories')))
		{
			foreach ($this->input->post('categories') as $key => $value) 
			{
				$this->db->delete('tb_post_category', array('category_id' => $value));
				$this->db->update('tb_category',array('parent_id' => 0), array('parent_id' => $value));
				$this->db->delete('tb_category', array('category_id' => $value));
			}
			$this->template->alert(
				lang('alert_delete_category_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_empty_changed'), 
				array('type' => 'warning','title' => lang('warning'), 'icon' => 'times')
			);	
		}
	}

	/**
	 * Handle Multiple Update Category
	 *
	 * @return string
	 **/
	public function multiple_update()
	{
		if(is_array($this->input->post('category')))
		{
			foreach ($this->input->post('category') as $key => $value) 
			{
				$category = array(
					'parent_id' => $this->input->post('parent')[$key],
					'slug' => $this->set_category_slug($this->input->post('slug')[$key]),
					'name' => $this->input->post('name')[$key],
					'description' => $this->input->post('description')[$key]
				);

				$this->db->update('tb_category', $category, array('category_id' => $value));
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
	 * Count Post
	 *
	 * @param Integer (category_id)
	 * @return Integer
	 **/
	public function count_post($category = 0)
	{
		$query = $this->db->query("
			SELECT category_id FROM tb_post_category WHERE category_id = ?", array($category)
		);
		return $query->num_rows();
	}

}

/* End of file Mcategory.php */
/* Location: ./application/modules/administrator/models/Mcategory.php */