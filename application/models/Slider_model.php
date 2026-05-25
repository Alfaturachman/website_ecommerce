<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Slider_model extends MY_Model
{

    protected $perPage = 6;

    public function getDefaultValues()
    {
        return [
            'title'     => '',
            'sequence'  => '',
            'image'     => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'title',
                'label' => 'Judul Slider',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'sequence',
                'label' => 'Urutan Slider',
                'rules' => 'trim|required|numeric|callback_unique_slug'
            ]
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $this->load->library('image_uploader');
        return $this->image_uploader->upload($fieldName, $fileName, './images/slider', [
            'allowed_types' => 'jpg|png|jpeg|JPG|PNG',
            'max_height'    => 500
        ]);
    }

    public function deleteImage($fileName)
    {
        $this->load->library('image_uploader');
        $this->image_uploader->delete($fileName, './images/slider');
    }
}

/* End of file Slider_model.php */