<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Inventaris 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->js(base_url('assets/app/user.js'));

		$this->load->model('muser', 'user');

		$this->load->model('mdivisi', 'divisi');

		$this->breadcrumbs->unshift(1, 'Pengguna', 'user');
	}

	public function index()
	{
		$this->page_title->push('Pengguna', 'Data Pengguna');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("user?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->user->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'users' => $this->user->get_all($config['per_page'], $this->input->get('page'))
		);
		$this->template->view('user/semua_user', $this->data);
	}

	public function adduser()
	{
		$this->breadcrumbs->unshift(2, 'Tambah Pengguna', 'adduser');
		$this->page_title->push('Pengguna', 'Tambah Pengguna');

		$this->data = array(
			'title' => "Tambah Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'divisi' => $this->user->getDivision()
		);
		$this->template->view('user/add_user', $this->data);
	}

	/**
	 * Handle Insert data
	 *
	 * @return void
	 **/
	public function insert()
	{
		$this->user->insert();
		redirect('user');
	}

	/**
	 * Auth username from database
	 *
	 * @param String
	 * @return Qeury Result
	 **/
	public function getusername()
	{
		// get query prepare statmennts
		$query = $this->db->query("SELECT * FROM tb_users WHERE username = ?", array($this->input->post('username')));

		if($query->num_rows() == 1)
		{
			$output['valid'] = FALSE;

		} else {
			$output['valid'] = TRUE;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Get edit Form user
	 *
	 * @return html output
	 **/
	public function get($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Sunting Pengguna', 'get');
		$this->page_title->push('Pengguna', 'Sunting Pengguna');

		$this->data = array(
			'title' => "Sunting Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'divisi' => $this->user->getDivision(),
			'get' => $this->user->get($param)
		);
		$this->template->view('user/edit_user', $this->data);
	}

	/**
	 * Handle Update User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function updateuser($param = 0)
	{
		$this->user->update($param);
		redirect("user/get/{$param}");
	}

	/**
	 * Handle Delete User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function delete($param = 0)
	{
		$this->user->delete($param);
		redirect('user');
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return String
	 **/
	public function bulkuser()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update();
				break;
			case 'update':
				$this->user->multiple_update();
				redirect('user');
				break;
			case 'delete':
				$this->user->multiple_delete();
				redirect('user');
				break;
			default:
				$this->template->alert(
					' Tidak ada data yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
	}

	/**
	 * Multiple Form update
	 *
	 * @access private
	 * @return Html Output
	 **/
	private function multiple_update()
	{
		$this->breadcrumbs->unshift(2, 'Sunting Pengguna', 'get');
		$this->page_title->push('Pengguna', 'Sunting Pengguna');

		$this->data = array(
			'title' => "Sunting Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'divisi' => $this->user->getDivision(),
		);
		$this->template->view('user/multiple_edit_user', $this->data);
	}

	/**
	 * Get Page Divisi
	 *
	 * @return html output
	 **/
	public function divisi()
	{
		$this->breadcrumbs->unshift(2, 'Jenis Divisi', 'divisi');
		$this->page_title->push('Pengguna', 'Jenis Divisi');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("user/divisi?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->divisi->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Jenis Divisi",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'divisi' => $this->divisi->get_all($config['per_page'], $this->input->get('page')),
		);
		$this->template->view('user/data_divisi', $this->data);
	}

	/**
	 * Add data divisi
	 *
	 * @return Void
	 **/
	public function adddivisi()
	{
		$this->divisi->insert();
		redirect('user/divisi');
	}

	/**
	 * Update Division name
	 *
	 * @param Integer ID_division
	 * @return void
	 **/
	public function updatedivisi($param = 0)
	{
		$this->divisi->update($param);
		redirect('user/divisi');
	}

	/**
	 * Handle Multiple Action DIvisi
	 *
	 * @return String
	 **/
	public function bulkdivisi()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update_divisi();
				break;
			case 'update':
				$this->divisi->multiple_update();
				redirect('user/divisi');
				break;
			case 'delete':
				$this->divisi->multiple_delete();
				redirect('user/divisi');
				break;
			default:
				$this->template->alert(
					' Tidak ada data yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
	}

	/**
	 * Multiple Form update divisi
	 *
	 * @access private
	 * @return Html Output
	 **/
	private function multiple_update_divisi()
	{
		$this->breadcrumbs->unshift(2, 'Jenis Divisi', 'divisi');
		$this->breadcrumbs->unshift(3, 'Sunting Divisi', 'bulkdivisi');
		$this->page_title->push('Pengguna', 'Sunting Divisi');

		$this->data = array(
			'title' => "Jenis Divisi",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('user/update_divisi', $this->data);
	}

	/**
	 * Delete divisi
	 *
	 * @param Integer (ID_division)
	 * @return Void
	 **/
	public function deletedivisi($param = 0)
	{
		$this->divisi->delete($param);
		redirect('user/divisi');
	}

	/**
	 * Get Account Setting page
	 *
	 * @return html output
	 **/
	public function account()
	{
		$this->breadcrumbs->unshift(2, 'Pengaturan', 'account');
		$this->page_title->push('Pengguna', 'Pengaturan');

		$this->data = array(
			'title' => "Pengaturan",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('user/account', $this->data);
	}

	/**
	 * Mengecek benarnya password lama
	 *
	 * @return String
	 **/
	public function authpass()
	{
		$password = $this->input->post('old_pass');

        // authentifaction dengan password verify
        if (password_verify($password, $this->session->userdata('user')->password)) 
        {
			$output['valid'] = TRUE;

		} else {
			$output['valid'] = FALSE;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Setting account (Ganti Password)
	 *
	 * @return void
	 **/
	public function account_setting()
	{
		$this->user->update_account();
		redirect('user/account');
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */