<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_method_model extends CI_Model
{
    private $table = 'payment_methods';

    public function get_all()
    {
        return $this->db
            ->where('is_active', 1)
            ->get($this->table)
            ->result();
    }

    public function get_all_admin()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result();
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

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }
}
