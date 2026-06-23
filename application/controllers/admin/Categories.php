<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Admin - Categories';
        $data['content'] = 'admin/category';

        $this->load->view('admin/layouts/app', $data);
    }
}