<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';
class Products extends Base_api
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('Product_image_model');
    }

    public function index_get()
    {
        return $this->success_response(
            'Data produk berhasil diambil',
            $this->Product_model->get_all()
        );
    }

    public function show_get($id)
    {
        $product = $this->Product_model->get_detail($id);

        if (!$product) {
            return $this->error_response(
                'Produk tidak ditemukan'
            );
        }

        $product->images = $this->Product_image_model
            ->get_by_product($id);

        return $this->success_response(
            'Detail produk',
            $product
        );
    }

    public function store_post()
    {
        $data = [
            'brand_id'=>$this->post('brand_id'),
            'category_id'=>$this->post('category_id'),
            'name'=>$this->post('name'),
            'slug'=>$this->post('slug'),
            'sku'=>$this->post('sku'),
            'price'=>$this->post('price'),
            'stock'=>$this->post('stock'),
            'short_description'=>$this->post('short_description'),
            'description'=>$this->post('description'),
            'is_featured'=>$this->post('is_featured'),
            'is_active'=>$this->post('is_active')
        ];

        $this->Product_model->create($data);

        return $this->success_response(
            'Produk berhasil ditambahkan'
        );
    }

    public function update_put($id)
    {
        $data = [
            'brand_id'=>$this->put('brand_id'),
            'category_id'=>$this->put('category_id'),
            'name'=>$this->put('name'),
            'slug'=>$this->put('slug'),
            'sku'=>$this->put('sku'),
            'price'=>$this->put('price'),
            'stock'=>$this->put('stock'),
            'short_description'=>$this->put('short_description'),
            'description'=>$this->put('description'),
            'is_featured'=>$this->put('is_featured'),
            'is_active'=>$this->put('is_active')
        ];

        $this->Product_model->update(
            $id,
            $data
        );

        return $this->success_response(
            'Produk berhasil diupdate'
        );
    }

    public function delete_delete($id)
    {
        if (!$this->Product_model->find($id))
        {
            return $this->error_response('Produk tidak ditemukan');
        }

        $result = $this->Product_model->delete($id);

        if ($result === 'used_in_order')
        {
            return $this->error_response(
                'Produk tidak dapat dihapus karena sudah digunakan di order'
            );
        }

        if (!$result)
        {
            return $this->error_response('Gagal menghapus produk');
        }

        return $this->success_response(
            'Produk berhasil dihapus'
        );
    }
}