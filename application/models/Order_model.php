<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends MY_Model
{
    public $table = 'orders';

    public function getAllOrdersWithDetails()
    {
        $this->db->select('orders.*, SUM(order_detail.sub_total) AS total_subtotal');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.id = order_detail.id_orders', 'left');
        $this->db->group_by('orders.id');
        return $this->db->get()->result();
    }
}

/* End of file Order_model.php */