<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {

    private $table = 'admin';

    public function getByEmail($email)
    {
        return $this->db
            ->get_where($this->table, [
                'email' => $email
            ])
            ->row();
    }

    public function updateToken($id, $token)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, [
                'token' => $token
            ]);
    }

    public function getByToken($token)
    {
        return $this->db
            ->get_where($this->table, [
                'token' => $token
            ])
            ->row();
    }
}