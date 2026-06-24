<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    public function get_cart($user_id)
    {
        return $this->db
            ->select('
                cart_items.id,
                cart_items.qty,
                products.id as product_id,
                products.name,
                products.price,
                (cart_items.qty * products.price) as subtotal
            ')
            ->from('carts')
            ->join('cart_items','cart_items.cart_id = carts.id')
            ->join('products','products.id = cart_items.product_id')
            ->where('carts.user_id',$user_id)
            ->get()
            ->result();
    }

    public function get_or_create_cart($user_id)
    {
        $cart = $this->db
            ->where('user_id',$user_id)
            ->get('carts')
            ->row();

        if(!$cart)
        {
            $this->db->insert('carts',[
                'user_id'=>$user_id
            ]);

            return $this->db->insert_id();
        }

        return $cart->id;
    }

    public function add_item($cart_id,$product_id,$qty)
    {
        $item = $this->db
            ->where('cart_id',$cart_id)
            ->where('product_id',$product_id)
            ->get('cart_items')
            ->row();

        if($item)
        {
            return $this->db
                ->where('id',$item->id)
                ->update('cart_items',[
                    'qty'=>$item->qty + $qty
                ]);
        }

        return $this->db->insert('cart_items',[
            'cart_id'=>$cart_id,
            'product_id'=>$product_id,
            'qty'=>$qty
        ]);
    }

    public function remove_item($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete('cart_items');
    }

    public function clear_cart($cart_id)
    {
        return $this->db
            ->where('cart_id',$cart_id)
            ->delete('cart_items');
    }
}