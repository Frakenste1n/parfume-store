<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'core/Base_api.php';
class Auth extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function register_post()
    {
        $email = $this->post('email');

        $user = $this->Auth_model->find_by_email($email);

        if ($user) {
            return $this->error_response('Email sudah digunakan');
        }

        $data = [
            'name' => $this->post('name'),
            'email' => $email,
            'password' => password_hash($this->post('password'), PASSWORD_BCRYPT),
            'phone' => $this->post('phone'),
            'address' => $this->post('address'),
            'role' => 'customer'
        ];

        $this->Auth_model->register($data);

        return $this->success_response('Register berhasil');
    }

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        $user = $this->Auth_model->find_by_email($email);

        if (!$user) {
            return $this->error_response('Email tidak ditemukan');
        }

        if (!password_verify($password, $user->password)) {
            return $this->error_response('Password salah');
        }

        unset($user->password);

        return $this->success_response(
            'Login berhasil',
            $user
        );
    }
}