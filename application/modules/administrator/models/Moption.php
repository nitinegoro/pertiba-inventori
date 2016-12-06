<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moption extends Administrator_Model {

	private $data = array();

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Get data option
	 *
	 * @return string
	 **/
	public function get($value='')
	{
		if(is_string($value))
		{
			$query = $this->db->query("SELECT option_value FROM tb_options WHERE option_name = ?", array($value));

			if(!$query->num_rows())
				return false;

			return $query->row()->option_value;
		} else {
			return false;
		}
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function update($name = '', $value = '')
	{
		if(is_string($name) OR $name != '')
		{
			$query = $this->db->query("UPDATE tb_options SET option_value = ? WHERE option_name = ?", array($value, $name));
			return $this->db->affected_rows();
		} else {
			return false;
		}
	}

}

/* End of file Option.php */
/* Location: ./application/modules/administrator/models/Option.php */