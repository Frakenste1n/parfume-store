<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        $data = [
            'page_title' => 'AURA',
            'page_css'   => 'home.css',
            'page_js'    => 'home.js',
            'content'    => 'customer/v_home'
        ];
    
        $this->load->view(
            'customer/layouts/app',
            $data
        );
    }
}