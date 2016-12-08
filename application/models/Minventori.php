<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minventori extends CI_Model 
{
	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_budget', 'tb_inventori_item.ID_inventori = tb_budget.ID_inventori', 'left');
		$this->db->join('tb_item_categories', 'tb_inventori_item.item_category_id = tb_item_categories.item_category_id', 'left');
		$this->db->join('tb_pengajuan', 'tb_inventori_item.ID_pengajuan = tb_pengajuan.ID_pengajuan', 'left');
		$this->db->join('tb_item_condition', 'tb_inventori_item.kondisi = tb_item_condition.condition_id', 'left');

		$this->db->where('tb_pengajuan.status', 'approve');

		$category = (!$this->input->get('sub_category')) ? $this->input->get('category') : $this->input->get('sub_category');

		if($category != '')
			$this->db->where('tb_inventori_item.item_category_id', $category);

		if($this->input->get('q') != '')
			$this->db->like('tb_inventori_item.inventori_name', $this->input->get('q'))
					->or_like('tb_inventori_item.vendor', $this->input->get('q'))
					->or_like('tb_inventori_item.serial_number', $this->input->get('q'))
					->or_like('tb_inventori_item.NO_inventori', $this->input->get('q'));

		$this->db->order_by('tb_inventori_item.NO_inventori', 'desc');

		if($type == 'result')
		{
			return $this->db->get('tb_inventori_item', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_inventori_item')->num_rows();
		}
	}
	
	/**
	 * Get One inventori item
	 *
	 * @param Integer (ID_inventori)
	 * @return Row
	 **/
	public function get($param = 0)
	{
		$query = $this->db->query("
			SELECT tb_inventori_item.*, tb_budget.*, tb_item_categories.*, tb_item_condition.* FROM tb_inventori_item 
			LEFT JOIN tb_budget ON tb_inventori_item.ID_inventori = tb_budget.ID_inventori
			LEFT JOIN tb_item_categories ON tb_inventori_item.item_category_id = tb_item_categories.item_category_id
			LEFT JOIN tb_item_condition ON tb_inventori_item.kondisi = tb_item_condition.condition_id
			WHERE tb_inventori_item.ID_inventori = ?
		", array($param));
		return $query->row();
	}

	/**
	 * Get Condition Data
	 *
	 * @return result
	 **/
	public function condition()
	{
		$query = $this->db->query("SELECT * FROM tb_item_condition");
		return $query->result();
	}

	/**
	 * Hapus Barang pada pengajuan
	 *
	 * @return Integer (ID_inventori)
	 * @return String
	 **/
	public function delete_item($param = 0)
	{
		$this->db->delete('tb_budget', array('ID_inventori' => $param));
		$this->db->delete('tb_inventori_item', array('ID_inventori' => $param));
		
		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Barang terhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menghapus data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}	
	}

	/**
	 * Update Inventori item
	 *
	 * @param Integer ID_inventori
	 * @return String
	 **/
	public function update($param = 0)
	{
		$get = $this->get($param);

		$item = array(
			'inventori_name' => $this->input->post('name'), 
			'serial_number' => $this->input->post('serial_number'),
			'vendor' => $this->input->post('vendor'),
			'description' => $this->input->post('deskripsi'),
			'quantity' => $this->input->post('quantity'),
			'kondisi' => $this->input->post('kondisi'),
			'item_category_id' => (!$this->input->post('sub_category')) ? $this->input->post('category') : $this->input->post('sub_category')
		);

		$this->db->update('tb_inventori_item', $item, array('ID_inventori' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}	
	}
}

/* End of file Minventari.php */
/* Location: ./application/models/Minventari.php */