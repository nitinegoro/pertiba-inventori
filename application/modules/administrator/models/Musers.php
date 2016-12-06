<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  user module 
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  https://facebook.com/muh.azzain
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Musers extends Administrator_Model {

	private $data = array();

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Get fields data
	 *
	 * @param String
	 * @param String
	 * @return String
	 **/
	public function get_all($where, $limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_role_access', 'tb_users.role_id = tb_role_access.role_id', 'left');
		// searching fields data
		$this->db->where_not_in('user_id', 1);
		if($where != '')
			$this->db->like('full_name', $where);
		if($where != '')
			$this->db->or_like('user_email', $where);
		
		// resulting data type num or result
		if($type == 'result')
		{
			$result = $this->db->get('tb_users', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_users')->num_rows();
		}

		return $result;
	}

	/**
	 * Get one user
	 *
	 * @return Query row
	 **/
	public function get($user = 0)
	{
		$query = $this->db->query("SELECT tb_users.*, tb_role_access.* FROM tb_users JOIN tb_role_access ON tb_users.role_id = tb_role_access.role_id WHERE tb_users.user_id = ?", array($user));
		return $query->row();
	}

	/**
	 * Get Role Acces (tb_role_access)
	 *
	 * @param Integer
	 * @return Query
	 **/
	public function get_role($role = FALSE)
	{
		if (is_int($role)) 
		{
			$query = $this->db->query("SELECT role_id, role_name, role FROM tb_role_access WHERE role_id = ?", array($role));

		} 
		else {
			$query = $this->db->query("SELECT role_id, role_name, role FROM tb_role_access");
		}

		return $query;
	}

	/**
	 * Inserting Data users
	 *
	 * @return String
	 **/
	public function insert()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'full_name' => $this->input->post('full_name'),
			'user_email' => $this->input->post('email'),
			'user_phone' => $this->input->post('phone'),
			'user_avatar' => '',
			'user_bio' => '',
			'registered' => date('Y-m-d H:i:s'),
			'role_id' => $this->input->post('role')
		);

		$this->db->insert('tb_users', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_create_user_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_create_user_danger'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Updating data user
	 *
	 * @param Integer
	 * @return String
	 **/
	public function update($user = FALSE)
	{
		$data = array(
			'username' => $this->input->post('username'),
			'full_name' => $this->input->post('full_name'),
			'user_email' => $this->input->post('email'),
			'user_phone' => $this->input->post('phone'),
			'role_id' => $this->input->post('role')
		);

		$this->db->update('tb_users', $data, array('user_id' => $user));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_edit_user_success') ."\n". anchor(site_url('administrator/users'), strtoupper(lang('btn_back'))), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_edit_user_warning'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}
	}

	/**
	 * Deleting data users
	 *
	 * @param Integer
	 * @return String
	 **/
	public function delete($user=0)
	{
		$obj = $this->get($user);

		if($obj->user_avatar !== '')
			unlink("assets/images/{$obj->user_avatar}");

		$this->db->delete('tb_users', array('user_id' => $user));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				lang('alert_delete_user_success'), 
				array('type' => 'success','title' => lang('success'), 'icon' => 'check')
			);
		} else {
			$this->template->alert(
				lang('alert_delete_user_warning'), 
				array('type' => 'danger','title' => lang('danger'), 'icon' => 'times')
			);
		}	
	}
}

/* End of file Musers.php */
/* Location: ./application/modules/administrator/models/Musers.php */
