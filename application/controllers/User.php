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

		$this->breadcrumbs->unshift(1, 'Pengguna', 'user');
	}

	public function index()
	{
		$this->page_title->push('Pengguna', 'Data Pengguna');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("user?q={$this->input->get('q')}&page={$this->input->get('page')}");
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
		# code...
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

		$this->data = array(
			'title' => "Jenis Divisi",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'divisi' => $this->user->getDivision()
		);
		$this->template->view('user/data_divisi', $this->data);
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */