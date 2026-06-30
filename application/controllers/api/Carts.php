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

        $items = $this->Cart_model->get_cart($user_id);

        return $this->success_response(
            'Cart berhasil diambil',
            [
                'items' => $items
            ]
        );
    }

    public function store_post()
    {
        $user_id = $this->post('user_id');
        $product_id = $this->post('product_id');
        $qty = $this->post('qty');

        if (!$user_id || !$product_id || !$qty)
        {
            return $this->error_response(
                'Data tidak lengkap'
            );
        }

        try
        {
            $cart_id = $this->Cart_model
                ->get_or_create_cart($user_id);

            $this->Cart_model->add_item(
                $cart_id,
                $product_id,
                $qty
            );

            return $this->success_response(
                'Produk berhasil ditambahkan ke cart'
            );
        }
        catch (Exception $e)
        {
            return $this->error_response(
                'Gagal menambahkan ke cart: ' . $e->getMessage()
            );
        }
    }

    public function delete_delete($id)
    {
        $this->Cart_model->remove_item($id);

        return $this->success_response(
            'Produk berhasil dihapus'
        );
    }

    public function update_put($id)
    {
        $qty = $this->put('qty');

        if (!$qty || $qty < 1)
        {
            return $this->error_response('Quantity minimal 1');
        }

        $this->Cart_model->update_item_qty($id, $qty);

        return $this->success_response(
            'Quantity berhasil diupdate'
        );
    }
}