<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alert
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->library(array('session'));

	}

    public function get($message, $config)
    {
        $alert  = "<div class='alert alert-{$config['type']}'>";
        $alert .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
        $alert .= "<strong><i class='ace-icon fa fa-{$config['icon']}'></i> {$config['title']}</strong><br> <small>{$message}</small>";
        $alert .= "</div>";
        $this->ci->session->set_flashdata('alert', $alert);
    }
	

}

/* End of file Alert.php */
/* Location: ./application/modules/administrator/libraries/Alert.php */
