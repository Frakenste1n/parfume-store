<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        $data = [
            'page_title' => 'Login',
            'page_css'   => 'auth.css',
            'page_js'    => 'login.js'
        ];

        $data['content'] =
            'customer/v_login';

        $this->load->view(
            'customer/layouts/app',
            $data
        );
    }

    public function register()
    {
        $data = [
            'page_title' => 'Register',
            'page_css'   => 'auth.css',
            'page_js'    => 'register.js'
        ];

        $data['content'] =
            'customer/v_register';

        $this->load->view(
            'customer/layouts/app',
            $data
        );
    }
}