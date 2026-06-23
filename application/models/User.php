<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    public function getAll()
    {
        return $this->db->get('user')->result();
    }

    public function getDetail($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row();
    }

    public function create($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('user', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('user', ['id' => $id]);
    }
}