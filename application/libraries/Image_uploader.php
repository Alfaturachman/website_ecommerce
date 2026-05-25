<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image_uploader
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function upload($fieldName, $fileName, $path, $config = [])
    {
        $defaultConfig = [
            'upload_path'       => $path,
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 20480,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $config = array_merge($defaultConfig, $config);

        $this->ci->load->library('upload', $config);

        if ($this->ci->upload->do_upload($fieldName)) {
            return $this->ci->upload->data();
        } else {
            $this->ci->session->set_flashdata('image_error', $this->ci->upload->display_errors('', ''));
            return false;
        }
    }

    public function delete($fileName, $path)
    {
        if (file_exists("$path/$fileName")) {
            unlink("$path/$fileName");
        }
    }
}
