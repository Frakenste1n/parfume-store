<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';
class Brands extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model');
    }

    public function index_get()
    {
        $data = $this->Brand_model->get_all();

        return $this->success_response(
            'Data brand berhasil diambil',
            $data
        );
    }

    public function show_get($id)
    {
        $brand = $this->Brand_model->find($id);

        if (!$brand) {
            return $this->error_response('Data tidak ditemukan');
        }

        return $this->success_response(
            'Detail brand',
            $brand
        );
    }

    public function store_post()
    {
        $data = [
            'name'=>$this->post('name'),
            'slug'=>$this->post('slug'),
            'description'=>$this->post('description'),
            'website'=>$this->post('website'),
            'instagram'=>$this->post('instagram'),
            'origin_country'=>$this->post('origin_country'),
            'is_featured'=>$this->post('is_featured'),
            'is_active'=>$this->post('is_active')
        ];

        if (!empty($_FILES['logo']['name'])) {

            $upload = upload_image(
                'logo',
                './uploads/brands/'
            );

            if (!$upload['success']) {
                return $this->error_response(
                    $upload['message']
                );
            }

            $data['logo'] = $upload['file_name'];
        }

        $this->Brand_model->create($data);

        return $this->success_response(
            'Brand berhasil ditambahkan'
        );
    }

    public function update_put($id)
    {
        $data = [
            'name'=>$this->put('name'),
            'slug'=>$this->put('slug'),
            'description'=>$this->put('description'),
            'website'=>$this->put('website'),
            'instagram'=>$this->put('instagram'),
            'origin_country'=>$this->put('origin_country'),
            'is_featured'=>$this->put('is_featured'),
            'is_active'=>$this->put('is_active')
        ];

        $this->Brand_model->update(
            $id,
            $data
        );

        return $this->success_response(
            'Brand berhasil diupdate'
        );
    }

    public function delete_delete($id)
    {
        $this->Brand_model->delete($id);

        return $this->success_response(
            'Brand berhasil dihapus'
        );
    }
}