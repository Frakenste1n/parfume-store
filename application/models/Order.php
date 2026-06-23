<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {

    public function createOrder($data)
    {
        $this->db->insert('orders', $data);

        return $this->db->insert_id();
    }

    public function createOrderItem($data)
    {
        return $this->db->insert('order_items', $data);
    }

    public function getAll()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get('orders')
            ->result();
    }

    public function getDetail($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('orders')
            ->row();
    }

    public function getItems($order_id)
    {
        return $this->db
            ->select('
                order_items.*,
                parfume.name,
                parfume.image
            ')
            ->from('order_items')
            ->join(
                'parfume',
                'parfume.id = order_items.parfume_id'
            )
            ->where('order_items.order_id', $order_id)
            ->get()
            ->result();
    }
}