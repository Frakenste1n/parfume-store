<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Test extends RestController {

    public function index_get()
    {
        $this->response([
            'status' => true,
            'message' => 'REST API berhasil'
        ], 200);
    }
}