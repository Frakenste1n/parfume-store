<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct()
    {
        parent::__construct();

        $this->load->library('session'); 
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'admin/dashboard';

         $data['admin_name'] = $this->session->userdata('admin_name');

        $this->load->view('admin/layouts/app', $data);
    }
}