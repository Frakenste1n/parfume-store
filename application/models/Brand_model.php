<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model
{
    protected $table = 'brands';

    public function get_all()
    {
        return $this->db
            ->order_by('id','DESC')
            ->get($this->table)
            ->result();
    }

    public function find($id)
    {
        return $this->db
            ->where('id',$id)
            ->get($this->table)
            ->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function update($id,$data)
    {
        return $this->db
            ->where('id',$id)
            ->update($this->table,$data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete($this->table);
    }

    public function get_home_brands()
{
    return $this->db
        ->where('is_active',1)
        ->order_by('is_featured','DESC')
        ->limit(8)
        ->get('brands')
        ->result();
}
}