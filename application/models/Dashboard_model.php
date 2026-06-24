<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function total_users()
    {
        return $this->db->count_all('users');
    }

    public function total_brands()
    {
        return $this->db->count_all('brands');
    }

    public function total_categories()
    {
        return $this->db->count_all('categories');
    }

    public function total_products()
    {
        return $this->db->count_all('products');
    }

    public function total_orders()
    {
        return $this->db->count_all('orders');
    }

    public function total_revenue()
    {
        return $this->db
            ->select_sum('grand_total')
            ->where('payment_status','paid')
            ->get('orders')
            ->row()
            ->grand_total ?? 0;
    }

    public function latest_orders()
    {
        return $this->db
            ->select('orders.*,users.name')
            ->from('orders')
            ->join('users','users.id=orders.user_id')
            ->order_by('orders.id','DESC')
            ->limit(5)
            ->get()
            ->result();
    }
}