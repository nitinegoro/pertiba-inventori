<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpengajuan extends CI_Model 
{
	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_users', 'tb_pengajuan.ID_user = tb_users.ID_user', 'left');
		$this->db->join('tb_division', 'tb_users.ID_division = tb_division.ID_division', 'left');

		$this->db->order_by('tb_pengajuan.ID_pengajuan', 'desc');

		if($this->input->get('q') != '')
			$this->db->like('tb_users.full_name', $this->input->get('q'));

		if($this->input->get('status') != '')
			$this->db->where('tb_pengajuan.status', $this->input->get('status'));

		if($this->input->get('from') != '')
			$this->db->where('tb_pengajuan.date >=', $this->input->get('from'));

		if($this->input->get('end') != '')
			$this->db->where('tb_pengajuan.date <=', $this->input->get('end'));

		if($type == 'result')
		{
			return $this->db->get('tb_pengajuan', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_pengajuan')->num_rows();
		}
	}

	/**
	 * Get One data pengajuan
	 *
	 * @param Integer ID_pengajuan
	 **/
	public function get($param = 0)
	{
		$this->db->join('tb_users', 'tb_pengajuan.ID_user = tb_users.ID_user', 'left');
		$this->db->join('tb_division', 'tb_users.ID_division = tb_division.ID_division', 'left');
		$this->db->where('tb_pengajuan.ID_pengajuan', $param);
		return $this->db->get('tb_pengajuan')->row();
	}

	/**
	 * Get Item Pengajuan
	 *
	 * @param Integer ID_pengajuan
	 **/
	public function get_items($param = 0)
	{
		$this->db->join('tb_budget', 'tb_inventori_item.ID_inventori = tb_budget.ID_inventori', 'left');
		$this->db->join('tb_item_categories', 'tb_inventori_item.item_category_id = tb_item_categories.item_category_id', 'left');
		$this->db->where('tb_inventori_item.ID_pengajuan', $param);
		return $this->db->get('tb_inventori_item')->result();
	}

	public function set_insert()
	{
		$this->insert();
		$this->insert_item();

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Pengajuan dibuat.', 
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
	 * Insert data pengjuan
	 *
	 * @access private
	 * @return Integer
	 **/
	private function insert()
	{
		$pengajuan = array(
			'ID_user' => $this->session->has_userdata('ID_user'),
			'date' => $this->input->post('tanggal'),
			'month' => date('m'),
			'year' => date('Y'),
			'status' => 'pending', // ('pending','approve') 
		);
		$this->db->insert('tb_pengajuan', $pengajuan);
	}

	/**
	 * Insert data item
	 *
	 * @access private
	 * @return affected_rows
	 **/
	private function insert_item()
	{
		if(is_array($this->input->post('name')))
		{
			$inventori = $this->getMaxItem();
			$ID_inventori = $this->getMaxItem();
			foreach($this->input->post('name') as $key => $value)
			{
				++$inventori;
				$item[] = array(
					'NO_inventori' => generate_inventori_number( $inventori ),
					'inventori_name' => $this->input->post('name')[$key],
					'serial_number' => $this->input->post('serial_number')[$key],
					'vendor' => $this->input->post('vendor')[$key],
					'description' => $this->input->post('deskripsi')[$key],
					'quantity' => $this->input->post('quantity')[$key],
					'kondisi' => '',
					'ID_pengajuan' => $this->getMaxAjuan(),
					'item_category_id' => (!$this->input->post('sub_category')[$key]) ? $this->input->post('category')[$key] : $this->input->post('sub_category')[$key]
				);

				$budget[] = array(
					'ID_inventori' => ++$ID_inventori,
					'nominal' => $this->input->post('nominal')[$key],
				);
			}
			$this->db->insert_batch('tb_inventori_item', $item);
			$this->db->insert_batch('tb_budget', $budget);
			
		} 
	}



	/**
	 * (get max no_inventori)
	 *
	 * @access private
	 * @return Integer 
	 **/
	private function getMaxItem()
	{
		$query = $this->db->query("SELECT MAX(ID_inventori) AS ID_inventori FROM tb_inventori_item");
		if($query->num_rows())
		{
			return $query->row('ID_inventori');
		} else {
			return 1;
		}
		
	}

	/**
	 * (get max ID_pengajuan)
	 *
	 * @access private
	 * @return Integer 
	 **/
	private function getMaxAjuan()
	{
		$query = $this->db->query("SELECT MAX(ID_pengajuan) AS ID_pengajuan FROM tb_pengajuan");
		if($query->num_rows())
		{
			return $query->row('ID_pengajuan');
		} else {
			return 1;
		}
	}

	/**
	 * Update data pengajuan beserta barangnya
	 *
	 * @param Integer ID_pengajuan
	 * @return String
	 **/
	public function update($param = 0)
	{
		// get one data
		$get = $this->get($param);

		// tb_pengajuan
		$pengajuan = array(
			'date' => $this->input->post('tanggal'),
		);
		$this->db->update('tb_pengajuan', $pengajuan, array('ID_pengajuan' => $param));

		// updating data items
		if(is_array($this->input->post('name')))
		{
			foreach($this->input->post('name') as $key => $value)
			{
				// tb_inventori_item
				$item[] = array(
					'inventori_name' => $this->input->post('name')[$key],
					'serial_number' => $this->input->post('serial_number')[$key],
					'vendor' => $this->input->post('vendor')[$key],
					'description' => $this->input->post('deskripsi')[$key],
					'quantity' => $this->input->post('quantity')[$key],
					'item_category_id' => (!$this->input->post('sub_category')[$key]) ? $this->input->post('category')[$key] : $this->input->post('sub_category')[$key]
				);
				$this->db->update('tb_inventori_item', $item[$key], array('ID_inventori' => $this->input->post('item_id')[$key]));

				// tb_budget
				$budget[] = array(
					'nominal' => $this->input->post('nominal')[$key],
				);
				$this->db->update('tb_budget', $budget[$key], array('ID_inventori' => $this->input->post('item_id')[$key]));
				
				if(!$this->input->post('item_id')[$key])
				{
					$inventori = $this->getMaxItem();

					++$inventori;
					$add_item = array(
						'NO_inventori' => generate_inventori_number( $inventori ),
						'inventori_name' => $this->input->post('name')[$key],
						'serial_number' => $this->input->post('serial_number')[$key],
						'vendor' => $this->input->post('vendor')[$key],
						'description' => $this->input->post('deskripsi')[$key],
						'quantity' => $this->input->post('quantity')[$key],
						'kondisi' => '',
						'ID_pengajuan' => $get->ID_pengajuan,
						'item_category_id' => (!$this->input->post('sub_category')[$key]) ? $this->input->post('category')[$key] : $this->input->post('sub_category')[$key]
					);
					$this->db->insert('tb_inventori_item', $add_item);

					$create_id_inventori = $this->getMaxItem();
					$add_budget = array(
						'ID_inventori' => $create_id_inventori++,
						'nominal' => $this->input->post('nominal')[$key],
					);	
					$this->db->insert('tb_budget', $add_budget);
					break;
				} 
			}	
		}

		$this->template->alert(
			' Perubahan disimpan.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Update Status pengajuan
	 *
	 * @param Integer (ID_pengajuan)
	 * @param String Status
	 * @return void
	 **/
	public function set_status($param = 0, $status = 'pending')
	{
		// get data pengajuan
		$get = $this->get($param);
		
		$this->db->update('tb_pengajuan', array('status' => $status), array('ID_pengajuan' => $param));

		// set notifications 
		$this->set_notification($param, $status);

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
	 * Beri pemberitahuan kepda user
	 *
	 * @access private
	 * @var string
	 **/
	private function set_notification($param = 0, $status = 'pending')
	{
		// get data pengajuan
		$get = $this->get($param);

		switch ($status) 
		{
			case 'pending':
				if($this->authNotification($param))
				{
					$notif = array(
						'notif_content' => "Menolak pengajuan barang anda.",
						'notif_date' => date('Y-m-d'),
						'sender_user_id' => $this->session->has_userdata('ID_user'),
						'read' => 'false'
					);
					$this->db->update('tb_notifications', $notif, array('ID_pengajuan' => $get->ID_pengajuan));
				} else {
					$notif = array(
						'notif_content' => "Menolak pengajuan barang anda.",
						'notif_date' => date('Y-m-d'),
						'receive_user_id' =>  $get->ID_user,
						'sender_user_id' => $this->session->has_userdata('ID_user'),
						'ID_pengajuan' => $get->ID_pengajuan,
						'read' => 'false'
					);
					$this->db->insert('tb_notifications', $notif);
				}
				break;
			case 'approve':
				if($this->authNotification($param))
				{
					$notif = array(
						'notif_content' =>"Menerima pengajuan anda.",
						'notif_date' => date('Y-m-d'),
						'sender_user_id' => $this->session->has_userdata('ID_user'),
						'read' => 'false'
					);
					$this->db->update('tb_notifications', $notif, array('ID_pengajuan' => $get->ID_pengajuan));
				} else {
					$notif = array(
						'notif_content' =>"Menerima pengajuan anda.",
						'notif_date' => date('Y-m-d'),
						'receive_user_id' =>  $get->ID_user,
						'sender_user_id' => $this->session->has_userdata('ID_user'),
						'ID_pengajuan' => $get->ID_pengajuan,
						'read' => 'false'
					);
					$this->db->insert('tb_notifications', $notif);
				}
				break;
		}
	}

	/**
	 * Cek apakah sudah tersedia notifikasi
	 *
	 * @access private
	 * @param Integer
	 * @return Boolean
	 **/
	private function authNotification($param = 0)
	{
		$query = $this->db->query("SELECT ID_pengajuan FROM tb_notifications WHERE ID_pengajuan = ?", array($param));
		if($query->num_rows())
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Hapus Barang pada pengajuan
	 *
	 * @return Integer (ID_inventori)
	 * @return String
	 **/
	public function delete_barang($param = 0)
	{
		$this->db->delete('tb_inventori_item', 'tb_budget');
		$this->db->where('ID_inventori', $param);
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
	 * Delete All data pengajuan and items
	 *
	 * @param Integer (ID_pengajuan)
	 * @return String
	 **/
	public function delete($param = 0)
	{
		// get one data
		$get = $this->get($param);

		foreach($this->items($param) as $row)
		{
			$this->db->delete('tb_budget', array('ID_inventori'=> $row->ID_inventori));
		}
		
		$this->db->delete('tb_notifications', array('receive_user_id'=> $get->ID_user));
		$this->db->delete('tb_inventori_item', array('ID_pengajuan'=> $param));
		$this->db->delete('tb_pengajuan', array('ID_pengajuan'=>$param));

		$this->template->alert(
			' pengajuan terhapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Multiple set_status
	 *
	 * @param Integer (ID_pengajuan)
	 * @return String
	 **/
	public function multiple_set_status($status = 'pending')
	{
		if(is_array($this->input->post('pengajuan')))
		{
			foreach ($this->input->post('pengajuan') as $key => $value) 
			{
				$this->db->update('tb_pengajuan', array('status' => $status), array('ID_pengajuan' => $value));
				$this->set_notification($value, $status);
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
	 * Multiple Delete All data pengajuan and items
	 *
	 * @param Integer (ID_pengajuan)
	 * @return String
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('pengajuan')))
		{
			foreach ($this->input->post('pengajuan') as $key => $value) 
			{
				// get one data
				$get = $this->get($value);
				// deletes price item
				foreach($this->items($value) as $row)
				{
					$this->db->delete('tb_budget', array('ID_inventori'=> $row->ID_inventori));
				}
				$this->db->delete('tb_notifications', array('receive_user_id'=> $get->ID_user));
				$this->db->delete('tb_inventori_item', array('ID_pengajuan'=> $value));
				$this->db->delete('tb_pengajuan', array('ID_pengajuan'=>$value));
			}
			$this->template->alert(
				' Data pengajuan terhapus.', 
				array('type' => 'success','icon' => 'check')
			);	
		} else {
			$this->template->alert(
				' Gagal menghapus data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Mpengajuan.php */
/* Location: ./application/models/Mpengajuan.php */