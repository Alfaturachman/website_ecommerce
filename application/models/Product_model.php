<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends MY_Model
{
    protected $perPage = 8;

    public function getDefaultValues()
    {
        return [
            'id_category'   => '',
            'slug'          => '',
            'title'         => '',
            'description'   => '',
            'size'          => '',
            'color'         => '',
            'type'          => '',
            'price'         => '',
            'is_available'  => 1,
            'image'         => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_category',
                'label' => 'Kategori',
                'rules' => 'required'
            ],
            [
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|callback_unique_slug'
            ],
            [
                'field' => 'title',
                'label' => 'Nama Produk',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'size',
                'label' => 'Ukuran',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'color',
                'label' => 'Warna',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'type',
                'label' => 'Tipe',
                'rules' => 'required'
            ],
            [
                'field' => 'price',
                'label' => 'Harga',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'is_available',
                'label' => 'Ketersediaan',
                'rules' => 'required'
            ]
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $this->load->library('image_uploader');
        return $this->image_uploader->upload($fieldName, $fileName, './images/product');
    }

    public function deleteImage($fileName)
    {
        $this->load->library('image_uploader');
        $this->image_uploader->delete($fileName, './images/product');
    }
}

/* End of file Product_model.php */