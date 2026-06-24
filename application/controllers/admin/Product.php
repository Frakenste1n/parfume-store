<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title'=>'Product',
            'content'=>'admin/product'
        ];

        $this->render_admin($data);
    }
}