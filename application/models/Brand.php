<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Model {

    private $table = 'brands';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function active()
    {
        return $this->db->where('is_active', 1)->get($this->table)->result();
    }

    public function featured()
    {
        return $this->db->where('is_featured', 1)->get($this->table)->result();
    }
}