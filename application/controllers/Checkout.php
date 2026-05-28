<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{
    private $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('rajaongkir');
        $this->id = $this->session->userdata('id');
        $this->_requireLogin();
    }

    public function index($input = null)
    {
        $this->checkout->table = 'cart';

        // Fetch user data based on the user ID
        $userData = $this->db->where('id', $this->id)
            ->get('user')
            ->row();

        $data['cart']      = $this->checkout->select([
            'cart.id', 'cart.quantity', 'cart.sub_total',
            'product.title', 'product.image', 'product.price'
        ])
            ->join('product')
            ->where('cart.id_user', $this->id)
            ->get();

        if (!$data['cart']) {
            $this->session->set_flashdata('warning', 'Tidak ada produk di dalam keranjang.');
            redirect(base_url('cart'));
        }

        $data['provinces'] = json_decode($this->rajaongkir->province(), true);

        // Set the default value for the 'name' input field
        $data['input']     = $input ? $input : (object) array_merge(
            $this->checkout->getDefaultValues(),
            ['name' => $userData->name],
            ['phone' => $userData->phone ?? ''],
            ['address' => $userData->address ?? '']
        );

        $data['title']     = "Checkout";
        $data['page']      = "pages/users/checkout";

        $this->view($data);
    }
    public function create()
    {
        if (!$this->input->post()) {
            $this->session->set_flashdata('error', 'No POST data received!');
            error_log('No POST data received.');
            redirect(base_url('checkout'));
        } else {
            $input = (object) $this->input->post(null, true);
        }

        $id_kabupaten = $this->input->post('kabupaten');
        $id_provinsi = $this->input->post('provinsi');
        $diskonpersen = $this->input->post('discountPercentage');
        $diskon = $this->input->post('diskon');
        $shippingCost = $this->input->post('shippingCost');
        $totalBelanja = $this->input->post('totalBelanja');
        error_log('Shipping Cost: ' . $shippingCost);
        error_log('Total Belanja: ' . $totalBelanja);
        $courier = $input->courier;

        // Get province name
        $province = json_decode($this->rajaongkir->province((int) $id_provinsi), true);
        $provinceName = $province['rajaongkir']['results']['province'];

        // Get city name
        $cityState = json_decode($this->rajaongkir->city((int) $id_provinsi, (int) $id_kabupaten), true);
        $cityName = $cityState['rajaongkir']['results']['city_name'];

        // Prepare data for order creation
        $data = [
            'id_user'       => $this->id,
            'date'          => date('Y-m-d'),
            'invoice'       => $this->id . date('YmdHis'),
            'diskon_persen' => $diskonpersen,
            'diskon'        => $diskon,
            'total'         => $totalBelanja,
            'name'          => $input->name,
            'address'       => $input->address,
            'city'          => $cityName,
            'province'      => $provinceName,
            'phone'         => $input->phone,
            'courier'       => $courier,
            'cost_courier'  => $shippingCost,
            'status'        => 'waiting'
        ];

        // Create order and order details
        if ($order = $this->checkout->create($data)) {
            $cart = $this->db->where('id_user', $this->id)
                ->get('cart')->result_array();

            foreach ($cart as $row) {
                $row['id_orders'] = $order;
                unset($row['id'], $row['id_user']);
                $this->db->insert('order_detail', $row);
            }

            // Clear the user's cart
            $this->db->delete('cart', ['id_user' => $this->id]);

            // Display success message
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');

            $data['title']      = 'Checkout Success';
            $data['content']    = (object) $data;
            $data['page']       = 'pages/users/success';

            $this->view($data);
        } else {
            // Display error message
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan.');
            return $this->index($input);
        }
    }

    public function rajaongkir_cek_kabupaten()
    {
        $provinsi_id = $this->input->get('provinsi');

        if (empty($provinsi_id)) {
            echo "<option value=''>Provinsi ID is required.</option>";
            return;
        }

        $response = json_decode($this->rajaongkir->city($provinsi_id), true);

        if (isset($response['rajaongkir']['results']) && is_array($response['rajaongkir']['results'])) {
            echo "<option value=''>- Pilih Kabupaten / Kota -</option>";
            foreach ($response['rajaongkir']['results'] as $result) {
                echo "<option value='" . $result['city_id'] . "'>" . $result['city_name'] . "</option>";
            }
        } else {
            echo "<option value=''>No cities available.</option>";
        }
    }

    public function rajaongkir_cek_ongkir()
    {
        $id_kabupaten = $this->input->get('kabupaten');
        $courier = $this->input->get('courier');

        $weightTotal = $this->db->select_sum('quantity')
            ->where('id_user', $this->id)
            ->get('cart')
            ->row()
            ->quantity;

        $berat = $weightTotal * 250;
        $cost = json_decode($this->rajaongkir->cost(152, $id_kabupaten, $berat, $courier), true);

        log_message('debug', 'RajaOngkir API Response: ' . json_encode($cost));

        $ongkirResults = 0;
        if (isset($cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'])) {
            $ongkirResults = $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        }

        if (isset($cost['rajaongkir']['status']) && $cost['rajaongkir']['status']['code'] != 200) {
            log_message('error', 'RajaOngkir API Error: ' . json_encode($cost['rajaongkir']['status']));
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(['shipping_cost' => $ongkirResults]));
    }
}

/* End of file Checkout.php */