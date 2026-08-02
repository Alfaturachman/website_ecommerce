<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends MY_Controller
{
	private $id;

	private function _applyPriceFilter(&$data)
	{
		$minPrice = $this->input->get('min_price');
		$maxPrice = $this->input->get('max_price');

		if ($minPrice !== null && $minPrice !== '') {
			$this->shop->where('product.price >=', (int)$minPrice);
			$data['min_price'] = (int)$minPrice;
		}
		if ($maxPrice !== null && $maxPrice !== '') {
			$this->shop->where('product.price <=', (int)$maxPrice);
			$data['max_price'] = (int)$maxPrice;
		}
	}

	public function index($page = null)
	{
		$data['title']      = 'Semua Produk';
		$this->_applyPriceFilter($data);
		$data['content']    = $this->shop
			->select(
				[
					'product.id', 'product.title AS product_title',
					'product.image', 'product.price', 'product.slug As product_slug',
					'category.title AS category_title', 'category.slug AS category_slug'
				]
			)
			->join('category')
			->where('product.is_available', 1)
			->where('delete', 1)
			->orderBy('product.price', 'DESC')
			->get();
		$this->_applyPriceFilter($data);
		$data['total_rows'] = $this->shop->where('product.is_available', 1)->where('delete', 1)->count();
		$data['gender']     = null;
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}


	private function _gender($type, $title, $slug, $page = null)
	{
		$data['title']      = $title;
		$this->_applyPriceFilter($data);
		$data['content']    = $this->shop->select(
			[
				'product.id', 'product.title AS product_title',
				'product.image', 'product.price', 'product.slug As product_slug',
				'category.title AS category_title', 'category.slug AS category_slug'
			]
		)
			->join('category')
			->paginate($page)->where('type', $type)->where('delete', 1)->get();
		$this->_applyPriceFilter($data);
		$data['total_rows'] = $this->shop->where('type', $type)->where('delete', 1)->count();
		$data['pagination'] = $this->shop->makePagination(
			base_url("shop/$slug"),
			3,
			$data['total_rows']
		);
		$data['gender']     = $type;
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}

	public function men($page = null)   { $this->_gender('L', 'Produk Pria', 'men', $page); }
	public function women($page = null) { $this->_gender('W', 'Produk Wanita', 'women', $page); }
	public function unisex($page = null){ $this->_gender('U', 'Produk Unisex', 'unisex', $page); }

	public function category($category, $page = null)
	{
		// Get the sort value from the URL query parameter
		$sort = $this->input->get('sort');

		// Define the default sort order
		$sortOrder = ($sort == 'desc') ? 'desc' : 'asc';

		$data['title']      = 'Belanja';
		$this->_applyPriceFilter($data);
		$data['content']    = $this->shop->select(
			[
				'product.id', 'product.title AS product_title',
				'product.image', 'product.price', 'product.slug As product_slug',
				'category.title AS category_title', 'category.slug AS category_slug'
			]
		)
			->join('category')
			->where('product.is_available', 1)
			->where('delete', 1)
			->where('category.slug', $category)
			->orderBy('product.price', $sortOrder) // Use the orderBy method to sort by price
			->paginate($page)
			->get();
		$this->_applyPriceFilter($data);
		$data['total_rows'] = $this->shop->where('product.is_available', 1)->where('category.slug', $category)->join('category')->count();
		$data['pagination'] = $this->shop->makePagination(
			base_url("shop/category/$category"),
			4,
			$data['total_rows']
		);
		$data['category']   = ucwords(str_replace('-', ' ', $category));
		$data['gender']     = null;
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}


	public function gender_category($gender, $category, $page = null)
	{
		$typeMap = ['men' => 'L', 'women' => 'W', 'unisex' => 'U'];
		$type    = $typeMap[$gender] ?? null;

		$sort = $this->input->get('sort');
		$sortOrder = ($sort == 'desc') ? 'desc' : 'asc';

		$data['title']      = genderLabel($type) . ' ' . ucwords(str_replace('-', ' ', $category));
		$this->_applyPriceFilter($data);
		$data['content']    = $this->shop->select(
			[
				'product.id', 'product.title AS product_title',
				'product.image', 'product.price', 'product.slug As product_slug',
				'category.title AS category_title', 'category.slug AS category_slug'
			]
		)
			->join('category')
			->where('product.is_available', 1)
			->where('delete', 1)
			->where('product.type', $type)
			->where('category.slug', $category)
			->orderBy('product.price', $sortOrder)
			->paginate($page)
			->get();
		$this->_applyPriceFilter($data);
		$data['total_rows'] = $this->shop->where('product.is_available', 1)->where('delete', 1)->where('product.type', $type)->where('category.slug', $category)->join('category')->count();
		$data['pagination'] = $this->shop->makePagination(
			base_url("shop/$gender/category/$category"),
			4,
			$data['total_rows']
		);
		$data['category']   = ucwords(str_replace('-', ' ', $category));
		$data['gender']     = $type;
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}


	public function search($page = null)
	{
		if ($this->input->post('keyword')) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		}

		$keyword = $this->session->userdata('keyword');

		if (!$keyword) {
			redirect(base_url('/'));
			return;
		}

		$data['title']		= 'Pencarian: Produk';
		$this->_applyPriceFilter($data);
		$data['content']	= $this->shop->select(
			[
				'product.id',
				'product.id_category',
				'product.title AS product_title',
				'product.image',
				'product.price',
				'product.slug As product_slug',
				'category.title AS category_title',
				'category.slug AS category_slug'
			]
		)
			->join('category')
			->where('product.is_available', 1)
			->where('delete', 1);

		$this->db->group_start();
		$this->db->like('product.title', $keyword);
		$this->db->or_like('product.description', $keyword);
		$this->db->group_end();

		$data['content'] = $this->shop->paginate($page)->get();

		$this->_applyPriceFilter($data);
		$this->shop->where('product.is_available', 1)->where('delete', 1);
		$this->db->group_start();
		$this->db->like('product.title', $keyword);
		$this->db->or_like('product.description', $keyword);
		$this->db->group_end();

		$data['total_rows']	= $this->shop->count();
		$data['pagination']	= $this->shop->makePagination(
			base_url('shop/search'),
			3,
			$data['total_rows']
		);
		$data['gender']		= null;
		$data['page']		= 'pages/users/shop';

		$this->view($data);
	}

	public function detail($slug)
	{
		$this->id = $this->session->userdata('id');
		$data['title']      = 'Detail Produk';
		$data['content']    = $this->shop->select(
			['product.id', 'product.title AS product_title', 'product.description', 'product.size', 'product.color', 'product.price', 'product.is_available', 'product.image', 'category.title AS category_title']
		)
			->join('category')
			->where('product.slug', $slug)
			->first();
		$data['page']       = 'pages/users/detail';

		$this->view($data);
	}
}

/* End of file Shop.php */