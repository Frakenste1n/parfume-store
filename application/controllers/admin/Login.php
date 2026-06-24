<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->model('Setting_model');

        $setting = $this->Setting_model->get_setting();

        $data = [
            'site_name'    => ($setting && $setting->site_name) ? $setting->site_name : 'Parfume CMS',
            'site_logo'    => ($setting && !empty($setting->logo))
                ? base_url('uploads/settings/' . $setting->logo)
                : '',
            'site_favicon' => ($setting && !empty($setting->favicon))
                ? base_url('uploads/settings/' . $setting->favicon)
                : ''
        ];

        $this->load->view('admin/login', $data);
    }

    public function store()
    {
        $user = [
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role'),
            'is_login' => true
        ];

        $this->session->set_userdata($user);

        echo json_encode([
            'success'=>true
        ]);
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('admin/login');
    }
}