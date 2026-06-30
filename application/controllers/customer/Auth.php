<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        $this->render_auth_page('Login', 'login.js', 'customer/v_login');
    }

    public function register()
    {
        $this->render_auth_page('Register', 'register.js', 'customer/v_register');
    }

    private function render_auth_page($title, $js, $content)
    {
        $this->load->model('Setting_model');
        $setting = $this->Setting_model->get_setting();

        $data = [
            'page_title' => ($setting && $setting->site_name) ? $setting->site_name . ' — ' . $title : $title,
            'page_css'   => 'auth.css',
            'page_js'    => $js,
            'content'    => $content,
            'site_name'  => ($setting && $setting->site_name) ? $setting->site_name : 'Parfume Store',
            'site_logo'  => ($setting && !empty($setting->logo))
                ? base_url('uploads/settings/' . $setting->logo)
                : '',
            'site_favicon' => ($setting && !empty($setting->favicon))
                ? base_url('uploads/settings/' . $setting->favicon)
                : ''
        ];

        $this->load->view('customer/layouts/app', $data);
    }
}
