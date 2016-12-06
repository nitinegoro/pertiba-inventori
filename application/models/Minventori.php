<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minventori extends CI_Model 
{
	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_budget', 'tb_inventori_item.ID_inventori = tb_budget.ID_inventori', 'left');
		$this->db->join('tb_item_categories', 'tb_inventori_item.item_category_id = tb_item_categories.item_category_id', 'left');
		$this->db->join('tb_pengajuan', 'tb_inventori_item.ID_pengajuan = tb_pengajuan.ID_pengajuan', 'left');

		$this->db->where('tb_pengajuan.status', 'approve');

		$category = (!$this->input->get('sub_category')) ? $this->input->get('category') : $this->input->get('sub_category');

		if($category != '')
			$this->db->where('tb_inventori_item.item_category_id', $category);

		if($this->input->get('q') != '')
			$this->db->like('tb_inventori_item.inventori_name', $this->input->get('q'))
					->or_like('tb_inventori_item.vendor', $this->input->get('q'))
					->or_like('tb_inventori_item.serial_number', $this->input->get('q'));

		$this->db->order_by('tb_inventori_item.NO_inventori', 'desc');

		if($type == 'result')
		{
			return $this->db->get('tb_inventori_item', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_inventori_item')->num_rows();
		}
	}
	

}

/* End of file Minventari.php */
/* Location: ./application/models/Minventari.php */