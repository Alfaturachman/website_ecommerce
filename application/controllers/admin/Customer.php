<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Customer_model', 'user');
        $this->_requireAdmin();
    }


    public function index($page = null)
    {
        $data['title']      = "Admin: Customer";
        $data['content']    = $this->user->select(
            ['user.id', 'user.name AS user_name', 'user.email AS user_email', 'user.image']
        )
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->user->count();
        $data['pagination'] = $this->user->makePagination(
            base_url('admin/customer'),
            3,
            $data['total_rows']
        );
        $data['page'] = 'pages/admin/customer/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        if ($this->input->post('keyword')) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        }

        $keyword = $this->session->userdata('keyword');

        if (!$keyword) {
            redirect(base_url('admin/customer'));
            return;
        }

        $data['title']      = 'Admin User';
        $data['content']    = $this->user->select(
            ['user.id', 'user.name AS user_name', 'user.email AS user_email', 'user.image']
        )
            ->like('user.name', $keyword)
            ->orLike('user.email', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->user->like('user.name', $keyword)->orLike('user.email', $keyword)->count();
        $data['pagination'] = $this->user->makePagination(base_url('admin/customer/search'), 4, $data['total_rows']);
        $data['page']       = 'pages/admin/customer/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('admin/customer'));
    }

    public function create()
    {
        $input = (object) $this->input->post(null, true);

        if (!$this->user->validate()) {
            $data['title']      = "Tambah Customer";
            $data['input']      = $input;
            $data['form_action'] = base_url('admin/customer/create');
            $data['page'] = 'pages/admin/customer/form';

            $this->viewAdmin($data);
            return;
        }

        $data = [
            'name'          => $input->name,
            'email'         => strtolower($input->email),
            'password'      => password_hash($input->password, PASSWORD_DEFAULT),
            'date_register' => time()
        ];

        if ($this->user->create($data)) {
            $this->session->set_flashdata("success", "Data berhasil disimpan!");
        } else {
            $this->session->set_flashdata("error", "Opps! terjadi kesalahan.");
        }

        redirect(base_url('admin/customer'));
    }

    public function edit($id)
    {
        $data['content'] = $this->user->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf, data tidak ditemukan!');
            redirect(base_url('admin/customer'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, false);
        }

        $validationRules = $this->user->getValidationRules();

        // Check if the email is being updated
        if ($data['input']->email !== $data['content']->email) {
            $validationRules[] = [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|valid_email|is_unique[user.email]',
                'error' => [
                    'is_unique' => 'This %s already exists.'
                ]
            ];
        }

        // Check if the password is being updated
        if ($data['input']->password) {
            $validationRules[] = [
                'field' => 'password_confirmation',
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]'
            ];
        }

        $this->form_validation->set_rules($validationRules);

        if ($this->form_validation->run() == false) {
            $data['title']      = "Ubah Customer";
            $data['form_action'] = base_url("admin/customer/edit/$id");
            $data['page']       = 'pages/admin/customer/form';

            $this->viewAdmin($data);
            return;
        }

        // Include 'name', 'email', and 'password' in the data you update in the database
        $dataToUpdate = [
            'name' => $data['input']->name
        ];

        if ($data['input']->email !== $data['content']->email) {
            $dataToUpdate['email'] = strtolower($data['input']->email);
        }

        if ($data['input']->password) {
            $dataToUpdate['password'] = password_hash($data['input']->password, PASSWORD_DEFAULT);
        }

        if ($this->user->where('id', $id)->update($dataToUpdate)) {
            $this->session->set_flashdata("success", "Data berhasil disimpan!");
        } else {
            $this->session->set_flashdata("error", "Opps! terjadi kesalahan.");
        }

        redirect(base_url('admin/customer'));
    }



    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('admin/customer'));
        }

        $user = $this->user->where('id', $id)->first();
        if (!$user) {
            $this->session->set_flashdata('warning', 'Maaf, data tidak ditemukan!');
            redirect(base_url('admin/customer'));
        }

        // Menambahkan klausa where pada penggunaan metode delete
        if ($this->user->where('id', $id)->delete()) {
            $this->session->set_flashdata("success", "Data berhasil dihapus!");
        } else {
            $this->session->set_flashdata("error", "Opps! terjadi kesalahan.");
        }

        redirect(base_url('admin/customer'));
    }
}

/* End of file Product.php */