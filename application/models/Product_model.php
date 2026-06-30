<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    protected $table = 'products';

    public function get_all()
    {
        return $this->db
            ->select('
                products.*,
                brands.name as brand_name,
                categories.name as category_name,
                (
                    SELECT pi.image
                    FROM product_images pi
                    WHERE pi.product_id = products.id
                    ORDER BY pi.is_primary DESC, pi.id ASC
                    LIMIT 1
                ) as primary_image
            ')
            ->from('products')
            ->join('brands', 'brands.id = products.brand_id')
            ->join('categories', 'categories.id = products.category_id')
            ->order_by('products.id', 'DESC')
            ->get()
            ->result();
    }

    public function get_detail($id)
    {
        return $this->db
            ->select('
                products.*,
                brands.name AS brand_name,
                categories.name AS category_name
            ')
            ->from('products')
            ->join('brands', 'brands.id=products.brand_id')
            ->join('categories', 'categories.id=products.category_id')
            ->where('products.id', $id)
            ->get()
            ->row();
    }

    public function find($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function has_order_items($id)
    {
        return $this->db
            ->where('product_id', $id)
            ->count_all_results('order_items') > 0;
    }

    public function delete($id)
    {
        if ($this->has_order_items($id))
        {
            return 'used_in_order';
        }

        $images = $this->db
            ->where('product_id', $id)
            ->get('product_images')
            ->result();

        foreach ($images as $image)
        {
            $path = FCPATH . 'uploads/products/' . $image->image;

            if (is_file($path))
            {
                unlink($path);
            }
        }

        $this->db->where('product_id', $id)->delete('product_images');
        $this->db->where('product_id', $id)->delete('cart_items');

        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }

    public function get_featured_home($limit = 8)
    {
        return $this->db
            ->select('
                products.*,
                brands.name as brand_name,
                categories.name as category_name,
                (
                    SELECT pi.image
                    FROM product_images pi
                    WHERE pi.product_id = products.id
                    ORDER BY pi.is_primary DESC, pi.id ASC
                    LIMIT 1
                ) as thumbnail
            ')
            ->from('products')
            ->join('brands', 'brands.id = products.brand_id')
            ->join('categories', 'categories.id = products.category_id')
            ->where('products.is_active', 1)
            ->where('products.is_featured', 1)
            ->order_by('products.id', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    public function search($keyword, $limit = 50)
    {
        $keyword = trim((string) $keyword);

        if ($keyword === '')
        {
            return [];
        }

        return $this->db
            ->select('
                products.*,
                brands.name as brand_name,
                categories.name as category_name,
                (
                    SELECT pi.image
                    FROM product_images pi
                    WHERE pi.product_id = products.id
                    ORDER BY pi.is_primary DESC, pi.id ASC
                    LIMIT 1
                ) as thumbnail
            ')
            ->from('products')
            ->join('brands', 'brands.id = products.brand_id')
            ->join('categories', 'categories.id = products.category_id')
            ->where('products.is_active', 1)
            ->group_start()
                ->like('products.name', $keyword)
                ->or_like('products.short_description', $keyword)
                ->or_like('products.description', $keyword)
                ->or_like('brands.name', $keyword)
                ->or_like('categories.name', $keyword)
            ->group_end()
            ->order_by('products.id', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }
}
