<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function get_admin()
    {
        return $this->db->get('admin')->result();
    }

    public function get_admin_by_id_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->get('admin')->row();
    }

    public function insert_admin($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function update_admin($id_admin, $data)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->update('admin', $data);
    }

    public function delete_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->delete('admin');
    }

    public function count_admin()
    {
        return $this->db->count_all('admin');
    }
}
