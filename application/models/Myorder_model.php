<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Myorder_model extends MY_Model
{

    public $table = "orders";

    public function getDefaultValues()
    {
        return [
            'id_orders'         => '',
            'account_name'      => '',
            'nominal'           => '',
            'note'              => '',
            'image'             => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'account_name',
                'label' => 'Nama pemilik',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nominal',
                'label' => 'Nominal',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'image',
                'label' => 'Bukti Transfer',
                'rules' => 'callback_image_required'
            ]
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $this->load->library('image_uploader');
        return $this->image_uploader->upload($fieldName, $fileName, './images/confirm', [
            'max_size' => 1024
        ]);
    }
}

/* End of file Myorder_model.php */