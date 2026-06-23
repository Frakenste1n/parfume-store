<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Orders extends RestController {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Order');
    }

    /*
    |--------------------------------------------------------------------------
    | GET ALL ORDERS
    |--------------------------------------------------------------------------
    */

    public function index_get()
    {
        $orders = $this->Order->getAll();

        $this->response([
            'status' => true,
            'data'   => $orders
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE ORDER
    |--------------------------------------------------------------------------
    */

    public function index_post()
    {
        $user_id = $this->post('user_id');
        $items   = $this->post('items');

        if (!$user_id) {

            $this->response([
                'status' => false,
                'message' => 'User wajib diisi'
            ], 400);

            return;
        }

        if (!$items || count($items) == 0) {

            $this->response([
                'status' => false,
                'message' => 'Items wajib diisi'
            ], 400);

            return;
        }

        $total_price = 0;

        $order_items = [];

        /*
        |--------------------------------------------------------------------------
        | LOOP ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($items as $item) {

            $query = $this->db->get_where('parfume', [
                'id' => $item['parfume_id']
            ]);

            $parfume = $query->row();

            if (!$parfume) {

                $this->response([
                    'status' => false,
                    'message' => 'Parfume tidak ditemukan'
                ], 404);

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | CEK STOCK
            |--------------------------------------------------------------------------
            */

            if ($parfume->stock < $item['qty']) {

                $this->response([
                    'status' => false,
                    'message' => 'Stock tidak mencukupi'
                ], 400);

                return;
            }

            $subtotal = $parfume->price * $item['qty'];

            $total_price += $subtotal;

            $order_items[] = [
                'parfume_id' => $parfume->id,
                'qty'        => $item['qty'],
                'subtotal'   => $subtotal
            ];

            /*
            |--------------------------------------------------------------------------
            | UPDATE STOCK
            |--------------------------------------------------------------------------
            */

            $new_stock = $parfume->stock - $item['qty'];

            $this->db->where('id', $parfume->id);

            $this->db->update('parfume', [
                'stock' => $new_stock
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $order_id = $this->Order->createOrder([
            'user_id'     => $user_id,
            'total_price' => $total_price,
            'status'      => 'pending'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($order_items as $item) {

            $item['order_id'] = $order_id;

            $this->Order->createOrderItem($item);
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        $this->response([
            'status'      => true,
            'message'     => 'Order berhasil dibuat',
            'order_id'    => $order_id,
            'total_price' => $total_price
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | GET DETAIL ORDER
    |--------------------------------------------------------------------------
    */

    public function detail_get($id = null)
    {
        if (!$id) {

            $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);

            return;
        }

        $order = $this->Order->getDetail($id);

        if (!$order) {

            $this->response([
                'status' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);

            return;
        }

        $items = $this->Order->getItems($id);

        $order->items = $items;

        $this->response([
            'status' => true,
            'data'   => $order
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS ORDER
    |--------------------------------------------------------------------------
    */

    public function status_put($id = null)
    {
        if (!$id) {

            $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);

            return;
        }

        $status = $this->put('status');

        $allowed_status = [
            'pending',
            'paid',
            'shipped',
            'completed'
        ];

        if (!in_array($status, $allowed_status)) {

            $this->response([
                'status' => false,
                'message' => 'Status tidak valid'
            ], 400);

            return;
        }

        $this->db->where('id', $id);

        $this->db->update('orders', [
            'status' => $status
        ]);

        $this->response([
            'status' => true,
            'message' => 'Status order berhasil diupdate'
        ], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ORDER
    |--------------------------------------------------------------------------
    */

    public function index_delete($id = null)
    {
        if (!$id) {

            $this->response([
                'status' => false,
                'message' => 'ID wajib diisi'
            ], 400);

            return;
        }

        $this->db->delete('order_items', [
            'order_id' => $id
        ]);

        $this->db->delete('orders', [
            'id' => $id
        ]);

        $this->response([
            'status' => true,
            'message' => 'Order berhasil dihapus'
        ], 200);
    }
}