<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdivisi extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('q') != '')
			$this->db->like('division_name', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_division', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_division')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("SELECT ID_division, division_name FROM tb_division WHERE ID_division = ?", array($param));
		return $query->row();
	}

	/**
	 * Get all user by division
	 *
	 * @param Integer ID_division
	 * @return Array
	 **/
	public function getUser($param = 0)
	{
		$query = $this->db->query("SELECT ID_division FROM tb_users WHERE ID_division = ?", array($param));
		return $query->result();
	}

	public function insert()
	{
		$data = array(
			'division_name' => $this->input->post('divisi'), 
		);
		$this->db->insert('tb_division', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Divisi ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$get = $this->get($param);

		$data = array(
			'division_name' => (!$this->input->post('divisi')) ? $get->division_name : $this->input->post('divisi'), 
		);

		$this->db->update('tb_division', $data, array('ID_division' => $param));

		if($this->db->affected_rows())
		{
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

	public function delete($param = 0)
	{
		foreach ($this->getUser($param) as $row) 
		{
			$data = array(
				'ID_division' => 1
			);

			$this->db->update('tb_users', $data, array('ID_division'=> $param));
		}

		$this->db->delete('tb_division', array('ID_division' => $param));

		$this->template->alert(
			' Divisi terhapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function multiple_update()
	{
		if(is_array($this->input->post('divisi')))
		{
			foreach ($this->input->post('divisi') as $key => $value) 
			{
				$get = $this->get($value);

				$data = array(
					'division_name' => (!$this->input->post('name')[$key]) ? $get->division_name : $this->input->post('name')[$key], 
				);

				$this->db->update('tb_division', $data, array('ID_division' => $value));
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
		if(is_array($this->input->post('divisi')))
		{
			foreach ($this->input->post('divisi') as $key => $value) 
			{
				foreach ($this->getUser($value) as $row) 
				{
					$data = array(
						'ID_division' => 1
					);

					$this->db->update('tb_users', $data, array('ID_division'=> $value));
				}

				$this->db->delete('tb_division', array('ID_division' => $value));
			}
			$this->template->alert(
				' Divisi terhapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data yang terpilih.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Mdivisi.php */
/* Location: ./application/models/Mdivisi.php */