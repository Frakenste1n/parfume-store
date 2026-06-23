<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Users';
        $data['content'] = 'admin/user';

        $this->load->view('admin/layouts/app', $data);
    }
}