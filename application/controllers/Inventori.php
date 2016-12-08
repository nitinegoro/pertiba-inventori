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

		$this->load->model('mcondition', 'condition');

		$this->load->js(base_url('assets/app/inventori.js'));
		$this->load->js(base_url('assets/app/pengajuan.js'));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'Barang Inventaris', 'inventori');
		$this->page_title->push('Master Data', 'Barang Inventaris');

		// data filter and searching
		$filter = array(
			'q' => $this->input->get('q'),
			'category' => $this->input->get('category'),
			'sub_category' => $this->input->get('sub_category'),
			'page' => $this->input->get('page')
		);

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("inventori?q={$filter['q']}&from={$filter['category']}&end={$filter['sub_category']}");
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
	 * undocumented class variable
	 *
	 * @param Integer ID_inventori
	 * @return void
	 **/
	public function delete_item($param = 0)
	{
		$this->inventori->delete_item($param);
		redirect('inventori');
	}

	/**
	 * Get Form Update Inventori
	 *
	 * @param Integer ID_inventori
	 * @return Html Output
	 **/
	public function get($param = 0)
	{
		$this->breadcrumbs->unshift(1, 'Barang Inventaris', 'inventori');
		$this->breadcrumbs->unshift(2, 'Sunting', 'get');
		$this->page_title->push('Master Data', 'Update Inventaris');

		$this->data = array(
			'title' => "Update Inventoris",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'parent_category' => $this->category->get_parent(),
			'js' => $this->load->get_js_files(),
			'condition' => $this->inventori->condition(),
			'get' => $this->inventori->get($param)
		);
		$this->template->view('inventori/update_barang', $this->data);
	}

	/**
	 * Update Inventori item
	 *
	 * @param Integer ID_inventori
	 * @return Void
	 **/
	public function update($param = 0)
	{
		$this->inventori->update($param);
		redirect("inventori/get/{$param}");
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
		$this->breadcrumbs->unshift(1, 'Master Data', 'inventori');
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

		$this->page_title->push('Master Data', 'Kategori Barang');
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

		$this->breadcrumbs->unshift(1, 'Master Data', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kategori Barang', 'category');

		$this->page_title->push('Master Data', 'Kategori Barang');
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
		$this->breadcrumbs->unshift(1, 'Master Data', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kategori Barang', 'category');

		$this->page_title->push('Master Data', 'Kategori Barang');
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

	/**
	 * Get Condition data
	 *
	 * @return html output
	 **/
	public function condition()
	{
		$this->breadcrumbs->unshift(1, 'Master Data', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kondisi Barang', 'category');

		$keyword = $this->input->get('q');
		$page = (!$this->input->get('page')) ? 0 : $this->input->get('page');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("inventori/condition?q={$keyword}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->condition->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->page_title->push('Master Data', 'Kondisi Barang');
		$this->data = array(
			'title' => "Kondisi Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'condition' => $this->condition->get_all($config['per_page'], $page)
		);
		$this->template->view('inventori/semua_kondisi', $this->data);
	}

	/**
	 * Insert data condition
	 *
	 * @return void
	 **/
	public function addcondition()
	{
		$this->condition->insert();
		redirect('inventori/condition');
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function getcondition($param = 0)
	{
		$this->breadcrumbs->unshift(1, 'Master Data', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kondisi Barang', 'category');
		$this->breadcrumbs->unshift(3, 'Sunting', 'getcondition');

		$this->page_title->push('Master Data', 'Sunting Kondisi Barang');

		$this->data = array(
			'title' => "Kondisi Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->condition->get($param)
		);
		$this->template->view('inventori/edit_kondisi', $this->data);
	}

	/**
	 * Update data condition 
	 *
	 * @param Integer condition_id
	 * @return void
	 **/
	public function editcondition($param = 0)
	{
		$this->condition->update($param);
		redirect("inventori/getcondition/{$param}");
	}

	/**
	 * handle Multiple Condition
	 *
	 * @return void
	 **/
	public function bulkcondition()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->condition->multiple_delete();
				redirect('inventori/condition');
				break;
			case 'set_update':
				$this->multiple_update_condition();
				break;
			case 'update':
				$this->condition->update_multiple();
				redirect('inventori/condition');
				break;
			default:
				$this->template->alert(
					'Tidak ada yang dipilih', 
					array('type' => 'warning','icon' => 'info')
				);
				redirect('inventori/condition');
				break;
		}	
	}

	/**
	 * Get Multiple Condition Update
	 *
	 * @access private
	 * @return html output
	 **/
	public function multiple_update_condition()
	{
		$this->breadcrumbs->unshift(1, 'Master Data', 'inventori');
		$this->breadcrumbs->unshift(2, 'Kondisi Barang', 'category');
		$this->breadcrumbs->unshift(3, 'Sunting', 'getcondition');

		$this->page_title->push('Master Data', 'Sunting Kondisi Barang');

		$this->data = array(
			'title' => "Kondisi Barang",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'parent_category' => $this->category->get_parent(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('inventori/update_kondisi_multiple', $this->data);
	}

	/**
	 * Delete Condition 
	 *
	 * @param Integer (condition_id)
	 * @return void
	 **/
	public function delete_condition($param = 0)
	{
		$this->condition->delete($param);
		redirect('inventori/condition');
	}
}

/* End of file Inventori.php */
/* Location: ./application/controllers/Inventori.php */