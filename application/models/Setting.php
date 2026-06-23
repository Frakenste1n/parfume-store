<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Model {

    private $table = 'settings';

    // GET SETTINGS
    public function getSettings()
    {
        return $this->db
            ->get($this->table)
            ->row();
    }

    // UPDATE SETTINGS
    public function updateSettings($data)
    {
        return $this->db
            ->where('id', 1)
            ->update($this->table, $data);
    }
}