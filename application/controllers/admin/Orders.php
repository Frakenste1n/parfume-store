<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title'=>'Order',
            'content'=>'admin/orders'
        ];

        $this->render_admin($data);
    }
}