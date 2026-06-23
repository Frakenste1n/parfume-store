<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Users extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User', 'User');
    }

    /*
    |--------------------------------------------------------------------------
    | GET ALL USERS
    |--------------------------------------------------------------------------
    */
    public function index_get()
    {
        $users = $this->User->getAll();

        $this->response([
            'status' => true,
            'data' => $users
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | GET DETAIL USER
    |--------------------------------------------------------------------------
    */
    public function detail_get($id = null)
    {
        if (!$id) {
            return $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);
        }

        $user = $this->User->getDetail($id);

        if (!$user) {
            return $this->response([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $this->response([
            'status' => true,
            'data' => $user
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE USER (REGISTER)
    |--------------------------------------------------------------------------
    */
    public function index_post()
    {
        $name     = $this->post('name');
        $email    = $this->post('email');
        $password = $this->post('password');

        if (!$name || !$email || !$password) {
            return $this->response([
                'status' => false,
                'message' => 'Data wajib diisi'
            ], 400);
        }

        // hash password
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];

        $id = $this->User->create($data);

        $this->response([
            'status' => true,
            'message' => 'User berhasil dibuat',
            'user_id' => $id
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */
    public function index_put($id = null)
    {
        if (!$id) {
            return $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);
        }

        $data = [];

        if ($this->put('name')) {
            $data['name'] = $this->put('name');
        }

        if ($this->put('email')) {
            $data['email'] = $this->put('email');
        }

        if ($this->put('password')) {
            $data['password'] = password_hash($this->put('password'), PASSWORD_BCRYPT);
        }

        $this->User->update($id, $data);

        $this->response([
            'status' => true,
            'message' => 'User berhasil diupdate'
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */
    public function index_delete($id = null)
    {
        if (!$id) {
            return $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);
        }

        $this->User->delete($id);

        $this->response([
            'status' => true,
            'message' => 'User berhasil dihapus'
        ], 200);
    }
}