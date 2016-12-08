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
			SELECT tb_users.*, tb_division.* FROM tb_users
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

	/**
	 * Updating data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function update($param = 0)
	{
		$get = $this->get($param);

		$user = array(
			'full_name' => (!$this->input->post('full_name')) ? $get->full_name : $this->input->post('full_name'),
			'ID_division' => (!$this->input->post('divisi')) ? $get->ID_division : $this->input->post('divisi'),
			'access' => (!$this->input->post('access')) ? $get->access : $this->input->post('access')  
		);

		$this->db->update('tb_users', $user, array('ID_user' => $param));

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

	/**
	 * Deleting data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function delete($param  = 0)
	{
		$get = $this->get($param);

		foreach ($this->getPengajuan($param) as $row) 
		{
			$data = array(
				'ID_user' => $this->session->userdata('user')->ID_user
			);
			$this->db->update('tb_pengajuan', $data, array('ID_user'=> $param));
		}

		$this->db->delete('tb_users', array('ID_user' => $param));

		$this->template->alert(
			' User terhapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Get Pengajuan user
	 *
	 * @param Integer ID_user
	 * @return Array result()
	 **/
	public function getPengajuan($user = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_pengajuan WHERE ID_user = ? ", array($user));
		return $query->result();
	}

	/**
	 * Multiple Update user
	 *
	 * @return string
	 **/
	public function multiple_update()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$get = $this->get($value);

				$user = array(
					'full_name' => (!$this->input->post('full_name')[$key]) ? $get->full_name : $this->input->post('full_name')[$key],
					'ID_division' => (!$this->input->post('divisi')[$key]) ? $get->ID_division : $this->input->post('divisi')[$key],
					'access' => (!$this->input->post('access')[$key]) ? $get->access : $this->input->post('access')[$key]  
				);

				$this->db->update('tb_users', $user, array('ID_user' => $value));
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

	/**
	 * Multiple Delete user
	 *
	 * @return string
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$get = $this->get($value);

				foreach ($this->getPengajuan($value) as $row) 
				{
					$data = array(
						'ID_user' => $this->session->userdata('user')->ID_user
					);
					$this->db->update('tb_pengajuan', $data, array('ID_user'=> $value));
				}

				$this->db->delete('tb_users', array('ID_user' => $value));
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

	/**
	 * Update passowrd and username account
	 *
	 * @param session id
	 * @return String
	 **/
	public function update_account()
	{
		$get = $this->get($this->session->userdata('user')->ID_user);

		$old_pass = password_hash($this->input->post('old_pass'), PASSWORD_DEFAULT);
		$new_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$user = array(
			'username' => (!$this->input->post('username')) ? $get->username : $this->input->post('username'),
			'password' => (!$this->input->post('passowrd')) ? $old_pass : $new_pass,
		);

		$this->db->update('tb_users', $user, array('ID_user' => $get->ID_user));

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
}

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */