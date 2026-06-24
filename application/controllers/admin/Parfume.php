<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parfume extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->admin_only();
    }

    public function index()
    {
        $data = [
            'title' => 'Parfume',
            'content' => 'admin/parfume'
        ];

        $this->render_admin($data);
    }
}
