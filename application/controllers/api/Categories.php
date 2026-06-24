<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';
class Categories extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    }

    public function index_get()
    {
        return $this->success_response(
            'Data category berhasil diambil',
            $this->Category_model->get_all()
        );
    }

    public function show_get($id)
    {
        $category = $this->Category_model->find($id);

        if (!$category) {
            return $this->error_response(
                'Data tidak ditemukan'
            );
        }

        return $this->success_response(
            'Detail category',
            $category
        );
    }

    public function store_post()
    {
        $data = [
            'name'=>$this->post('name'),
            'slug'=>$this->post('slug'),
            'description'=>$this->post('description'),
            'is_active'=>$this->post('is_active')
        ];

        $this->Category_model->create($data);

        return $this->success_response(
            'Category berhasil ditambahkan'
        );
    }

    public function update_put($id)
    {
        $data = [
            'name'=>$this->put('name'),
            'slug'=>$this->put('slug'),
            'description'=>$this->put('description'),
            'is_active'=>$this->put('is_active')
        ];

        $this->Category_model->update(
            $id,
            $data
        );

        return $this->success_response(
            'Category berhasil diupdate'
        );
    }

    public function delete_delete($id)
    {
        $this->Category_model->delete($id);

        return $this->success_response(
            'Category berhasil dihapus'
        );
    }
}