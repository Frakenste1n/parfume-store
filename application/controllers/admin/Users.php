<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'content' => 'admin/user'
        ];

        $this->render_admin($data);
    }
}
