<?php
class unggulan_model extends CI_Model {
    private $table = 'unggulan'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_unggulan($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_unggulan_by_id_unggulan($id_unggulan) {
        return $this->db->get_where($this->table, ['id_unggulan' => $id_unggulan])->row();
    }

    public function get_unggulan_by_nama_unggulan($nama_unggulan) {
        return $this->db->get_where($this->table, ['nama_unggulan' => $nama_unggulan])->row();
    }

    public function get_unggulan() {
        $this->db->order_by('id_unggulan', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function update_unggulan($id_unggulan, $data) {
        $this->db->where('id_unggulan', $id_unggulan);
        return $this->db->update($this->table, $data);
    }

    public function delete_unggulan($id_unggulan) {
        $this->db->where('id_unggulan', $id_unggulan);
        return $this->db->delete($this->table);
    }

    public function count_unggulan() {
        return $this->db->count_all_results($this->table);
    }
}
