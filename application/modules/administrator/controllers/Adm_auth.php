<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 ********************************************************************** |
 * Web Aadministration
 * Custom CMS using Codeigniter Framework.
 *
 * @package	  Administrator
 * @category  login authentification
 * @author	  Vicky Nitinegoro <pkpvicky@gmail.com>
 * @copyright 2016
 * @link	  http://teitramega.co.id
 * @since 	  Version 1.0.0
 ********************************************************************** |
 */

class Adm_auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','alert'));
	}

	/**
	 * Halaman Login Web Administrator
	 *
	 * @return html output
	 **/
	public function index()
	{
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('adm_login');
        } 
        else 
        {
        	$username = $this->input->post('username');
        	$password = $this->input->post('password');

        	// get data user
        	$user = $this->_get_user($username);

        	// authentifaction dengan password verify
        	if (password_verify($password, $user->password)) 
        	{
        		// set session data
        		$this->_set_user_login($user);

        		// if session destroy in other page
        		if( $this->input->get('from_url') != '')
        		{
        			redirect( $this->input->get('from_url') );
        		} else {
        			redirect('administrator');
        		}

        	} else {
	        	// set error alert
				$this->alert->get(
					'Username dan password tidak valid.', 
					array('type' => 'danger','title' => 'Maaf!', 'icon' => 'times')
				);
        		$this->load->view('adm_login');
        	}
        }
	}

	/**
	 * Auth username from database
	 *
	 * @param String
	 * @return Qeury Result
	 **/
	private function _get_user($username = '')
	{
		// get query prepare statmennts
		$query = $this->db->query("SELECT * FROM tb_users WHERE username = ?", array($username));

		if($query->num_rows() == 1)
		{
			return $query->row();
		} else {
			// hilangkan error object
			return (Object) array('password' => '');
		}
	}

	/**
	 * Handle login verification
	 *
	 * @param String
	 * @return void 
	 **/
	private function _set_user_login($user)
	{
        // set session data
        $user_session = array(
        	'is_login' => TRUE,
        	'user_id' => $user->user_id,
        	'user' => $user
        );	
        $this->session->set_userdata( $user_session );
	}
	
	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function signout()
	{
		$this->session->unset_userdata('is_login');
		redirect($this->input->get('from_url'));
	}

}

/* End of file Adm_auth.php */
/* Location: ./application/modules/administrator/controllers/Adm_auth.php */