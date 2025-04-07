<?php
class Galeri_model extends CI_Model {
    private $table = 'galeri'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_galeri($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_galeri_by_id_galeri($id_galeri) {
        return $this->db->get_where($this->table, ['id_galeri' => $id_galeri])->row();
    }

    public function get_galeri_by_id_wisata($id_wisata) {
        return $this->db->get_where($this->table, ['wisata' => $id_wisata])->result();
    }

    public function get_galeri() {
        $this->db->order_by('id_galeri', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function update_galeri($id_galeri, $data) {
        $this->db->where('id_galeri', $id_galeri);
        return $this->db->update($this->table, $data);
    }

    public function delete_galeri($id_galeri) {
        $this->db->where('id_galeri', $id_galeri);
        return $this->db->delete($this->table);
    }

    public function count_galeri() {
        return $this->db->count_all_results($this->table);
    }
}
