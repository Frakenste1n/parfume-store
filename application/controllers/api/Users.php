<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Users extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    // GET BY ID
    public function index_get($id = null)
    {
        if ($id === null) {
            return $this->success_response(
                'Data user berhasil diambil',
                $this->User_model->get_all()
            );
        }

        $user = $this->User_model->find($id);

        if (!$user) {
            return $this->error_response('User tidak ditemukan');
        }

        return $this->success_response(
            'Detail user berhasil diambil',
            $user
        );
    }

    // CREATE
    public function index_post()
    {
        $data = [
            'name'  => $this->post('name'),
            'email' => $this->post('email'),
            'phone' => $this->post('phone'),
            'address' => $this->post('address'),
            'role' => $this->post('role') ?? 'user',
            'is_active' => 1,
            'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
        ];

        $this->User_model->create($data);

        return $this->success_response('User berhasil dibuat', null, 201);
    }

    // UPDATE
    public function index_put($id)
    {
        $user = $this->User_model->find($id);

        if (!$user) {
            return $this->error_response('User tidak ditemukan');
        }

        $data = [
            'name'  => $this->put('name') ?? $user->name,
            'email' => $this->put('email') ?? $user->email,
            'phone' => $this->put('phone') ?? $user->phone,
            'address' => $this->put('address') ?? $user->address,
            'role' => $this->put('role') ?? $user->role,
            'is_active' => $this->put('is_active') ?? $user->is_active,
        ];

        if ($this->put('password')) {
            $data['password'] = password_hash($this->put('password'), PASSWORD_DEFAULT);
        }

        $this->User_model->update($id, $data);

        return $this->success_response('User berhasil diupdate');
    }

    // DELETE
    public function index_delete($id)
    {
        $user = $this->User_model->find($id);

        if (!$user) {
            return $this->error_response('User tidak ditemukan');
        }

        $this->User_model->delete($id);

        return $this->success_response('User berhasil dihapus');
    }
}