<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Founder_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($active_only = FALSE)
    {
        $this->db->order_by('id', 'ASC');

        if ($active_only)
        {
            $this->db->where('is_active', TRUE);
        }

        return $this->db->get('founders')->result();
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get('founders')->row();
    }

    public function create($data)
    {
        $this->db->insert('founders', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update('founders', $data);
        return $this->db->affected_rows() > 0;
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete('founders');
        return $this->db->affected_rows() > 0;
    }

    public function toggle_active($id, $is_active)
    {
        $this->db->where('id', $id)->update('founders', ['is_active' => $is_active]);
        return $this->db->affected_rows() > 0;
    }
}
