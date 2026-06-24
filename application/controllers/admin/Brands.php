<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title' => 'Brand',
            'content' => 'admin/brand'
        ];

        $this->render_admin($data);
    }
}