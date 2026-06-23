<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin');
    }

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        $admin = $this->Admin->getByEmail($email);

        if (!$admin) {

            $this->response([
                'status' => false,
                'message' => 'Email tidak ditemukan'
            ], 404);

            return;
        }

        if (!password_verify($password, $admin->password)) {

            $this->response([
                'status' => false,
                'message' => 'Password salah'
            ], 401);

            return;
        }

        $token = bin2hex(random_bytes(32));

        $this->Admin->updateToken(
            $admin->id,
            $token
        );

        $this->response([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email
            ]
        ], 200);
    }

    protected function check_token()
    {
        $token = $this->input->get_request_header('Authorization');

        if (!$token) {
            return false;
        }

        $token = str_replace('Bearer ', '', $token);

        $admin = $this->Admin->getByToken($token);

        return $admin ?: false;
    }
}