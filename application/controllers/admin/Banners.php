<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title'   => 'Banner',
            'content' => 'admin/banner'
        ];

        $this->render_admin($data);
    }
}
