<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function admin_only()
    {
        if (
            !$this->session->userdata('is_login')
            ||
            $this->session->userdata('role') != 'admin'
        )
        {
            redirect('admin/login');
        }
    }

    protected function render_admin($data = [])
    {
        $this->load->model('Setting_model');

        $setting = $this->Setting_model->get_setting();

        $data['store_setting'] = $setting;
        $data['admin_name'] = $this->session->userdata('name') ?: 'Admin';
        $data['admin_email'] = $this->session->userdata('email') ?: '';
        $data['site_name'] = ($setting && $setting->site_name) ? $setting->site_name : 'Parfume CMS';
        $data['site_logo'] = ($setting && !empty($setting->logo))
            ? base_url('uploads/settings/' . $setting->logo)
            : '';
        $data['site_favicon'] = ($setting && !empty($setting->favicon))
            ? base_url('uploads/settings/' . $setting->favicon)
            : '';

        $this->load->view('admin/layouts/app', $data);
    }
}
