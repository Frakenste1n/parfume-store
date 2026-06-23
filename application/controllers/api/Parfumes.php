<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Parfumes extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Parfume');
    }

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */
    public function index_get()
    {
        $data = $this->Parfume->getAll();

        $this->response([
            'status' => true,
            'data' => $data
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | GET DETAIL
    |--------------------------------------------------------------------------
    */
    public function detail_get($id)
    {
        $data = $this->Parfume->getById($id);

        if (!$data) {
            return $this->response([
                'status' => false,
                'message' => 'Parfume tidak ditemukan'
            ], 404);
        }

        $this->response([
            'status' => true,
            'data' => $data
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function index_post()
    {
        $name = $this->post('name');
        $brand_id = $this->post('brand_id');
        $price = $this->post('price');
        $stock = $this->post('stock');

        if (!$name || !$brand_id || !$price) {
            return $this->response([
                'status' => false,
                'message' => 'Nama, brand, dan price wajib diisi'
            ], 400);
        }

        $data = [
            'name' => $name,
            'brand_id' => $brand_id,
            'price' => $price,
            'stock' => $stock
        ];

        $insert = $this->Parfume->create($data);

        if ($insert) {
            return $this->response([
                'status' => true,
                'message' => 'Parfume berhasil ditambahkan'
            ], 201);
        }

        return $this->response([
            'status' => false,
            'message' => 'Gagal menambahkan parfume'
        ], 400);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function index_put($id)
    {
        if (!$id) {
            return $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);
        }

        $data = [
            'name' => $this->put('name'),
            'brand_id' => $this->put('brand_id'),
            'price' => $this->put('price'),
            'stock' => $this->put('stock')
        ];

        $update = $this->Parfume->update($id, $data);

        if ($update) {
            return $this->response([
                'status' => true,
                'message' => 'Parfume berhasil diupdate'
            ], 200);
        }

        return $this->response([
            'status' => false,
            'message' => 'Gagal update parfume'
        ], 400);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function index_delete($id)
    {
        if (!$id) {
            return $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);
        }

        $delete = $this->Parfume->delete($id);

        return $this->response([
            'status' => $delete,
            'message' => $delete ? 'Parfume berhasil dihapus' : 'Gagal hapus'
        ], $delete ? 200 : 400);
    }
}