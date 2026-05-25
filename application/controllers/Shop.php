<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends MY_Controller
{

	public function index($page = null)
	{
		$data['title']      = 'Semua Produk';
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
		$data['total_rows'] = $this->shop->where('product.is_available', 1)->where('delete', 1)->count();
		$data['gender']     = null;
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}


	public function men($page = null)
	{
		$data['title']      = 'Produk Pria';
		$data['content']    = $this->shop->select(
			[
				'product.id', 'product.title AS product_title',
				'product.image', 'product.price', 'product.slug As product_slug',
				'category.title AS category_title', 'category.slug AS category_slug'
			]
		)
			->join('category')
			->paginate($page)->where('type', 'L')->where('delete', 1)->get();
		$data['total_rows'] = $this->shop->where('type', 'L')->where('delete', 1)->count();
		$data['pagination'] = $this->shop->makePagination(
			base_url('shop/men'),
			3,
			$data['total_rows']
		);
		$data['gender']     = 'L';
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}

	public function women($page = null)
	{
		$data['title']      = 'Produk Wanita';
		$data['content']    = $this->shop->select(
			[
				'product.id', 'product.title AS product_title',
				'product.image', 'product.price', 'product.slug As product_slug',
				'category.title AS category_title', 'category.slug AS category_slug'
			]
		)
			->join('category')
			->paginate($page)->where('type', 'W')->where('delete', 1)->get();
		$data['total_rows'] = $this->shop->where('type', 'W')->where('delete', 1)->count();
		$data['pagination'] = $this->shop->makePagination(
			base_url('shop/women'),
			3,
			$data['total_rows']
		);
		$data['gender']     = 'W';
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}

	public function unisex($page = null)
	{
		$data['title']      = 'Produk Unisex';
		$data['content']    = $this->shop->select(
			[
				'product.id', 'product.title AS product_title',
				'product.image', 'product.price', 'product.slug As product_slug',
				'category.title AS category_title', 'category.slug AS category_slug'
			]
		)
			->join('category')
			->paginate($page)->where('type', 'U')->where('delete', 1)->get();
		$data['total_rows'] = $this->shop->where('type', 'U')->where('delete', 1)->count();
		$data['pagination'] = $this->shop->makePagination(
			base_url('shop/unisex'),
			3,
			$data['total_rows']
		);
		$data['gender']     = 'U';
		$data['page']       = 'pages/users/shop';

		$this->view($data);
	}

	public function category($category, $page = null)
	{
		// Get the sort value from the URL query parameter
		$sort = $this->input->get('sort');

		// Define the default sort order
		$sortOrder = ($sort == 'desc') ? 'desc' : 'asc';

		$data['title']      = 'Belanja';
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
		if (isset($_POST['keyword'])) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		} else {
			redirect(base_url('/'));
		}

		$keyword	= $this->session->userdata('keyword');
		$data['title']		= 'Pencarian: Produk';
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
			->like('product.title', $keyword)
			->orLike('product.description', $keyword)
			->paginate($page)
			->get();
		$data['total_rows']	= $this->shop->like('product.title', $keyword)->orLike('product.description', $keyword)->count();
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