<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title'   => 'Payment',
            'content' => 'admin/payment'
        ];

        $this->render_admin($data);
    }
}
