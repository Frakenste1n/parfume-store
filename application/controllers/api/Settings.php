<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Settings extends RestController {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Setting', 'Setting');
    }

    public function index_get()
    {
        $data = $this->Setting->getSettings();

        $this->response([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function index_post()
    {
        $data = [
            'site_name' => $this->post('site_name'),
            'logo' => $this->post('logo'),
            'favicon' => $this->post('favicon'),
            'about_us' => $this->post('about_us'),
            'founder_name' => $this->post('founder_name'),
            'founder_photo' => $this->post('founder_photo'),
            'whatsapp' => $this->post('whatsapp'),
            'instagram' => $this->post('instagram'),
            'email' => $this->post('email'),
            'address' => $this->post('address'),
            'featured_title' => $this->post('featured_title'),
            'featured_subtitle' => $this->post('featured_subtitle'),
        ];

        $updated = $this->Setting->updateSettings($data);

        $this->response([
            'status' => $updated,
            'message' => $updated ? 'success' : 'failed'
        ], 200);
    }
}
