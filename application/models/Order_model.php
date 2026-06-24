<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function checkout(
        $user_id,
        $payment_method_id
    )
    {
        $this->db->trans_begin();

        $cart = $this->db
            ->where('user_id',$user_id)
            ->get('carts')
            ->row();

        if(!$cart)
        {
            return false;
        }

        $items = $this->db
            ->select('
                cart_items.qty,
                products.*
            ')
            ->from('cart_items')
            ->join(
                'products',
                'products.id=cart_items.product_id'
            )
            ->where('cart_id',$cart->id)
            ->get()
            ->result();

        $subtotal=0;

        foreach($items as $item)
        {
            $subtotal += ($item->qty * $item->price);
        }

        $order_number='ORD'.date('YmdHis');

        $this->db->insert('orders',[
            'user_id'=>$user_id,
            'order_number'=>$order_number,
            'subtotal'=>$subtotal,
            'grand_total'=>$subtotal,
            'payment_status'=>'pending'
        ]);

        $order_id=$this->db->insert_id();

        foreach($items as $item)
        {
            $this->db->insert('order_items',[
                'order_id'=>$order_id,
                'product_id'=>$item->id,
                'product_name'=>$item->name,
                'price'=>$item->price,
                'qty'=>$item->qty,
                'subtotal'=>$item->qty * $item->price
            ]);

            $this->db
                ->where('id',$item->id)
                ->set(
                    'stock',
                    'stock-'.$item->qty,
                    false
                )
                ->update('products');
        }

        $this->db->insert('payment_transactions',[
            'order_id'=>$order_id,
            'payment_method_id'=>$payment_method_id,
            'amount'=>$subtotal
        ]);

        $this->db->insert('order_status_histories',[
            'order_id'=>$order_id,
            'status'=>'pending',
            'description'=>'Pesanan dibuat'
        ]);

        $this->db
            ->where('cart_id',$cart->id)
            ->delete('cart_items');

        if($this->db->trans_status()===FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();

        return $order_id;
    }

    public function get_orders()
    {
        return $this->db
            ->select('orders.*, users.name')
            ->from('orders')
            ->join('users','users.id=orders.user_id')
            ->order_by('orders.id','DESC')
            ->get()
            ->result();
    }

    public function get_order($id)
    {
        return $this->db
            ->select('orders.*, users.name, users.email, users.phone')
            ->from('orders')
            ->join('users', 'users.id = orders.user_id')
            ->where('orders.id', $id)
            ->get()
            ->row();
    }

    public function get_order_items($order_id)
    {
        return $this->db
            ->where('order_id', $order_id)
            ->get('order_items')
            ->result();
    }

    public function update_payment_status($id, $status)
    {
        $updated = $this->db
            ->where('id', $id)
            ->update('orders', [
                'payment_status' => $status
            ]);

        if ($updated)
        {
            $this->db->insert('order_status_histories', [
                'order_id'    => $id,
                'status'      => $status,
                'description' => 'Status pembayaran diupdate'
            ]);
        }

        return $updated;
    }

    public function delete_order($id)
    {
        $this->db->trans_begin();

        $this->db->where('order_id', $id)->delete('order_items');
        $this->db->where('order_id', $id)->delete('payment_transactions');
        $this->db->where('order_id', $id)->delete('order_status_histories');
        $this->db->where('id', $id)->delete('orders');

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();

        return true;
    }
}
