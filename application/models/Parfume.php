<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parfume extends CI_Model
{

    private $table = 'parfume';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
{
    $this->db->select('parfume.*, brands.name as brand_name, brands.logo as brand_logo');
    $this->db->from('parfume');
    $this->db->join('brands', 'brands.id = parfume.brand_id', 'left');
    $this->db->where('parfume.id', $id);

    return $this->db->get()->row();
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

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }
}