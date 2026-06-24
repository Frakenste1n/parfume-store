<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting',
            'content' => 'admin/setting'
        ];

        $this->render_admin($data);
    }
}
