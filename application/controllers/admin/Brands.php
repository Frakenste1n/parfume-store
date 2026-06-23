<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Admin - Brand Management';
        $data['admin_name'] = 'Administrator';
        $data['content'] = 'admin/brand';

        $this->load->view('admin/layouts/app', $data);
    }
}