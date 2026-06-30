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
        $user_id = $this->post('user_id');
        $payment_method_id = $this->post('payment_method_id');
        $shipping_address = $this->post('shipping_address');

        if (!$user_id)
        {
            return $this->error_response('User ID wajib diisi', null, 422);
        }

        if (!$payment_method_id)
        {
            return $this->error_response('Metode pembayaran wajib dipilih', null, 422);
        }

        try
        {
            $order_id = $this->Order_model->checkout(
                $user_id,
                $payment_method_id,
                $shipping_address
            );

            if (!$order_id)
            {
                return $this->error_response('Checkout gagal. Silakan coba lagi.', null, 500);
            }

            return $this->success_response(
                'Checkout berhasil',
                [
                    'order_id' => $order_id
                ]
            );
        }
        catch (Exception $e)
        {
            log_message('error', 'Checkout error: ' . $e->getMessage());
            return $this->error_response('Terjadi kesalahan saat memproses checkout: ' . $e->getMessage(), null, 500);
        }
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
