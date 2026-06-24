<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Base_api extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    protected function success_response($message, $data = null, $code = 200)
    {
        $this->response([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error_response($message)
    {
        $this->response([
            'success' => false,
            'message' => $message
        ], 200);
    }
}