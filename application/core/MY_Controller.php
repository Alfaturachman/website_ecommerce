<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $model = strtolower(get_class($this));
        if (file_exists(APPPATH . 'models/' . ucfirst($model) . '_model.php'))
        {
            $this->load->model(ucfirst($model) . '_model', $model, true);
        }
    }

    protected function _requireLogin()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url(), 'refresh');
            return false;
        }
        return true;
    }

    protected function _requireAdmin()
    {
        if (!$this->session->userdata('username')) {
            redirect('admin');
            return false;
        }
        return true;
    }

    protected function _flash($type, $message)
    {
        $this->session->set_flashdata($type, $message);
    }

    public function viewAdmin($data)
    {
        $this->load->view('layouts/admin/app', $data);
    }

    public function view($data)
    {
        $this->load->view('layouts/user/app', $data);
    }
}

/* End of file MY_Controller.php */
