<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('admin');
		}
	}


	public function index($page = null)
	{
		$data['title']      = 'Admin: Order';
		$data['content']    = $this->order->orderBy('date', 'DESC')->paginate($page)->get();
		$data['total_rows'] = $this->order->count();
		$data['pagination'] = $this->order->makePagination(base_url('admin/order'), 3, $data['total_rows']);
		$data['page']       = 'pages/admin/order/index';

		$this->viewAdmin($data);
	}

	public function search($page = null)
	{
		if (isset($_POST['keyword'])) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		} else {
			redirect(base_url('order'));
		}

		$keyword	        = $this->session->userdata('keyword');
		$data['title']		= 'Admin: Order';
		$data['content']	= $this->order->like('invoice', $keyword)
			->orderBy('date', 'DESC')
			->paginate($page)->get();
		$data['total_rows']	= $this->order->like('invoice', $keyword)->count();
		$data['pagination']	= $this->order->makePagination(
			base_url('admin/order/search'),
			3,
			$data['total_rows']
		);
		$data['page']		= 'pages/admin/order/index';

		$this->viewAdmin($data);
	}

	public function reset()
	{
		$this->session->unset_userdata('keyword');
		redirect(base_url('admin/order'));
	}

	public function detail($id)
	{
		$data['order']			= $this->order->where('id', $id)->first();
		if (!$data['order']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan.');
			redirect(base_url('order'));
		}

		$this->order->table	= 'order_detail';
		$data['order_detail']	= $this->order->select([
			'order_detail.id_orders', 'order_detail.id_product', 'order_detail.quantity', 'order_detail.message', 'order_detail.sub_total', 'product.title', 'product.image', 'product.price'
		])
			->join('product')
			->where('order_detail.id_orders', $id)
			->get();

		if ($data['order']->status !== 'waiting') {
			$this->order->table = 'order_confirm';
			$data['order_confirm']	= $this->order->where('id_orders', $id)->first();
		}
		$data['title']          = 'Order Detail';
		$data['page']			= 'pages/admin/order/detail';

		$this->viewAdmin($data);
	}

	// Order.php (Order controller)

	public function report()
	{
		// Load necessary libraries
		$this->load->library('pdfgenerator');

		// Set the locale to Indonesian
		setlocale(LC_TIME, 'id_ID.utf8');

		// Set data for the PDF report
		$data['title'] = 'Laporan Data Order';
		$file_pdf = 'Laporan_Data_Order_' . date('d_F_Y'); // Set the PDF file name
		$paper = 'A4';
		$orientation = 'landscape';

		$data['orders'] = $this->order->getAllOrdersWithDetails(); // Adjust this method based on your model

		// Include the current date and time
		$data['currentDateTime'] = strftime('%A, %e %B %Y %H:%M:%S');

		// Load the HTML view for the table of orders
		$html = $this->load->view('pages/admin/order/report', $data, true);

		// Generate and stream the PDF
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, true);
	}


	public function update($id)
	{
		if (!$_POST) {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan!');
			redirect(base_url("order/detail/$id"));
		}

		if ($this->input->post('waybill') != "") {
			$update = $this->order->where('id', $id)->update(['waybill' => $this->input->post('waybill'), 'status' => $this->input->post('status')]);
		} else {
			$update = $this->order->where('id', $id)->update(['status' => $this->input->post('status')]);
		}

		if ($update) {
			$this->session->set_flashdata('success', 'Data berhasil diperbaharui.');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan!');
		}

		redirect(base_url("admin/order/detail/$id"));
	}
}

/* End of file Order.php */