<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parfume extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE VIEW
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data = [
            'title' => 'Admin - Parfume Management',
            'content' => 'admin/parfume'
        ];

        $this->load->view('admin/layouts/app', $data);
    }
}