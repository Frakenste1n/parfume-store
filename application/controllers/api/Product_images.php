<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';
class Product_images extends Base_api
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_image_model');
    }

    public function store_post()
    {
        $upload = upload_image(
            'image',
            './uploads/products/'
        );

        if (!$upload['success']) {
            return $this->error_response(
                $upload['message']
            );
        }

        $data = [
            'product_id'=>$this->post('product_id'),
            'image'=>$upload['file_name'],
            'is_primary'=>$this->post('is_primary')
        ];

        $this->Product_image_model->create($data);

        return $this->success_response(
            'Gambar berhasil ditambahkan'
        );
    }

    public function delete_delete($id)
    {
        $this->Product_image_model->delete($id);

        return $this->success_response(
            'Gambar berhasil dihapus'
        );
    }
}