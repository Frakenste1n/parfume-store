<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';
class Carts extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
    }

    public function index_get()
    {
        $user_id = $this->get('user_id');

        return $this->success_response(
            'Cart berhasil diambil',
            $this->Cart_model->get_cart($user_id)
        );
    }

    public function store_post()
    {
        $user_id=$this->post('user_id');

        $cart_id=$this->Cart_model
            ->get_or_create_cart($user_id);

        $this->Cart_model->add_item(
            $cart_id,
            $this->post('product_id'),
            $this->post('qty')
        );

        return $this->success_response(
            'Produk berhasil ditambahkan ke cart'
        );
    }

    public function delete_delete($id)
    {
        $this->Cart_model->remove_item($id);

        return $this->success_response(
            'Produk berhasil dihapus'
        );
    }
}