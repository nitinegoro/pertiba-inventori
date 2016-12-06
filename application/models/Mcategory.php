<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcategory extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		// tidak termasuk kategori default
		$this->db->where_not_in('item_category_id', 1);

		// set ordering
		if($this->input->get('order') == 'asc')
		{
			$this->db->order_by('category_name', 'asc');
		} else {
			$this->db->order_by('category_name', 'desc');
		}

		// set like from $_GET['q']
		if($this->input->get('q') != '')
			$this->db->like('category_name', $this->input->get('q'));

		// resulting data type num or result
		if($type == 'result')
		{
			$result = $this->db->get('tb_item_categories', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_item_categories')->num_rows();
		}

		return $result;
	}
	
	/**
	 * Get one category
	 *
	 * @param Integer (item_category_id)
	 * @return Array
	 **/
	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_item_categories WHERE item_category_id = ?", array($param));
		return $query->row();
	}

	/**
	 * Get Prent category
	 *
	 * @return Array
	 **/
	public function get_parent()
	{
		$query = $this->db->query("SELECT * FROM tb_item_categories WHERE category_parent IN (0)");
		return $query->result();
	}

	/**
	 * Get Chile category
	 *
	 * @return Array
	 **/
	public function get_child($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_item_categories WHERE category_parent IN (?)", array($param));
		return $query->result();
	}

	public function insert()
	{
		$category = array(
			'category_parent' => $this->input->post('parent'),
			'category_name' => $this->input->post('category')
		);

		$this->db->insert('tb_item_categories', $category);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Kategori ditambahkan', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menambahkan kategori', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$get = $this->get($param);
		$category = array(
			'category_parent' =>( !$this->input->post('parent')) ? $get->category_parent : $this->input->post('parent'),
			'category_name' => (!$this->input->post('category')) ? $get->category_name : $this->input->post('category')
		);

		$this->db->update('tb_item_categories', $category, array('item_category_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' perubahan disimpan', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan kategori', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function update_multiple()
	{
		if(is_array($this->input->post('category')))
		{
			foreach ($this->input->post('category') as $key => $value) 
			{
				$category = array(
					'category_parent' => $this->input->post('parent')[$key],
					'category_name' => $this->input->post('name')[$key]
				);

				$this->db->update('tb_item_categories', $category, array('item_category_id' => $value));
			}
			$this->template->alert(
				' perubahan disimpan', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan kategori', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$this->db->delete('tb_item_categories', array('item_category_id' => $param));

		$this->db->update('tb_inventori_item', array('item_category_id' => 1), array('item_category_id' => $param));

		$this->template->alert(
			' Kategori terhapus', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Update tb_item_categories and tb_inventori_item 
	 * Yang mengikuti kategori yang dihapus
	 *
	 * @return string
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('categories')))
		{
			foreach ($this->input->post('categories') as $key => $value) 
			{
				$this->db->delete('tb_item_categories',array('item_category_id' =>  $value));
				$this->db->update('tb_inventori_item', array('item_category_id' => 1), array('item_category_id' => $value));
				$this->db->update('tb_item_categories', array('category_parent' => 0), array('category_parent' => $value));
			}
			$this->template->alert(
				' Kategori terhapus', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada kategori yang dipilih', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	/**
	 * Hitungg Jumlah Kategori
	 *
	 * @param Integer item_category_id
	 * @return Integer
	 **/
	public function count_items($param = 0)
	{
		$query = $this->db->query("SELECT item_category_id FROM tb_inventori_item WHERE item_category_id = ?", array($param));
		return $query->num_rows();
	}
}

/* End of file Mcategory.php */
/* Location: ./application/models/Mcategory.php */