<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Categories extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Category');
    }

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function index_get()
    {
        $data = $this->Category->getAll();

        return $this->response([
            'status' => true,
            'data'   => $data
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | GET DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail_get($id = null)
    {
        if (!$id) {

            return $this->response([
                'status'  => false,
                'message' => 'ID wajib diisi'
            ], 400);

        }

        $data = $this->Category->getById($id);

        if (!$data) {

            return $this->response([
                'status'  => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);

        }

        return $this->response([
            'status' => true,
            'data'   => $data
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function index_post()
    {
        $category_name = trim($this->post('category_name'));

        if (empty($category_name)) {

            return $this->response([
                'status'  => false,
                'message' => 'Nama kategori wajib diisi'
            ], 400);

        }

        $data = [
            'category_name' => $category_name
        ];

        $insert = $this->Category->create($data);

        if (!$insert) {

            return $this->response([
                'status'  => false,
                'message' => 'Gagal menambahkan kategori'
            ], 400);

        }

        return $this->response([
            'status'  => true,
            'message' => 'Kategori berhasil ditambahkan'
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function index_put($id = null)
    {
        if (!$id) {

            return $this->response([
                'status'  => false,
                'message' => 'ID wajib diisi'
            ], 400);

        }

        $category = $this->Category->getById($id);

        if (!$category) {

            return $this->response([
                'status'  => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);

        }

        $category_name = trim($this->put('category_name'));

        if (empty($category_name)) {

            return $this->response([
                'status'  => false,
                'message' => 'Nama kategori wajib diisi'
            ], 400);

        }

        $data = [
            'category_name' => $category_name
        ];

        $update = $this->Category->update($id, $data);

        if (!$update) {

            return $this->response([
                'status'  => false,
                'message' => 'Gagal update kategori'
            ], 400);

        }

        return $this->response([
            'status'  => true,
            'message' => 'Kategori berhasil diupdate'
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function index_delete($id = null)
    {
        if (!$id) {

            return $this->response([
                'status'  => false,
                'message' => 'ID wajib diisi'
            ], 400);

        }

        $category = $this->Category->getById($id);

        if (!$category) {

            return $this->response([
                'status'  => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);

        }

        $delete = $this->Category->delete($id);

        if (!$delete) {

            return $this->response([
                'status'  => false,
                'message' => 'Gagal menghapus kategori'
            ], 400);

        }

        return $this->response([
            'status'  => true,
            'message' => 'Kategori berhasil dihapus'
        ], 200);
    }
}