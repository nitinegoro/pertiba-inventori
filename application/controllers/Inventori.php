<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends Inventaris 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcategory', 'category');

		$this->load->model('minventori', 'inventori');

		$this->load->js(base_url('assets/app/inventori.js'));
		$this->load->js(base_url('assets/app/pengajuan.js'));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'Barang Inventaris', 'inventori');
		$this->page_title->push('Inventaris', 'Barang Inventaris');

		// data filter and searching
		$filter = array(
			'q' => $this->input->get('q'),
			'category' => $this->input->get('category'),
			'sub_category' => $this->input->get('sub_category'),
			'page' => $this->input->get('page')
		);

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("inventori?q={$filter['q']}&from={$filter['category']}&end={$filter['sub_category']}&page={$filter['page']}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->inventori->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Barang Inventoris",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'parent_category' => $this->category->get_parent(),
			'js' => $this->load->get_js_files(),
			'inventaris' => $this->inventori->get_all($config['per_page'], $filter['page'])
		);
		$this->template->view('inventori/semua_barang', $this->data);
	}


	/**
	 * Print Data Inventaris
	 *
	 * @return Html Output
	 **/
	public function print_data()
	{
		// data filter and searching
		$filter = array(
			'q' => $this->input->get('q'),
			'category' => $this->input->get('category'),
			'sub_category' => $this->input->get('sub_category'),
			'page' => $this->input->get('page')
		);

		$data = array('inventori' => $this->inventori->get_all(0, $filter['page']), );

		// loaded html view
		$this->load->view('inventori/print_barang', $data);

		if($this->input->get('pdf')== TRUE)
			$this->pdf_output();
	}

	/**
	 * PDF Data Inventaris
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
		$this->dompdf->stream("DATA-INVENTARIS.pdf", array("Attachment"=> 0 ) );	
	}

	/**
	 * Categories pages
	 *
	 * @return html output
	 **/
	public function category()
	{
		$this->breadcrumbs->unshift(1, 'Inventaris', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kategori Barang', 'category');

		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("inventori/category?q={$keyword}&order=asc");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->category->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->page_title->push('Inventaris', 'Kategori Barang');
		$this->data = array(
			'title' => "Kategori Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'parent_category' => $this->category->get_parent(),
			'all_category' => $this->category->get_all($config['per_page'], $page)
		);
		$this->template->view('inventori/semua_kategori', $this->data);
	}

	/**
	 * Handle Insert Category
	 *
	 * @return void
	 **/
	public function addcategory()
	{
		$this->category->insert();
		redirect('inventori/category');
	}

	/**
	 * Updating one category
	 *
	 * @param Integer (item_category_id)
	 * @return void (affected_rows)
	 **/
	public function getcategory($param = 0)
	{
		if(!$param)
			show_404();

		$this->breadcrumbs->unshift(1, 'Inventaris', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kategori Barang', 'category');

		$this->page_title->push('Inventaris', 'Kategori Barang');
		$this->data = array(
			'title' => "Kategori Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'parent_category' => $this->category->get_parent(),
			'get' => $this->category->get($param),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('inventori/update_kategori', $this->data);
	}

	/**
	 * Handle Updating Category
	 *
	 * @var string
	 **/
	public function editcategory($param = 0)
	{
		if(!$param)
			show_404();

		$this->category->update($param);
		redirect("inventori/getcategory/{$param}");
	}

	/**
	 * handle Multiple Category
	 *
	 * @return void
	 **/
	public function bulkcategory()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->category->multiple_delete();
				redirect('inventori/category');
				break;
			case 'set_update':
				$this->multiple_update_category();
				break;
			case 'update':
				$this->category->update_multiple();
				redirect('inventori/category');
				break;
			default:
				$this->template->alert(
					'Tidak ada yang dipilih', 
					array('type' => 'warning','icon' => 'info')
				);
				redirect('inventori/category');
				break;
		}	
	}

	/**
	 * Get Multiple Catgory Update
	 *
	 * @access private
	 * @return html output
	 **/
	public function multiple_update_category()
	{
		$this->breadcrumbs->unshift(1, 'Inventaris', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kategori Barang', 'category');

		$this->page_title->push('Inventaris', 'Kategori Barang');
		$this->data = array(
			'title' => "Kategori Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'parent_category' => $this->category->get_parent(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('inventori/update_kategori_multiple', $this->data);
	}

	/**
	 * Hhandle Delete Category item
	 * dan rubah barang inventori yang mengikuti menjadi default
	 *
	 * @param Integer (item_category_id)
	 * @return void
	 **/
	public function delete_category($param = 0)
	{
		$this->category->delete($param);
		redirect('inventori/category');
	}

	/**
	 * Mengambil data child kategori dengan json
	 *
	 * @param Integer (item_category_id as category_parent)
	 * @return JSON
	 **/
	public function get_category_child($param = 0)
	{
		$output = array();
		if($this->category->get_child($param) != NULL) 
		{
			$output['response'] = TRUE;
			$output['query']	= array('id' => $param, 'name' => $this->category->get($param)->category_name);
			foreach ($this->category->get_child($param) as $row) 
			{
				$output['results'][] = array(
					'child_id' => $row->item_category_id,
					'name' => $row->category_name
				);
			}
		} else {
			$output['response'] = FALSE;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}
}

/* End of file Inventori.php */
/* Location: ./application/controllers/Inventori.php */