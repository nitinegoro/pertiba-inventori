<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

	}
	public function index()
	{	
/*		$config['upload_path'] = 'assets/media/uploads';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '100';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('file')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo "success";
		}*/
		require FCPATH.'vendor/tinymce/filemanager/upload.php';
	}

}

/* End of file Upload.php */
/* Location: ./application/modules/administrator/controllers/Upload.php */