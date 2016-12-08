<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapp extends CI_Model {

	/**
	 * Get Notifications for user
	 *
	 * @param Integer (receive_id)
	 * @param Integer (sender_user_id)
	 * @return result
	 **/
	public function notifications($param = 0)
	{
		$where = (!$param) ? $this->session->userdata('user')->ID_user : $param;
		$query = $this->db->query("
			SELECT tb_notifications.*, tb_users.* FROM tb_notifications
			LEFT JOIN tb_users ON tb_notifications.sender_user_id = tb_users.ID_user
			WHERE tb_notifications.receive_user_id = ? AND tb_notifications.read = 'false'
		", array($where));
		return $query->result();
	}

	/**
	 * Get Category Data
	 *
	 * @return result
	 **/
	public function category()
	{
		$query = $this->db->query("SELECT * FROM tb_item_categories");
		return $query->result();
	}

	/**
	 * Hitung Jumlah Itm per jenis / kategori
	 *
	 * @param Integer item_category_id
	 * @return Integer
	 **/
	public function count_category($param = 0)
	{
		$query = $this->db->query("SELECT item_category_id FROM tb_inventori_item WHERE item_category_id = ?", array($param));
		return $query->num_rows();
	}

	/**
	 * Get Category Data
	 *
	 * @return result
	 **/
	public function condition()
	{
		$query = $this->db->query("SELECT * FROM tb_item_condition");
		return $query->result();
	}

	/**
	 * Hitung Jumlah Itm per Kondisi
	 *
	 * @param Integer item_category_id
	 * @return Integer
	 **/
	public function count_condition($param = 0)
	{
		$query = $this->db->query("SELECT kondisi FROM tb_inventori_item WHERE kondisi = ?", array($param));
		return $query->num_rows();
	}

	/**
	 * Hitung Jumlah pengajuan bulan dan status
	 *
	 * @param Integer bulan
	 * @param Integer Tahun
	 * @param String (status)
	 * @return Integer
	 **/
	public function pengajuan($bulan = 0, $tahun = 0, $status = 'approve')
	{
		$query = $this->db->query("SELECT ID_pengajuan FROM tb_pengajuan WHERE month = ? AND year = ? AND status = ?", array($bulan, $tahun, $status));
		return $query->num_rows();
	}

	/**
	 * Hitung Jumlah anggaran pengajuan bulan dan status
	 *
	 * @param Integer bulan
	 * @param Integer Tahun
	 * @param String (status)
	 * @return Integer
	 **/
	public function anggaran($bulan = 0, $tahun = 0)
	{
		$query = $this->db->query("
			SELECT tb_inventori_item.quantity, tb_budget.nominal FROM tb_inventori_item 
			LEFT JOIN tb_budget ON tb_inventori_item.ID_inventori = tb_budget.ID_inventori
			LEFT JOIN tb_pengajuan ON tb_inventori_item.ID_pengajuan = tb_pengajuan.ID_pengajuan
			WHERE tb_pengajuan.month = ? AND tb_pengajuan.year = ?
			", array($bulan, $tahun));
		$total = 0;
		$sub_total = 0;
		foreach ($query->result() as $row) 
		{
			$sub_total = ($row->quantity * $row->nominal);
		}
		$total += $sub_total;
		return $total;
	}
}

/* End of file Mapp.php */
/* Location: ./application/models/Mapp.php */