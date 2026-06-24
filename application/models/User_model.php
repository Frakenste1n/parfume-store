<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'users';

    public function get_all()
    {
        return $this->db
            ->select('id,name,email,phone,address,role,is_active,created_at')
            ->order_by('id','DESC')
            ->get($this->table)
            ->result();
    }

    public function find($id)
    {
        return $this->db
            ->select('id,name,email,phone,address,role,is_active,created_at')
            ->where('id',$id)
            ->get($this->table)
            ->row();
    }

    public function find_by_email($email)
    {
        return $this->db
            ->where('email',$email)
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
}