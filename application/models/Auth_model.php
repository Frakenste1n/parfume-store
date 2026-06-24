<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    private $table = 'users';

    public function register($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function find_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->get($this->table)
            ->row();
    }

    public function update_token($id, $token)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, [
                'token' => $token
            ]);
    }
}