<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Payments extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Payment');
    }

    /*
    GET /api/payments
    GET /api/payments?id=1
    */

    public function index_get()
    {
        $id = $this->get('id');

        if ($id) {

            $data = $this->Payment->get_by_id($id);

            if (!$data) {
                return $this->response([
                    'status' => false,
                    'message' => 'Payment method tidak ditemukan'
                ], RestController::HTTP_NOT_FOUND);
            }

            return $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        }

        $data = $this->Payment->get_all();

        return $this->response([
            'status' => true,
            'data' => $data
        ], RestController::HTTP_OK);
    }

    public function detail_get($id = null)
{
    if (!$id) {
        return $this->response([
            'status' => false,
            'message' => 'ID wajib diisi'
        ], 400);
    }

    $payment = $this->Payment->get_by_id($id);

    if (!$payment) {
        return $this->response([
            'status' => false,
            'message' => 'Payment tidak ditemukan'
        ], 404);
    }

    return $this->response([
        'status' => true,
        'data' => $payment
    ], 200);
}

    /*
    POST /api/payments
    */

    public function index_post()
    {
        $data = [
            'name' => $this->post('name'),
            'account_name' => $this->post('account_name'),
            'account_number' => $this->post('account_number'),
            'logo' => $this->post('logo'),
            'is_active' => $this->post('is_active') ?? 1
        ];

        $insert = $this->Payment->insert($data);

        if ($insert) {

            return $this->response([
                'status' => true,
                'message' => 'Payment method berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        }

        return $this->response([
            'status' => false,
            'message' => 'Gagal menambahkan payment method'
        ], RestController::HTTP_BAD_REQUEST);
    }

    /*
    PUT /api/payments?id=1
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

    if ($this->put('account_name')) {
        $data['account_name'] = $this->put('account_name');
    }

    if ($this->put('account_number')) {
        $data['account_number'] = $this->put('account_number');
    }

    if ($this->put('logo')) {
        $data['logo'] = $this->put('logo');
    }

    $this->Payment->update($id, $data);

    return $this->response([
        'status' => true,
        'message' => 'Payment berhasil diupdate'
    ], 200);
}

    /*
    DELETE /api/payments?id=1
    */

    public function index_delete($id = null)
{
    if (!$id) {
        return $this->response([
            'status' => false,
            'message' => 'ID wajib diisi'
        ], 400);
    }

    $this->Payment->delete($id);

    return $this->response([
        'status' => true,
        'message' => 'Payment berhasil dihapus'
    ], 200);
}
}