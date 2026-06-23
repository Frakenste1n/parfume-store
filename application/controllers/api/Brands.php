<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Brands extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand', 'Brand');
    }

    // GET ALL
    public function index_get()
    {
        $data = $this->Brand->getAll();

        $this->response([
            'status' => true,
            'data' => $data
        ], 200);
    }

    // DETAIL
    public function show_get($id = null)
    {
        $data = $this->Brand->getById($id);

        if (!$data) {
            $this->response([
                'status' => false,
                'message' => 'Brand not found'
            ], 404);
            return;
        }

        $this->response([
            'status' => true,
            'data' => $data
        ], 200);
    }

    // CREATE
    public function index_post()
    {
        $logo = $this->uploadLogo();


        if ($logo === false) {
            $this->response([
                'status' => false,
                'message' => strip_tags($this->upload->display_errors())
            ], 400);
            return;
        }

        $data = [
            'name' => $this->post('name'),
            'logo' => $logo,
            'description' => $this->post('description'),
            'website' => $this->post('website'),
            'instagram' => $this->post('instagram'),
            'origin_country' => $this->post('origin_country'),
            'is_featured' => $this->post('is_featured') ?? 0,
            'is_active' => $this->post('is_active') ?? 1,
        ];

        $this->Brand->create($data);

        $this->response([
            'status' => true,
            'message' => 'Brand created'
        ], 201);


    }


    // UPDATE
    public function update_post($id)
    {
        $brand = $this->Brand->getById($id);


        if (!$brand) {
            $this->response([
                'status' => false,
                'message' => 'Brand not found'
            ], 404);
            return;
        }

        $logo = $this->uploadLogo();

        if ($logo === false) {
            $this->response([
                'status' => false,
                'message' => strip_tags($this->upload->display_errors())
            ], 400);
            return;
        }

        if ($logo) {

            $oldFile = FCPATH . 'uploads/brands/' . $brand->logo;

            if (!empty($brand->logo) && file_exists($oldFile)) {
                unlink($oldFile);
            }

        } else {
            $logo = $brand->logo;
        }

        $data = [
            'name' => $this->post('name'),
            'logo' => $logo,
            'description' => $this->post('description'),
            'website' => $this->post('website'),
            'instagram' => $this->post('instagram'),
            'origin_country' => $this->post('origin_country'),
            'is_featured' => $this->post('is_featured'),
            'is_active' => $this->post('is_active'),
        ];

        $this->Brand->update($id, $data);

        $this->response([
            'status' => true,
            'message' => 'Brand updated'
        ], 200);

    }


    // DELETE
    public function delete_post($id)
{
    $brand = $this->Brand->getById($id);

    if (!$brand) {
        $this->response([
            'status' => false,
            'message' => 'Brand not found'
        ], 404);
        return;
    }

    if (!empty($brand->logo)) {

        $file = FCPATH.'uploads/brands/'.$brand->logo;

        if(file_exists($file)){
            unlink($file);
        }

    }

    $this->Brand->delete($id);

    $this->response([
        'status' => true,
        'message' => 'Brand deleted successfully'
    ], 200);
}


    // FEATURED
    public function featured_get()
    {
        $data = $this->Brand->featured();

        $this->response([
            'status' => true,
            'data' => $data
        ], 200);
    }

    private function uploadLogo()
    {
        if (empty($_FILES['logo']['name'])) {
            return null;
        }

        $path = FCPATH . 'uploads/brands/';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['encrypt_name'] = true;
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('logo')) {
            return false;
        }

        $file = $this->upload->data();

        return $file['file_name'];

    }

}