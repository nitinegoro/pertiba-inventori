<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_division', 'tb_users.ID_division = tb_division.ID_division', 'left');

		if($this->input->get('q') != '')
			$this->db->like('tb_users.full_name', $this->input->get('q'))
					->or_like('tb_division.division_name', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_users', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_users')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("
			SELECT tb_users.full_name, tb_users.ID_user, tb_division.ID_division, tb_division.division_name FROM tb_users
			LEFT JOIN tb_division ON tb_division.ID_division = tb_users.ID_division WHERE tb_users.ID_user = ?
		", array($param));

		return $query->row();
	}

	/**
	 * get Division
	 *
	 * @return Object
	 **/
	public function getDivision()
	{
		$query = $this->db->query("SELECT * FROM tb_division");
		return $query->result();
	}

	/**
	 * Inserting data
	 *
	 * @return String
	 **/
	public function insert()
	{
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$user = array(
			'full_name' => $this->input->post('full_name'),
			'username' => $this->input->post('username'),
			'password' => $password,
			'ID_division' => $this->input->post('divisi'),
			'access' => $this->input->post('access') 
		);

		$this->db->insert('tb_users', $user);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' User ditambahkan.', 
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

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */