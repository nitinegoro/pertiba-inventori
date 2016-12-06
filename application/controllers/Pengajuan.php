<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends Inventaris 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcategory', 'category');
		$this->load->model('mpengajuan', 'pengajuan');
		$this->load->js(base_url('assets/app/pengajuan.js'));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'Data Pengajuan ', 'pengajuan');
		$this->page_title->push('Pengajuan', 'Data Pengajuan Barang');

		// data filter and searching
		$filter = array(
			'q' => $this->input->get('q'),
			'status' => $this->input->get('status'),
			'from' => $this->input->get('from'),
			'end' => $this->input->get('end'),
			'page' => $this->input->get('page')
		);

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("pengajuan?q={$filter['q']}&status={$filter['status']}&from={$filter['from']}&end={$filter['end']}&page={$filter['page']}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->pengajuan->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Pengajuan Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'pengajuan' => $this->pengajuan->get_all($config['per_page'], $filter['page']),
			'parent_category' => $this->category->get_parent(),
		);
		$this->template->view('pengajuan/semua_pengajuan', $this->data);
	}

	/**
	 * form pengajuan inventori
	 *
	 * @return html output
	 **/
	public function create()
	{
		$this->breadcrumbs->unshift(1, 'Data Pengajuan ', 'pengajuan');
		$this->breadcrumbs->unshift(2, 'Buat Pengajuan ', 'pengajuan/create');

		$this->page_title->push('Pengajuan', 'Buat Pengajuan Barang');
		$this->data = array(
			'title' => "Buat Pengajuan Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'parent_category' => $this->category->get_parent(),
		);
		$this->template->view('pengajuan/buat_pengajuan', $this->data);
	}

	public function insert()
	{
		$this->pengajuan->set_insert();
		redirect('pengajuan/create');
	}

	/**
	 * Form SUnting data pengajuan
	 *
	 * @param Integer ID_pengajuan
	 * @return html Output
	 **/
	public function get( $param = 0)
	{
		if(!$param OR !$this->pengajuan->get($param))
			show_404();

		$this->breadcrumbs->unshift(1, 'Data Pengajuan ', 'pengajuan');
		$this->breadcrumbs->unshift(2, 'Sunting Pengajuan ', 'pengajuan/get');

		$this->page_title->push('Pengajuan', 'Sunting Pengajuan Barang');
		$this->data = array(
			'title' => "Buat Pengajuan Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'parent_category' => $this->category->get_parent(),
			'get' => $this->pengajuan->get($param)
		);
		$this->template->view('pengajuan/update_pengajuan', $this->data);
	}

	/**
	 * Update data pengajuan beserta barangnya
	 *
	 * @param Integer ID_pengajuan
	 * @return Void
	 **/
	public function update($param = 0)
	{
/*		echo "<pre>";
		print_r($this->input->post());*/
		$this->pengajuan->update($param);
		redirect("pengajuan/get/{$param}");
	}

	/**
	 * Hapus Barang pada pengajuan
	 *
	 * @return Integer (ID_inventori)
	 * @return void
	 **/
	public function delete_barang($param = 0)
	{
		$this->pengajuan->delete_barang();
		redirect("pengajuan/get/{$param}");
	}

	/**
	 * Update Status pengajuan
	 *
	 * @param Integer (ID_pengajuan)
	 * @param String Status (pending or approve)
	 * @return String
	 **/
	public function set_status($param = 0, $status = 'pending')
	{
		$this->pengajuan->set_status($param, $status);
		redirect('pengajuan');
	}

	/**
	 * Delete All data pengajuan and items
	 *
	 * @param Integer (ID_pengajuan)
	 * @return void
	 **/
	public function delete($param = 0)
	{
		$this->pengajuan->delete($param);
		redirect('pengajuan');
	}

	/**
	 * Get Multiple Action
	 *
	 * @return void
	 **/
	public function bulk_action($param = 0)
	{
		switch ($this->input->post('action')) 
		{
			case 'terima':
				$this->pengajuan->multiple_set_status('approve');
				break;
			case 'tunda':
				$this->pengajuan->multiple_set_status('pending');
				break;
			case 'delete':
				$this->pengajuan->multiple_delete();
				break;
			default:
				$this->template->alert(
					' Tidak ada data yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
		redirect('pengajuan');
	}

	/**
	 * Get Print Page
	 *
	 * @return html output (Print)
	 **/
	public function print_out($param = 0)
	{
		// data filter and searching
		$filter = array(
			'q' => $this->input->get('q'),
			'category' => $this->input->get('category'),
			'sub_category' => $this->input->get('sub_category'),
			'status' => $this->input->get('status'),
			'from' => $this->input->get('from'),
			'end' => $this->input->get('end'),
			'page' => $this->input->get('page')
		);

		$data = array(
			'items' => $this->pengajuan->get_items($param) , 
		);

		$this->load->view('pengajuan/print_pengajuan', $data);
	}

	/**
	 * Get Print Page Data pengajuan
	 *
	 * @return html output (Print)
	 **/
	public function print_data()
	{
		// data filter and searching
		$filter = array(
			'q' => $this->input->get('q'),
			'category' => $this->input->get('category'),
			'sub_category' => $this->input->get('sub_category'),
			'status' => $this->input->get('status'),
			'from' => $this->input->get('from'),
			'end' => $this->input->get('end'),
			'page' => $this->input->get('page')
		);

		$data = array('pengajuan' => $this->pengajuan->get_all(0,$filter['page'],'result'), );

		// loaded html view
		$this->load->view('pengajuan/print_data_pengajuan', $data);

		if($this->input->get('pdf')==TRUE)
			$this->pdf_output();
	}

	/**
	 * PDF Data Pengajuan
	 *
	 * @return Html Output
	 **/
	public function pdf_output()
	{
		// Get output html with CI Output
		$html = $this->output->get_output();
		// Load library
		$this->load->library('Pdfgenerator');
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("DATA-PENGAJUAN.pdf", array("Attachment"=> 0 ) );	
	}
}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */