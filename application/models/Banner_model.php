<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model
{
    private $table = 'banners';

    public function get_all()
    {
        return $this->db
            ->order_by('sort_order','ASC')
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

    public function get_active_banner()
{
    return $this->db
        ->where('is_active',1)
        ->order_by('sort_order','ASC')
        ->get('banners')
        ->result();
}
}