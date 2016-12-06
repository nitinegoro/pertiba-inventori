<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

	}
}


/**
* 
*/
class Inventaris extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','breadcrumbs','page_title','config', 'slug','table'));
		$this->load->helper(array('menus','date'));
		date_default_timezone_set('Asia/Jakarta');
		$this->breadcrumbs->unshift(0, 'Dashboard', 'main');

		if($this->session->has_userdata('is_login')==FALSE)
			redirect('login?from_url='.current_url());
	}

	/**
	 * (generate no_inventori)
	 *
	 * @return string 
	 **/
	public function set_no_inventori()
	{
		
	}
}




/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */