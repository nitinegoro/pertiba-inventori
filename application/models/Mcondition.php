<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcondition extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		// set like from $_GET['q']
		if($this->input->get('q') != '')
			$this->db->like('c_name', $this->input->get('q'));

		// resulting data type num or result
		if($type == 'result')
		{
			$result = $this->db->get('tb_item_condition', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_item_condition')->num_rows();
		}

		return $result;
	}

	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_item_condition WHERE condition_id = ?", array($param));
		return $query->row();
	}

	public function insert()
	{
		$condition = array(
			'c_name' => $this->input->post('kondisi'),
			'c_description' => $this->input->post('deskripsi') 
		);

		$this->db->insert('tb_item_condition', $condition);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Pilihan kondisi ditambahkan', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menambahkan data', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$get = $this->get($param);

		$condition = array(
			'c_name' => (!$this->input->post('kondisi')) ? $get->c_name : $this->input->post('kondisi'),
			'c_description' => (!$this->input->post('deskripsi')) ? $get->c_description : $this->input->post('deskripsi') 
		);

		$this->db->update('tb_item_condition', $condition, array('condition_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$this->db->delete('tb_item_condition', array('condition_id' => $param));

		$this->db->update('tb_inventori_item', array('kondisi' => 0), array('kondisi' => $param));

		$this->template->alert(
			' data terhapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function update_multiple()
	{
		if(is_array($this->input->post('condition')))
		{
			foreach ($this->input->post('condition') as $key => $value) 
			{
				$get = $this->get($value);

				$condition = array(
					'c_name' => (!$this->input->post('kondisi')[$key]) ? $get->c_name : $this->input->post('kondisi')[$key],
					'c_description' => (!$this->input->post('deskripsi')[$key]) ? $get->c_description : $this->input->post('deskripsi')[$key] 
				);

				$this->db->update('tb_item_condition', $condition, array('condition_id' => $value));
			}
			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function multiple_delete()
	{
		if(is_array($this->input->post('conditions')))
		{
			foreach ($this->input->post('conditions') as $key => $value) 
			{
				$this->db->delete('tb_item_condition', array('condition_id' => $value));

				$this->db->update('tb_inventori_item', array('kondisi' => 0), array('kondisi' => $value));
			}
			$this->template->alert(
				' data terhapus.', 
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
	 * Get items in where condition
	 *
	 * @param Integer condition_id
	 * @return Integer
	 **/
	public function count_items($param = 0)
	{
		$query = $this->db->query("SELECT kondisi FROM tb_inventori_item WHERE kondisi = ?", array($param));
		return $query->num_rows();
	}
}

/* End of file Mcondition.php */
/* Location: ./application/models/Mcondition.php */