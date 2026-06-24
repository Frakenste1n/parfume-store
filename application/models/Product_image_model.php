<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_image_model extends CI_Model
{
    private $table = 'product_images';

    public function get_by_product($product_id)
    {
        return $this->db
            ->where('product_id',$product_id)
            ->order_by('is_primary','DESC')
            ->get($this->table)
            ->result();
    }

    public function create($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete($this->table);
    }
}