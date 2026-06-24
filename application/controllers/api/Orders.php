<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Orders extends Base_api
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Order_model');
    }

    public function index_get()
    {
        return $this->success_response(
            'Data order berhasil diambil',
            $this->Order_model->get_orders()
        );
    }

    public function show_get($id)
    {
        $order = $this->Order_model->get_order($id);

        if (!$order)
        {
            return $this->error_response('Order tidak ditemukan');
        }

        $order->items = $this->Order_model->get_order_items($id);

        return $this->success_response(
            'Detail order',
            $order
        );
    }

    public function store_post()
    {
        $order_id = $this->Order_model->checkout(
            $this->post('user_id'),
            $this->post('payment_method_id')
        );

        if(!$order_id)
        {
            return $this->error_response(
                'Checkout gagal'
            );
        }

        return $this->success_response(
            'Checkout berhasil',
            [
                'order_id'=>$order_id
            ]
        );
    }

    public function update_put($id)
    {
        $status = $this->put('payment_status');

        if (!$status)
        {
            return $this->error_response('Status pembayaran wajib diisi');
        }

        if (!$this->Order_model->get_order($id))
        {
            return $this->error_response('Order tidak ditemukan');
        }

        $this->Order_model->update_payment_status($id, $status);

        return $this->success_response(
            'Status order berhasil diupdate',
            $this->Order_model->get_order($id)
        );
    }

    public function delete_delete($id)
    {
        if (!$this->Order_model->get_order($id))
        {
            return $this->error_response('Order tidak ditemukan');
        }

        if (!$this->Order_model->delete_order($id))
        {
            return $this->error_response('Gagal menghapus order');
        }

        return $this->success_response(
            'Order berhasil dihapus'
        );
    }
}
