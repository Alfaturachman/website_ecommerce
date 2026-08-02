<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    private $id;

    public function __construct()
    {
        parent::__construct();
        $this->id = $this->session->userdata('id');
        $this->_requireLogin();
    }

    public function index()
    {
        $data['title']      = 'Keranjang Belanja';
        $data['content']    = $this->cart->select([
            'cart.id', 'cart.quantity', 'cart.message', 'cart.sub_total',
            'product.title', 'product.image', 'product.price'
        ])
            ->join('product')
            ->where('id_user', $this->id)
            ->get();
        $data['page']       = 'pages/users/cart';

        return $this->view($data);
    }

    public function add()
    {
        if (!$_POST || $this->input->post('quantity') < 1) {
            redirect(base_url());
        } else {
            $input = (object) $this->input->post(null, true);

            $this->cart->table = 'product';
            $product = $this->cart->where('id', $input->id_product)->first();

            $subtotal = $product->price * $input->quantity;

            $this->cart->table = 'cart';
            $cart = $this->cart->where('id_user', $this->id)->where('id_product', $input->id_product)->first();

            if ($cart) {
                // Produk sudah ada di keranjang, tidak perlu menambah kuantitas
                $this->session->set_flashdata('warning', 'Barang sudah ada di keranjang.');
                redirect(base_url("shop/detail/$product->slug"));
            }

            // Produk belum ada di keranjang, tambahkan
            $data = [
                'id_user' => $this->id,
                'id_product' => $input->id_product,
                'quantity' => $input->quantity,
                'message' => $input->message,
                'sub_total' => $subtotal
            ];

            if ($this->cart->create($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
            }

            redirect(base_url("shop/detail/$product->slug"));
        }
    }

    public function isProductInCart($id)
    {
        $cart = $this->cart->where('id_user', $this->id)
            ->where('id_product', $id)
            ->get();

        $isProductInCart = $cart ? true : false;

        echo json_encode(['isProductInCart' => $isProductInCart]);
    }

    public function update($id)
    {
        if (!$_POST || $this->input->post('quantity') < 1) {
            $this->session->set_flashdata('error', 'Kuantitas tidak boleh kosong');
            redirect(base_url('cart'));
        }

        $this->cart->table = 'cart';
        $data['content'] = $this->cart->where('id', $id)->where('id_user', $this->id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect(base_url('cart'));
        }

        $data['input']      = (object) $this->input->post(null, true);

        $this->cart->table  = 'product';
        $product            = $this->cart->where('id', $data['content']->id_product)->first();

        $subtotal           =  $data['input']->quantity * $product->price;

        $cart = [
            'quantity'  => $data['input']->quantity,
            'sub_total' => $subtotal
        ];

        $this->cart->table  = 'cart';
        if ($this->cart->where('id', $id)->where('id_user', $this->id)->update($cart)) {
            $this->session->set_flashdata('success', 'Keranjang berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url("cart"));
    }

    public function updateMessage($id)
    {
        if (!$_POST) {
            $this->session->set_flashdata('error', 'Data tidak ada!');
            redirect(base_url('cart'));
        }

        $this->cart->table  = 'cart';
        $data['content'] = $this->cart->where('id', $id)->where('id_user', $this->id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect(base_url('cart'));
        }

        $data['input']      = (object) $this->input->post(null, true);

        $cart = [
            'message'  => $data['input']->message
        ];

        if ($this->cart->where('id', $id)->where('id_user', $this->id)->update($cart)) {
            $this->session->set_flashdata('success', 'Pesan berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url("cart"));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('cart'));
        }

        $this->cart->table = 'cart';
        if (!$this->cart->where('id', $id)->where('id_user', $this->id)->first()) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
            redirect(base_url('cart'));
        }

        if ($this->cart->where('id', $id)->where('id_user', $this->id)->delete()) {
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan.');
        }

        redirect(base_url('cart'));
    }
}

/* End of file Cart.php */