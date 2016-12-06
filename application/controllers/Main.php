<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Inventaris 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->page_title->push('Dashboard', 'Halaman Utama');
	}

	public function index()
	{
		//$this->breadcrumbs->unshift(1, 'Test', 'administrator/pages');
		//$this->breadcrumbs->unshift(2, 'Test', 'administrator/pages');
		$this->data = array(
			'title' => "Main",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);
		$this->template->view('vmain', $this->data);
	}

}

/* End of file Main.php */
/* Location: ./application/libraries/Main.php */