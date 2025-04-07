<?php
class Iklan_model extends CI_Model {
    private $table = 'iklan'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_iklan($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_iklan_by_id_iklan($id_iklan) {
        return $this->db->get_where($this->table, ['id_iklan' => $id_iklan])->row();
    }

    public function get_iklan() {
        $this->db->order_by('id_iklan', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function update_iklan($id_iklan, $data) {
        $this->db->where('id_iklan', $id_iklan);
        return $this->db->update($this->table, $data);
    }

    public function delete_iklan($id_iklan) {
        $this->db->where('id_iklan', $id_iklan);
        return $this->db->delete($this->table);
    }

    public function count_iklan() {
        return $this->db->count_all_results($this->table);
    }
}
